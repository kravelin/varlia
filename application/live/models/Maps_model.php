<?php
class Maps_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_maps($area = NULL, $id = NULL)
    {
        switch ($area)
        {
            case 'realm':
                $this->db->where(array('realm_id' => $id));
                break;
            case 'region':
                $this->db->where(array('region_id' => $id));
                break;
            case 'location':
                $this->db->where(array('location_id' => $id));
                break;
        }

        $this->db->order_by('name');
        $query = $this->db->get('maps');
        return $query->result_array();
    }
}
