<div class="container">
    <h1><?php echo $name ?></h1>
    <h2><?php echo $location['altnames'] ?></h2>

    <div class="location-stats">
        <b>Realm:</b> <a href="<?php echo site_url('realms/view/' . $realm['slug']) . '">' . $location['realm'] ?></a><br />
        <b>Region:</b> <a href="<?php echo site_url('regions/view/' . $region['slug']) . '">' . $region['name'] ?></a><br />
    </div>
    <div class="location-lore">
        <p><?php echo $location['lore'] ?></p>
    </div>

    <div class="location-maps">
<?php if (!empty($maps)): ?>
    <?php echo $maps ?>
<?php endif; ?>
    </div>

</div>
