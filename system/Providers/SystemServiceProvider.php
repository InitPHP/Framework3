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
