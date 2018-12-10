<?php
$request_uri = $_SERVER['REQUEST_URI'];

if (preg_match('/\/admin$|\/admin\//', $request_uri)) {
    //Require static header
    require_once 'views/admin/partials/header.php';

    if (is_logged()) {
        switch ($request_uri) {
            case '/admin':
                require 'views/admin/home.php';
                break;
            default:
                header('Redirect: /admin');
        }
    } else {
        switch ($request_uri) {
            case '/admin':
                require 'views/admin/login.php';
                break;
            case '/admin/create-account':
                require 'views/admin/create-account.php';
                break;
            default:
                header('Location: /admin');
        }
    }

    //Require static footer
    require_once 'views/admin/partials/footer.php';
} else {
    //Require static header
    require_once 'views/partials/header.php';

    if (preg_match('/\/post\/(?<ID>\d+)\/?/', $request_uri, $matches)) {
        $post_id = $matches[1];
        require 'views/post.php';
    } else {
        switch ($request_uri) {
            case '/':
                require 'views/home.php';
                break;
            case '/about':
                require 'views/about.php';
                break;
            case '/contact':
                require 'views/contact.php';
                break;
            default:
                header('HTTP/1.0 404 Not Found');
                require 'views/404.php';
        }
    }

    //Require static footer
    require_once 'views/partials/footer.php';
}
