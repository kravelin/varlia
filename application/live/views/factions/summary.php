<div class="container">
    <h1><?php echo $name ?></h1>

    <div class="faction-lore">
        <?php echo $faction['lore'] ?>
    </div>

    <h3>Members</h3>
    <ul>
<?php if (!empty($gods)): ?>
    <?php foreach ($gods as $god): ?>
        <li><a href="<?php echo site_url('gods/view/' . $god['slug']) . '">' . $god['name'] ?></a></li>
    <?php endforeach; ?>
<?php endif; ?>
    </ul>

</div>
