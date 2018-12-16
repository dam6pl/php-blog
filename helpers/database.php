<?php

try {
    /* @var $pdo PDO */
    $pdo = new PDO(
        sprintf(
            "mysql:host=%s;dbname=%s;port=3306",
            DB_HOST,
            DB_NAME
        ),
        DB_USER,
        DB_PASS
    );
} catch (PDOException $exception) {
    die($exception->getMessage());
}

/**
 * Create tables in the database.
 *
 * @uses PDO $pdo
 */
function create_database()
{
    global $pdo;


}

/**
 * Check if current user is admin.
 *
 * @return bool
 */
function is_admin(): bool {
    return true;
}