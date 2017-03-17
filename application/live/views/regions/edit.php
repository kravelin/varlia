<div class="container">
    <h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('regions/edit/' . $region['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $region['id'] ?>" />

        <label for="name">Name</label>
        <input type="input" name="name" value="<?php echo $region['name'] ?>" /><br />

        <label for="altnames">Alternate Names</label>
        <input type="input" name="altnames" value="<?php echo $region['altnames'] ?>" /><br />

        <label for="lore">Lore</label>
        <textarea cols="80" rows="5" name="lore"><?php echo $region['lore'] ?></textarea><br />

        <input type="submit" name="submit" value="Edit region" />

    </form>
</div>