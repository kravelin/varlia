<div class="container container-fluid">
    <header class="col-md-12">
        <h1>
            <?php echo $name ?>
        <?php if(!empty($monster['base5e'])): ?>
            ( Based on: <?php echo $monster['base5e'] ?> )
        <?php endif; ?>
        </h1>
    </header>
    <main class="col-md-6">
        <?php echo $monster['size'] . ' ' . $monster['monsterType'] ?>
        <?php if (!empty($monster['subtype'])): ?>
            ( <?php echo $monster['subtype']; ?> )
        <?php endif; ?>
            , <?php echo $monster['alignment']; ?><br />
        <span class="monsterDivider"></span>
        <b>Armor Class:</b> <?php echo get_armorClass($monster['armor'], $monster['armorBonus'], $monster['shield'], $monster['dexterity']); ?><br />
        <b>Hit Points:</b> <?php echo get_hitPoints($monster['hitDice'],$monster['size'],$monster['constitution']); ?><br />
        <b>Speed:</b> <?php echo $monster['speed'] . ' ft.'; ?>
            <?php echo empty($monster['flySpeed']) ? '' : ', fly ' . $monster['flySpeed']; ?>
            <?php echo $monster['hover'] ? ' (hover)' : ''; ?>
            <?php echo empty($monster['climbSpeed']) ? '' : ', climb ' . $monster['climbSpeed'] . 'ft.'; ?>
            <?php echo empty($monster['burrowSpeed']) ? '' : ', burrow ' . $monster['burrowSpeed'] . 'ft.'; ?>
            <?php echo empty($monster['swimSpeed']) ? '' : ', swim ' . $monster['swimSpeed'] . 'ft.'; ?>
        <br />
        <span class="monsterDivider"></span>
        <section class="row statBlock">
            <span class="col-md-2"><b>STR</b></span>
            <span class="col-md-2"><b>DEX</b></span>
            <span class="col-md-2"><b>CON</b></span>
            <span class="col-md-2"><b>INT</b></span>
            <span class="col-md-2"><b>WIS</b></span>
            <span class="col-md-2"><b>CHA</b></span>
        </section>
        <section class="row statBlock">
            <span class="col-md-2"><?php echo $monster['strength'] . ' (' . get_formatted_statBonus($monster['strength']) . ')'; ?></span>
            <span class="col-md-2"><?php echo $monster['dexterity'] . ' (' . get_formatted_statBonus($monster['dexterity']) . ')'; ?></span>
            <span class="col-md-2"><?php echo $monster['constitution'] . ' (' . get_formatted_statBonus($monster['constitution']) . ')'; ?></span>
            <span class="col-md-2"><?php echo $monster['intelligence'] . ' (' . get_formatted_statBonus($monster['intelligence']) . ')'; ?></span>
            <span class="col-md-2"><?php echo $monster['wisdom'] . ' (' . get_formatted_statBonus($monster['wisdom']) . ')'; ?></span>
            <span class="col-md-2"><?php echo $monster['charisma'] . ' (' . get_formatted_statBonus($monster['charisma']) . ')'; ?></span>
        </section>
        <span class="monsterDivider"></span>
        <section>
    <?php if ($monster['saveSTR'] || $monster['saveDEX'] || $monster['saveCON'] || $monster['saveINT'] || $monster['saveWIS'] || $monster['saveCHA']): ?>
            <b>Saving Throws:</b>
        <?php echo get_formatted_saves($monster) ?><br />
    <?php endif; ?>
    <?php echo !empty($skills) ? $skills : '' ?>
    <?php echo !empty($vulnerabilities) ? $vulnerabilities : '' ?>
    <?php echo !empty($resistances) ? $resistances : '' ?>
    <?php echo !empty($immunities) ? $immunities : '' ?>
    <?php echo !empty($conditions) ? $conditions : '' ?>
    <?php echo $senses ?>
    <?php echo $languages ?>
    <?php echo $challenge ?>
        </section>
        <span class="monsterDivider"></span>
    <?php if (!empty($abilities)): ?>
        <section>
            <h4>Abilities</h4>
            <span class="monsterUnderline"></span>
        <?php echo $abilities ?>
        </section>
    <?php endif; ?>
    <?php if (!empty($actions)): ?>
        <section>
            <h4>Actions</h4>
            <span class="monsterUnderline"></span>
        <?php echo $actions ?>
        </section>
    <?php endif; ?>
    <?php if (!empty($legendaryActions)): ?>
        <section>
            <h4>Lengedary Actions</h4>
            <span class="monsterUnderline"></span>
        <?php echo $legendaryActions ?>
        </section>
    <?php endif; ?>
    <?php if (!empty($lair)): ?>
        <section>
            <h3>A <?php echo $monster['name'] ?>'s Lair</h3>
            <span class="monsterUnderline"></span>
        <?php echo $lair ?>
            <br />
            <h4>Lair Actions</h4>
        <?php echo $lairActions ?>
            <br />
            <h4>Regional Effects</h4>
        <?php echo $regionalEffects ?>
        </section>
    <?php endif; ?>
    <?php if (!empty($habitat)): ?>
        <section>
            <h4>Habitat</h4>
            <span class="monsterUnderline"></span>
        <?php echo $habitat ?>
        </section>
    <?php endif; ?>
    <?php if (!empty($lore)): ?>
        <section>
            <h4>Lore</h4>
            <span class="monsterUnderline"></span>
        <?php echo $lore ?>
        </section>
    <?php endif; ?>
    <?php if (!empty($description)): ?>
        <section>
            <h4>Description</h4>
            <span class="monsterUnderline"></span>
        <?php echo $description ?>
        </section>
    <?php endif; ?>
    </main>

    <aside class="col-md-6">
<?php if (is_file('/www/images/monsters/' . $monster['slug'] . '.png')): ?>
        <figure>
            <img src="<?php echo '/images/monsters/' . $monster['slug'] . '.png" alt="Image of a ' . $monster['name']; ?>" />
            <figcaption><?php echo $name ?></figcaption>
        </figure>
<?php endif; ?>
    </aside>
</div>
