<?php

namespace InitPHP\Framework\Libraries;

use InitPHP\Encryption\BaseHandler;
use InitPHP\Encryption\Encrypt;
use InitPHP\Encryption\HandlerInterface;

/**
 * @mixin BaseHandler
 */
class Encryption
{

    protected HandlerInterface $handler;

    public function __construct(?string $driver = null)
    {
        $config = config('encryption.' . ($driver ?? env('ENCRYPTION_DRIVER')));
        $this->handler = Encrypt::use($config['handler'], $config['options']);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->handler->{$name}(...$arguments);
    }

    public function use(?string $driver = null): self
    {
        return new Encryption($driver);
    }

}
