<div class="container mt-5 pt-5">
    <div class="col-12">
        <a href="<?= HOME_URL; ?>/admin/posts/new"
            class="btn btn-primary float-right mb-3">Dodaj nowy post</a>
        <table class="table table-bordered posts-list">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tytuł</th>
                <th scope="col">Autor</th>
                <th scope="col">Utworzono</th>
                <th scope="col">Ostatnia modyfikacja</th>
                <th scope="col">Zarządzaj</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (get_posts() as $post): ?>
                <tr>
                    <th scope="row"><?= $post['post_id']; ?></th>
                    <td><?= $post['title']; ?></td>
                    <td><?= "{$post['display_name']} ({$post['login']})"; ?></td>
                    <td><?= $post['added_at']; ?></td>
                    <td><?= $post['modified_at']; ?></td>
                    <td class="actions">
                        <a href="<?= HOME_URL; ?>admin/posts/<?= $post['post_id']; ?>">
                        <span class="fa-stack fa-sm">
                            <i class="fas fa-edit fa-stack-1x"></i>
                        </span>
                        </a>
                        <form action="" method="post">
                            <input type="text" name="action" title="action" value="remove_post" hidden>
                            <input type="text" name="post_id" title="post_id" value="<?= $post['post_id']; ?>" hidden>
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
</div>