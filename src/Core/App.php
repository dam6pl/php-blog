<?php
declare(strict_types=1);

namespace Core;

/**
 * Class App
 *
 * @package Core
 */
class App
{
    /**
     * @var Router
     */
    public $router;

    /**
     * App constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->router = new Router();
        $this->router->dispatch($_SERVER['REQUEST_URI']);
    }
}