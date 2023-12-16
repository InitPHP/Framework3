<?php

return [

    'sodium'        => [
        'handler'           => \InitPHP\Encryption\Sodium::class,
        'options'           => [
            'key'       => env('APP_KEY'),
            'blocksize' => 16,
        ],
    ],


    'openssl'       => [
        'handler'           => \InitPHP\Encryption\OpenSSL::class,
        'options'           => [
            'algo'      => env('ENCRYPTION_ALGO'),
            'cipher'    => env('ENCRYPTION_CIPHER'),
            'key'       => env('APP_KEY'),
        ],
    ],

];
