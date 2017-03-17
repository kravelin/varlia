<div class="container">
    <h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('regions/create'); ?>

        <label for="name">Name</label>
        <input type="input" name="name" /><br />

        <label for="altnames">Alternate Names</label>
        <input type="input" name="altnames" /><br />

        <label for="lore">Lore</label>
        <textarea cols="80" rows="5" name="lore"></textarea><br />

        <input type="submit" name="submit" value="Create new region" />

    </form>
</div>