<div class="container">
    <h2><?php echo $title; ?></h2>

<?php foreach ($locations as $location): ?>

        <h3><?php echo $location['name'].' - '.$location['altnames']; ?></h3>
        <p><a href="<?php echo site_url('locations/'.$location['slug']); ?>">View location</a></p>

<?php endforeach; ?>
</div>
