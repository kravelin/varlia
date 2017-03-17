<?php
class Locations_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_locations($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('locations');
            return $query->result_array();
        }

        $query = $this->db->get_where('locations', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_location_by_name($name = FALSE)
    {
        if ($name === FALSE)
        {
            return FALSE;
        }

        $query = $this->db->get_where('locations', array('name' => $name));
        return $query->row_array();
    }

    public function get_locations_by_realm($realm = FALSE)
    {
        if ($realm === FALSE)
        {
            return FALSE;
        }

        $query = $this->db->get_where('locations', array('realm' => $realm));
        return $query->result_array();
    }

    public function set_locations()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'altnames' => $this->input->post('altnames'),
            'realm' => $this->input->post('realm'),
            'lore' => $this->input->post('lore'),
            'slug' => $slug
        );

        return $this->db->insert('locations', $data);
    }

    public function update_locations()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'altnames' => $this->input->post('altnames'),
            'realm' => $this->input->post('realm'),
            'lore' => $this->input->post('lore'),
            'slug' => $slug
        );

        $where = "id = " . $this->input->post('id');

        return $this->db->update('locations', $data, $where);
    }

    public function delete_locations()
    {
        $where = "id = " . $this->input->post('id');

        return $this->db->delete('locations', $where);
    }
}
