<?php
class Realms_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_realms($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('realms');
            return $query->result_array();
        }

        $query = $this->db->get_where('realms', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_realm_by_name($name = FALSE)
    {
        if ($name === FALSE)
        {
            return FALSE;
        }

        $query = $this->db->get_where('realms', array('name' => $name));
        return $query->row_array();
    }

    public function get_realms_by_region($region = FALSE)
    {
        if ($region === FALSE)
        {
            return FALSE;
        }

        $query = $this->db->get_where('realms', array('region' => $region));
        return $query->result_array();
    }

    public function set_realms()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'altnames' => $this->input->post('altnames'),
            'lore' => $this->input->post('lore'),
            'region' => $this->input->post('region'),
            'slug' => $slug
        );

        return $this->db->insert('realms', $data);
    }

    public function update_realms()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'altnames' => $this->input->post('altnames'),
            'lore' => $this->input->post('lore'),
            'region' => $this->input->post('region'),
            'slug' => $slug
        );

        $where = "id = " . $this->input->post('id');

        return $this->db->update('realms', $data, $where);
    }

    public function delete_realms()
    {
        $where = "id = " . $this->input->post('id');

        return $this->db->delete('realms', $where);
    }
}
