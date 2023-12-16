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

use \InitPHP\Console\{Input, Output};
use InitPHP\Framework\Console\Command;
use InitPHP\Framework\Console\Utils\MakeFile;

class MakeCommandCommand extends Command
{

    public $command = 'make:command';

    public function execute(Input $input, Output $output)
    {
        $name = !$input->hasSegment(0) ? $output->ask("Name ?", false) : $input->getSegment(0);
        $path = APP_DIR . "Console/Commands/";
        $namespace = "App\\Console\\Commands";
        if ($input->hasOption('s')) {
            $path = SYS_DIR . "Console/Commands/";
            $namespace = "InitPHP\\Framework\\Console\\Commands";
        }
        if (str_contains($name, "/")) {
            $split = explode("/", $name);
            $name = array_pop($split);
            $namespace .= "\\" . implode("\\", $split);
            $path .= implode("/", $split) . "/";
        }
        $path .= $name . ".php";
        $make = new MakeFile(SYS_DIR . "Console/Templates/Command.txt");

        if ($make->to($path, ["name" => $name, "namespace" => $namespace])) {
            $output->success("Ok");
        } else {
            $output->error("Error");
        }
    }

    public function definition(): string
    {
        return 'Creates a command.';
    }

}