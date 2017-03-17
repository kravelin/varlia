<div class="container">
    <h2><?php echo $title; ?></h2>

    <h3>Are you sure you want to delete the god <?php echo $god['name'] ?>?</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('gods/delete/' . $god['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $god['id'] ?>" />

        <input type="submit" name="submit" value="Delete god" />

    </form>
</div>
