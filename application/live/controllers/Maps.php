<?php
class Maps extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('make_navbar_helper');
        $this->load->helper('maps_helper');
    }

    public function view($page = 'index')
    {
        if ( ! file_exists(APPPATH.'views/maps/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        if ( $page === 'index' )
        {
            $data['title'] = "Maps Index";
            $data['maps'] = get_formatted_maps_list();

            $this->load->view('templates/header', $data);
            $this->load->view('maps/index', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['title'] = ucfirst($page); // capitalize the first letter

            $this->load->view('templates/header', $data);
            $this->load->view('maps/' . $page, $data);
            $this->load->view('templates/footer');
        }
    }
}
