<div class="container">
    <h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('realms/create'); ?>

        <label for="name">Name</label>
        <input type="input" name="name" /><br />

        <label for="altnames">Alternate Names</label>
        <input type="input" name="altnames" /><br />

        <label for="region">Region</label>
        <select>
<?php foreach ($regions as $region): ?>
            <option value="<?php echo $region['name'] . '" ' . set_select('region', $region['name']) . ' >' . $region['name']; ?></option>
<?php endforeach; ?>
        </select><br />

        <label for="lore">Lore</label>
        <textarea cols="80" rows="5" name="lore"></textarea><br />

        <input type="submit" name="submit" value="Create new realm" />

    </form>
</div>
