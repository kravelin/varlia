<div class="container">
    <h2>Success</h2>

<?php if ($type === 'create'): ?>
    <p>New monster, <?php echo $monster['name'] ?>, successfully created.</p>
    <a href="<?php echo site_url('monsters/view/' . $monster['slug']); ?>">View</a>
<?php elseif ($type === 'edit'): ?>
    <p>Monster, <?php echo $monster['name'] ?>, successfully updated.</p>
    <a href="<?php echo site_url('monsters/view/' . $monster['slug']); ?>">View</a>
<?php elseif ($type === 'delete'): ?>
    <p>Monster successfully deleted.</p>
<?php else: ?>
    <p>Monstrous success!</p>
<?php endif; ?>
    <p><a href="<?php echo site_url('admin'); ?>">Return to Admin page</a></p>
</div>
