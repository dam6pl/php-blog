<?php

/**
 * Create new session on logged in.
 *
 * @param string $login User login.
 */
function create_session(string $login): void
{
    $_SESSION['login'] = $login;
}

/**
 * Remove session on logged out.
 */
function remove_session(): void
{
    session_destroy();
    $_SESSION['login'] = null;
}

/**
 * Check if current user is logged.
 *
 * @return bool
 */
function is_logged(): bool
{
    return isset($_SESSION['login']) && $_SESSION['login'] !== null;
}