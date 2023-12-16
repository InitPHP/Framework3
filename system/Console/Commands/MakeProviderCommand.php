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

class MakeProviderCommand extends \InitPHP\Framework\Console\Command
{

    /** @var string Command */
    public $command = 'make:provider';

    public function execute(Input $input, Output $output)
    {
        $name = !$input->hasSegment(0) ? $output->ask("Name ?", false) : $input->getSegment(0);
        $path = APP_DIR . "Providers/";
        $namespace = "App\\Providers";
        if ($input->hasOption('s')) {
            $path = SYS_DIR . "Providers/";
            $namespace = "InitPHP\\Framework\\Providers";
        }
        if (str_contains($name, "/")) {
            $split = explode("/", $name);
            $name = array_pop($split);
            $namespace .= "\\" . implode("\\", $split);
            $path .= implode("/", $split) . "/";
        }
        $path .= $name . ".php";
        $make = new MakeFile(SYS_DIR . "Console/Templates/Providers.txt");

        if ($make->to($path, ["name" => $name, "namespace" => $namespace])) {
            $output->success("Ok");
        } else {
            $output->error("Error");
        }
    }

    public function definition(): string
    {
        return 'Creates a service provider.';
    }

    public function arguments(): array
    {
        return [];
    }

}
