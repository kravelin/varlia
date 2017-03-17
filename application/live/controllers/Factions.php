<?php
class Factions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('factions_model');
        $this->load->model('gods_model');
        $this->load->helper('url_helper');
        $this->load->helper('make_navbar_helper');
    }

    public function index()
    {
        $data['factions'] = $this->factions_model->get_factions();
        $data['title'] = 'List of Factions';

        $this->load->view('templates/header', $data);
        $this->load->view('factions/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['faction'] = $this->factions_model->get_factions($slug);

        if (empty($data['faction']))
        {
            show_404();
        }

        $data['name'] = $data['faction']['name'];
        $data['title'] = "View Faction";
        $data['gods'] = $this->gods_model->get_gods_by_faction($data['name']);

        $this->load->view('templates/header', $data);
        $this->load->view('factions/summary', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a new faction';

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('factions/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Created Faction Success";

            $this->factions_model->set_factions();

            $this->load->view('templates/header', $data);
            $this->load->view('factions/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($slug = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['faction'] = $this->factions_model->get_factions($slug);

        if (empty($data['faction']))
        {
            show_404();
        }

        $data['title'] = 'Edit a faction';

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('factions/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Edit Faction Success";

            $this->factions_model->update_factions();

            $this->load->view('templates/header', $data);
            $this->load->view('factions/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete($slug = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['faction'] = $this->factions_model->get_factions($slug);

        if (empty($data['faction']))
        {
            show_404();
        }

        $data['title'] = 'Edit a faction';

        $this->form_validation->set_rules('id', 'id', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('factions/delete', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Delete Faction Success";

            $this->factions_model->delete_factions();

            $this->load->view('templates/header', $data);
            $this->load->view('factions/success', $data);
            $this->load->view('templates/footer');
        }
    }
}
