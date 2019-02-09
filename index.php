<?php

session_start();

define('REQUEST_URL', $_SERVER['REQUEST_URI']);
define('HOME_URL', str_replace(
        'index.php', '',
        (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'])
);
define('MAILS_DIR', __DIR__ . '/mails');

//Redirect AJAX request to separate file and break loading page
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    include_once 'helpers/ajax.php';
    die();
}

//Require helpers
require_once 'helpers/database.php';
require_once 'helpers/session.php';
require_once 'helpers/request.php';

//Simple router
include_once 'helpers/router.php';
