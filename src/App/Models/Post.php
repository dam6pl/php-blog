<?php
declare(strict_types=1);

namespace App\Models;

use Core\AModel;
use PDO;

class Post extends AModel
{
    /**
     * @param int $id
     *
     * @return object
     */
    public static function getPost(int $id): object
    {
        $db = static::getDB();

        $post = $db->query("SELECT * FROM posts LEFT JOIN users ON posts.author_id = users.user_id 
    WHERE post_id = {$id}");

        return self::filterPost($post->fetch(PDO::FETCH_OBJ));
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        $db = static::getDB();

        $posts = $db->query('SELECT post_id, users.display_name, users.login, title, content, image_url, 
    posts.added_at, posts.modified_at FROM posts LEFT JOIN users ON posts.author_id = users.user_id 
    ORDER BY posts.post_id');

        return \array_map(
            [__CLASS__, 'filterPost'],
            $posts->fetchAll(PDO::FETCH_OBJ)
        );
    }

    /**
     * @param object $post
     *
     * @return object
     */
    private static function filterPost(object $post): object
    {
        $content = \strip_tags($post->content);
        $content = \preg_split('~[.?!]~', $content);

        $post->content = @\reset($content);
        $post->date = date('d M Y', strtotime($post->modified_at));
        $post->hour = date('H:i', strtotime($post->modified_at));

        return $post;
    }
}