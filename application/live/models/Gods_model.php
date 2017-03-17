<?php
class Gods_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_gods($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('gods');
            return $query->result_array();
        }

        $query = $this->db->get_where('gods', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_gods_by_faction($faction = FALSE)
    {
        if ($faction === FALSE)
        {
            return FALSE;
        }

        $query = $this->db->get_where('gods', array('faction' => $faction));
        return $query->result_array();
    }

    public function set_gods()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'altnames' => $this->input->post('altnames'),
            'portfolio' => $this->input->post('portfolio'),
            'worshippers' => $this->input->post('worshippers'),
            'devotions' => $this->input->post('devotions'),
            'home' => $this->input->post('home'),
            'faction' => $this->input->post('faction'),
            'lore' => $this->input->post('lore'),
            'alignment' => $this->input->post('alignment'),
            'rank' => $this->input->post('rank'),
            'slug' => $slug,
            'symbol' => $this->input->post('symbol')
        );

        return $this->db->insert('gods', $data);
    }

    public function update_gods()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('name'), 'dash', TRUE);

        $data = array(
            'name' => $this->input->post('name'),
            'altnames' => $this->input->post('altnames'),
            'portfolio' => $this->input->post('portfolio'),
            'worshippers' => $this->input->post('worshippers'),
            'devotions' => $this->input->post('devotions'),
            'home' => $this->input->post('home'),
            'faction' => $this->input->post('faction'),
            'lore' => $this->input->post('lore'),
            'alignment' => $this->input->post('alignment'),
            'rank' => $this->input->post('rank'),
            'slug' => $slug,
            'symbol' => $this->input->post('symbol')
        );

        $where = "id = " . $this->input->post('id');

        return $this->db->update ('gods', $data, $where);
    }

    public function delete_gods()
    {
        $where = "id = " . $this->input->post('id');

        return $this->db->delete('gods', $where);
    }
}
