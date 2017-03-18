<?php
class Realms extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('realms_model');
        $this->load->model('regions_model');
        $this->load->model('locations_model');
        $this->load->helper('url_helper');
        $this->load->helper('make_navbar_helper');
        $this->load->helper('maps_helper');
    }

    public function index()
    {
        $data['realms'] = $this->realms_model->get_realms();
        $data['title'] = 'List of Realms';

        $this->load->view('templates/header', $data);
        $this->load->view('realms/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($name = NULL)
    {
        $data['realm'] = $this->realms_model->get_realms($name);

        if (empty($data['realm']))
        {
            show_404();
        }

        $data['title'] = "View Realm";
        $data['name'] = $data['realm']['name'];
        $data['region'] = $this->regions_model->get_region_by_name($data['realm']['region']);
        $data['locations'] = $this->locations_model->get_locations_by_realm($data['name']);
        $data['maps'] = get_formatted_maps_list('realm', $data['realm']['id']);

        $this->load->view('templates/header', $data);
        $this->load->view('realms/summary', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a new realm';
        $data['regions'] = $this->regions_model->get_regions();

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('realms/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Created Realm Success";

            $this->realms_model->set_realms();

            $this->load->view('templates/header', $data);
            $this->load->view('realms/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($slug)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['realm'] = $this->realms_model->get_realms($slug);

        if (empty($data['realm']))
        {
            show_404();
        }

        $data['title'] = 'Edit a realm';
        $data['regions'] = $this->regions_model->get_regions();

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('realms/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Edit Realm Success";

            $this->realms_model->update_realms();

            $this->load->view('templates/header', $data);
            $this->load->view('realms/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete($slug)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['realm'] = $this->realms_model->get_realms($slug);

        if (empty($data['realm']))
        {
            show_404();
        }

        $data['title'] = 'Delete Eealm';

        $this->form_validation->set_rules('id', 'id', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('realms/delete', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Delete Realm Success";

            $this->realms_model->delete_realms();

            $this->load->view('templates/header', $data);
            $this->load->view('realms/success', $data);
            $this->load->view('templates/footer');
        }
    }
}
