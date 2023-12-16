<?php

namespace InitPHP\Framework\Console\Commands;

use \InitPHP\Console\{Input, Output};

class ViewCacheClearCommand extends \InitPHP\Framework\Console\Command
{

    /** @var string Command */
    public $command = 'view:clear';

    public function execute(Input $input, Output $output)
    {
        $path = STORAGE_DIR . "cache/views/*";
        $caches = glob($path);
        foreach ($caches as $cache) {
            if (basename($cache) === '.gitignore') {
                continue;
            }
            $output->writeln($cache);
            unlink($cache);
        }
        $output->success("Ok");
    }

    public function definition(): string
    {
        return 'View cache clear';
    }

    public function arguments(): array
    {
        return [];
    }

}
