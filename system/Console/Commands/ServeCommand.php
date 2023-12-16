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
