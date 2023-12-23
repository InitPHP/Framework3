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
namespace InitPHP\Framework\Providers;

use InitPHP\Framework\Base;
use Symfony\Component\Console\Application;

class ConsoleServiceProvider extends AbstractProvider
{

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $console = new Application("InitPHP Framework", "3.0");
        $commands = glob(SYS_DIR . "Console/Commands/*.php");
        foreach ($commands as $command) {
            $commandClass = '\\InitPHP\\Framework\\Console\\Commands\\' . basename($command, '.php');
            if (!class_exists($commandClass)) {
                continue;
            }
            $console->add(new $commandClass());
        }
        $commands = glob(APP_DIR . "Console/Commands/*.php");
        foreach ($commands as $command) {
            $commandClass = '\\App\\Console\\Commands\\' . basename($command, '.php');
            if (!class_exists($commandClass)) {
                continue;
            }
            $console->add(new $commandClass());
        }
        !Base::hasProperty('console') && Base::setProperty('console', $console);
    }

}
