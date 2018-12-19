<!-- Page Header -->
<header class="masthead" style="background-image: url('<?= HOME_URL; ?>assets/images/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Blog podróżniczy dla ciekawych świata!</h1>
                    <span class="subheading">
                        Opisy wycieczek, subiektywne przewodniki, piękne zdjęcia i mnóstwo porad jak zaplanować własny wyjazd.
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php foreach (get_posts(true) as $post): ?>
                <div class="post-preview">
                    <a href="<?= HOME_URL; ?>posts/<?= $post['post_id']; ?>">
                        <h2 class="post-title">
                            <?= $post['title']; ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?= @reset(preg_split('~[.?!]~', $post['content'])); ?>.
                        </h3>
                    </a>
                    <p class="post-meta">Opublikowany przez
                        <a href="#"><?= $post['display_name']; ?></a>
                        dnia <?= date('d M Y', strtotime($post['modified_at'])); ?>
                        o godzinie <?= date('H:i', strtotime($post['modified_at'])); ?></p>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>