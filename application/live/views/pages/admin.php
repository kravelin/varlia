<div class="container">
    <h1>Admin central hub</h1>
    <section>
        <h2>Gods</h2>
        <a href="<?php echo site_url('gods') ?>">Index of Gods</a><br />
        <a href="<?php echo site_url('gods/create') ?>">Create a new god</a><br />
<?php foreach ($gods as $entry): ?>
        <?php echo $entry['name'] . ' - <a href="' . site_url('gods/view/' . $entry['slug']) . '">View</a> - <a href="' . site_url('gods/edit/' . $entry['slug']) . '">Edit</a> - <a href="' . site_url('gods/delete/' . $entry['slug']) . '">Delete</a><br />'; ?>
<?php endforeach; ?>
    </section>
    <section>
        <h2>Factions</h2>
        <a href="<?php echo site_url('factions') ?>">Index of Factions</a><br />
        <a href="<?php echo site_url('factions/create') ?>">Create a new faction</a><br />
<?php foreach ($factions as $entry): ?>
        <?php echo $entry['name'] . ' - <a href="' . site_url('factions/view/' . $entry['slug']) . '">View</a> - <a href="' . site_url('factions/edit/' . $entry['slug']) . '">Edit</a> - <a href="' . site_url('factions/delete/' . $entry['slug']) . '">Delete</a><br />'; ?>
<?php endforeach; ?>
    </section>
    <section>
        <h2>Regions</h2>
        <a href="<?php echo site_url('regions') ?>">Index of regions</a><br />
        <a href="<?php echo site_url('regions/create') ?>">Create a new region</a><br />
<?php foreach ($regions as $entry): ?>
        <?php echo $entry['name'] . ' - <a href="' . site_url('regions/view/' . $entry['slug']) . '">View</a> - <a href="' . site_url('regions/edit/' . $entry['slug']) . '">Edit</a> - <a href="' . site_url('regions/delete/' . $entry['slug']) . '">Delete</a><br />'; ?>
<?php endforeach; ?>
    </section>
    <section>
        <h2>Realms</h2>
        <a href="<?php echo site_url('realms') ?>">Index of realms</a><br />
        <a href="<?php echo site_url('realms/create') ?>">Create a new realm</a><br />
<?php foreach ($realms as $entry): ?>
        <?php echo $entry['name'] . ' - <a href="' . site_url('realms/view/' . $entry['slug']) . '">View</a> - <a href="' . site_url('realms/edit/' . $entry['slug']) . '">Edit</a> - <a href="' . site_url('realms/delete/' . $entry['slug']) . '">Delete</a><br />'; ?>
<?php endforeach; ?>
    </section>
    <section>
        <h2>Locations</h2>
        <a href="<?php echo site_url('locations') ?>">Index of locations</a><br />
        <a href="<?php echo site_url('locations/create') ?>">Create a new location</a><br />
<?php foreach ($locations as $entry): ?>
        <?php echo $entry['name'] . ' - <a href="' . site_url('locations/view/' . $entry['slug']) . '">View</a> - <a href="' . site_url('locations/edit/' . $entry['slug']) . '">Edit</a> - <a href="' . site_url('locations/delete/' . $entry['slug']) . '">Delete</a><br />'; ?>
<?php endforeach; ?>
    </section>
    <section>
        <h2>Monsters</h2>
        <a href="<?php echo site_url('monsters') ?>">Index of monsters</a><br />
        <a href="<?php echo site_url('monsters/create') ?>">Create a new monster</a><br />
<?php foreach ($monsters as $entry): ?>
        <?php echo $entry['name'] . ' - <a href="' . site_url('monsters/view/' . $entry['slug']) . '">View</a> - <a href="' . site_url('monsters/edit/' . $entry['slug']) . '">Edit</a> - <a href="' . site_url('monsters/delete/' . $entry['slug']) . '">Delete</a><br />'; ?>
<?php endforeach; ?>
    </section>
    <section>
        <h2>News</h2>
        <a href="<?php echo site_url('news') ?>">Index of news articles</a><br />
        <a href="<?php echo site_url('news/create') ?>">Create new news item</a><br />
    </section>
</div>