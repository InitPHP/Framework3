<?php
return [

    'default'       => [
        'username'      => env('DB_USER'),
        'password'      => env('DB_PASS'),
        'charset'       => env('DB_CHARSET'),
        'collation'     => env('DB_COLLATE'),
        'driver'        => env('DB_DRIVER'),
        'host'          => env('DB_HOST'),
        'port'          => env('DB_PORT'),
        'database'      => env('DB_NAME'),
        'log'           => null,
        'debug'         => false,
    ],

];
