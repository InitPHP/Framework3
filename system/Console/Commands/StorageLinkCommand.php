<?php

namespace InitPHP\Framework\Console\Commands;

use InitPHP\Console\Input;
use InitPHP\Console\Output;
use InitPHP\Framework\Console\Command;

class StorageLinkCommand extends Command
{

    public $command = 'storage:link';

    public function execute(Input $input, Output $output)
    {
        if (symlink(STORAGE_DIR . "public/", PUBLIC_DIR . "storage")) {
            $output->success("Shortcut created!");
        } else {
            $output->error("Shortcut failed!");
        }
    }

    public function definition(): string
    {
        return 'Creates a shortcut to the storage/public directory in public_html.';
    }

}
