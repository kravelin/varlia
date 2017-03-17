<div class="container">
    <h2><?php echo $title; ?></h2>

    <h3>Are you sure you want to delete the faction <?php echo $faction['name'] ?>?</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('factions/delete/' . $faction['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $faction['id'] ?>" />

        <input type="submit" name="submit" value="Delete faction" />

    </form>
</div>
