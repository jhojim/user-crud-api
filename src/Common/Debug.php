<?php

namespace SRC\Common;

class Debug
{
    private static $data = [];

    public static function enabled()
    {
        if (isset($_REQUEST['debug']) && $_REQUEST['debug']) {
            if (PHP_OS=='WINNT') {
                return true;
            }
            if ($_REQUEST['debug']=='secret') {
                return true;
            }
        }
        return false;
    }

    public static function get()
    {
        return self::$data;
    }

    public static function add($key, $value)
    {
        $keys = is_array($key) ? $key : explode('.', $key);
        $member = array_pop($keys);

        // Truncate long keys
        if ((int)@$_REQUEST['debug']<=1 && strlen($member)>120) {
            $member = substr($member, 0, 118) . "...";
        }

        $val = &self::$data;
        foreach ($keys as $subkey) {
            if (!isset($val[$subkey])) {
                $val[$subkey] = [];
            }
            $val = &$val[$subkey];
        }

        // Make val an array if this is the 2nd value we get for it
        if (isset($val[$member]) && !is_array($val[$member])) {
            $val[$member] = [$val[$member]];
        }
        if (isset($val[$member]) && is_array($val[$member])) {
            $val[$member] []= $value;
        } else {
            $val[$member] = $value;
        }

        return $val;
    }

    // Returns a DebugTimer object
    public static function startTimer($key)
    {
        if (func_num_args()>1) {
            $key = func_get_args();
        }

        $timer = new DebugTimer($key);
        return $timer;
    }

    public static function endTimer($key, $time)
    {
        if ($key) {
            self::add($key, $time);
        }
    }
}