<div class="container">
    <h1><?php echo ucfirst($type['name']) ?></h1>
    <p><?php echo $type['description'] ?></p>
    <b>Notable Monsters:</b>
    <ul>
        <?php foreach ($monsters as $monster): ?>
        <li><?php echo $monster ?></li>
        <?php endforeach; ?>
    </ul>
</div>