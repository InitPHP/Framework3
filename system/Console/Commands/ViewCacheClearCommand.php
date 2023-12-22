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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewCacheClearCommand extends Command
{

    protected static $defaultName = 'view:clear';

    public function execute(InputInterface $input, OutputInterface $output): int
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
        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setDescription('View cache clear')
            ->setHelp('');
    }

}
