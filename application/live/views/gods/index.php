<h2><?php echo $title; ?></h2>

<?php foreach ($gods as $god): ?>

        <h3><?php echo $god['name']; ?> - <?php echo $god['altnames']; ?></h3>
        <p><a href="<?php echo site_url('gods/'.$god['slug']); ?>">View god</a></p>

<?php endforeach; ?>
