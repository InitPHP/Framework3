<?php

use JetBrains\PhpStorm\NoReturn;

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
    #[NoReturn]
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