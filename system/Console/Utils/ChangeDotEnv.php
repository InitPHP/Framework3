<?php

namespace InitPHP\Framework\Console\Utils;

class ChangeDotEnv
{

    private string $env;

    private array $change = [];

    public function __construct()
    {
        $this->env = file_get_contents(BASE_DIR . ".env");
    }

    public function change(string $key, string $value): self
    {
        $this->change[$key] = $value;

        return $this;
    }

    public function save(?string $path = null): bool
    {
        if (!empty($this->change)) {
            foreach ($this->change as $key => $value) {
                $this->env = preg_replace('/^' . preg_quote($key, '/') . '\s*=\s*(["\']?).*\1/m', ($key . '=${2}' . $value . '${2}'), $this->env);
            }
        }
        $path = empty($path) ? (BASE_DIR . ".env") : $path;

        return file_put_contents($path, $this->env) !== false;
    }

}
