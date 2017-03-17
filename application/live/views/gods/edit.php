<div class="container">
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('gods/edit/' . $god['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $god['id'] ?>" />

        <label for="names">Name:</label>
        <input type="input" name="name" value="<?php echo $god['name'] ?>" /><br />

        <label for="rank">Rank:</label>
        <input type="input" name="rank" value="<?php echo $god['rank'] ?>" /><br />

        <label for="symbol">Holy Symbol:</label>
        <input type="input" name="symbol" value="<?php echo $god['symbol'] ?>" /><br />

        <label for="altnames">Alternate Names:</label>
        <input type="input" size="100" name="altnames" value="<?php echo $god['altnames'] ?>" /><br />

        <label for="alignment">Alignment:</label>
        <input type="input" size="50" name="alignment" value="<?php echo $god['alignment'] ?>" /><br />

        <label for="portfolio">Portfolio:</label>
        <input type="input" size="100" name="portfolio" value="<?php echo $god['portfolio'] ?>" /><br />

        <label for="worshippers">Worshippers:</label>
        <input type="input" size="100" name="worshippers" value="<?php echo $god['worshippers'] ?>" /><br />

        <label for="devotions">Devotions:</label>
        <input type="input" size="100" name="devotions" value="<?php echo $god['devotions'] ?>" /><br />

        <label for="home">Home:</label>
        <select name="home">
<?php foreach ($locations as $location): ?>
    <?php if ($location['name'] === $god['name']): ?>
            <option value="<?php echo $location['name'] ?>" <?php echo set_select('home', $location['name'], TRUE); ?> ><?php echo $location['name'] ?></option>
    <?php else: ?>
            <option value="<?php echo $location['name'] ?>" <?php echo set_select('home', $location['name']); ?> ><?php echo $location['name'] ?></option>
    <?php endif; ?>
<?php endforeach; ?>
        </select><br />

        <label for="faction">Faction:</label>
        <select name="faction">
<?php foreach ($factions as $faction): ?>
    <?php if ($faction['name'] === $god['faction']): ?>
            <option value="<?php echo $faction['name'] ?>" <?php echo set_select('faction', $faction['name'], TRUE); ?> ><?php echo $faction['name'] ?></option>
    <?php else: ?>
            <option value="<?php echo $faction['name'] ?>" <?php echo set_select('faction', $faction['name']); ?> ><?php echo $faction['name'] ?></option>
    <?php endif; ?>
<?php endforeach; ?>
        </select><br />

        <label for="lore">Lore:</label>
        <textarea cols="80" rows="5" name="lore"><?php echo $god['lore'] ?></textarea><br />

        <input type="submit" name="submit" value="Edit god" />

    </form>
</div>
