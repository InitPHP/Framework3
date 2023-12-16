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
