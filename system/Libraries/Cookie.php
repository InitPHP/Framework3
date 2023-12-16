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

class Cookie
{

    /** @var \InitPHP\Cookies\Cookie[] */
    protected static array $segments = [];

    public function __get(string $name)
    {
        return self::$segments[$name] ?? null;
    }


    public function segment(string $name): \InitPHP\Cookies\Cookie
    {
        if (isset(self::$segments[$name])) {
            return self::$segments[$name];
        }
        $options = array_merge(config('cookie.options', []), config('cookie.segments.' . $name . '.options', []));

        return self::$segments[$name] = new \InitPHP\Cookies\Cookie($name, config('cookie.salt'), $options);
    }

}
