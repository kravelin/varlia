<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('get_sizes'))
{
    function get_sizes()
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        $CI->db->select('name');
        $query = $CI->db->get('sizes');

        $sizes = $query->result_array();

        return $sizes;
    }
}

if (!function_exists('get_monsterTypes'))
{
    function get_monsterTypes($name = NULL)
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        if ($name === NULL)
        {
            $CI->db->select('name');
            $query = $CI->db->get('monsterTypes');

            $types = $query->result_array();
        }
        else
        {
            $CI->db->where(array('name'=>$name));
            $query = $CI->db->get('monsterTypes');

            $types = $query->row_array();
        }

        return $types;
    }
}

if (!function_exists('get_formatted_monsters_by_type'))
{
    function get_formatted_monsters_by_type($type = NULL)
    {
        if ($type === NULL)
        {
            return NULL;
        }

        $CI =& get_instance();
        $CI ->load->model('monsters_model');

        $CI->db->where(array('name'=>$type));
        $CI->db->select('id');
        $query = $CI->db->get('monsterTypes');
        $query = $query->row_array();

        $typeID = $query['id'];
        $CI->db->where(array('type_id'=>$typeID));
        $CI->db->order_by('name');
        $query = $CI->db->get('monsters_by_type');
        $query = $query->result_array();

        $monsters = array();
        foreach ($query as $row)
        {
            $monsterString = $row['name'];
            if ($row['source'] !== NULL)
            {
                $monsterString .= ' (' . $row['source'];

                if ($row['page'] !== NULL)
                {
                    $monsterString .= ' p.' . $row['page'];
                }
                $monsterString .= ')';
            }

            $monsters[] = $monsterString;
        }

        $CI->db->where(array('monsterType'=>$type));
        $query = $CI->db->get('monsters');
        $query = $query->result_array();

        foreach ($query as $row)
        {
            $monsterString = $row['name'] . ' <a href="/monsters/view/' . $row['slug'] . '">View</a>';

            $monsters[] = $monsterString;
        }

        sort($monsters, SORT_NATURAL | SORT_FLAG_CASE);

        return $monsters;
    }
}

if (!function_exists('get_alignments'))
{
    function get_alignments()
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        $CI->db->select('name');
        $query = $CI->db->get('alignments');

        $alignments = $query->result_array();

        return $alignments;
    }
}

if (!function_exists('get_hitPoints'))
{
    function get_hitPoints($hitDice = 1, $size = 'Tiny', $constitution = 10)
    {
        $hdSize = get_HDsize($size);
        $hpSize = get_HPsize($size);
        $conBonus = get_statBonus($constitution);
        $hitPoints = floor(($hitDice * $hpSize) + ($conBonus * $hitDice));

        $hpString = $hitPoints . ' (' . $hitDice . $hdSize;
        if ($conBonus > 0)
        {
            $hpString .= ' + ' . ($conBonus * $hitDice);
        }
        else if ($conBonus < 0)
        {
            $hpString .= ' - ' . abs($conBonus * $hitDice);
        }
        $hpString .= ')';

        return $hpString;
    }
}

if (!function_exists('get_HDsize'))
{
    function get_HDsize($size = 'Medium')
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        $CI->db->select('hit_die');
        $CI->db->where(array('name'=>$size));
        $query = $CI->db->get('sizes');

        $size = $query->row_array();

        return $size['hit_die'];
    }
}

if (!function_exists('get_HPsize'))
{
    function get_HPsize($size = 'Medium')
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        $CI->db->select('hit_points');
        $CI->db->where(array('name'=>$size));
        $query = $CI->db->get('sizes');

        $size = $query->row_array();

        return $size['hit_points'];
    }
}

if (!function_exists('get_statBonus'))
{
    function get_statBonus($score = 10)
    {
        if ($score > 11)
        {
            return ceil(($score - 11) / 2);
        }
        else if ($score < 10)
        {
            return floor(($score - 10) / 2);
        }
        else
        {
            return 0;
        }
    }
}

if (!function_exists('get_formatted_statBonus'))
{
    function get_formatted_statBonus($score = 10)
    {
        $bonus = get_statBonus($score);

        if ($bonus >= 0)
        {
            $bonus = '+' . $bonus;
        }

        return $bonus;
    }
}

if (!function_exists('get_formatted_saves'))
{
    function get_formatted_saves($monster = NULL)
    {
        if (empty($monster))
        {
            return '';
        }

        $challengeBonus = get_challenge_profBonus($monster['challenge']);

        $output = '';
        $counter = 0;
        $saves = array(
            'Str' => array($monster['saveSTR'],$monster['strength']),
            'Dex' => array($monster['saveDEX'],$monster['dexterity']),
            'Con' => array($monster['saveCON'],$monster['constitution']),
            'Int' => array($monster['saveINT'],$monster['intelligence']),
            'Wis' => array($monster['saveWIS'],$monster['wisdom']),
            'Cha' => array($monster['saveCHA'],$monster['charisma'])
        );

        foreach ($saves as $key => $save)
        {
            if ($save[0])
            {
                if ($counter > 0)
                {
                    $output .= ', ';
                }
                $bonus = $challengeBonus + get_statBonus($save[1]);
                $output .= $key . ': +' . $bonus;
                $counter++;
            }

        }

        return $output;
    }
}

if (!function_exists('get_challenge_profBonus'))
{
    function get_challenge_profBonus($challenge)
    {
        return ceil($challenge / 4) + 1;
    }
}

if (!function_exists('get_armorClass'))
{
    function get_armorClass($armor = 'none', $bonus = 0, $shield = FALSE, $dexterity = 10)
    {
        $output = '';

        if ($armor === 'natural armor')
        {
            $output .= 10 + $bonus + get_statBonus($dexterity) + ($shield ? 2 : 0);
            $output .= ' (natural armor' . ($shield ? ', shield' : '') . ')';
        }
        else if ($armor === 'none')
        {
            $output .= 10 + $bonus + get_statBonus($dexterity) + ($shield ? 2 : 0);
            $output .= ($shield ? '(shield)' : '');
        }
        else if ($armor === 'mage armor')
        {
            $base = 10 + get_statBonus($dexterity) + $bonus;
            $output .= $base . ' (' . $base + 3 . ' with mage armor)';
        }
        else if ($armor === 'barkskin')
        {
            $base = 10 + get_statBonus($dexterity) + $bonus;
            $output .= $base . ' (' . $base + 3 . ' with barkskin)';
        }
        else
        {
            $armors = get_armorTypes();
            $dexBonus = get_statBonus($dexterity);

            foreach ($armors as $entry)
            {
                if ($entry['type'] === $armor)
                {
                    if ($entry['dexBonus'] === 'max 2')
                    {
                        $dexBonus = ($dexBonus > 2 ? 2 : $dexBonus);
                    }
                    else if ($entry['dexBonus'] === 'none')
                    {
                        $dexBonus = 0;
                    }
                    $output .= 10 + $bonus + $entry['value'] + ($shield ? 2 : 0) + $dexBonus;
                    $output .= ' (' . $armor . ($shield ? ', shield' : '') . ')';
                }
            }
        }

        return $output;
    }
}

if (!function_exists('get_armorTYpes'))
{
    function get_armorTypes()
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        $armors = $CI->monsters_model->get_stat('armors');

        return $armors;
    }
}

if (!function_exists('get_formatted_damage_types_list'))
{
    function get_formatted_damage_types_list($format = 'create', $monsterID = NULL)
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        $damageTypes = $CI->monsters_model->get_stat('damage_types');
        if ($monsterID)
        {
            $monsterDamages = $CI->monsters_model->get_monster_damages($monsterID);
        }

        $output = '';

        foreach($damageTypes as $type)
        {
            $output .= '<span class="col-md-6 selection-text">' . $type['type'] . '</span>';
            $output .= '<span class="col-md-1"><input type="checkbox" name="resistances[]" value="' . $type['id'] . '"';
            if ($format === 'edit' && isset($monsterDamages) && !empty($monsterDamages) && in_array($type['id'], $monsterDamages['resists']))
            {
                $output .= ' CHECKED';
            }
            $output .= ' />Resists</span>';
            $output .= '<span class="col-md-1"><input type="checkbox" name="immunities[]" value="' . $type['id'] . '"';
            if ($format === 'edit' && isset($monsterDamages) && !empty($monsterDamages) && in_array($type['id'], $monsterDamages['immunes']))
            {
                $output .= ' CHECKED';
            }
            $output .= ' />Immune</span>';
            $output .= '<span class="col-md-4"><input type="checkbox" name="vulnerabilities[]" value="' . $type['id'] . '"';
            if ($format === 'edit' && isset($monsterDamages) && !empty($monsterDamages) && in_array($type['id'], $monsterDamages['vulns']))
            {
                $output .= ' CHECKED';
            }
            $output .= ' />Vulnerable</span>';

            $output .= '<br />';
        }

        return $output;
    }
}

if (!function_exists('get_formatted_list'))
{
    function get_formatted_list($format = 'create', $monsterID = NULL, $stat = NULL, $cols = 6)
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        $types = $CI->monsters_model->get_stat($stat);
        if ($monsterID)
        {
            $monsterTypes = $CI->monsters_model->get_monster_stat($monsterID, $stat);
        }

        $output = '';
        $counter = 1;
        $index = 1;
        $maxindex = sizeof($types);
        $colwidth = 12 / $cols;

        foreach($types as $type)
        {
            if ($index === $maxindex && $counter !== $cols)
            {
                if ($counter === 1)
                {
                    $colwidth = 12;
                }
                else
                {
                    $colwidth = 12 - ($colwidth * ($counter - 1));
                }
            }
            $output .= '<span class="col-md-' . $colwidth . '"><input type="checkbox" name="' . $stat . '[]" value="' . $type['id'] . '"';
            if ($format === 'edit' && isset($monsterTypes) && !empty($monsterTypes) && in_array($type['id'], $monsterTypes[$stat . '_id']))
            {
                $output .= ' CHECKED';
            }
            $output .= ' />' . $type['type'];
            if ($stat === 'skills')
            {
                $output .= ' <input type="checkbox" name="skillDouble[' . $type['id'] . ']" value="1"';
                if ($format === 'edit' && isset($monsterTypes) && !empty($monsterTypes) && in_array($type['id'], $monsterTypes['skills_id']))
                {
                    extract($monsterTypes);
                    foreach ($skills_id as $skillIndex => $skillID)
                    {
                        if ($skillID === $type['id'] && $double_prof[$skillIndex] === '1')
                        {
                            $output .= ' CHECKED';
                        }
                    }
                }
                $output .= ' />Double Proficiency Bonus';
            }
            if ($stat === 'senses')
            {
                $output .= ' <input type="input" size="5" name="sensesValue[' . $type['id'] . ']"';
                if ($format === 'edit' && isset($monsterTypes) && !empty($monsterTypes) && in_array($type['id'], $monsterTypes['senses_id']))
                {
                    $senseValue = NULL;
                    extract($monsterTypes);
                    foreach ($senses_id as $senseIndex => $senseID)
                    {
                        if ($senseID === $type['id'])
                        {
                            $senseValue = $value[$senseIndex];
                        }
                    }
                    $output .= ' value="' . $senseValue . '"';
                }
                $output .= ' /> ' . $type['value_type'];
            }
            $output .= '</span>';
            if ($counter === $cols)
            {
                $output .= '<br />';
                $counter = 0;
            }
            $counter++;
            $index++;
        }
        if ($counter !== 1)
        {
            $output .= '<br />';
        }

        return $output;
    }
}

if (!function_exists('get_challenge_xp'))
{
    function get_challenge_xp($challenge = 1)
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        $query = $CI->db->where(array('challenge'=>$challenge));
        $query = $CI->db->get('challenge_xp');
        $query = $query->row_array();

        $output = $query['xp'];

        return $output;
    }
}

if (!function_exists('get_formatted_block'))
{
    function get_formatted_block($block = NULL, $monster = NULL)
    {
        if ($block === NULL || $monster === NULL)
        {
            return NULL;
        }

        if ($block === '')
        {
            return '';
        }

        # check for the [NAME] placeholder
        while (strpos($block, '[NAME]') !== FALSE)
        {
            $block = get_name_block($block, $monster['name']);
        }

        # check for weapon attacks
        while (strpos($block, '[WA]') !== FALSE)
        {
            $block = get_weapon_attack_block($block, $monster);
        }

        # check for natural attacks
        while (strpos($block, '[NA]') !== FALSE)
        {
            $block = get_natural_attack_block($block, $monster);
        }

        # check for Ability blcks
        while (strpos($block, '[AB]') !== FALSE)
        {
            $block = get_ability_block($block, $monster);
        }

        # check for Paragraph blocks
        while (strpos($block, '[P]') !== FALSE)
        {
            $block = get_paragraph_block($block);
        }

        return $block;
    }
}

if (!function_exists('get_paragraph_block'))
{
    function get_paragraph_block($block = NULL)
    {
        ### FORMAT FOR A PARAGRAPH BLOCK: [P]text[/P]

        $start = strpos($block, '[P]');
        $end = strpos($block, '[/P]', $start);
        $stringLength = $end + 3 - $start;

        $outText = substr($block, $start + 3, ($end - 3 - $start));
        $outText = ucfirst($outText);
        $outText = finalize_block($outText);

        return $outText;
    }
}

if (!function_exists('get_name_block'))
{
    function get_name_block($block = NULL, $name = '[missing name]')
    {
        ### FORMAT FOR A NAME BLOCK: [NAME]

        $start = strpos($block, '[NAME]');

        $block = substr_replace($block, strtolower($name), $start, 6);

        return $block;
    }
}

if (!function_exists('get_natural_attack_block'))
{
    function get_natural_attack_block($block = NULL, $monster = NULL)
    {
        ### FORMAT FOR A NATURAL ATTACK BLOCK: [NA]Name:type:stat:reach/reange:target:damageDie#:damageDieType:damageType:modifier:modiferValue[/NA]
        ### type is one of MW(melee weapon), RW (ranged weapon), MRW (melee or ranged weapon), MS (melee spell), RS (ranged spell)
        ### stat is the Ability Score used for the attack (typiecally Strength or Dexterity)

        #get the attack string from the block
        $start = strpos($block, '[NA]');
        $end = strpos($block, '[/NA]', $start);
        $attackString = substr($block, $start + 4, ($end - 4 - $start));
        $stringLength = strlen($attackString) + 9;

        # break the string into the component parts
        list($name, $type, $attackStat, $reach, $target, $die, $dieType, $damageType, $modifier, $modifierValue) = explode(':', $attackString);

        $outString = '<b>' . ucfirst($name) . ':</b> ';
        switch ($type)
        {
            case 'MW':
                $outString .= '<i>Melee Weapon Attack:</i> ';
                break;
            case 'RW':
                $outString .= '<i>Ranged Weapon Attack:</i> ';
                break;
            case 'MRW':
                $outString .= '<i>Melee or Ranged Weapon Attack:</i> ';
                break;
            case 'MS':
                $outString .= '<i>Melee Spell Attack:</i> ';
                break;
            case 'RS':
                $outString .= '<i>Ranged Spell Attack:</i> ';
                break;
            default:
                $outString .='<i>Unknown Attack Type:</i> ';
        }

        $statBonus = get_statBonus($monster[$attackStat]);
        $profBonus = get_challenge_profBonus($monster['challenge']);
        $attackMod = ($modifier === 'attack' ? $modifierValue : 0);

        #determine the attack to hit bonus and add it's string to the attack block
        $hitBonus = 0 + $profBonus + $statBonus + $attackMod;
        if ($hitBonus > 0)
        {
            $outString .= '+' . $hitBonus . ' to hit, ';
        }
        else if ($hitBonus < 0)
        {
            $outString .= $hitBonus . ' to hit, ';
        }

        #add the reach/range to the attack block
        $outString .= $reach . ', ';

        #add the number of targets
        $outString .= $target . '. ';

        #add the on hit to the attack block
        $damageMod = $attackMod + $statBonus;
        $outString .= '<i>Hit:</i> ' . get_formatted_damage_dice($dieType, $die, $damageMod) . ' ' . $damageType . ' damage';

        if ($modifier === 'condition')
        {
            $outString .= $modifierValue;
        }
        $outString .= '.';

        $outString = finalize_block($outString);

        $block = substr_replace($block, $outString, $start, $stringLength);

        return $block;
    }
}

if (!function_exists('get_ability_block'))
{
    function get_ability_block($block = NULL, $monster = NULL)
    {
        ### FORMAT FOR AN ABILITY BLOCK: [AB]Name:description[/AB]

        # initialize the title and body of the block
        $title = '';
        $body = '';

        $start = strpos($block, '[AB]');
        $end = strpos($block, '[/AB]', $start);
        $abilityString = substr($block, $start, ($end + 5 - $start));
        $abilityLength = strlen($abilityString);
        $break = strpos($abilityString, ':');

        $title = substr($abilityString, 4, $break - 4);
        $body = substr($abilityString, $break + 1, -5);

        $abilityString = '<b>' . ucfirst($title) . '</b>: ' . ucfirst($body);
        $abilityString = finalize_block($abilityString);
        $block = substr_replace($block, $abilityString, $start, $abilityLength);

        return $block;
    }
}

if (!function_exists('get_weapon_attack_block'))
{
    function get_weapon_attack_block($block = NULL, $monster = NULL)
    {
        ### FORMAT FOR A WEAPON ATTACK: [WA]weaponName:modifier:amount[/WA] or [WA]weaponName[/WA] or [WA]weaponName:xdamage:die#:dieType:damageType[/WA]
        ### modifier format: type-amount where type is: damage, attack, condition and amount is the value of the change (# of dice, bonus to attack, or condition name)

        # initialize the database connection
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        # initialize the weapon and modifier variables
        $weapon = '';
        $modifier = '';

        $start = strpos($block, '[WA]');                                # get the start of the weapon attack string
        $end = strpos($block, '[/WA]', $start);                         # get the end of the weapon attack string
        $attackString = substr($block, $start, ($end + 5 - $start));    # extract the weapon attack string
        $attackLength = strlen($attackString);                          # get the length of the attack string for later replacement
        $break = strpos($attackString, ':');                            # check for a space to see if there's modifiers to the attack

        if ($break !== FALSE)
        {
            $modifier = substr($attackString, $break + 1, -5);
            $weapon = substr($attackString, 4, ($break - 4));
        }
        else
        {
            $weapon = substr($attackString, 4, -5);
        }

        # initialize the modifier variables in case there is no modifier
        $modType = '';
        $modAmount = 0;

        # parse out the modifier string if it exists
        if (!empty($modifier) && strpos($modifier, 'xdamage') !== FALSE)
        {
            list($modType, $dieNum, $dieType, $dmgType) = explode(':', $modifier);
        }
        else if (!empty($modifier))
        {
            list($modType, $modAmount) = explode(':', $modifier);
        }

        # get the weapon stats from the database
        $query = $CI->db->where(array('name'=>$weapon));
        $query = $CI->db->get('weapons');
        $query = $query->row_array();

        # start building the attack block, bolding the weapon name
        $attackBlock = '<b>' . ucfirst($weapon) . ':</b> <i>';

        # check the weapon type to determine the attack type string
        if ($query['type'] === 'M')
        {
            $attackBlock .= 'Melee Weapon Attack:</i> ';
        }
        else if ($query['type'] === 'R')
        {
            $attackBlock .= 'Ranged Weapon Attack:</i> ';
        }
        else
        {
            $attackBlock .= 'Melee or Ranged Weapon Attack:</i> ';
        }

        # get the ability score to use for determing attack modifiers
        $attackStat = $query['stat'];
        if ($attackStat === 'both')
        {
            if ($monster['strength'] > $monster['dexterity'])
            {
                $attackStat = 'strength';
            }
            else
            {
                $attackStat = 'dexterity';
            }
        }

        # get the stat bonus and prof bonus for use in calculations, and attack modifier if it's set
        $statBonus = get_statBonus($monster[$attackStat]);
        $profBonus = get_challenge_profBonus($monster['challenge']);
        $attackMod = ($modType === 'attack' ? $modAmount : 0);

        #determine the attack to hit bonus and add it's string to the attack block
        $hitBonus = 0 + $profBonus + $statBonus + $attackMod;
        if ($hitBonus > 0)
        {
            $attackBlock .= '+' . $hitBonus . ' to hit, ';
        }
        else if ($hitBonus < 0)
        {
            $attackBlock .= $hitBonus . ' to hit, ';
        }

        #add the reach/range to the attack block
        $attackBlock .= $query['reach_range'] . ', ';

        #add the number of targets
        $attackBlock .= $query['target'] . '. ';

        #add the on hit to the attack block
        $dmg_die = $query['damageMulti'];
        if ($modType === 'damage' || $modType === 'mdamage')
        {
            $dmg_die = $dmg_die + $modAmount;
        }
        $modifier = $attackMod + $statBonus;
        $attackBlock .= '<i>Hit:</i> ' . get_formatted_damage_dice($query['damage'], $dmg_die, $modifier) . ' ' . $query['damage_type'] . ' damage';

        if ($modType === 'mdamage')
        {
            $attackBlock .= ' in melee or ' . get_formatted_damage_dice($query['damage'], $query['damageMulti'], $modifier) . ' ' . $query['damage_type'] . ' damage at range';
        }

        if ($modType === 'xdamage')
        {
            $attackBlock .= ' plus ' . get_formatted_damage_dice($dieType, $dieNum, 0) . ' ' . $dmgType . ' damage';
        }

        if ($query['two_handed'] === "1")
        {
            $dmg_die = $query['two_hand_damageMulti'];
            if ($modType === 'damage')
            {
                $dmg_die = $dmg_die + $modAmount;
            }
            $attackBlock .= ', or ' . get_formatted_damage_dice($query['two_hand_damage'], $dmg_die, $modifier) . ' ' . $query['damage_type'] . ' damage if used with two hands';
            if ($query['type'] === 'MR')
            {
                $attackBlock .= ' to make a melee attack';
            }
        }

        # end the attack block
        $attackBlock .= '.';

        $attackBlock = finalize_block($attackBlock);

        # replace the attack string in the base block with the new attack block
        $block = substr_replace($block, $attackBlock, $start, $attackLength);

        return $block;
    }
}

if (!function_exists('finalize_block'))
{
    function finalize_block($block = NULL)
    {
        $block = ucfirst($block);
        $block = '<p>' . $block . '</p>';

        return $block;
    }
}

if (!function_exists('get_formated_damage_dice'))
{
    function get_formatted_damage_dice($dieType = 6, $dieNumber = 1, $modifier = 0)
    {
        $average = floor(get_die_average($dieType) * $dieNumber) + $modifier;

        $modifierString = '';
        if ($modifier > 0 )
        {
            $modifierString = ' + ' . $modifier;
        }
        if ($modifier < 0 )
        {
            $modifierString = ' ' . $modifier;
        }

        $output = $average . ' (' . $dieNumber . 'd' . $dieType . $modifierString . ')';

        return $output;
    }
}

if (!function_exists('get_die_average'))
{
    function get_die_average($dieType = 6)
    {
        $CI =& get_instance();
        $CI->load->model('monsters_model');

        $CI->db->where(array('size'=>$dieType));
        $query = $CI->db->get('dieAverages');
        $query = $query->row_array();

        return $query['average'];
    }
}
