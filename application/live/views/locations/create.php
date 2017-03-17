<div class="container">
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('locations/create'); ?>

        <label for="names">Name</label>
        <input type="input" name="name" /><br />

        <label for="altnames">Alternate Names</label>
        <input type="input" name="altnames" /><br />

        <label for=realm">Realm</label>
        <select name="realm">
    <?php foreach ($realms as $realm): ?>
            <option value="<?php echo $realm['name'] . '" ' . set_select('realm', $realm['name']) . '>' . $realm['name']; ?></option>
    <?php endforeach; ?>
        </select><br />

        <label for="lore">Lore</label>
        <textarea cols="80" rows="5" name="lore"></textarea><br />

        <input type="submit" name="submit" value="Create new location" />

    </form>
</div>