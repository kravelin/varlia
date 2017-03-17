<div class="container">
    <h2><?php echo $title; ?></h2>

    <h3>Are you sure you want to delete the realm <?php echo $realm['name'] ?>?</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('realms/delete/' . $realm['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $realm['id'] ?>" />

        <input type="submit" name="submit" value="Delete realm" />

    </form>
</div>
