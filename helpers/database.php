<?php

if ($config_file = @file_get_contents('config.conf')) {
    foreach (explode(PHP_EOL, $config_file) as $single) {
        list($k, $v) = explode(':', $single);
        $config[$k] = $v;
    }
} else {
    die('Plik konfiguracyjny nie został utworzony!');
}

try {
    /* @var $pdo PDO */
    $pdo = new PDO(
        sprintf(
            "mysql:host=%s;dbname=%s;port=3306",
            $config['DB_HOST'],
            $config['DB_NAME']
        ),
        $config['DB_USER'],
        $config['DB_PASS']
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
        password varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        display_name varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
        is_admin bool NOT NULL,
        added_at datetime NOT NULL,
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
        FOREIGN KEY (author_id) REFERENCES users(user_id) ON DELETE CASCADE 
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');

        $pdo->exec('CREATE TABLE IF NOT EXISTS comments (
        comment_id int(11) NOT NULL AUTO_INCREMENT,
        post_id int(11) NOT NULL,
        name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        content LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
        added_at datetime NOT NULL,
        PRIMARY KEY (comment_id),
        FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE 
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

/**
 * Get list of posts.
 *
 * @return array
 */
function get_posts(): array
{
    global $pdo;

    $query = $pdo->prepare("SELECT post_id, users.display_name, users.login, title, content, image_url, 
posts.added_at, posts.modified_at FROM posts LEFT JOIN users ON posts.author_id = users.user_id 
ORDER BY posts.post_id ");
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

    $query = $pdo->prepare("SELECT * FROM posts LEFT JOIN users ON posts.author_id = users.user_id  WHERE post_id = ?");
    $query->execute([$post_id]);

    return $query->fetch(PDO::FETCH_ASSOC) ?: [];
}

/**
 * Update post or create new when Post ID is 0.
 *
 * @param int    $post_id
 * @param string $title
 * @param string $content
 * @param string $image_url
 *
 * @return int
 */
function update_post(int $post_id, string $title, string $content, string $image_url): int
{
    global $pdo;

    $current_time = date('Y-m-d H:i:s');

    if ($post_id > 0) {
        $query = $pdo->prepare("UPDATE posts SET title = ?, content = ?, image_url = ?, 
modified_at = ? WHERE post_id = ?");
        $query->execute([$title, $content, $image_url, $current_time, $post_id]);
    } else {
        $query = $pdo->prepare("INSERT INTO posts(author_id, title, content, image_url, 
added_at, modified_at) VALUES (?, ?, ?, ?, ?, ?)");
        $query->execute([
            $_SESSION['user_id'],
            $title,
            $content,
            $image_url,
            $current_time,
            $current_time
        ]);

        $post_id = $pdo->lastInsertId();
    }

    return (int)$post_id;
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

    $query = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $query->execute([$login]);

    $user_info = $query->fetch(PDO::FETCH_ASSOC);

    if (isset($user_info['password']) && password_verify($password, $user_info['password'])) {
        return $user_info;
    }

    return [];
}

/**
 * Create new user.
 *
 * @param string $login
 * @param string $password
 * @param string $display_name
 */
function create_user(string $login, string $password, string $display_name): void
{
    global $pdo;

    $current_time = date('Y-m-d H:i:s');

    $query = $pdo->prepare("INSERT INTO users(login, password, display_name, is_admin, added_at) 
VALUES(?, ?, ?, ?, ?)");
    $query->execute([
        $login,
        password_hash($password, PASSWORD_DEFAULT),
        $display_name,
        0,
        $current_time
    ]);
}

/**
 * Delete single user.
 *
 * @param int $user_id
 */
function delete_user(int $user_id): void
{
    global $pdo;

    $query = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    $query->execute([$user_id]);
}

/**
 * Create new comment
 *
 * @param int    $post_id
 * @param string $name
 * @param string $message
 */
function create_comment(int $post_id, string $name, string $message): void
{
    global $pdo;

    $current_time = date('Y-m-d H:i:s');

    $query = $pdo->prepare("INSERT INTO comments(post_id, name, content, added_at) 
VALUES(?, ?, ?, ?)");
    $query->execute([
        $post_id,
        $name,
        $message,
        $current_time
    ]);
}

/**
 * Get comments.
 *
 * @param int $post_id
 *
 * @return array
 */
function get_comments(int $post_id = 0): array
{
    global $pdo;
    if ($post_id > 0) {
        $query = $pdo->prepare("SELECT * FROM comments WHERE post_id = ?");
        $query->execute([$post_id]);
    } else {
        $query = $pdo->prepare("SELECT comment_id, posts.post_id, posts.title as post_title, 
comments.name, comments.content, comments.added_at FROM comments LEFT JOIN posts on comments.post_id = posts.post_id");
        $query->execute();
    }

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Delete single user.
 *
 * @param int $comment_id
 */
function delete_comment(int $comment_id): void
{
    global $pdo;

    $query = $pdo->prepare("DELETE FROM comments WHERE comment_id = ?");
    $query->execute([$comment_id]);
}