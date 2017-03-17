<?php
class Locations extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('locations_model');
        $this->load->model('realms_model');
        $this->load->model('regions_model');
        $this->load->helper('url_helper');
        $this->load->helper('make_navbar_helper');
    }

    public function index()
    {
        $data['locations'] = $this->locations_model->get_locations();
        $data['title'] = 'List of Locations';

        $this->load->view('templates/header', $data);
        $this->load->view('locations/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['location'] = $this->locations_model->get_locations($slug);

        if (empty($data['location']))
        {
            show_404();
        }

        $data['name'] = $data['location']['name'];
        $data['title'] = "View Location";
        $data['realm'] = $this->realms_model->get_realm_by_name($data['location']['realm']);
        $data['region'] = $this->regions_model->get_region_by_name($data['realm']['region']);

        $this->load->view('templates/header', $data);
        $this->load->view('locations/summary', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a new location';
        $data['realms'] = $this->realms_model->get_realms();

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('realm', 'realm', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('locations/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Create Location Success";

            $this->locations_model->set_locations();

            $this->load->view('templates/header', $data);
            $this->load->view('locations/success');
            $this->load->view('templates/footer');
        }
    }

    public function edit($slug = FALSE)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['location'] = $this->locations_model->get_locations($slug);

        if (empty($data['location']))
        {
            show_404();
        }

        $data['title'] = 'Edit a location';
        $data['realms'] = $this->realms_model->get_realms();

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('realm', 'realm', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('locations/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Edit Location Success";

            $this->locations_model->update_locations();

            $this->load->view('templates/header', $data);
            $this->load->view('locations/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete($slug = FALSE)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['location'] = $this->locations_model->get_locations($slug);

        if (empty($data['location']))
        {
            show_404();
        }

        $data['title'] = 'Delete location';

        $this->form_validation->set_rules('id', 'id', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('locations/delete', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Delete Location Success";

            $this->locations_model->delete_locations();

            $this->load->view('templates/header', $data);
            $this->load->view('locations/success', $data);
            $this->load->view('templates/footer');
        }
    }
}
