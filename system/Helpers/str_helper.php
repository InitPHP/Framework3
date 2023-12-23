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

if (!function_exists('camelCase2SnakeCase')) {
    function camelCase2SnakeCase(string $camelCase): string
    {
        $string = lcfirst($camelCase);

        return preg_replace_callback('/[A-Z]/', function ($match) {
            return '_' . strtolower($match[0]);
        }, $string);
    }
}

if (!function_exists('snakeCase2PascalCase')) {
    function snakeCase2PascalCase(string $snake_case): string
    {
        $split = explode('_', strtolower($snake_case));
        $pascalCase = '';
        foreach ($split as $row) {
            $pascalCase .= ucfirst($row);
        }

        return $pascalCase;
    }
}

if (!function_exists('snakeCase2CamelCase')) {
    function snakeCase2CamelCase(string $snake_case): string
    {
        return lcfirst(snakeCase2PascalCase($snake_case));
    }
}

if (!function_exists('str_starts_clear')) {
    function str_starts_clear(string $str, string|array $clear): string
    {
        is_string($clear) && $clear = [$clear];

        foreach ($clear as $c) {
            if (!empty($c) && str_starts_with($str, $c)) {
                $str = mb_substr($str, mb_strlen($c));
            }
        }

        return $str;
    }
}


if (!function_exists('str_ends_clear')) {
    function str_ends_clear(string $str, string|array $clear): string
    {
        is_string($clear) && $clear = [$clear];

        foreach ($clear as $c) {
            if (!empty($c) && str_ends_with($str, $c)) {
                $str = mb_substr($str, 0, (mb_strlen($str) - mb_strlen($c)));
            }
        }

        return $str;
    }
}
