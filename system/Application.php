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
namespace InitPHP\Framework;

use InitPHP\Framework\Providers\{BootstrapServiceProvider,
    ConsoleServiceProvider,
    HttpServiceProvider,
    SystemServiceProvider};
use InitPHP\Framework\Providers\Exceptions\ProviderLoadException;
use InitPHP\Framework\Providers\Interfaces\ProviderInterface;
use InitPHP\HTTP\Facade\Emitter;


class Application
{

    protected const SYSTEM_PROVIDERS = [
        SystemServiceProvider::class,
        BootstrapServiceProvider::class,
        HttpServiceProvider::class,
    ];

    public const CLI_APP = 0;

    public const HTTP_APP = 1;

    private int $appType;

    protected array $providers = [];

    public function __construct()
    {
        $this->providers = self::SYSTEM_PROVIDERS;
    }

    public function __get(string $name)
    {
        return Base::getProperty($name);
    }

    public function __set(string $name, $value): void
    {
        Base::setProperty($name, $value);
    }

    public function __isset(string $name): bool
    {
        return Base::hasProperty($name);
    }

    /**
     * @return $this
     */
    public function httpServer(): self
    {
        $this->appType = self::HTTP_APP;

        return $this;
    }

    public function cliServer(): self
    {
        $this->providers[] = ConsoleServiceProvider::class;
        $this->appType = self::CLI_APP;

        return $this;
    }

    /**
     * @return self
     * @throws ProviderLoadException
     */
    public function boot(): self
    {
        foreach ($this->providers as $provider) {
            $providerObj = ContainerDependency::get($provider);
            if ($providerObj instanceof ProviderInterface) {
                $providerObj->boot();
            } else {
                throw new ProviderLoadException('"' . $provider . '" provider does not implement InitPHP\\Framework\\Providers\\Interfaces\\ProviderInterface.');
            }
        }

        $appProviders = config('app.providers');
        if (is_array($appProviders)) {
            foreach ($appProviders as $provider) {
                $providerObj = ContainerDependency::get($provider);
                if ($providerObj instanceof ProviderInterface) {
                    $providerObj->boot();
                } else {
                    throw new ProviderLoadException('"' . $provider . '" provider does not implement InitPHP\\Framework\\Providers\\Interfaces\\ProviderInterface.');
                }
            }
        }

        return $this;
    }

    public function run(): void
    {
        switch ($this->appType) {
            case self::CLI_APP:
                Base::getProperty('console')->run();
                break;
            default:
                Emitter::emit(Base::getProperty('router')->dispatch());
        }
    }

}
