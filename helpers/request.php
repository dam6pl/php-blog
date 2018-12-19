<?php

//Simple routing for POST requests
if (!empty($_POST) && isset($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);
    var_dump($_POST);
    if (function_exists($action)) {
        $action();
    }
}

function login()
{
    $user = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (user_exist($user, $password)) {
        create_session($user);
    }
}

function logout() {
    remove_session();
}

function register_account()
{
    echo "elo";
}