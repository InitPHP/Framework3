<?php
/**
 * InitPHP Framework
 *
 * This file is part of InitPHP.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2023 InitPHP Framework
 * @license    http://initphp.github.io/license.txt  MIT
 * @version    3.0
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);
namespace InitPHP\Framework\Libraries;

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
        return new self($driver ?? env('LOGGER_DRIVER'));
    }

}
