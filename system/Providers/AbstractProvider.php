<?php

namespace InitPHP\Framework\Providers;

use InitPHP\Framework\Providers\Interfaces\ProviderInterface;

abstract class AbstractProvider implements ProviderInterface
{

    /**
     * @inheritDoc
     */
    abstract public function boot(): void;

}
