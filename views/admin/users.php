<div class="container mt-5 pt-5">
    <div class="col-12">
        <table class="table table-bordered posts-list">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Login</th>
                <th scope="col">Nazwa wyświetlana</th>
                <th scope="col">Rola</th>
                <th scope="col">Utworzono</th>
                <th scope="col">Ostatnia modyfikacja</th>
                <th scope="col">Zarządzaj</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (get_users() as $user): ?>
                <tr>
                    <th scope="row"><?= $user['user_id']; ?></th>
                    <td><?= $user['login']; ?></td>
                    <td><?= $user['display_name']; ?></td>
                    <td><?= $user['is_admin'] ? 'Administrator' : 'Użytkownik'; ?></td>
                    <td><?= $user['added_at']; ?></td>
                    <td><?= $user['modified_at']; ?></td>
                    <td class="actions">
                        <a href="<?= HOME_URL; ?>admin/post/1">
                        <span class="fa-stack fa-sm">
                            <i class="fas fa-edit fa-stack-1x"></i>
                        </span>
                        </a>
                        <form action="" method="post">
                            <input type="text" name="action" title="action" value="remove_post" hidden>
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