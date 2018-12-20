<div class="container mt-5 pt-5">
    <table class="table table-bordered posts-list">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Post</th>
            <th scope="col">Autor</th>
            <th scope="col">Komentarz</th>
            <th scope="col">Utworzono</th>
            <th scope="col">Zarządzaj</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (get_comments() as $comment): ?>
            <tr>
                <th scope="row"><?= $comment['comment_id']; ?></th>
                <td>
                    <a href="<?= HOME_URL; ?>posts/<?= $comment['post_id']; ?>">
                        <?= $comment['post_title']; ?>
                    </a>
                </td>
                <td><?= $comment['name']; ?></td>
                <td><?= $comment['content']?></td>
                <td><?= $comment['added_at']; ?></td>
                <td class="actions">
                    <form action="" method="post">
                        <input type="text" name="action" title="action" value="action_remove_comment" hidden>
                        <input type="text" name="comment_id" title="comment_id" value="<?= $comment['comment_id']; ?>" hidden>
                        <button type="submit">
                        <span class="fa-stack fa-sm">
                            <i class="fas fa-trash-alt fa-stack-1x"></i>
                        </span>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>