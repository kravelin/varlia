<h2><?php echo $title; ?></h2>

<?php foreach ($monsters as $monster): ?>

        <h3><?php echo $monster['name']; ?></h3>
        <p><a href="<?php echo site_url('monsters/'.$monster['slug']); ?>">View monster</a></p>

<?php endforeach; ?>
