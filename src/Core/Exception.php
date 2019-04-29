<?php
declare(strict_types=1);

namespace Core;

use App\Config;

class Exception extends \Exception
{
    /**
     * @param $level
     * @param $message
     * @param $file
     * @param $line
     *
     * @throws \Exception
     */
    public static function errorHandler($level, $message, $file, $line): void
    {

    }

    /**
     * @param \Throwable $exception
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function exceptionHandler($exception): void
    {
        $code = $exception->getCode();

        if ($code !== 404) {
            $code = 500;
        }

        http_response_code($code);

        if (Config::SHOW_ERRORS) {
            echo "<h1>Fatal error</h1>";
            echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
            echo "<p>Message: '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        } else {
            View::renderTemplate('404.twig');
        }
    }
}