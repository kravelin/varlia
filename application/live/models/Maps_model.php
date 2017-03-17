<?php
class Maps_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_maps($filename = FALSE)
    {
        if ($filename === FALSE)
        {
            $query = $this->db->get('maps');
            return $query->result_array();
        }

        $query = $this->db->get_where('maps', array('filename' => $filename));
        return $query->row_array();
    }
}
