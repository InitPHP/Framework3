<?php

namespace InitPHP\Framework\Console\Commands;

use InitPHP\Framework\Console\Utils\MakeFile;
use \InitPHP\Console\{Input, Output};

class MakeModelCommand extends \InitPHP\Framework\Console\Command
{

    /** @var string Command */
    public $command = 'make:model';

    public function execute(Input $input, Output $output)
    {
        $name = trim((!$input->hasSegment(0) ? $output->ask("Name ?", false) : $input->getSegment(0)), "/");

        $entity = null;
        if ($input->hasOption('e')) {
            $entity = MakeEntityCommand::makeEntity($name);
        }
        empty($entity) && $entity = "\\InitPHP\\Framework\\Database\\Entity::class";

        $path = APP_DIR . "Database/Models/";
        $namespace = "App\\Database\\Models";

        if (str_contains($name, "/")) {
            $split = explode("/", $name);
            $name = array_pop($split);
            $namespace .= "\\" . implode("\\", $split);
            $path .= implode("/", $split) . "/";
        }
        $path .= $name . ".php";
        $make = new MakeFile(SYS_DIR . "Console/Templates/Model.txt");

        if ($make->to($path, ["name" => $name, "namespace" => $namespace, 'entity' => $entity, 'schema' => camelCase2SnakeCase($name)])) {
            $output->success("Ok");
        } else {
            $output->error("Error");
        }
    }

    public function definition(): string
    {
        return 'Creates a model.';
    }

    public function arguments(): array
    {
        return [];
    }

}
