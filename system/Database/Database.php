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
