<?php

return [

    'file'      => [
        'handler'               => \InitPHP\Cache\Handler\File::class,
        'options'               => [
            'prefix'        => '',
            'mode'          => 0640,
        ],
    ],

    'redis'     => [
        'handler'               => \InitPHP\Cache\Handler\Redis::class,
        'options'               => [
            'prefix'    => 'cache_',
            'host'      => '127.0.0.1',
            'password'  => null,
            'port'      => 6379,
            'timeout'   => 0,
            'database'  => 0
        ],
    ],

    'memcache'  => [
        'handler'               => \InitPHP\Cache\Handler\Memcache::class,
        'options'               => [
            'prefix'        => 'cache_',
            'host'          => '127.0.0.1',
            'port'          => 11211,
            'weight'        => 1,
            'raw'           => false,
            'default_ttl'   => 60,
        ],
    ],

    'wincache'  => [
        'handler'               => \InitPHP\Cache\Handler\Wincache::class,
        'options'               => [
            'prefix'        => 'cache_',
            'default_ttl'   => 60,
        ],
    ],

];
