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

use InitPHP\Framework\Console\Command;
use InitPHP\Framework\Console\Utils\MakeFile;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCommandCommand extends Command
{

    protected static $defaultName = 'make:command';

    public function execute(InputInterface $input, OutputInterface $output): int
    {

        $name = $input->getArgument('name');

        $path = APP_DIR . "Console/Commands/";
        $namespace = "App\\Console\\Commands";
        if ($input->getOption('system')) {
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

        return $make->to($path, ["name" => $name, "namespace" => $namespace]) ? Command::SUCCESS : Command::FAILURE;
    }

    protected function configure(): void
    {
        $this->setDescription('Creates a command.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the command class.')
            ->addOption('system', 's', InputOption::VALUE_NONE, 'Creates a system command.');
    }

}