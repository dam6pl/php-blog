<?php

if (!empty($_POST) && isset($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    if (function_exists($action)) {
        $action();
    }
}

function register_account() {
    echo "elo";
}