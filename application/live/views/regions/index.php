<div class="container">
    <h2><?php echo $title; ?></h2>

<?php foreach ($regions as $region): ?>

        <h3><?php echo $region['name'].' - '.$region['altnames']; ?></h3>
        <p><a href="<?php echo site_url('regions/'.$region['slug']); ?>">View Region</a></p>

<?php endforeach; ?>
</div>
