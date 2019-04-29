<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Exception::errorHandler');
set_exception_handler('Core\Exception::exceptionHandler');

new Core\App();