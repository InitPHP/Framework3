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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use \InitPHP\Framework\Console\Command;

class MakeProviderCommand extends Command
{

    protected static $defaultName = 'make:provider';

    protected function configure(): void
    {
        $this->setDescription('Creates a service provider.')
            ->addArgument('name', InputArgument::REQUIRED, 'Provider Name')
            ->addOption('system', 's', InputOption::VALUE_OPTIONAL, 'System Provider');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $path = APP_DIR . "Providers/";
        $namespace = "App\\Providers";
        if ($input->hasOption('system')) {
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

        return $make->to($path, ["name" => $name, "namespace" => $namespace]) ? Command::SUCCESS : Command::FAILURE;
    }

}
