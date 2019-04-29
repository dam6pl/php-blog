<?php
declare(strict_types=1);

/**
 * @var \Core\Router $router
 */

$router->add('/', ['controller' => 'PageController', 'action' => 'index']);
$router->add('/about', ['controller' => 'PageController', 'action' => 'about']);
$router->add('/contact', ['controller' => 'PageController', 'action' => 'contact']);

$router->add('/posts/{id:\d+}', ['controller' => 'PostController', 'action' => 'single']);
$router->add('/admin/posts', ['controller' => 'PostController', 'action' => 'index']);
$router->add('/admin/posts/{id:\d+}', ['controller' => 'PostController', 'action' => 'edit']);
