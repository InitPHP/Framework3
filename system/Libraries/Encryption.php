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
namespace InitPHP\Framework\Libraries;

use \InitPHP\Encryption\{BaseHandler, Encrypt, HandlerInterface};

/**
 * @mixin BaseHandler
 */
class Encryption
{

    protected HandlerInterface $handler;

    public function __construct(?string $driver = null)
    {
        $config = config('encryption.' . ($driver ?? env('ENCRYPTION_DRIVER')));
        $this->handler = Encrypt::use($config['handler'], $config['options']);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->handler->{$name}(...$arguments);
    }

    public function use(?string $driver = null): self
    {
        return new Encryption($driver);
    }

}
