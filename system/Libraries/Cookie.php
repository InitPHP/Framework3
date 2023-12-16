<?php

namespace InitPHP\Framework\Libraries;

class Cookie
{

    /** @var \InitPHP\Cookies\Cookie[] */
    protected static array $segments = [];

    public function __get(string $name)
    {
        return self::$segments[$name] ?? null;
    }


    public function segment(string $name): \InitPHP\Cookies\Cookie
    {
        if (isset(self::$segments[$name])) {
            return self::$segments[$name];
        }
        $options = array_merge(config('cookie.options', []), config('cookie.segments.' . $name . '.options', []));

        return self::$segments[$name] = new \InitPHP\Cookies\Cookie($name, config('cookie.salt'), $options);
    }

}
