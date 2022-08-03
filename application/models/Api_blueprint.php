<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_blueprint extends CI_Model
{
    public function get_scan_user($id)
    {
        $this->db->select('*');
        $this->db->where('delivery_code', $id);
        $this->db->from('scan-user');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_data($data, $data_detail)
    {
        $this->db->insert('scan-user', $data);
        foreach ($data_detail as $value) {
            $this->db->insert('detail_scan', $value);
        }
        return $this->db->affected_rows();
    }
}
