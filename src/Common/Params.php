<?php

namespace SRC\Common;

use SRC\Exception\InvalidParametersException;
use SRC\Exception\ParametersConfigurationException;

class Params
{
    private $params = [];
    private $values = [];
    private $options = [];
    private $errors = [];

    const ANY = 'any';
    const NUMBER = 'number';
    const STRING = 'string';
    const TIME = 'time';
    const JSON = 'json';
    const NUMBER_CSV = 'number_csv';
    const STRING_CSV = 'string_csv';
    const ARR = 'array';

    // Initializes and parses parameters
    // $values can either be an object, array, SRC\Action instance or Slim\Http\Request instance
    // $options is an array of parameters to be parsed with options, eg:
    // [
    //   'from' => ['type'=>'time', 'default'=>'-24hours'],
    //   'to' => ['type'=>'time', 'default'=>'now'],
    //   'postid' => ['type'=>'int', 'default'=>0xFFFFFFFF],
    //   'service' => ['type'=>'string', 'default'=>''],
    // ]
    // Supported types: int, string, array, json, time, any
    public function __construct($values, $options)
    {
        if (!is_array($options) || !count($options)) {
            throw new ParametersConfigurationException();
        }

        // If we got passed a SRC\Action, get all possible params from that in url,get,post order
        if (is_a($values, 'SRC\Common\Action')) {
            $action = $values;
            $values = $action->getAllArguments();
            // If we got passed a Request, get query params
        } elseif (is_a($values, 'Slim\Http\Request')) {
            $req = $values;
            $values = $req->getQueryParams();
        }

        $this->values = (array) $values;
        $this->options = $options;
        $this->params = $this->parseAll();

        if ($this->hasErrors()) {
            throw new InvalidParametersException($this->getErrors());
        }
    }

    // Gets a param by name
    public function get($name = false)
    {
        if ($name == false) {
            return $this->params;
        }

        return isset($this->params[$name]) ? $this->params[$name] : null;
    }

    // Same as above but directly, eg $params->something
    public function __get($name)
    {
        return $this->get($name);
    }

    // Check if there were any parameter errors
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    // Returns an array of error messages
    public function getErrors()
    {
        return count($this->errors) ? $this->errors : false;
    }

    // Parses all parameters, returns array of [$key=>$val, $key2=>$val2]
    private function parseAll()
    {
        $failValue = '___invalidvalue'.mt_rand();

        $values = [];
        foreach ($this->options as $name => $paramOptions) {
            if (!is_object($paramOptions)) {
                $paramOptions = (object) $paramOptions;
            }

            $paramOptions->name = $name;
            $paramOptions->error = false;
            $value = self::parseParam(@$this->values[$name], $paramOptions, $failValue);

            if ($value === $failValue) {
                if ($paramOptions->error) {
                    $error = sprintf('%s: %s', $name, $paramOptions->error);
                } else {
                    $error = sprintf('%s: Invalid value', $name);
                }

                $this->errors [] = $error;
            } else {
                $values[$name] = $value;
            }
        }

        return $values;
    }

    // Parse a single parameter
    private function parseParam($value, $options, $failValue = null)
    {
        if (!is_object($options)) {
            $options = (object) $options;
        }
        $options->error = false;

        $parsedValue = $failValue;

        // If no value given, set default (if given)
        if ($value === null && isset($options->default)) {
            $value = $options->default;
        }

        if ($value !== null) {
            $givenValue = $value;
            if (!isset($options->type)) {
                $options->type = 'any';
            }

            switch ($options->type) {
                case self::NUMBER:
                    if (is_numeric($givenValue)) {
                        $parsedValue = (double) $givenValue;
                    } else {
                        $options->error = sprintf("'%s' Is not a number", $givenValue);
                    }
                    break;

                case self::STRING:
                    $parsedValue = (string) $givenValue;
                    break;

                case self::TIME:
                    $tmp = self::parseTime($givenValue);
                    if ($tmp !== false) {
                        $parsedValue = $tmp;
                    } else {
                        $options->error = sprintf("Could not parse '%s'", $givenValue);
                    }
                    break;

                case self::JSON:
                    $tmp = @json_decode($givenValue);
                    if ($tmp !== false) {
                        $parsedValue = $tmp;
                    } else {
                        $options->error = 'JSON error';
                    }
                    break;

                case self::ARR:
                    if (is_array($givenValue)) {
                        $parsedValue = $givenValue;
                    } else {
                        $options->error = 'Not an array';
                    }
                    break;

                case self::NUMBER_CSV:
                case self::STRING_CSV:
                    $values = str_getcsv((string) $givenValue);
                    if (empty($givenValue) || !count($values)) {
                        if (isset($options->default)) {
                            $values = [];
                        } else {
                            $options->error = 'Cannot be empty';
                            break;
                        }
                    }
                    foreach ($values as &$value) {
                        if (strlen($value) == 0) {
                            $options->error = 'Contains an empty value';
                            break;
                        }
                        // For int_csv, check if we actually got an integer value
                        if ($options->type == self::NUMBER_CSV) {
                            if (!ctype_digit($value)) {
                                $options->error = 'Contains a non-integer value';
                                break;
                            }
                            $value = (int) $value;
                        }
                    }
                    if ($options->error) {
                        break;
                    }
                    $parsedValue = $values;
                    break;

                case self::ANY:
                    $parsedValue = $givenValue;
                    break;

                default:
                    $options->error = "Unsupported param type $options->type";
                    break;
            }
        }

        // Check min/max values
        if ((!$options->error) &&
            (
                (isset($options->min) && $parsedValue < $options->min) ||
                (isset($options->max) && $parsedValue > $options->max)
            )
        ) {
            $options->error = 'Value is out of range';
            $parsedValue = $failValue;
        }

        if (!$options->error && isset($options->allowed)) {
            if (is_array($parsedValue)) {
                foreach ($parsedValue as $arrayValue) {
                    if (!in_array($arrayValue, $options->allowed)) {
                        $options->error = 'Invalid value, allowed values are '.implode(', ', $options->allowed);
                        $parsedValue = $failValue;
                        break;
                    }
                }
            } elseif (!in_array($parsedValue, $options->allowed)) {
                $options->error = 'Invalid value, allowed values are '.implode(', ', $options->allowed);
                $parsedValue = $failValue;
            }
        }

        // Check if array values are unique
        if (!$options->error
            && isset($options->unique)
            && $options->unique
            && is_array($parsedValue)
            && count(array_unique($parsedValue))!=count($parsedValue)
        ) {
            $options->error = 'Values must be unique';
            $parsedValue = $failValue;
        }

        return $parsedValue;
    }

    // Parses a date/time into a timestamp
    // Takes either a timestamp or a strtotime() compatible string
    public static function parseTime($str, $defaultValue = false)
    {
        if (strlen($str)) {
            // Timestamp
            if (is_numeric($str)) {
                return (double) $str;
            }

            // Convert abbreviations like 24h to full strings, eg 24hours
            $str = preg_replace('/([0-9])s$/', '\\1seconds', $str);
            $str = preg_replace('/([0-9])h$/', '\\1hours', $str);
            $str = preg_replace('/([0-9])m$/', '\\1minutes', $str);
            $str = preg_replace('/([0-9])d$/', '\\1days', $str);
            $str = preg_replace('/([0-9])w$/', '\\1weeks', $str);
            $str = preg_replace('/([0-9])y$/', '\\1years', $str);

            // Parse time
            // Something might have overwritten the default TZ, so make sure we actually use UTC while parsing
            $saveTz = date_default_timezone_get();
            date_default_timezone_set('UTC');
            $ts = @strtotime($str);
            date_default_timezone_set($saveTz);
            if ($ts !== false) {
                return $ts;
            }
        }

        return $defaultValue;
    }
}
