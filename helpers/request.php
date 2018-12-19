<?php

//Simple routing for POST requests
if (!empty($_POST) && isset($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    if (function_exists($action)) {
        $action();
    }

    header("Location: " . HOME_URL . "admin");
}

/**
 * Login user.
 */
function login(): void
{
    $user = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (!empty($user = get_user($user, $password))) {
        create_session($user);
    }
}

/**
 * Logout user.
 */
function logout(): void
{
    remove_session();
}

/**
 * Register user.
 */
function register_account(): void
{
    //TODO register user.
}

/**
 * Save single post content.
 */
function save_post()
{
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content');
    $image = filter_input(INPUT_POST, 'image', FILTER_VALIDATE_URL);

    update_post($post_id ?: 0, $title, $content, $image);
}

/**
 * Remove single post.
 */
function remove_post(): void
{
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
    var_dump($post_id);
    delete_post($post_id);
}