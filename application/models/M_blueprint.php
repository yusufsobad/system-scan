<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_blueprint extends CI_Model
{
    public function get_sbd_item($perpage, $start)
    {
        $this->db->select('*');
        $this->db->limit($perpage, $start);
        $this->db->from('sbd-item');
        $query = $this->db->get();
        return $query;
    }

    public function get_keyword($keyword = '', $perpage, $start)
    {
        $this->db->select('*');
        $this->db->from('sbd-item');
        $this->db->limit($perpage, $start);
        $this->db->like('qrcode', $keyword);
        $this->db->or_like('receiver', $keyword);
        return $this->db->get();
    }

    public function insert_data($data)
    {
        $this->db->insert('sbd-item', $data);
    }

    public function count_data()
    {
        $this->db->from('sbd-item');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function check_db($key)
    {
        $this->db->where('qrcode', $key);
        $query = $this->db->get('sbd-item');
        if ($query->num_rows() > 0) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function get_data($where, $table)
    {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
