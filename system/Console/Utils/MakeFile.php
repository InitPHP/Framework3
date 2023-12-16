<?php

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
