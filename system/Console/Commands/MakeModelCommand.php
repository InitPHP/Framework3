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
use \InitPHP\Framework\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModelCommand extends Command
{

    protected static $defaultName = 'make:model';

    protected function configure(): void
    {
        $this->setDescription('Creates a model.')
            ->addArgument('name', InputArgument::REQUIRED, 'Model class name')
            ->addOption('entity', 'e', InputOption::VALUE_NONE, 'Create Entity Class.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = trim($input->getArgument('name'), "/");
        $entity = null;
        if ($input->getOption('entity')) {
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

        return $make->to($path, ["name" => $name, "namespace" => $namespace, 'entity' => $entity, 'schema' => camelCase2SnakeCase($name)])
            ? Command::SUCCESS
            : Command::FAILURE;
    }

}
