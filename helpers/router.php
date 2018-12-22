<?php

if (preg_match('/^\/admin$|\/admin\//', REQUEST_URL)) {
    //Require static header
    require_once 'views/admin/partials/header.php';

    if (is_logged()) {
        switch (REQUEST_URL) {
            case '/admin':
                require 'views/admin/all-posts.php';
                break;
            case (bool)preg_match('/^\/admin\/posts\/(?<ID>(?:\d+|new))\/?/', REQUEST_URL, $matches):
                $post_id = $matches[1];
                require 'views/admin/single-post.php';
                break;
            case '/admin/users':
                require 'views/admin/all-users.php';
                break;
            case '/admin/comments':
                require 'views/admin/all-comments.php';
                break;
            default:
                header("Location: " . HOME_URL . "admin");
        }
    } else {
        switch (REQUEST_URL) {
            case '/admin':
                require 'views/admin/login.php';
                break;
            case '/admin/create-account':
                require 'views/admin/register.php';
                break;
            default:
                header("Location: " . HOME_URL . "/admin");
        }
    }

    //Require static footer
    require_once 'views/admin/partials/footer.php';
} else {
    //Require static header
    require_once 'views/partials/header.php';

    switch (REQUEST_URL) {
        case '/':
            require 'views/home.php';
            break;
        case '/about':
            require 'views/about.php';
            break;
        case '/contact':
            require 'views/contact.php';
            break;
        case (bool)preg_match('/^\/posts\/(?<ID>\d+)\/?$/', REQUEST_URL, $matches):
            $post = get_post($matches[1]);
            if ($post) {
                require 'views/post.php';
                break;
            }
        default:
            header('HTTP/1.0 404 Not Found');
            require 'views/404.php';
    }

    //Require static footer
    require_once 'views/partials/footer.php';
}
