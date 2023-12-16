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
namespace InitPHP\Framework\Console\Utils;

class MakeFile
{
    protected string $template;

    public function __construct(string $path)
    {
        $this->template = $path;
    }

    public function to(string $target, array $arguments): bool
    {
        try {
            $context = [];
            foreach ($arguments as $key => $value) {
                $context['{' . $key . '}'] = $value;
            }
            if (file_exists($target)) {
                return false;
            }
            $content = file_get_contents($this->template);
            !empty($context) && $content = strtr($content, $context);
            return file_put_contents($target, $content) !== false;
        } catch (\Throwable $e) {
            return false;
        }
    }

}
