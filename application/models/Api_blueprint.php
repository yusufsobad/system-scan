<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_blueprint extends CI_Model
{
    public function get_data($where, $data, $table)
    {
        $this->db->select('*');
        $this->db->where($where, $data);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_scan_user($id)
    {
        $this->db->select('*');
        $this->db->where('id_temporary', $id);
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

    public function update_data($data, $id)
    {
        $this->db->update('scan-user', $data, ['id_paket' => $id]);
        return $this->db->affected_rows();
    }

    function check_db($key)
    {
        $this->db->where('id_temporary', $key);
        $query = $this->db->get('scan-user');
        if ($query->num_rows() > 0) {
            $data = 'true';
            return $data;
        } else {
            $data = 'false';
            return $data;
        }
    }
}
