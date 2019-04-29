<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Post;
use Core\AController;
use Core\View;

/**
 * Class App
 *
 * @package Core
 */
class PageController extends AController
{
    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(): void
    {
        View::renderTemplate(
            'Index.twig',
            [
                'title'     => 'Blog podróżniczy dla ciekawych świata!',
                'sub_title' => 'Opisy wycieczek, subiektywne przewodniki, piękne zdjęcia i mnóstwo porad jak zaplanować własny wyjazd.',
                'posts'     => Post::getAll()
            ]
        );
    }

    public function about(): void
    {

    }

    public function contact():void
    {

    }
}