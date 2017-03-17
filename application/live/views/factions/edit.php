<div class="container">
    <h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('factions/edit/' . $faction['slut']); ?>

        <input type="hidden" name="id" value="<?php echo $faction['id'] ?>" />

        <label for="name">Name</label>
        <input type="input" name="name" value="<?php echo $faction['name'] ?>" /><br />

        <label for="lore">Lore</label>
        <textarea cols="80" rows="5" name="lore"><?php echo $faction['lore'] ?></textarea><br />

        <input type="submit" name="submit" value="Edit faction" />

    </form>
</div>
