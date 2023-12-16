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

use InitPHP\Container\Container;
use Psr\Container\ContainerInterface;

/**
 * @mixin Container
 * @method static void set(string $id, $concrete = null)
 * @method static object get(string $id)
 * @method static bool has(string $id)
 */
class ContainerDependency
{

    protected static ContainerInterface $instance;

    public function __call(string $name, array $arguments)
    {
        if (!isset(self::$instance)) {
            self::$instance = new Container();
        }

        return self::$instance->{$name}(...$arguments);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        if (!isset(self::$instance)) {
            self::$instance = new Container();
        }

        return self::$instance->{$name}(...$arguments);
    }

}
