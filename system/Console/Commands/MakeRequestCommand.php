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
use \InitPHP\Framework\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeRequestCommand extends Command
{

    protected static $defaultName = 'make:request';

    protected function configure(): void
    {
        $this->setDescription('Creates a request.')
            ->addArgument('name', InputArgument::REQUIRED, 'Request class name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');

        $path = APP_DIR . "HTTP/Requests/";
        $namespace = "App\\HTTP\\Requests";

        if (str_contains($name, "/")) {
            $split = explode("/", $name);
            $name = array_pop($split);
            $namespace .= "\\" . implode("\\", $split);
            $path .= implode("/", $split) . "/";
        }
        $path .= $name . ".php";

        $write = (new MakeFile(SYS_DIR . 'Console/Templates/Request.txt'))
            ->to($path, ['name' => $name, 'namespace' => $namespace]);

        return $write ? Command::SUCCESS : Command::FAILURE;
    }

}
