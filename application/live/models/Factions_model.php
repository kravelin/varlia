<?php
class Factions_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_factions($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('factions');
            return $query->result_array();
        }

        $query = $this->db->get_where('factions', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_faction_by_name($name = FALSE)
    {
        if ($name === FALSE)
        {
            return FALSE;
        }

        $query = $this->db->get_where('factions', array('name' => $name));
        return $query->row_array();
    }

    public function set_factions()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'lore' => $this->input->post('lore'),
            'slug' => $slug
        );

        return $this->db->insert('factions', $data);
    }

    public function update_factions()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'lore' => $this->input->post('lore'),
            'slug' => $slug
        );

        $where = "id = " . $this->input->post('id');

        return $this->db->update('factions', $data, $where);
    }

    public function delete_factions()
    {
        $where = "id = " . $this->input->post('id');

        return $this->db->delete('factions', $where);
    }
}
