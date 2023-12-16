<?php
return [

    'null'          => [
        'handler'           => \Psr\Log\NullLogger::class,
        'options'           => []
    ],

    'file'          => [
        'handler'           => \InitPHP\Logger\FileLogger::class,
        'options'           => [
            'path'              => STORAGE_DIR . 'logs/{year}-{month}-{day}.log',
        ]
    ],

];