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

use InitPHP\Framework\Console\Utils\ChangeDotEnv;
use \InitPHP\Console\{Input, Output};

class KeyGenerateCommand extends \InitPHP\Framework\Console\Command
{

    /** @var string Command */
    public $command = 'key:generate';

    public function execute(Input $input, Output $output)
    {
        $key = '"' . base64_encode(random_bytes(16)) . '"';
        if ((new ChangeDotEnv())->change('APP_KEY', $key)->save()) {
            $output->success("Ok");
        } else {
            $output->error("Failed");
        }
    }

    public function definition(): string
    {
        return 'Generates and replaces a new APP_KEY.';
    }

    public function arguments(): array
    {
        return [];
    }

}
