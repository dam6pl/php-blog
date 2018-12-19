<?php
/**
 * @var int $post_id Post ID.
 */

$post = get_post($post_id);

?>

<!-- Page Header -->
<header class="masthead" style="background-image: url('<?= $post['image_url']; ?>')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1><?= $post['title']; ?></h1>
                    <span class="meta">Opublikowany przez
                        <a href="#"><?= $post['display_name']; ?></a>
                        dnia <?= date('d M Y', strtotime($post['modified_at'])); ?>
                        o godzinie <?= date('H:i', strtotime($post['modified_at'])); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <?= $post['content']; ?>
            </div>
        </div>
    </div>
</article>