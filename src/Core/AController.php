<?php
declare(strict_types=1);

namespace Core;

/**
 * Class AController
 *
 * @package Core
 */
abstract class AController
{
    /**
     * @var array
     */
    protected $route_params = [];

    /**
     * AController constructor.
     *
     * @param array $route_params
     */
    public function __construct(array $route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * @param $name
     * @param $args
     *
     * @throws Exception
     */
    public function __call(string $name, array $args): void
    {
        $method = $name . 'Action';
        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], $args);
        } else {
            throw new Exception("Method $method not found in controller " . get_class($this));
        }
    }
}