<?php
class Regions_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_regions($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('regions');
            return $query->result_array();
        }

        $query = $this->db->get_where('regions', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_region_by_name($name = FALSE)
    {
        if ($name === FALSE)
        {
            return FALSE;
        }

        $query = $this->db->get_where('regions', array('name' => $name));
        return $query->row_array();
    }

    public function set_regions()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'altnames' => $this->input->post('altnames'),
            'lore' => $this->input->post('lore'),
            'slug' => $slug
        );

        return $this->db->insert('regions', $data);
    }

    public function update_regions()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'altnames' => $this->input->post('altnames'),
            'lore' => $this->input->post('lore'),
            'slug' => $slug
        );

        $where = "id = " . $this->input->post('id');

        return $this->db->update('regions', $data, $where);
    }

    public function delete_regions()
    {
        $where = "id = " . $this->input->post('id');

        return $this->db->delete('regions', $where);
    }
}
