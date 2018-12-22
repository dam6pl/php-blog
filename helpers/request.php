<?php

//Simple routing for POST requests
if (!empty($_POST) && isset($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    if (function_exists($action)) {
        $action();
    }

    if ($action !== 'action_save_post') {
        header("Location: " . REQUEST_URL);
    }
}

/**
 * Login user.
 */
function action_login(): void
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
function action_logout(): void
{
    remove_session();
}

/**
 * Register user.
 */
function action_register_account(): void
{
    $display_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    create_user($login, $password, $display_name);
}

/**
 * Save single post content.
 */
function action_save_post(): void
{
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content');
    $image = filter_input(INPUT_POST, 'image', FILTER_VALIDATE_URL);

    $postid = update_post($post_id ?: 0, $title, $content, $image);

    header("Location: " . HOME_URL . "admin/posts/{$postid}");
}

/**
 * Remove single post.
 */
function action_remove_post(): void
{
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);

    delete_post($post_id);
}

/**
 * Add new comment.
 */
function action_add_comment(): void
{
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'message');

    create_comment($post_id, $name, $content);
}

/**
 * Remove single post.
 */
function action_remove_comment(): void
{
    $comment_id = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT);

    delete_comment($comment_id);
}

function action_remove_user(): void
{
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

    delete_user($user_id);
}