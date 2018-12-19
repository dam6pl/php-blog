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

    $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

    create_database();
} catch (PDOException $exception) {
    die($exception->getMessage());
}

/**
 * Create tables in the database.
 */
function create_database(): void
{
    global $pdo;

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $pdo->exec('CREATE TABLE IF NOT EXISTS users (
        user_id int(11) NOT NULL AUTO_INCREMENT,
        login varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
        password varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
        display_name varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
        is_admin bool NOT NULL,
        added_at datetime NOT NULL,
        modified_at datetime NOT NULL,
        PRIMARY KEY (user_id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');

        $pdo->exec('CREATE TABLE IF NOT EXISTS posts (
        post_id int(11) NOT NULL AUTO_INCREMENT,
        author_id int(11) NOT NULL,
        title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        content LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
        image_url varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        added_at datetime NOT NULL,
        modified_at datetime NOT NULL,
        PRIMARY KEY (post_id),
        FOREIGN KEY (author_id) REFERENCES users(user_id) 
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');

        $pdo->exec('CREATE TABLE IF NOT EXISTS comments (
        comment_id int(11) NOT NULL AUTO_INCREMENT,
        post_id int(11) NOT NULL,
        content varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        added_at datetime NOT NULL,
        modified datetime NOT NULL,
        PRIMARY KEY (comment_id),
        FOREIGN KEY (post_id) REFERENCES posts(post_id) 
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    } catch (PDOException $e) {
        die($e->getMessage());
    }
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

/**
 * Get list of posts.
 *
 * @param bool $order_desc
 *
 * @return array
 */
function get_posts(bool $order_desc = false): array
{
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM posts JOIN users ORDER BY post_id " . ($order_desc ? "DESC" : "ASC"));
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get single post.
 *
 * @param int $post_id
 *
 * @return array
 */
function get_post(int $post_id): array
{
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM posts JOIN users WHERE post_id = ?");
    $query->execute([$post_id]);

    return $query->fetch(PDO::FETCH_ASSOC);
}

/**
 * Update post or create new when Post ID is 0.
 *
 * @param int    $post_id
 * @param string $title
 * @param string $content
 * @param string $image_url
 */
function update_post(int $post_id, string $title, string $content, string $image_url): void
{
    global $pdo;

    $current_time = date('Y-m-d H:i:s');

    if ($post_id > 0) {
        $query = $pdo->prepare("UPDATE posts SET title = ?, content = ?, image_url = ?, modified_at = ? WHERE post_id = ?");
        $query->execute([$title, $content, $image_url, $current_time, $post_id]);
    } else {
        $query = $pdo->prepare("INSERT INTO posts(author_id, title, content, image_url, added_at, modified_at) VALUES (?, ?, ?, ?, ?, ?)");
        $query->execute([
            $_SESSION['user_id'],
            $title,
            $content,
            $image_url,
            $current_time,
            $current_time
        ]);
    }
}

/**
 * Remove post from database.
 *
 * @param int $post_id
 */
function delete_post(int $post_id): void
{
    global $pdo;

    $query = $pdo->prepare("DELETE FROM posts WHERE post_id = ?");
    $query->execute([$post_id]);
}

/**
 * Get list of users.
 *
 * @return array
 */
function get_users(): array
{
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM users");
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get single user details based on login details.
 *
 * @param string $login
 * @param string $password
 *
 * @return array
 */
function get_user(string $login, string $password): array
{
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
    $query->execute([$login, md5($password)]);

    return $query->fetch(PDO::FETCH_ASSOC) ?: [];
}