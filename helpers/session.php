<?php

/**
 * Create new session on logged in.
 *
 * @param array $user
 */
function create_session(array $user): void
{
    $_SESSION['login'] = $user['login'];
    $_SESSION['user_id'] = $user['user_id'];
}

/**
 * Remove session on logged out.
 */
function remove_session(): void
{
    session_destroy();
    $_SESSION['login'] = null;
    $_SESSION['user_id'] = null;
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