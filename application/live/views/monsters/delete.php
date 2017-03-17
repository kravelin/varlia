<div class="container">
    <h2><?php echo $title; ?></h2>

    <h3>Are you sure you want to delete the monster <?php echo $monster['name'] ?>?</h3>

<?php echo validation_errors(); ?>

<?php echo form_open('monsters/delete/' . $monster['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $monster['id'] ?>" />

        <input type="submit" name="submit" value="Delete monster" />

    </form>
</div>
