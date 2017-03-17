<div class="container">
    <h1><?php echo $name ?></h1>
    <h2><?php echo $region['altnames']; ?></h2>

    <div class="region-lore">
        <p><?php echo $region['lore']; ?></p>
    </div>

<?php if (!empty($realms)): ?>
    <h3>Realms / Locations in <?php echo $region['name']; ?></h3>
    <ul>
    <?php foreach ($realms as $realm): ?>
        <li><a href="<?php echo site_url('realms/view/' . $realm['slug']) . '">' . $realm['name']; ?></a></li>
        <?php if (!empty($locations)): ?>
            <ul>
            <?php foreach ($locations as $location): ?>
                <?php if ($location['realm'] === $realm['name']): ?>
                <li><a href="<?php echo site_url('locations/view/' . $location['slug']) . '">' . $location['name']; ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>
