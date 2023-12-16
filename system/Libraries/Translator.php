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

class Translator extends \InitPHP\Translator\Translator
{

    public function __construct()
    {
        parent::__construct();

        $this->setDir(BASE_DIR . 'resources/languages')
            ->useDirectory()
            ->setDefault(config('app.language'));
    }

    public function trans(string $key, ?array $context = null, ?string $default = null): string
    {
        return $this->_r($key, ($default ?? $key), ($context ?? []));
    }

}
