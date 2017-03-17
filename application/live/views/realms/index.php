<div class="container">
    <h2><?php echo $title; ?></h2>

<?php foreach ($realms as $realm): ?>

        <h3><?php echo $realm['name'].' - '.$realm['altnames']; ?></h3>
        <p><a href="<?php echo site_url('realms/'.$realm['slug']); ?>">View Realm</a></p>

<?php endforeach; ?>
</div>