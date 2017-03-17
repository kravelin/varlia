<div class="container">
    <h2><?php echo $title; ?></h2>

<?php foreach ($factions as $faction): ?>

        <h3><?php echo $faction['name']; ?></h3>
        <p><a href="<?php echo site_url('factions/'.$faction['slug']); ?>">View Faction</a></p>

<?php endforeach; ?>
</div>
