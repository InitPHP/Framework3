<?php

namespace InitPHP\Framework\Console\Commands;

use InitPHP\Framework\Base;
use \InitPHP\Console\{Input, Output};

use const PHP_EOL;

class RouteListCommand extends \InitPHP\Framework\Console\Command
{

    /** @var string Command */
    public $command = 'route:list';

    public function execute(Input $input, Output $output)
    {
        if ($input->hasArgument('method')) {
            $routes = [
                strtoupper($input->getArgument('method')) => Base::getProperty('router')->getRoutes($input->getArgument('method'))
            ];
        } else {
            $routes = Base::getProperty('router')->getRoutes(null);
        }

        $i = 0;
        $table = new \InitPHP\CLITable\Table();
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
    }

    public function definition(): string
    {
        return 'Routes list.';
    }

    public function arguments(): array
    {
        return [];
    }

}
