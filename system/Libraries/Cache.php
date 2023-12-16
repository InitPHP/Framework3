<?php

namespace InitPHP\Framework\Libraries;

use InitPHP\Cache\CacheInterface;

/**
 * @mixin CacheInterface
 */
class Cache
{

    private CacheInterface $cache;

    public function __construct(?string $driver = null)
    {
        $config = config('cache.' . ($driver ?? env('CACHE_DRIVER', 'file')));
        $this->cache = \InitPHP\Cache\Cache::create($config['handler'], $config['options']);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->cache->{$name}(...$arguments);
    }

    public function use(?string $driver = null): Cache
    {
        return new Cache($driver);
    }

}
