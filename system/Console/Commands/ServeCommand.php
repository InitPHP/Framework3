<?php

namespace InitPHP\Framework\Console\Commands;

use \InitPHP\Console\{Input, Output};

class ServeCommand extends \InitPHP\Framework\Console\Command
{

    /** @var string Command */
    public $command = 'serve';

    public function execute(Input $input, Output $output)
    {
        $host = $input->hasArgument("host") ? $input->getArgument("host") : "127.0.0.1";
        $port = $input->hasArgument("port") ? $input->getArgument("port") : 8000;
        !is_int($port) && $port = 8000;

        $shell = "php -S " . $host . ":" . $port . " -t \"" . PUBLIC_DIR . "\"";
        exec($shell);
    }

    public function definition(): string
    {
        return 'It runs a PHP Web server.';
    }

    public function arguments(): array
    {
        return [];
    }

}
