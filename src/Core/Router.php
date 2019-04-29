<?php
declare(strict_types=1);

namespace Core;

/**
 * Class Router
 *
 * @package Core
 */
class Router
{
    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $router = $this;
        require_once __DIR__ . '/../../web/routing.php';
    }


    /**
     * @param       $route
     * @param array $params
     */
    public function add(string $route, array $params = []): void
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param $url
     *
     * @return bool
     */
    public function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param $url
     *
     * @throws Exception
     */
    public function dispatch(string $url): void
    {
        $url = $this->removeQueryStringVariables($url);
        if ($this->match($url)) {
            if (isset($this->params['middleware'])) {
                $middleware = $this->params['middleware'];
                $middleware = $this->convertToStudlyCaps($middleware);
                $middleware = $this->getMiddlewareNamespace() . $middleware;

                if ($middleware instanceof AMiddleware) {
                    /** @var AMiddleware $middleware_object */
                    $middleware_object = new $middleware($this->params);
                    $middleware_object->handle();
                }
            }

            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;
            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
                if (preg_match('/action$/i', $action) === 0) {
                    $controller_object->$action();
                } else {
                    throw new Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
                }
            } else {
                throw new Exception("Controller class $controller not found");
            }
        } else {
            throw new Exception('No route matched.', 404);
        }
    }

    /**
     * @param $string
     *
     * @return string
     */
    protected function convertToStudlyCaps(string $string): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * @param $string
     *
     * @return string
     */
    protected function convertToCamelCase(string $string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     * @param $url
     *
     * @return string
     */
    protected function removeQueryStringVariables(string $url): string
    {
        if ($url !== '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    /**
     * @return string
     */
    protected function getNamespace(): string
    {
        $namespace = 'App\Controllers\\';
        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }


    /**
     * @return string
     */
    protected function getMiddlewareNamespace(): string
    {
        $namespace = 'App\Middleware\\';
        if (array_key_exists('middleware_namespace', $this->params)) {
            $namespace .= $this->params['middleware_namespace'] . '\\';
        }
        return $namespace;
    }
}