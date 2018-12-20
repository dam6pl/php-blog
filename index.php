<?php

session_start();

define('REQUEST_URL', str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF']));
define('HOME_URL', str_replace(
        'index.php', '',
        'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'])
);

//Require helpers
require_once 'helpers/database.php';
require_once 'helpers/session.php';
require_once 'helpers/request.php';

//Simple router
include_once 'helpers/router.php';
