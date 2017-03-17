<div class="container">
    <h1><?php echo $name ?></h1>
    <h2><?php echo $realm['altnames'] ?></h2>
    <h4>Region: <a href="<?php echo site_url('regions/view/' . $region['slug']) . '">' . $realm['region'] ?></a></h4>

    <div class="realm-lore">
        <p><?php echo $realm['lore'] ?></p>
    </div>

<?php if (!empty($locations)): ?>
    <h3>Notable locations in <?php echo $realm['name'] ?></h3>
    <ul>
    <?php foreach ($locations as $location): ?>
        <li><a href="<?php echo site_url('locations/view/' . $location['slug']) . '">' . $location['name'] ?></a></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>
