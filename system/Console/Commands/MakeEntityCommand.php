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
namespace InitPHP\Framework\Console\Commands;

use InitPHP\Framework\Console\Utils\MakeFile;
use \InitPHP\Console\{Input, Output};

class MakeEntityCommand extends \InitPHP\Framework\Console\Command
{

    /** @var string Command */
    public $command = 'make:entity';

    public function execute(Input $input, Output $output)
    {
        $name = trim((!$input->hasSegment(0) ? $output->ask("Name ?", false) : $input->getSegment(0)), "/");

        if (!empty(self::makeEntity($name))) {
            $output->success("Ok");
        } else {
            $output->error("Error");
        }
    }

    public function definition(): string
    {
        return 'Creates a entity.';
    }

    public function arguments(): array
    {
        return [];
    }

    public static function makeEntity(string $name): ?string
    {
        $path = APP_DIR . "Database/Entities/";
        $namespace = "App\\Database\\Entities";
        if (str_contains($name, "/")) {
            $split = explode("/", $name);
            $name = array_pop($split);
            $namespace .= "\\" . implode("\\", $split);
            $path .= implode("/", $split) . "/";
        }
        $path .= $name . ".php";
        $make = new MakeFile(SYS_DIR . "Console/Templates/Entity.txt");

        if ($make->to($path, ["name" => $name, "namespace" => $namespace])) {
            return "\\" . $namespace . "\\" . $name . "::class";
        }

        return null;
    }

}
