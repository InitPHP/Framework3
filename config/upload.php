<?php
return [

    'local'     => [
        'handler'           => \InitPHP\Upload\Adapters\LocalAdapter::class,
        'credentials'       => [
            'dir'   => STORAGE_DIR . 'public/uploads/',
            'url'   => base_url("uploads/"),
        ],
        'options'           => [
            'allowed_extensions'    => [],
            'allowed_mime_types'    => [],
            'allowed_max_size'      => 0,
        ],
    ],


    'ftp'       => [
        'handler'           => \InitPHP\Upload\Adapters\FTPAdapter::class,
        'credentials'       => [
            'host'      => 'ftp.example.com',
            'port'      => 21,
            'username'  => 'user',
            'password'  => '123456',
            'timeout'   => 90,
            'url'       => 'http://example.com/',
        ],
        'options'           => [
            'allowed_extensions'    => [],
            'allowed_mime_types'    => [],
            'allowed_max_size'      => 0,
        ],
    ],


    's3'        => [
        'handler'           => \InitPHP\Upload\Adapters\S3Adapter::class,
        'credentials'       => [
            'key'           => '',
            'secret_key'    => '',
            'region'        => '',
            'bucket'        => '',
            'ACL'           => 'public-read',
            'version'       => 'latest',
        ],
        'options'           => [
            'allowed_extensions'    => [],
            'allowed_mime_types'    => [],
            'allowed_max_size'      => 0,
        ],
    ],

];