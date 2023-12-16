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
namespace InitPHP\Framework\HTTP;

use InitPHP\Framework\HTTP\Exceptions\RequestInvalidException;
use InitPHP\Validation\Validation;

/**
 * @mixin \InitPHP\HTTP\Message\Request
 */
abstract class FormRequest
{

    protected \InitPHP\HTTP\Message\Request $request;

    protected Validation $validation;

    public function __construct()
    {
        $this->request = \InitPHP\HTTP\Message\Request::createFromGlobals();
        $this->prepare();
        $this->validation = new Validation($this->request->all());
        $rules = $this->rules();
        if (!empty($rules)) {
            foreach ($rules as $key => $rule) {
                $this->validation->rule($key, $rule);
            }
            if (!$this->validation->validation()) {
                if (env("APP_ENV", "production") === "development") {
                    throw new RequestInvalidException(implode(", " . \PHP_EOL, $this->validation->getError()));
                }
                abort(400);
            }
        }
    }

    public function __isset(string $name): bool
    {
        return $this->request->__isset($name);
    }

    public function __get(string $name)
    {
        return $this->request->__get($name);
    }

    public function __set(string $name, $value)
    {
        return $this->request->__set($name, $value);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->request->{$name}(...$arguments);
    }

    /**
     * @return void
     */
    protected function prepare()
    {
    }

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [];
    }

}
