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

use InitPHP\Framework\Base;
use \InitPHP\Framework\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use const PHP_EOL;

class RouteListCommand extends Command
{

    protected static $defaultName = 'route:list';


    protected function configure(): void
    {
        $this->setDescription('Routes list.')
            ->addArgument('method', InputArgument::OPTIONAL, 'HTTP Method');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->hasArgument('method')) {
            $routes = [
                strtoupper($input->getArgument('method')) => Base::getProperty('router')->getRoutes($input->getArgument('method'))
            ];
        } else {
            $routes = Base::getProperty('router')->getRoutes(null);
        }

        $i = 0;
        $table = new \InitPHP\Console\Utils\Table();
        foreach ($routes as $method => $route) {
            foreach ($route as $path => $row) {
                $execute = $row['execute'];
                if (is_array($execute)) {
                    $execute = implode('::', $execute);
                } else if (is_callable($execute)) {
                    $execute = '[Callable]';
                }
                $table->row([
                    'id'        => ++$i,
                    'method'    => $method,
                    'path'      => $path,
                    'execute'   => str_starts_clear((string)$execute, [BASE_DIR, base_url()]),
                    'name'      => $row['options']['name'] ?? '-',
                ]);
            }
        }

        $output->write(PHP_EOL . $table->getContent() . PHP_EOL);

        return Command::SUCCESS;
    }

}
