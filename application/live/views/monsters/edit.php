<div class="container">
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('monsters/edit/' . $monster['slug']); ?>

        <input type="hidden" name="id" value="<?php echo $monster['id'] ?>" />

        <label for="names">Name:</label>
        <input type="input" size="100" name="name" value="<?php echo $monster['name']; ?>" /><br />

        <label for="base5e">Base 5e Monster:</label>
        <input type="input" size="100" name="base5e" value="<?php echo $monster['base5e']; ?>" /><br />

        <label for="size">Size:</label>
        <select name="size">
    <?php if (empty($monster['size'])): ?>
            <option value="" <?php echo set_select('size', '', TRUE); ?>></option>
    <?php else: ?>
            <option value="" <?php echo set_select('size', '', TRUE); ?>></option>
    <?php endif; ?>
    <?php foreach ($sizes as $size): ?>
        <?php if ($size['name'] === $monster['size']): ?>
            <option value="<?php echo $size['name'] . '" ' . set_select('size', $size['name'], TRUE) . '>' . $size['name']; ?></option>
        <?php else: ?>
            <option value="<?php echo $size['name'] . '" ' . set_select('size', $size['name']) . '>' . $size['name']; ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
        </select><br />

        <label for="monsterType">Monster Type:</label>
        <select name="monsterType">
    <?php foreach ($monsterTypes as $type): ?>
        <?php if ($type['name'] === $monster['monsterType']): ?>
            <option value="<?php echo $type['name'] . '" ' . set_select('monsterType', $type['name'], TRUE) . '>' . $type['name']; ?></option>
        <?php else: ?>
            <option value="<?php echo $type['name'] . '" ' . set_select('monsterType', $type['name']) . '>' . $type['name']; ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
        </select>

        <label for="subtype">Subtype:</label>
        <input type="input" size="50" name="subtype" value="<?php echo $monster['subtype']; ?>" /><br />


        <label for="alignment">Alignment:</label>
        <select name="alignment">
    <?php foreach ($alignments as $alignment): ?>
        <?php if ($alignment['name'] === $monster['alignment']): ?>
            <option value="<?php echo $alignment['name'] . '" ' . set_select('alignment', $alignment['name'], TRUE) . '>' . $alignment['name']; ?></option>
        <?php else: ?>
            <option value="<?php echo $alignment['name'] . '" ' . set_select('alignment', $alignment['name']) . '>' . $alignment['name']; ?></option>
        <?php endif; ?>
   <?php endforeach; ?>
        </select><br />

        <label for="armor">Armor:</label>
        <select name="armor">
    <?php foreach ($armorTypes as $armor): ?>
        <?php if ($armor['type'] === $monster['armor']): ?>
            <option value="<?php echo $armor['type'] . '" ' . set_select('armor', $armor['type'], TRUE) . '>' . $armor['type']; ?></option>
        <?php else: ?>
            <option value="<?php echo $armor['type'] . '" ' . set_select('armor', $armor['type']) . '>' . $armor['type']; ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
        </select>

        <label for="armorBonus">Armor Bonus:</label>
        <input type="input" size="5" name="armorBonus" value="<?php echo $monster['armorBonus']; ?>" />

        <label for="shield">Has Shield:</label>
        <input type="checkbox" name="shield" value="1" <?php echo $monster['shield'] ? 'CHECKED' : '' ?> /><br />

        <label for="hitDice">Hit Dice:</label>
        <input type="input" size="5" name="hitDice" value="<?php echo $monster['hitDice']; ?>" /><br />

        <span class="col-md-2"><label for="speed">Speed:</label>
        <input type="input" size="5" name="speed" value="<?php echo $monster['speed']; ?>" /></span>

        <span class="col-md-2"><label for="climbSpeed">Climb:</label>
        <input type="input" size="5" name="clibSpeed" value="<?php echo $monster['climbSpeed']; ?>" /></span>

        <span class="col-md-2"><label for="burrowSpeed">Burrow:</label>
        <input type="input" size="5" name="burrowSpeed" value="<?php echo $monster['burrowSpeed']; ?>" /></span>

        <span class="col-md-2"><label for="swimSpeed">Swim:</label>
        <input type="input" size="5" name="swimSpeed" value="<?php echo $monster['swimSpeed']; ?>" /></span>

        <span class="col-md-4"><label for="flySpeed">Fly Speed:</label>
        <input type="input" size="5" name="flySpeed" value="<?php echo $monster['flySpeed']; ?>" />

        <label for="hover">Hovers:</label>
        <input type="checkbox" name="hover" value="1" <?php echo ($monster['hover'] ? 'CHECKED' : '') ?> /></span><br />

        <span class="col-md-2"><label for="strength">STR:</label>
        <input type="input" size="5" name="strength" value="<?php echo $monster['strength']; ?>" /></span>

        <span class="col-md-2"><label for="dexterity">DEX:</label>
        <input type="input" size="5" name="dexterity" value="<?php echo $monster['dexterity']; ?>" /></span>

        <span class="col-md-2"><label for="constitution">CON:</label>
        <input type="input" size="5" name="constitution" value="<?php echo $monster['constitution']; ?>" /></span>

        <span class="col-md-2"><label for="intelligence">INT:</label>
        <input type="input" size="5" name="intelligence" value="<?php echo $monster['intelligence']; ?>" /></span>

        <span class="col-md-2"><label for="Wisdom">WIS:</label>
        <input type="input" size="5" name="wisdom" value="<?php echo $monster['wisdom']; ?>" /></span>

        <span class="col-md-2"><label for="charisma">CHA:</label>
        <input type="input" size="5" name="charisma" value="<?php echo $monster['charisma']; ?>" /></span><br />

        <b>Saving Throws:</b><br />
        <span class="col-md-2"><label for="saveSTR">STR:</label>
        <input type="checkbox" name="saveSTR" value="1" <?php echo $monster['saveSTR'] ? 'CHECKED' : '' ?> /></span>

        <span class="col-md-2"><label for="saveDEX">DEX:</label>
        <input type="checkbox" name="saveDEX" value="1" <?php echo $monster['saveDEX'] ? 'CHECKED' : '' ?> /></span>

        <span class="col-md-2"><label for="saveCON">CON:</label>
        <input type="checkbox" name="saveCON" value="1" <?php echo $monster['saveCON'] ? 'CHECKED' : '' ?> /></span>

        <span class="col-md-2"><label for="saveINT">INT:</label>
        <input type="checkbox" name="saveINT" value="1" <?php echo $monster['saveINT'] ? 'CHECKED' : '' ?> /></span>

        <span class="col-md-2"><label for="saveWIS">WIS:</label>
        <input type="checkbox" name="saveWIS" value="1" <?php echo $monster['saveWIS'] ? 'CHECKED' : '' ?> /></span>

        <span class="col-md-2"><label for="saveCHA">CHA:</label>
        <input type="checkbox" name="saveCHA" value="1" <?php echo $monster['saveCHA'] ? 'CHECKED' : '' ?> /></span><br />

        <b>Skills:</b><br />
        <?php echo get_formatted_list('edit', $monster['id'], 'skills', 3); ?><br />

        <b>Damage Types:</b><br />
        <?php echo get_formatted_damage_types_list('edit', $monster['id']); ?><br />

        <b>Condition Immunities:</b><br />
        <?php echo get_formatted_list('edit', $monster['id'], 'conditions', 6); ?><br />

        <b>Senses:</b><br />
        <?php echo get_formatted_list('edit', $monster['id'], 'senses', 2); ?><br />

        <b>Languages:</b> <input type="checkbox" name="understand_only" value="TRUE" <?php echo $monster['understand_only'] ? 'CHECKED' : '' ?> />Understands Only<br />
        <?php echo get_formatted_list('edit', $monster['id'], 'languages', 2); ?><br />

        <label for="challenge">Challenge:</label>
        <input type="input" size="5" name="challenge" value="<?php echo $monster['challenge']; ?>" /><br />

        <label for="abilities">Abilities:</label>
        <textarea cols="80" rows="5" name="abilities"><?php echo $monster['abilities']; ?></textarea><br />

        <label for="actions">Actions:</label>
        <textarea cols="80" rows="8" name="actions"><?php echo $monster['actions']; ?></textarea><br />

        <label for="legendaryActions">Legendary Actions:</label>
        <textarea cols="80" rows="8" name="legendaryActions"><?php echo $monster['legendaryActions']; ?></textarea><br />

        <label for="lair">Lair:</label>
        <textarea cols="80" rows="8" name="lair"><?php echo $monster['lair']; ?></textarea><br />

        <label for="lairActions">Lair Actions:</label>
        <textarea cols="80" rows="8" name="lairActions"><?php echo $monster['lairActions']; ?></textarea><br />

        <label for="regionalEffects">Regional Effects:</label>
        <textarea cols="80" rows="8" name="regionalEffects"><?php echo $monster['regionalEffects']; ?></textarea><br />

        <label for="habitat">Habitat:</label>
        <textarea cols="80" rows="5" name="habitat"><?php echo $monster['habitat']; ?></textarea><br />

        <label for="lore">Lore:</label>
        <textarea cols="80" rows="8" name="lore"><?php echo $monster['lore']; ?></textarea><br />

        <label for="description">Description:</label>
        <textarea cols="80" rows="8" name="description"><?php echo $monster['description']; ?></textarea><br />

        <input type="submit" name="submit" value="Edit monster" />

    </form>
</div>
