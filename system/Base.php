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
namespace InitPHP\Framework;

use InitPHP\Framework\Database\Database;
use InitPHP\Framework\HTTP\{Request, Response};
use InitPHP\Framework\Libraries\{Cache, Cookie, Encryption, Logger, Session, Input, Upload};

/**
 * @property-read Request $request
 * @property-read Response $response
 * @property-read Cookie $cookie
 * @property-read Session $session
 * @property-read Input $input
 * @property-read Database $database
 * @property-read Cache $cache
 * @property-read Encryption $encrypt
 * @property-read Logger $logger
 * @property-read Upload $upload
 */
abstract class Base
{

    private static array $_properties = [];

    public function __get(string $name)
    {
        return self::getProperty($name);
    }

    public function __set(string $name, $value): void
    {
        self::setProperty($name, $value);
    }

    public function __isset(string $name): bool
    {
        return self::hasProperty($name);
    }

    /**
     * @param string $name
     * @return object|null
     */
    public static function getProperty(string $name): ?object
    {
        return self::$_properties[$name] ?? null;
    }

    /**
     * @param string $name
     * @param object $value
     * @return void
     */
    public static function setProperty(string $name, object $value): void
    {
        self::$_properties[$name] = $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function hasProperty(string $name): bool
    {
        return isset(self::$_properties[$name]);
    }

}
