<?php
class Gods extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('gods_model');
        $this->load->model('locations_model');
        $this->load->model('factions_model');
        $this->load->helper('url_helper');
        $this->load->helper('make_navbar_helper');
    }

    public function index()
    {
        $data['gods'] = $this->gods_model->get_gods();
        $data['title'] = 'List of Gods';

        $this->load->view('templates/header', $data);
        $this->load->view('gods/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['god'] = $this->gods_model->get_gods($slug);

        if (empty($data['god']))
        {
            show_404();
        }

        $data['name'] = $data['god']['name'];
        $data['title'] = "View God";
        $data['symbol'] = "/images/gods/" . $data['slug'] . ".png";
        $data['location'] = $this->locations_model->get_location_by_name($data['god']['home']);
        $data['faction'] = $this->factions_model->get_faction_by_name($data['god']['faction']);

        $this->load->view('templates/header', $data);
        $this->load->view('gods/summary', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a new god';
        $data['locations'] = $this->locations_model->get_locations();
        $data['factions'] = $this->factions_model->get_factions();

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('alignment', 'alignment', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('gods/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Create God Success";

            $this->gods_model->set_gods();

            $this->load->view('templates/header', $data);
            $this->load->view('gods/success');
            $this->load->view('templates/footer');
        }
    }

    public function edit($slug = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['god'] = $this->gods_model->get_gods($slug);

        if (empty($data['god']))
        {
            show_404();
        }

        $data['title'] = 'Edit god';
        $data['locations'] = $this->locations_model->get_locations();
        $data['factions'] = $this->factions_model->get_factions();

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('alignment', 'alignment', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('gods/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Edit God Success";

            $this->gods_model->update_gods();

            $this->load->view('templates/header', $data);
            $this->load->view('gods/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete($slug = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['god'] = $this->gods_model->get_gods($slug);

        if (empty($data['god']))
        {
            show_404();
        }

        $data['title'] = 'Delete god';

        $this->form_validation->set_rules('id', 'id', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('gods/delete', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Delete God Success";

            $this->gods_model->delete_gods();

            $this->load->view('templates/header', $data);
            $this->load->view('gods/success', $data);
            $this->load->view('templates/footer');
        }
    }
}
