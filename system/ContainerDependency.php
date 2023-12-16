<?php

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
