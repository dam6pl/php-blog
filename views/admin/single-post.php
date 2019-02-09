<?php
/**
 * $var int $post_id Post ID
 */

$post = is_numeric($post_id) ? get_post($post_id) : null;
?>

<div class="container mt-5 pt-5">
    <form method="POST" id="single-post-edit">
        <input type="text" name="action" title="action" value="action_save_post" hidden>
        <input type="text" name="post_id" title="post_id" value="<?= $post['post_id'] ?? ''; ?>" hidden>
        <div class="form-group">
            <label for="title">Tytuł postu</label>
            <input type="text" class="form-control" name="title" value="<?= $post['title'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Treść postu</label>
            <textarea class="form-control" name="content" id="visual-content" rows="10" required
                      style="opacity: 0"><?= $post['content'] ?? ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Zdjęcie postu</label>
            <input type="url" class="form-control" name="image" value="<?= $post['image_url'] ?? ''; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary float-right">Zapisz post</button>
    </form>
</div>