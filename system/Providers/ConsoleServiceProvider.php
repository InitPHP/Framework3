<?php

namespace InitPHP\Framework\Providers;

use InitPHP\Framework\Base;
use InitPHP\Framework\Providers\AbstractProvider;

class ConsoleServiceProvider extends AbstractProvider
{

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $console = new \InitPHP\Console\Application("InitPHP Framework", "3.0");
        $commands = glob(SYS_DIR . "Console/Commands/*.php");
        foreach ($commands as $command) {
            $commandClass = '\\InitPHP\\Framework\\Console\\Commands\\' . basename($command, '.php');
            if (!class_exists($commandClass)) {
                continue;
            }
            $console->register($commandClass);
        }
        $commands = glob(APP_DIR . "Console/Commands/*.php");
        foreach ($commands as $command) {
            $commandClass = '\\App\\Console\\Commands\\' . basename($command, '.php');
            if (!class_exists($commandClass)) {
                continue;
            }
            $console->register($commandClass);
        }
        !Base::hasProperty('console') && Base::setProperty('console', $console);
    }

}
