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

use \InitPHP\Console\{Input, Output};
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
