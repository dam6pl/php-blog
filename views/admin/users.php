<div class="container mt-5 pt-5">
    <div class="col-12">
        <table class="table table-bordered posts-list">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tytuł</th>
                <th scope="col">Autor</th>
                <th scope="col">Ostatnia modyfikacja</th>
                <th scope="col">Zarządzaj</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Wpis pierwszy</td>
                <td>Damian Nowak (dam6pl)</td>
                <td><?= date('d M Y H:m:s'); ?></td>
                <td class="actions">
                    <a href="/admin/post/1">
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
            </tbody>
        </table>
    </div>
</div>