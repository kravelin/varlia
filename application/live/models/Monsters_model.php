<?php
class Monsters_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('rules_helper');
    }

    public function get_monsters($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('monsters');
            return $query->result_array();
        }

        $query = $this->db->get_where('monsters', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_monster_by_name($name = FALSE)
    {
        if ($name === FALSE)
        {
            return FALSE;
        }

        $query = $this->db->get_where('monsters', array('name' => $name));
        return $query->row_array();
    }

    public function set_monsters()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'slug' => $slug,
            'name' => $this->input->post('name'),
            'base5e' => $this->input->post('base5e'),
            'size' => $this->input->post('size'),
            'monsterType' => $this->input->post('monsterType'),
            'subtype' => $this->input->post('subtype'),
            'alignment' => $this->input->post('alignment'),
            'armor' => $this->input->post('armor'),
            'armorBonus' => $this->input->post('armorBonus'),
            'shield' => $this->input->post('shield'),
            'hitDice' => $this->input->post('hitDice'),
            'speed' => $this->input->post('speed'),
            'flySpeed' => $this->input->post('flySpeed'),
            'hover' => $this->input->post('hover'),
            'climbSpeed' => $this->input->post('climbSpeed'),
            'burrowSpeed' => $this->input->post('burrowSpeed'),
            'swimSpeed' => $this->input->post('swimSpeed'),
            'strength' => $this->input->post('strength'),
            'dexterity' => $this->input->post('dexterity'),
            'constitution' => $this->input->post('constitution'),
            'intelligence' => $this->input->post('intelligence'),
            'wisdom' => $this->input->post('wisdom'),
            'charisma' => $this->input->post('charisma'),
            'saveSTR' => $this->input->post('saveSTR'),
            'saveDEX' => $this->input->post('saveDEX'),
            'saveCON' => $this->input->post('saveCON'),
            'saveINT' => $this->input->post('saveINT'),
            'saveWIS' => $this->input->post('saveWIS'),
            'saveCHA' => $this->input->post('saveChA'),
            'understand_only' => $this->input->post['understand_only'],
            'challenge' => $this->input->post('challenge'),
            'abilities' => $this->input->post('abilities'),
            'actions' => $this->input->post('actions'),
            'legendaryActions' => $this->input->post('legendaryActions'),
            'description' => $this->input->post('description'),
            'lore' => $this->input->post('lore'),
            'habitat' => $this->input->post('habitat'),
            'lair' => $this->input->post('lair'),
            'lairActions' => $this->input->post('lairActions'),
            'regionalEffects' => $this->input->post('regionalEffects')
        );

        $monster = $this->db->insert('monsters', $data);
        $monster = $this->db->where(array('name'=>$this->input->post('name')));
        $monster = $this->db->get('monsters');
        $monster = $monster->row_array();
        $monsterID = $monster['id'];

        if(!empty($this->input->post('skills')))
        {
            foreach ($this->input->post('skills') as $skill)
            {
                $skillDouble = $this->input->post('skillDouble');

                if ($skillDouble !== NULL)
                {
                    if (array_key_exists($skill, $skillDouble))
                    {
                        $skillDouble = $skillDouble[$skill];
                    }
                    else
                    {
                        $skillDouble = NULL;
                    }
                }

                $skillData = array(
                    'skills_id' => $skill,
                    'monster_id' => $monsterID,
                    'double_prof' => $skillDouble
                );

                $this->db->insert('monster_skills', $skillData);
            }
        }

        if (!empty($this->input->post('vulernabilities')))
        {
            foreach ($this->input->post('vulnerabilities') as $dmg_vuln)
            {
                if (!empty($monster))
                {
                    $vulnData = array(
                        'damages_id' => $dmg_vuln,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_vulnerabilities', $vulnData);
                }
            }
        }

        if (!empty($this->input->post('resistances')))
        {
            foreach ($this->input->post('resistances') as $dmg_resist)
            {
                if (!empty($monster))
                {
                    $resistData = array(
                        'damages_id' => $dmg_resist,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_resistances', $resistData);
                }
            }
        }

        if (!empty($this->input->post('immunities')))
        {
            foreach ($this->input->post('immunities') as $dmg_immune)
            {
                if (!empty($monster))
                {
                    $immuneData = array(
                        'damages_id' => $dmg_immune,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_immunities', $immuneData);
                }
            }
        }

        if (!empty($this->input->post('conditions')))
        {
            foreach ($this->input->post('conditions') as $con_immune)
            {
                if (!empty($monster))
                {
                    $conData = array(
                        'conditions_id' => $con_immune,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_conditions', $conData);
                }
            }
        }

        if (!empty($this->input->post('senses')))
        {
            foreach ($this->input->post('senses') as $sense)
            {
                if (!empty($monster))
                {
                    $senseValue = $this->input->post('sensesValue');
                    if (array_key_exists($sense, $senseValue))
                    {
                        $senseValue = $senseValue[$sense];
                    }
                    else
                    {
                        $senseValue = NULL;
                    }

                    $senseData = array(
                        'senses_id' => $sense,
                        'monster_id' => $monsterID,
                        'value' => $senseValue
                    );

                    $this->db->insert('monster_senses', $senseData);
                }
            }
        }

        if (!empty($this->input->post('languages')))
        {
            foreach ($this->input->post('languages') as $language)
            {
                if (!empty($monster))
                {
                    $languageData = array(
                        'languages_id' => $language,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_languages', $languageData);
                }
            }
        }

        return $monster;
    }

    public function update_monsters()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'slug' => $slug,
            'name' => $this->input->post('name'),
            'base5e' => $this->input->post('base5e'),
            'size' => $this->input->post('size'),
            'monsterType' => $this->input->post('monsterType'),
            'subtype' => $this->input->post('subtype'),
            'alignment' => $this->input->post('alignment'),
            'armor' => $this->input->post('armor'),
            'armorBonus' => $this->input->post('armorBonus'),
            'shield' => $this->input->post('shield'),
            'hitDice' => $this->input->post('hitDice'),
            'speed' => $this->input->post('speed'),
            'flySpeed' => $this->input->post('flySpeed'),
            'hover' => $this->input->post('hover'),
            'climbSpeed' => $this->input->post('climbSpeed'),
            'burrowSpeed' => $this->input->post('burrowSpeed'),
            'swimSpeed' => $this->input->post('swimSpeed'),
            'strength' => $this->input->post('strength'),
            'dexterity' => $this->input->post('dexterity'),
            'constitution' => $this->input->post('constitution'),
            'intelligence' => $this->input->post('intelligence'),
            'wisdom' => $this->input->post('wisdom'),
            'charisma' => $this->input->post('charisma'),
            'saveSTR' => $this->input->post('saveSTR'),
            'saveDEX' => $this->input->post('saveDEX'),
            'saveCON' => $this->input->post('saveCON'),
            'saveINT' => $this->input->post('saveINT'),
            'saveWIS' => $this->input->post('saveWIS'),
            'saveCHA' => $this->input->post('saveChA'),
            'understand_only' => $this->input->post['understand_only'],
            'challenge' => $this->input->post('challenge'),
            'abilities' => $this->input->post('abilities'),
            'actions' => $this->input->post('actions'),
            'legendaryActions' => $this->input->post('legendaryActions'),
            'description' => $this->input->post('description'),
            'lore' => $this->input->post('lore'),
            'habitat' => $this->input->post('habitat'),
            'lair' => $this->input->post('lair'),
            'lairActions' => $this->input->post('lairActions'),
            'regionalEffects' => $this->input->post('regionalEffects')
        );

        $monsterID = $this->input->post('id');

        $where = "id = " . $monsterID;

        $monster = $this->db->update ('monsters', $data, $where);

        $this->db->where(array('monster_id'=>$monsterID));
        $this->db->delete('monster_skills');

        if(!empty($this->input->post('skills')))
        {
            foreach ($this->input->post('skills') as $skill)
            {
                $skillDouble = $this->input->post('skillDouble');

                if ( $skillDouble !== NULL )
                {
                    if (array_key_exists($skill, $skillDouble))
                    {
                        $skillDouble = $skillDouble[$skill];
                    }
                    else
                    {
                        $skillDouble = NULL;
                    }
                }
                $skillData = array(
                    'skills_id' => $skill,
                    'monster_id' => $monsterID,
                    'double_prof' => $skillDouble
                );

                $this->db->insert('monster_skills', $skillData);
            }
        }

        $this->db->where(array('monster_id'=>$monsterID));
        $this->db->delete('monster_vulnerabilities');

        if (!empty($this->input->post('vulernabilities')))
        {
            foreach ($this->input->post('vulnerabilities') as $dmg_vuln)
            {
                if (!empty($monster))
                {
                    $vulnData = array(
                        'damages_id' => $dmg_vuln,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_vulnerabilities', $vulnData);
                }
            }
        }

        $this->db->where(array('monster_id'=>$monsterID));
        $this->db->delete('monster_resistances');

        if (!empty($this->input->post('resistances')))
        {
            foreach ($this->input->post('resistances') as $dmg_resist)
            {
                if (!empty($monster))
                {
                    $resistData = array(
                        'damages_id' => $dmg_resist,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_resistances', $resistData);
                }
            }
        }

        $this->db->where(array('monster_id'=>$monsterID));
        $this->db->delete('monster_immunities');

        if (!empty($this->input->post('immunities')))
        {
            foreach ($this->input->post('immunities') as $dmg_immune)
            {
                if (!empty($monster))
                {
                    $immuneData = array(
                        'damages_id' => $dmg_immune,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_immunities', $immuneData);
                }
            }
        }

        $this->db->where(array('monster_id'=>$monsterID));
        $this->db->delete('monster_conditions');

        if (!empty($this->input->post('conditions')))
        {
            foreach ($this->input->post('conditions') as $con_immune)
            {
                if (!empty($monster))
                {
                    $conData = array(
                        'conditions_id' => $con_immune,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_conditions', $conData);
                }
            }
        }

        $this->db->where(array('monster_id'=>$monsterID));
        $this->db->delete('monster_senses');

        if (!empty($this->input->post('senses')))
        {
            foreach ($this->input->post('senses') as $sense)
            {
                if (!empty($monster))
                {
                    $senseValue = $this->input->post('sensesValue');
                    if (array_key_exists($sense, $senseValue))
                    {
                        $senseValue = $senseValue[$sense];
                    }
                    else
                    {
                        $senseValue = NULL;
                    }

                    $senseData = array(
                        'senses_id' => $sense,
                        'monster_id' => $monsterID,
                        'value' => $senseValue
                    );

                    $this->db->insert('monster_senses', $senseData);
                }
            }
        }

        $this->db->where(array('monster_id'=>$monsterID));
        $this->db->delete('monster_languages');

        if (!empty($this->input->post('languages')))
        {
            foreach ($this->input->post('languages') as $language)
            {
                if (!empty($monster))
                {
                    $languageData = array(
                        'languages_id' => $language,
                        'monster_id' => $monsterID
                    );

                    $this->db->insert('monster_languages', $languageData);
                }
            }
        }

        return $monster;
    }

    public function delete_monsters()
    {
        $where = 'id = ' . $this->input->post('id');
        $whereMD = 'monster_id = ' . $this->input->post['id'];

        $this->db->delete('monster_conditons', $whereMD);
        $this->db->delete('monster_immunities', $whereMD);
        $this->db->delete('monster_languages', $whereMD);
        $this->db->delete('monster_resistances', $whereMD);
        $this->db->delete('monster_senses', $whereMD);
        $this->db->delete('monster_skills', $whereMD);
        $this->db->delete('monster_vulnerabilities', $whereMD);

        return $this->db->delete('monsters', $where);
    }

    public function get_stat($stat = NULL)
    {
        $this->db->order_by('type','ASC');
        $query = $this->db->get($stat);
        return $query->result_array();
    }

    public function get_monster_stat($monsterID, $stat)
    {
        $this->db->where(array('monster_id'=>$monsterID));

        $query = $this->db->get('monster_' . $stat);
        $query = $query->result_array();

        $output = array();
        foreach($query as $key => $value)
        {
            $keys = array_keys($value);
            foreach ($keys as $item)
            {
                $output[$item][$key] = $value[$item];
            }
        }
        return $output;
    }

    public function get_formatted_skills($monster)
    {
        $skills = $this->monsters_model->get_monster_stat($monster['id'], 'skills');

        if (!empty($skills))
        {
            $output = '<b>Skills:</b> ';
            $counter = 0;
            extract($skills);

            foreach ($skills_id as $index => $skillID)
            {
                $this->db->where(array('id'=>$skillID));
                $query = $this->db->get('skills');
                $skill = $query->row_array();

                if (!empty($skill))
                {
                    if ($counter > 0)
                    {
                        $output .= ', ';
                    }
                    $stat = $skill['attribute'];
                    $profBonus = get_challenge_profBonus($monster['challenge']);

                    $output .= $skill['type'] . ' +' . (get_statBonus($monster[$stat]) + ($double_prof[$index] === '1' ? $profBonus * 2 : $profBonus));
                }
                $counter++;
            }
            $output .= '<br />';

            return $output;
        }
        return NULL;
    }

    public function get_formatted_vulnerabilities($monster)
    {
        $dmg_vulns = $this->monsters_model->get_monster_stat($monster['id'], 'vulnerabilities');

        if (!empty($dmg_vulns))
        {
            $output = '<b>Damage Vulnerabilities:</b> ';
            $counter = 0;

            foreach ($dmg_vulns as $vulnID)
            {
                $this->db->where(array('id'=>$vulnID[0]));
                $query = $this->db->get('damage_types');
                $vuln = $query->row_array();

                if ($counter > 0)
                {
                    $output .= ', ';
                }
                $output .= $vuln['type'];
                $counter++;
            }
            $output .= '<br />';

            return $output;
        }
        return NULL;
    }

    public function get_formatted_resistances($monster)
    {
        $dmg_resists = $this->monsters_model->get_monster_stat($monster['id'], 'resistances');

        if (!empty($dmg_resists))
        {
            $output = '<b>Damage Resistances:</b> ';
            $counter = 0;

            foreach ($dmg_resists as $resistID)
            {
                $this->db->where(array('id'=>$resistID[0]));
                $query = $this->db->get('damage_types');
                $resist = $query->row_array();

                if ($counter > 0)
                {
                    $output .= ', ';
                }
                $output .= $resist['type'];
                $counter++;
            }
            $output .= '<br />';

            return $output;
        }
        return NULL;
    }

    public function get_formatted_immunities($monster)
    {
        $dmg_immunes = $this->monsters_model->get_monster_stat($monster['id'], 'immunities');

        if (!empty($dmg_immunes))
        {
            $output = '<b>Damage Immunities:</b> ';
            $counter = 0;

            foreach ($dmg_immunes as $immuneID)
            {
                $this->db->where(array('id'=>$immuneID[0]));
                $query = $this->db->get('damage_types');
                $immune = $query->row_array();

                if ($counter > 0)
                {
                    $output .= ', ';
                }
                $output .= $immune['type'];
                $counter++;
            }
            $output .= '<br />';

            return $output;
        }
        return NULL;
    }

    public function get_formatted_conditions($monster)
    {
        $con_immunes = $this->monsters_model->get_monster_stat($monster['id'], 'conditions');

        if (!empty($con_immunes))
        {
            $output = '<b>Condition Immunities:</b> ';
            $counter = 0;

            foreach ($con_immunes as $immuneID)
            {
                $this->db->where(array('id'=>$immuneID[0]));
                $query = $this->db->get('conditions');
                $immune = $query->row_array();

                if ($counter > 0)
                {
                    $output .= ', ';
                }
                $output .= $immune['type'];
                $counter++;
            }
            $output .= '<br />';

            return $output;
        }
        return NULL;
    }

    public function get_formatted_senses($monster)
    {
        $senses = $this->monsters_model->get_monster_stat($monster['id'], 'senses');

        $output = '<b>Senses:</b> ';
        $counter = 0;

        if (!empty($senses))
        {
            extract($senses);
            foreach ($senses_id as $key => $senseID)
            {
                $this->db->where(array('id'=>$senseID));
                $query = $this->db->get('senses');
                $sense = $query->row_array();
                if ($counter > 0)
                {
                    $output .= ', ';
                }
                $output .= $sense['type'] . ' ' . $value[$key] . ' ' . $sense['value_type'];
                $counter++;
            }
        }
        if ($counter > 0)
        {
            $output .= ', ';
        }

        $passiveBonus = 10 + get_statBonus($monster['wisdom']);
        $profBonus = 0;
        $this->db->where(array('monster_id'=>$monster['id']));
        $this->db->where(array('skills_id'=>30));
        $query = $this->db->get('monster_skills');
        $query = $query->row_array();
        if (!empty($query))
        {
            $profBonus = get_challenge_profBonus($monster['challenge']);
        }
        $passiveBonus += $profBonus;

        $output .= 'passive Perception ' . $passiveBonus . '<br />';

        return $output;
    }

    public function get_formatted_languages($monster)
    {
        $languages = $this->monsters_model->get_monster_stat($monster['id'], 'languages');

        $output = '<b>Languages:</b> ';
        $counter = 0;

        if (!empty($languages))
        {
            foreach ($languages['languages_id'] as $languageID)
            {
                $this->db->where(array('id'=>$languageID));
                $query = $this->db->get('languages');
                $language = $query->row_array();

                if ($counter > 0)
                {
                    $output .= ', ';
                }
                $output .= $language['type'];
                $counter++;
            }
        }
        if ($counter === 0)
        {
            $output .= '----';
        }
        $output .= '<br />';
        return $output;
    }

    public function get_monster_damages($monsterID)
    {
        $damages = [];
        $damages['vulns'] = $this->monsters_model->get_monster_stat($monsterID, 'vulnerabilities');
        $damages['resists'] = $this->monsters_model->get_monster_stat($monsterID, 'resistances');
        $damages['immunes'] = $this->monsters_model->get_monster_stat($monsterID, 'immunities');

        return $damages;
    }

    public function get_formatted_challenge($challenge = 1)
    {
        $output = '<b>Challenge:</b> ';
        if ($challenge === '0.100')
        {
            $ouput .= '0 (';
        }
        else if ($challenge === '0.125')
        {
            $output .= '1/8 (';
        }
        else if ($challenge === '0.250')
        {
            $output .= '1/4 (';
        }
        else if ($challenge === '0.500')
        {
            $output .= '1/2 (';
        }
        else
        {
            $out_challenge = substr($challenge, 0, -4);
            $output .= $out_challenge . ' (';
        }
        $output .= get_challenge_xp($challenge) . ' XP)<br />';

        return $output;
    }
}
