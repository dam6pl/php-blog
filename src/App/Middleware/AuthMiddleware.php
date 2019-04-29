<?php
declare(strict_types=1);

namespace App\Providers;

use Core\AMiddleware;

class AuthMiddleware extends AMiddleware
{
    public function handle(): void
    {
        //TODO Jeśli użytkownik niezalogowany, przekierować do logowania!
    }
}