<?php

namespace InitPHP\Framework\Console\Commands;

use InitPHP\Framework\Console\Utils\MakeFile;
use \InitPHP\Console\{Input, Output};

class MakeRequestCommand extends \InitPHP\Framework\Console\Command
{

    /** @var string Command */
    public $command = 'make:request';

    public function execute(Input $input, Output $output)
    {
        $name = trim((!$input->hasSegment(0) ? $output->ask("Name ?", false) : $input->getSegment(0)), "/");

        $path = APP_DIR . "HTTP/Requests/";
        $namespace = "App\\HTTP\\Requests";

        if (str_contains($name, "/")) {
            $split = explode("/", $name);
            $name = array_pop($split);
            $namespace .= "\\" . implode("\\", $split);
            $path .= implode("/", $split) . "/";
        }
        $path .= $name . ".php";
        $make = new MakeFile(SYS_DIR . "Console/Templates/Requests.txt");

        if ($make->to($path, ["name" => $name, "namespace" => $namespace])) {
            $output->success("Ok");
        } else {
            $output->error("Error");
        }
    }

    public function definition(): string
    {
        return 'Creates a request.';
    }

    public function arguments(): array
    {
        return [];
    }

}
