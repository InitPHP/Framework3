<?php

return [
    'options'   => [
    ],


    'file'          => [
        'adapter'           => \InitPHP\Sessions\Adapters\FileAdapter::class,
        'options'           => [
            'path'      => STORAGE_DIR . 'system/sessions/'
        ],
    ],

    'redis'         => [
        'adapter'           => \InitPHP\Sessions\Adapters\RedisAdapter::class,
        'options'           => [
            'host'      => '127.0.0.1', // string
            'port'      => 6379, // int
            'timeout'   => 0, // int
            'password'  => null, // null or string
            'database'  => 0,
            'ttl'       => 86400,
            'prefix'    => 'sess'
        ],
    ],

    'database'      => [
        'adapter'           => \InitPHP\Sessions\Adapters\PDOAdapter::class,
        'options'           => [
            'dsn'           => env('DB_DRIVER')
                . ':host=' . env('DB_HOST')
                . ';port=' . env('DB_PORT')
                . ';dbname=' . env('DB_NAME')
                . ';charset=' . env('DB_CHARSET'),
            'username'      => env('DB_USER'),
            'password'      => env('DB_PASS'),
        ],
    ],

    'memcache'      => [
        'adapter'           => \InitPHP\Sessions\Adapters\MemCacheAdapter::class,
        'options'           => [
            'host'          => '127.0.0.1', // string
            'port'          => 11211, // int
            'weight'        => 1, // int
            'raw'           => false, // boolean
            'prefix'        => null, // null or string
            'ttl'           => 86400, // int
        ],
    ],

    'cookie'        => [
        'adapter'           => \InitPHP\Sessions\Adapters\CookieAdapter::class,
        'options'           => [
            'name'  => 'sessDataCookieName',
            'key'   => env('APP_KEY'),
            'ttl'   => 86400
        ],
    ],

    'mongodb'       => [
        'adapter'           => \InitPHP\Sessions\Adapters\MongoDBAdapter::class,
        'options'           => [
            'dsn'               => 'mongodb://127.0.0.1:27017',
            'collation'         => 'sessDbName.sessCollectionName'
        ],
    ],

];
