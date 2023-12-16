<?php

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
