<div class="container">
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('gods/create'); ?>

        <label for="names">Name:</label>
        <input type="input" name="name" /><br />

        <label for="rank">Rank:</label>
        <input type="input" name="rank" /><br />

        <label for="symbol">Holy Symbol:</label>
        <input type="input" size="50" name="symbol" /><br />

        <label for="altnames">Alternate Names:</label>
        <input type="input" size="100" name="altnames" /><br />

        <label for="alignment">Alignment:</label>
        <input type="input" size="50" name="alignment" /><br />

        <label for="portfolio">Portfolio:</label>
        <input type="input" size="100" name="portfolio" /><br />

        <label for="worshippers">Worshippers:</label>
        <input type="input" size="100" name="worshippers" /><br />

        <label for="devotions">Devotions:</label>
        <input type="input" size="100" name="devotions" /><br />

        <label for="home">Home:</label>
        <select name="home">
    <?php foreach ($locations as $location): ?>
            <option value="<?php echo $location['name'] ?>" <?php echo set_select('home', $location['name']); ?> ><?php echo $location['name'] ?></option>
    <?php endforeach; ?>
        </select><br />

        <label for="faction">Faction:</label>
        <select name="faction">
    <?php foreach ($factions as $faction): ?>
            <option value="<?php echo $faction['name'] ?>" <?php echo set_select('faction', $faction['name']); ?> ><?php echo $faction['name'] ?></option>
    <?php endforeach; ?>
        </select><br />

        <label for="lore">Lore:</label>
        <textarea cols="80" rows="8" name="lore"></textarea><br />

        <input type="submit" name="submit" value="Create new god" />

    </form>
</div>
