<?php

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
