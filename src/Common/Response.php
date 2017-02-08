<?php
namespace SRC\Common;

class Response
{
    public static function format($obj)
    {
        if (!$obj) {
            return '';
        }

        if (Debug::enabled()) {
            if (is_object($obj)) {
                $obj = clone $obj;
                $obj->debug = Debug::get();
            } elseif (is_array($obj)) {
                $obj['debug'] = Debug::get();
            }

            return json_encode($obj, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
        }

        if (@$_REQUEST['pretty']) {
            return json_encode($obj, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
        } else {
            return json_encode($obj, JSON_UNESCAPED_SLASHES);
        }
    }


    public static function success($results = null)
    {
        $obj = (object)[
            //'success' => 1
        ];
        if (is_string($results)) {
            $obj->message = $results;
        } elseif (is_array($results) && isset($results['results']) && is_array($results['results'])) {
            foreach ($results as $key => $val) {
                $obj->$key = $val;
            }
        } elseif (is_object($results) && isset($results->results) && is_array($results->results)) {
            foreach ($results->results as $key => $val) {
                $obj->$key = $val;
            }
        } elseif (is_null($results)) {
            $obj->results = true;
        } else {
            $obj->results = $results;
        }

        return (new \Slim\Http\Response())->withStatus(200)->write(self::format($obj));
    }


    public static function error($status, $messages = false)
    {
        $obj = (object)[
            'error' => 1,
        ];
        if ($messages) {
            if (is_string($messages) && func_num_args()>2) {
                $args = func_get_args();
                array_shift($args); // $status
                $format = array_shift($args);
                $messages = [vsprintf($format, $args)];
            } elseif (is_object($messages)) {
                $messages = (array)$messages;
            }
            if (!is_array($messages)) {
                $messages = [$messages];
            }
            $obj->messages = $messages;
        } else {
            $obj->messages = ['Unspecified error'];
        }

        return (new \Slim\Http\Response())->withStatus($status)->write(self::format($obj));
    }
}
