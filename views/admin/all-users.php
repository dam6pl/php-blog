<div class="container mt-5 pt-5">
    <table class="table table-bordered posts-list">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Login</th>
            <th scope="col">Nazwa wyświetlana</th>
            <th scope="col">Rola</th>
            <th scope="col">Utworzono</th>
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
                <td class="actions">
                    <?php if ($_SESSION['login'] !== $user['login']): ?>
                        <form action="" method="post"
                              onsubmit="return confirm('Jeśli usuniesz użytkownika, ' +
                               'zostaną usunięte wszystkie jego posty. Jesteś tego pewien?');">
                            <input type="text" name="action" title="action" value="action_remove_user" hidden>
                            <input type="text" name="user_id" title="user_id" value="<?= $user['user_id']; ?>" hidden>

                            <button type="submit">
                            <span class="fa-stack fa-sm">
                                <i class="fas fa-trash-alt fa-stack-1x"></i>
                            </span>
                            </button>
                        </form>
                    <?php else: ?>
                        <span class="fa-stack fa-sm">
                            <i class="fas fa-times fa-stack-1x"></i>
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>