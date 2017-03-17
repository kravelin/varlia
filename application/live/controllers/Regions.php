<?php
class Regions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('regions_model');
        $this->load->model('realms_model');
        $this->load->model('locations_model');
        $this->load->helper('url_helper');
        $this->load->helper('make_navbar_helper');
    }

    public function index()
    {
        $data['regions'] = $this->regions_model->get_regions();
        $data['title'] = 'List of Regions';

        $this->load->view('templates/header', $data);
        $this->load->view('regions/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['region'] = $this->regions_model->get_regions($slug);

        if (empty($data['region']))
        {
            show_404();
        }

        $data['name'] = $data['region']['name'];
        $data['title'] = "View Region";
        $data['realms'] = $this->realms_model->get_realms_by_region($data['name']);
        $data['locations'] = $this->locations_model->get_locations();

        $this->load->view('templates/header', $data);
        $this->load->view('regions/summary', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a new region';

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('regions/create', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Created Region Success";

            $this->regions_model->set_regions();

            $this->load->view('templates/header', $data);
            $this->load->view('regions/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($slug = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['region'] = $this->regions_model->get_regions($slug);

        if (empty($data['region']))
        {
            show_404();
        }

        $data['title'] = 'Edit a region';

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('regions/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = "Edit Region Success";

            $this->regions_model->update_regions();

            $this->load->view('templates/header', $data);
            $this->load->view('regions/success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete($slug = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['region'] = $this->regions_model->get_regions($slug);

        if (empty($data['region']))
        {
            show_404();
        }

        $data['title'] = 'Delete Region';

        $this->form_validation->set_rules('id', 'id', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('regions/delete', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = 'Delete Region Success';

            $this->regions_model->delete_region();

            $this->load->view('templates/header', $data);
            $this->load->view('regions/success', $data);
            $this->load->view('templates/footer');
        }
    }
}
