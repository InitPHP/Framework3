<?php

namespace InitPHP\Framework\Console\Commands;

use InitPHP\Framework\Console\Utils\MakeFile;
use \InitPHP\Console\{Input, Output};

class MakeMiddlewareCommand extends \InitPHP\Framework\Console\Command
{

    /** @var string Command */
    public $command = 'make:middleware';

    public function execute(Input $input, Output $output)
    {
        $name = trim((!$input->hasSegment(0) ? $output->ask("Name ?", false) : $input->getSegment(0)), "/");

        $path = APP_DIR . "HTTP/Middlewares/";
        $namespace = "App\\HTTP\\Middlewares";

        if (str_contains($name, "/")) {
            $split = explode("/", $name);
            $name = array_pop($split);
            $namespace .= "\\" . implode("\\", $split);
            $path .= implode("/", $split) . "/";
        }
        $path .= $name . ".php";
        $make = new MakeFile(SYS_DIR . "Console/Templates/Middleware.txt");

        if ($make->to($path, ["name" => $name, "namespace" => $namespace])) {
            $output->success("Ok");
        } else {
            $output->error("Error");
        }
    }

    public function definition(): string
    {
        return 'Creates a middleware.';
    }

    public function arguments(): array
    {
        return [];
    }

}
