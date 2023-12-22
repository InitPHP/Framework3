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

class StorageLinkCommand extends Command
{

    protected static $defaultName = 'storage:link';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        return symlink(STORAGE_DIR . "public/", PUBLIC_DIR . "storage") ? Command::SUCCESS : Command::FAILURE;
    }

    protected function configure(): void
    {
        $this->setDescription('Creates a shortcut to the storage/public directory in public_html.')
            ->setHelp('');
    }

}
