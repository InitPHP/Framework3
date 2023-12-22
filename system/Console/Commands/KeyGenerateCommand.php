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
use InitPHP\Framework\Console\Utils\ChangeDotEnv;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class KeyGenerateCommand extends Command
{

    protected static $defaultName = 'key:generate';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $key = '"' . base64_encode(random_bytes(16)) . '"';

        return ((new ChangeDotEnv())->change('APP_KEY', $key)->save()) ? Command::SUCCESS : Command::FAILURE;
    }

    protected function configure(): void
    {
        $this->setDescription('Creates a command.')
            ->setHelp('');
    }

}