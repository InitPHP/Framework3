<?php

namespace App\HTTP\Middlewares;

use \Psr\Http\Message\{RequestInterface, ResponseInterface};

class Middleware extends \InitPHP\Framework\HTTP\Middleware
{

    /**
     * @inheritDoc
     */
    public function before(RequestInterface $request, ResponseInterface $response, array $arguments = []): ?ResponseInterface
    {
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function after(RequestInterface $request, ResponseInterface $response, array $arguments = []): ?ResponseInterface
    {
        return $response;
    }

}
