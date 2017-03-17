<div class="container">
    <h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('realms/edit/' . $realm['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $realm['id'] ?>" />

        <label for="name">Name</label>
        <input type="input" name="name" value="<?php echo $realm['name'] ?>" /><br />

        <label for="altnames">Alternate Names</label>
        <input type="input" name="altnames" value="<?php echo $realm['altnames'] ?>" /><br />

        <label for="region">Region</label>
        <select>
<?php foreach ($regions as $region): ?>
    <?php if ($region['name'] === $realm['region']): ?>
            <option value="<?php echo $region['name'] . '" ' . set_select('region', $region['name'], TRUE) . ' >' . $region['name']; ?></option>
    <?php else: ?>
            <option value="<?php echo $region['name'] . '" ' . set_select('region', $region['name']) . ' >' . $region['name']; ?></option>
    <?php endif; ?>
<?php endforeach; ?>
        </select><br />

        <label for="lore">Lore</label>
        <textarea cols="80" rows="5" name="lore"><?php echo $region['lore'] ?></textarea><br />

        <input type="submit" name="submit" value="Edit realm" />

    </form>
</div>
