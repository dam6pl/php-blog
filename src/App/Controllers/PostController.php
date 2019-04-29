<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Core\AController;
use Core\View;

/**
 * Class App
 *
 * @package Core
 */
class PostController extends AController
{
    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function single(): void
    {
        View::renderTemplate(
            'Post.twig',
            [
                'post' => Post::getPost((int)$this->route_params['id']),
                'comments' => Comment::getAllForPost((int)$this->route_params['id'])
            ]
        );
    }
}