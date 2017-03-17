<div class="container">
    <h2><?php echo $title; ?></h2>

    <h3>Are you sure you want to delete the location <?php echo $location['name'] ?>?</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('locations/delete/' . $location['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $location['id'] ?>" />

        <input type="submit" name="submit" value="Delete location" />

    </form>
</div>
