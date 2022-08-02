<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_blueprint extends CI_Model
{
    public function get_scan_user($id)
    {
        $this->db->select('*');
        $this->db->where('ID', $id);
        $this->db->from('scan-user');
        $query = $this->db->get();
        return $query->result_array();
    }
}
