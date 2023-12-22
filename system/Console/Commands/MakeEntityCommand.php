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
use Symfony\Component\Console\Output\OutputInterface;

class MakeEntityCommand extends Command
{

    protected static $defaultName = 'make:entity';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = trim($input->getArgument('name'), "/");

        return !empty(self::makeEntity($name)) ? Command::SUCCESS : Command::FAILURE;
    }

    protected function configure(): void
    {
        $this->setDescription('Creates a entity.')
            ->setHelp('--name=EntityName')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the entity class.');
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
