<div class="container">
    <h2><?php echo $title; ?></h2>

    <h3>Are you sure you want to delete the region <?php echo $region['name'] ?>?</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('regions/delete/' . $region['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $region['id'] ?>" />

        <input type="submit" name="submit" value="Delete region" />

    </form>
</div>
