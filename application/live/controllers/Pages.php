<?php
class Pages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->model('gods_model');
        $this->load->model('factions_model');
        $this->load->model('regions_model');
        $this->load->model('realms_model');
        $this->load->model('locations_model');
        $this->load->model('monsters_model');
        $this->load->helper('url_helper');
        $this->load->helper('make_navbar_helper');
    }

    public function view($page = 'home')
    {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        if ( $page === 'home' )
        {
            $data['title'] = "Varlia Online";
            $data['news'] = $this->news_model->get_latest();

            $this->load->view('templates/header', $data);
            $this->load->view('pages/home', $data);
            $this->load->view('news/latest', $data);
            $this->load->view('templates/footer');
        }
        elseif ( $page === 'admin' )
        {
            $data['title'] = "Admin Central Hub";
            $data['gods'] = $this->gods_model->get_gods();
            $data['factions'] = $this->factions_model->get_factions();
            $data['regions'] = $this->regions_model->get_regions();
            $data['realms'] = $this->realms_model->get_realms();
            $data['locations'] = $this->locations_model->get_locations();
            $data['monsters'] = $this->monsters_model->get_monsters();

            $this->load->view('templates/header', $data);
            $this->load->view('pages/admin', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = ucfirst($page); // capitalize the first letter

            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }
    }
}