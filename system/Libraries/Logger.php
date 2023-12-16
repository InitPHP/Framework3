<?php

namespace InitPHP\Framework\Libraries;

use Psr\Log\LoggerInterface;


class Logger extends \InitPHP\Logger\Logger
{

    public function __construct(string ...$drivers)
    {
        $loggers = [];
        foreach ($drivers as $driver) {
            $config = config('logger.' . $driver);
            if ($config === null) {
                continue;
            }
            $loggers[] = new $config['handler']($config['options']);
        }
        parent::__construct(...$loggers);
    }

    public function use(?string $driver = null): Logger
    {
        return new Logger($driver ?? env('LOGGER_DRIVER'));
    }

}
