<?php
if (!function_exists('camelCase2SnakeCase')) {
    function camelCase2SnakeCase(string $camelCase): string
    {
        $string = lcfirst($camelCase);
        $split = preg_split('', $string, -1, PREG_SPLIT_NO_EMPTY);
        $snake_case = '';
        $i = 0;
        foreach ($split as $row) {
            $snake_case .= ($i === 0 ? '_' : '')
                . strtolower($row);
            ++$i;
        }

        return lcfirst($snake_case);
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
