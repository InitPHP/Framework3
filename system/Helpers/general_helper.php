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

if (!function_exists('config')) {
    function config(string $name, $default = null)
    {
        return \InitPHP\Config\Config::get($name, $default);
    }
}

if (!function_exists('env')) {
    function env(string $name, $default = null)
    {
        return \InitPHP\DotENV\DotENV::get($name, $default);
    }
}

if (!function_exists('trans')) {
    function trans(string $key, ?array $context = null, ?string $default = null): string
    {
        return \InitPHP\Framework\Base::getProperty('lang')->trans($key, $context, $default);
    }
}

if (!function_exists('base_url')) {
    function base_url(?string $path = null): string
    {
        return rtrim(env("APP_URL"), "/") . "/" . ltrim(($path ?? ""), "/");
    }
}

if (!function_exists('asset')) {
    function asset(?string $path = null): string
    {
        return rtrim(env("ASSET_URL", base_url("/assets")), "/") . "/" . ltrim(($path ?? ""), "/");
    }
}

if (!function_exists('request')) {
    function request(): \InitPHP\Framework\HTTP\Request
    {
        return \InitPHP\Framework\Base::getProperty('request');
    }
}

if (!function_exists('response')) {
    function response(): \InitPHP\Framework\HTTP\Response
    {
        return \InitPHP\Framework\Base::getProperty('response');
    }
}

if (!function_exists('abort')) {
    function abort(int $status, array|string|null $withMessage = null): void
    {
        $response = response()
            ->setStatusCode($status);

        if (is_array($withMessage)) {
            $response = $response->json($withMessage);
        } else if (is_string($withMessage)) {
            $response->getBody()->write($withMessage);
        }

        \InitPHP\HTTP\Facade\Emitter::emit($response);
        exit(1);
    }
}

if (!function_exists('elapsed_time')) {
    function elapsed_time(string $startPointer = 'framework_start', string $endPointer = 'framework_end', int $decimal = 5): float
    {
        return \InitPHP\PerformanceMeter\PerformanceMeter::elapsedTime($startPointer, $endPointer, $decimal);
    }
}

if (!function_exists('performance_pointer')) {
    function performance_pointer(string $name): void
    {
        \InitPHP\PerformanceMeter\PerformanceMeter::setPointer($name);
    }
}

if (!function_exists('memory_usage')) {
    function memory_usage(string $startPointer = 'framework_start', string $endPointer = 'framework_end', int $decimal = 2): string
    {
        return \InitPHP\PerformanceMeter\PerformanceMeter::memoryUsage($startPointer, $endPointer, $decimal);
    }
}

