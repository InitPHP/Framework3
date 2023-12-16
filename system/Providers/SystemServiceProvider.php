<?php

namespace InitPHP\Framework\Providers;

use InitPHP\Config\Config;
use InitPHP\DotENV\DotENV;
use InitPHP\Framework\Providers\AbstractProvider;

class SystemServiceProvider extends AbstractProvider
{

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        // dotENV
        \InitPHP\DotENV\DotENV::create(BASE_DIR . '.env');

        // Error Handler
        if (DotENV::get('APP_ENV', 'production') === 'development') {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        }

        // Helper Files
        $this->helperProvider();

        // Config Files
        $this->configProvider();
    }

    private function helperProvider(): void
    {
        $sysHelpers = glob(SYS_DIR . 'Helpers/*.php');
        if (is_array($sysHelpers)) {
            foreach ($sysHelpers as $helper) {
                require_once $helper;
            }
        }

        $appHelpers = glob(APP_DIR . 'Helpers/*.php');
        if (is_array($appHelpers)) {
            foreach ($appHelpers as $helper) {
                require_once $helper;
            }
        }
    }

    private function configProvider(): void
    {
        $configFiles = glob(BASE_DIR . 'config/*.php');
        if (is_array($configFiles)) {
            foreach ($configFiles as $config) {
                Config::setFile(basename($config, '.php'), $config);
            }
        }
    }

}
