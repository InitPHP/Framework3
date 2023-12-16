<?php

namespace InitPHP\Framework\Libraries;


class Session extends \InitPHP\Sessions\Session
{

    public function __construct()
    {
        $config = config('session.' . env('SESSION_DRIVER', 'file'));
        $handler = new $config['adapter']($config['options']);

        self::createImmutable($handler);
        self::start(config('session.options', []));
    }

}