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

use InitPHP\Upload\Adapters\BaseUploadAdapter;

/**
 * @mixin BaseUploadAdapter
 */
class Upload
{

    protected BaseUploadAdapter $upload;

    public function __construct(?string $driver = null)
    {
        $config = config('upload.' . ($driver ?? env("UPLOAD_DRIVER")));
        $this->upload = new $config['handler']($config['credentials'], $config['options']);
    }

    public function use(?string $driver = null): Upload
    {
        return new Upload($driver);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->upload->{$name}(...$arguments);
    }

}
