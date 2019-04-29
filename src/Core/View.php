<?php
declare(strict_types=1);

namespace Core;

use \Twig\Error;

class View
{
    /**
     * @param string $view
     * @param array  $args
     *
     * @throws Exception
     */
    public static function render(string $view, array $args = []): void
    {
        extract($args, EXTR_SKIP);
        $file = dirname(__DIR__) . "/Views/{$view}";
        if (is_readable($file)) {
            require $file;
        } else {
            throw new Exception("$file not found");
        }
    }

    /**
     * @param       $template
     * @param array $args
     *
     * @throws Error\LoaderError
     * @throws Error\RuntimeError
     * @throws Error\SyntaxError
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/Views');
            $twig = new \Twig_Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}