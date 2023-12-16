<?php

namespace InitPHP\Framework\HTTP;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Router extends \InitPHP\Router\Router
{

    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        parent::__construct($request, $response, [
            'paths'                 => [
                'controller'            => APP_DIR . 'HTTP/Controllers/',
                'middleware'            => APP_DIR . 'HTTP/Middlewares/',
            ],
            'namespaces'            => [
                'controller'            => 'App\\HTTP\\Controllers',
                'middleware'            => 'App\\HTTP\\Middlewares',
            ],
            'base_path'             => env('BASE_PATH', '/'),
            'variable_method'       => true,
            'argument_new_instance' => true,
        ]);
    }

    public function getRoutes(?string $method = null): array
    {
        $res = [];
        if($method === null){
            foreach ($this->routes as $id => $route) {
                foreach ($route['methods'] as $_method) {
                    if(!isset($res[$_method])){
                        $res[$_method] = [];
                    }
                    $res[$_method][$route['path']] = [
                        'execute'   => $route['execute'],
                        'options'   => array_merge($route['options'], ['name' => $this->findNameByRouteId($id)]),
                    ];
                }
            }
            return $res;
        }

        $method = \strtoupper($method);
        if(isset($this->methodIds[$method])){
            foreach ($this->methodIds[$method] as $id) {
                $route = $this->routes[$id];
                $res[$route['path']] = [
                    'execute'   => $route['execute'],
                    'options'   => array_merge($route['options'], ['name' => $this->findNameByRouteId($id)]),
                ];
            }
        }

        return $res;
    }

    public function findNameByRouteId(int $id): ?string
    {
        $name = array_search($id, $this->names);

        return empty($name) ? null : $name;
    }

}
