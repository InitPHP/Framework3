<?php

namespace InitPHP\Framework\Database;

use InitORM\Database\Facade\DB;

/**
 * @mixin \InitORM\Database\Database
 */
class Database
{

    public function __construct()
    {
    }

    public function __call(string $name, array $arguments)
    {
        return DB::getDatabase()->{$name}(...$arguments);
    }

}
