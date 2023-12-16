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
namespace InitPHP\Framework\HTTP;

use InitPHP\Framework\Base;
use Psr\Http\Message\ResponseInterface;

/**
 * @mixin Router
 * @method static array getRoutes(?string $method = null)
 * @method static void destroy()
 * @method static Router register(string|string[] $methods, string $path, string|array|callable $execute, array $options = [])
 * @method static Router link(string $link, string $source, array $options = [])
 * @method static Router add(string|string[] $methods, string $path, string|array|callable $execute, array $options = [])
 * @method static Router get(string $path, string|array|callable $execute, array $options = [])
 * @method static Router post(string $path, string|array|callable $execute, array $options = [])
 * @method static Router put(string $path, string|array|callable $execute, array $options = [])
 * @method static Router delete(string $path, string|array|callable $execute, array $options = [])
 * @method static Router options(string $path, string|array|callable $execute, array $options = [])
 * @method static Router patch(string $path, string|array|callable $execute, array $options = [])
 * @method static Router head(string $path, string|array|callable $execute, array $options = [])
 * @method static Router any(string $path, string|array|callable $execute, array $options = [])
 * @method static Router error_404(string|array|callable $execute, array $options = [])
 * @method static void group(string $prefix, \Closure $group, array $options = [])
 * @method static void domain(string $host, \Closure $group, array $options = [])
 * @method static void port(int $port, \Closure $group, array $options = [])
 * @method static void ip($ip, \Closure $group, array $options = [])
 * @method static void resource(string $prefix, string $controller)
 * @method static Router name(string $name)
 * @method static string route(string $name, array $arguments = [])
 * @method static Router filter(string|callable $filter, int $position = self::BOTH)
 * @method static Router middleware(string|callable $middleware, int $position = self::BOTH)
 * @method static Router pattern(string $key, string $pattern)
 * @method static Router where(string $key, string $pattern)
 * @method static ResponseInterface dispatch()
 */
class Route
{

    public const BOTH = \InitPHP\Router\Router::BOTH; // both
    public const BEFORE = \InitPHP\Router\Router::BEFORE; // before
    public const AFTER = \InitPHP\Router\Router::AFTER; // after

    public const ROUTE = \InitPHP\Router\Router::ROUTE;

    public const LINK = \InitPHP\Router\Router::LINK;

    public const SUPPORTED_METHODS = [
        'GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'PATCH', 'OPTIONS',
        'ANY', 'LINK'
    ];

    public function __call(string $name, array $arguments)
    {
        return Base::getProperty('router')->{$name}(...$arguments);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        return Base::getProperty('router')->{$name}(...$arguments);
    }

    public static function path(string $file, array $options = []): void
    {
        Route::group('', function () use ($file) {
            require_once $file;
        }, $options);
    }

}
