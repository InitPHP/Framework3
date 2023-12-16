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
