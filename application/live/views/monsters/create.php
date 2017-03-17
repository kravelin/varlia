<div class="container">
    <h2><?php echo $title; ?></h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('monsters/create'); ?>

        <label for="names">Name:</label>
        <input type="input" size="100" name="name" /><br />

        <label for="base5e">Base 5e Monster:</label>
        <input type="input" size="100" name="base5e" /><br />

        <label for="size">Size:</label>
        <select name="size">
    <?php foreach ($sizes as $size): ?>
        <?php if ($size['name'] === 'Medium'): ?>
            <option value="<?php echo $size['name'] . '" ' . set_select('size', $size['name'], TRUE) . '>' . $size['name']; ?></option>
        <?php else: ?>
            <option value="<?php echo $size['name'] . '" ' . set_select('size', $size['name']) . '>' . $size['name']; ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
         </select><br />

        <label for="monsterType">Monster Type:</label>
        <select name="monsterType">
    <?php foreach ($monsterTypes as $type): ?>
            <option value="<?php echo $type['name'] . '" ' . set_select('monsterType', $type['name']) . '>' . $type['name']; ?></option>
    <?php endforeach; ?>
        </select>

        <label for="subtype">Subtype:</label>
        <input type="text" size="50" name="subtype" /><br />

        <label for="alignment">Alignment:</label>
        <select name="alignment">
    <?php foreach ($alignments as $alignment): ?>
            <option value="<?php echo $alignment['name'] . '" ' . set_select('alignment', $alignment['name']) . '>' . $alignment['name']; ?></option>
   <?php endforeach; ?>
        </select><br />

        <label for="armor">Armor:</label>
        <select name="armor">
    <?php foreach ($armorTypes as $armor): ?>
            <option value="<?php echo $armor['type'] . '" ' . set_select('armor', $armor['type']) . '>' . $armor['type']; ?></option>
    <?php endforeach; ?>
        </select>

        <label for="armorBonus">Armor Bonus:</label>
        <input type="input" size="5" name="armorBonus" />

        <label for="shield">Has Shield:</label>
        <input type="checkbox" name="shield" value="1" /><br />

        <label for="hitDice">Hit Dice:</label>
        <input type="input" size="5" name="hitDice" /><br />

        <span class="col-md-2"><label for="speed">Speed:</label>
        <input type="input" size="5" name="speed" /></span>

        <span class="col-md-2"><label for="climbSpeed">Climb:</label>
        <input type="input" size="5" name="climbSpeed" /></span>

        <span class="col-md-2"><label for="burrowSpeed">Burrow:</label>
        <input type="input" size="5" name="burrowSpeed" /></span>

        <span class="col-md-2"><label for="swimSpeed">Swim:</label>
        <input type="input" size="5" name="swimSpeed" /></span>

        <span class="col-md-4"><label for="flySpeed">Fly:</label>
        <input type="input" size="5" name="flySpeed" />

        <label for="hover">Hovers:</label>
        <input type="checkbox" name="hover" value="TRUE" /></span><br />

        <span class="col-md-2"><label for="strength">STR:</label>
        <input type="input" size="5" name="strength" /></span>

        <span class="col-md-2"><label for="dexterity">DEX:</label>
        <input type="input" size="5" name="dexterity" /></span>

        <span class="col-md-2"><label for="constitution">CON:</label>
        <input type="input" size="5" name="constitution" /></span>

        <span class="col-md-2"><label for="intelligence">INT:</label>
        <input type="input" size="5" name="intelligence" /></span>

        <span class="col-md-2"><label for="wisdom">WIS:</label>
        <input type="input" size="5" name="wisdom" /></span>

        <span class="col-md-2"><label for="charisma">CHA:</label>
        <input type="input" size="5" name="charisma" /></span><br />

        <b>Saving Throws:</b><br />
        <span class="col-md-2"><label for="saveSTR">STR:</label>
        <input type="checkbox" name="saveSTR" value="TRUE"/></span>

        <span class="col-md-2"><label for="saveDEX">DEX:</label>
        <input type="checkbox" name="saveDEX" value="TRUE"/></span>

        <span class="col-md-2"><label for="saveCON">CON:</label>
        <input type="checkbox" name="saveCON" value="TRUE" /></span>

        <span class="col-md-2"><label for="saveINT">INT:</label>
        <input type="checkbox" name="saveINT" value="TRUE" /></span>

        <span class="col-md-2"><label for="saveWIS">WIS:</label>
        <input type="checkbox" name="saveWIS" value="TRUE" /></span>

        <span class="col-md-2"><label for="saveCHA">CHA:</label>
        <input type="checkbox" name="saveCHA" value="TRUE" /></span><br />

        <b>Skills:</b><br />
        <?php echo get_formatted_list('create', NULL, 'skills', 3); ?><br />

        <b>Damage Types:</b><br />
        <?php echo get_formatted_damage_types_list('create'); ?><br />

        <b>Condition Immunities:</b><br />
        <?php echo get_formatted_list('create', NULL, 'conditions', 6); ?><br />

        <b>Senses:</b><br />
        <?php echo get_formatted_list('create', NULL, 'senses', 2); ?><br />

        <b>Languages:</b> <input type="checkbox" name="understand_only" value="TRUE" />Understands Only<br />
        <?php echo get_formatted_list('create', NULL, 'languages', 2); ?><br />

        <label for="challenge">Challenge:</label>
        <input type="input" size="5" name="challenge" /><br />

        <label for="abilities">Abilities:</label>
        <textarea cols="50" rows="10" name="abilities" /></textarea><br />

        <label for="actions">Actions:</label>
        <textarea cols="80" rows="10" name="actions"></textarea><br />

        <label for="legendaryActions">Legendary Actions:</label>
        <textarea cols="80" rows="10" name="legendaryActions"></textarea><br />

        <label for="lair">Lair:</label>
        <textarea cols="80" rows="8" name="lair"></textarea><br />

        <label for="lairActions">Lair Actions:</label>
        <textarea cols="80" rows="8" name="lairActions"></textarea><br />

        <label for="regionalEffects">Regional Effects:</label>
        <textarea cols="80" rows="8" name="regionalEffects"></textarea><br />

        <label for="habitat">Habitat:</label>
        <textarea cols="80" rows="5" name="regions" /></textarea><br />

        <label for="lore">Lore:</label>
        <textarea cols="80" rows="8" name="lore"></textarea><br />

        <label for="description">Description:</label>
        <textarea cols="80" rows="8" name="description"></textarea><br />

        <input type="submit" name="submit" value="Create new monster" />

    </form>
</div>
