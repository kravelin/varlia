<?php
class Monsters extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('monsters_model');
        $this->load->model('locations_model');
        $this->load->model('realms_model');
        $this->load->model('regions_model');
        $this->load->helper('url_helper');
        $this->load->helper('make_navbar_helper');
        $this->load->helper('rules_helper');
    }

    public function index()
    {
        $data['monsters'] = $this->monsters_model->get_monsters();
        $data['title'] = 'List of Monsters';

        $this->load->view('templates/header', $data);
        $this->load->view('monsters/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['monster'] = $this->monsters_model->get_monsters($slug);

        if (empty($data['monster']))
        {
            show_404();
        }

        $data['name'] = $data['monster']['name'];
        $data['title'] = "View Monster";

        $data['skills'] = $this->monsters_model->get_formatted_skills($data['monster']);
        $data['vulnerabilities'] = $this->monsters_model->get_formatted_vulnerabilities($data['monster']);
        $data['resistances'] = $this->monsters_model->get_formatted_resistances($data['monster']);
        $data['immunities'] = $this->monsters_model->get_formatted_immunities($data['monster']);
        $data['conditions'] = $this->monsters_model->get_formatted_conditions($data['monster']);
        $data['senses'] = $this->monsters_model->get_formatted_senses($data['monster']);
        $data['languages'] = $this->monsters_model->get_formatted_languages($data['monster']);
        $data['challenge'] = $this->monsters_model->get_formatted_challenge($data['monster']['challenge']);
        $data['abilities'] = get_formatted_block($data['monster']['abilities'], $data['monster']);
        $data['actions'] = get_formatted_block($data['monster']['actions'], $data['monster']);
        $data['legendaryActions'] = get_formatted_block($data['monster']['legendaryActions'], $data['monster']);
        $data['description'] = get_formatted_block($data['monster']['description'], $data['monster']);
        $data['lore'] = get_formatted_block($data['monster']['lore'], $data['monster']);
        $data['habitat'] = get_formatted_block($data['monster']['habitat'], $data['monster']);
        $data['lair'] = get_formatted_block($data['monster']['lair'], $data['monster']);
        $data['lairActions'] = get_formatted_block($data['monster']['lairActions'], $data['monster']);
        $data['regionalEffects'] = get_formatted_block($data['monster']['regionalEffects'], $data['monster']);

        $this->load->view('templates/header', $data);
        $this->load->view('monsters/summary', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a new monster';
        $data['sizes'] = get_sizes();
        $data['monsterTypes'] = get_monsterTypes();
        $data['alignments'] = get_alignments();
        $data['armorTypes'] = get_armorTypes('types');

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('alignment', 'alignment', 'required');
        $this->form_validation->set_rules('monsterType', 'monsterType', 'required');
        $this->form_validation->set_rules('hitDice', 'hitDice', 'required');
        $this->form_validation->set_rules('strength', 'strength', 'required');
        $this->form_validation->set_rules('dexterity', 'dexterity', 'required');
        $this->form_validation->set_rules('constitution', 'constitution', 'required');
        $this->form_validation->set_rules('intelligence', 'intelligence', 'required');
        $this->form_validation->set_rules('wisdom', 'wisdom', 'required');
        $this->form_validation->set_rules('charisma', 'charisma', 'required');
        $this->form_validation->set_rules('challenge', 'challenge', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('monsters/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Create monster Success";
            $data['type'] = 'create';

            $this->monsters_model->set_monsters();
            $data['monster'] = $this->monsters_model->get_monster_by_name($this->input->post('name'));

            $this->load->view('templates/header', $data);
            $this->load->view('monsters/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($slug = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['monster'] = $this->monsters_model->get_monsters($slug);

        if (empty($data['monster']))
        {
            show_404();
        }

        $data['title'] = 'Edit monster';
        $data['sizes'] = get_sizes();
        $data['monsterTypes'] = get_monsterTypes();
        $data['alignments'] = get_alignments();
        $data['armorTypes'] = get_armorTypes('types');

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('alignment', 'alignment', 'required');
        $this->form_validation->set_rules('monsterType', 'monsterType', 'required');
        $this->form_validation->set_rules('hitDice', 'hitDice', 'required');
        $this->form_validation->set_rules('strength', 'strength', 'required');
        $this->form_validation->set_rules('dexterity', 'dexterity', 'required');
        $this->form_validation->set_rules('constitution', 'constitution', 'required');
        $this->form_validation->set_rules('intelligence', 'intelligence', 'required');
        $this->form_validation->set_rules('wisdom', 'wisdom', 'required');
        $this->form_validation->set_rules('charisma', 'charisma', 'required');
        $this->form_validation->set_rules('challenge', 'challenge', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('monsters/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Edit monster Success";
            $data['type'] = 'edit';

            $this->monsters_model->update_monsters();

            $this->load->view('templates/header', $data);
            $this->load->view('monsters/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete($slug = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['monster'] = $this->monsters_model->get_monsters($slug);

        if (empty($data['monster']))
        {
            show_404();
        }

        $data['title'] = 'Delete monster';

        $this->form_validation->set_rules('id', 'id', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('monsters/delete', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Delete monster Success";
            $data['type'] = 'delete';

            $this->monsters_model->delete_monsters();

            $this->load->view('templates/header', $data);
            $this->load->view('monsters/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function types($slug = NULL)
    {
        $data['type'] = get_monsterTypes($slug);
        $data['title'] = 'Monsters of type ' . $slug;
        $data['monsters'] = get_formatted_monsters_by_type($slug);

        $this->load->view('templates/header', $data);
        $this->load->view('monsters/types', $data);
        $this->load->view('templates/footer');
    }
}
