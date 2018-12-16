<?php

//TODO Add config from file.

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

    $pdo->query('CREATE TABLE `users` (
        `id_user` int(11) NOT NULL,
        `full_name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
        `login` varchar(50) COLLATE utf8_polish_ci NOT NULL,
        `password` varchar(50) COLLATE utf8_polish_ci NOT NULL,
        `register_a` date NOT NULL,
        `is_admin` tinyint(1) NOT NULL,
        `added_at` date NOT NULL,
        `modified_at` date NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;');

    $pdo->query('CREATE TABLE `posts` (
        `id_post` int(11) NOT NULL,
        `id_user` int(11) NOT NULL,
        `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
        `content` varchar(50) COLLATE utf8_polish_ci NOT NULL,
        `added_at` date NOT NULL,
        `modified_at` date NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;');

    $pdo->query('CREATE TABLE `komments` (
        `id_komment` int(11) NOT NULL,
        `id_post` int(11) NOT NULL,
        `content` varchar(50) COLLATE utf8_polish_ci NOT NULL,
        `added_at` date NOT NULL,
        `modified` date NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;');
}

/**
 * Check if current user is admin.
 *
 * @return bool
 */
function is_admin(): bool
{
    return true;
}