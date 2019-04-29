<?php
declare(strict_types=1);

namespace App\Models;

use Core\AModel;
use PDO;

class Comment extends AModel
{
    /**
     * @param int $id
     *
     * @return array
     */
    public static function getAllForPost(int $id): array
    {
        $db = static::getDB();

        $comments = $db->query("SELECT * FROM comments WHERE post_id = {$id}");

        return \array_map(
            [__CLASS__, 'filterComment'],
            $comments->fetchAll(PDO::FETCH_OBJ)
        );
    }


    /**
     * @param object $comment
     *
     * @return object
     */
    private static function filterComment(object $comment): object
    {
        $comment->date = date('d M Y', strtotime($comment->added_at));
        $comment->hour = date('H:i', strtotime($comment->added_at));

        return $comment;
    }
}