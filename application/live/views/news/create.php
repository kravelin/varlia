<div class="container">
    <h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/create'); ?>

        <label for="title">Title</label>
        <input class="input-text" type="input" name="title" /><br />

        <label for="text">Text</label>
        <textarea class="input-text" name="text"></textarea><br />

        <input class="submit-button" type="submit" name="submit" value="Create news item" />

    </form>
</div>
