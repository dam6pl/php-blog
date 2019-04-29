<?php
declare(strict_types=1);

namespace Core;

abstract class AMiddleware
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
     * @return mixed
     */
    abstract public function handle(): void;
}