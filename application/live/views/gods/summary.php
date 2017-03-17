<div class="container container-fluid">
    <h1><?php echo $name ?></h1>
    <h2><?php echo $god['altnames'] ?></h2>

    <main class="col-md-10">
        <b>Rank:</b> <?php echo $god['rank'] ?><br />
        <b>Alignment:</b> <?php echo $god['alignment'] ?><br />
        <b>Portfolio:</b> <?php echo $god['portfolio'] ?><br />
        <b>Worshippers:</b> <?php echo $god['worshippers'] ?><br />
        <b>Devotions:</b> <?php echo $god['devotions'] ?><br />
        <b>Home:</b> <a href="<?php echo site_url('locations/view/' . $location['slug']) ?>"><?php echo $god['home'] ?></a><br />
        <b>Faction:</b> <a href="<?php echo site_url('factions/view/' . $faction['slug']) ?>"><?php echo $god['faction'] ?></a><br />
        <br />
        <p><?php echo $god['lore'] ?></p>
    </main>

    <aside class="col-md-2">
<?php if (is_file("/www" . $symbol)): ?>
        <figure>
            <img src="<?php echo $symbol ?>" alt="<?php echo $god['symbol'] ?>" />
            <figcaption><?php echo $name ?>'s Holy Symbol: <?php echo $god['symbol'] ?></figcaption>
        </figure>
<?php else: ?>
        <h4><?php echo $name ?>'s Holy Symbol: <?php echo $god['symbol'] ?></h4>
<?php endif; ?>
    </aside>
</div>
