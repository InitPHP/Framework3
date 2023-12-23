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

use \InitPHP\Framework\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends Command
{

    protected static $defaultName = 'serve';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $host = $input->getOption("host");
        $port = intval($input->getOption("port"));

        $shell = "php -S " . $host . ":" . $port . " -t \"" . PUBLIC_DIR . "\"";
        exec($shell);

        return Command::SUCCESS;
    }

    protected function configure()
    {
        $this->setDescription('It runs a PHP Web server.')
            ->addOption('host', 'host', InputOption::VALUE_OPTIONAL, 'The host name or IP', '127.0.0.1')
            ->addOption('port', 'p', InputOption::VALUE_OPTIONAL, 'The port', '8000');
    }

}
