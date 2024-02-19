<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_blueprint extends CI_Model
{
    public function get_sbd_item($perpage, $start)
    {
        $this->db->select('*');
        $this->db->limit($perpage, $start);
        $this->db->from('scan-user');
        $query = $this->db->get();
        return $query;
    }

    public function get_where($where, $table)
    {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function data_table($perpage, $start, $table)
    {
        $this->db->select('*');
        $this->db->limit($perpage, $start);
        $this->db->from($table);
        $this->db->order_by('ID', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_keyword($keyword = '', $perpage, $start, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        $this->db->like('delivery_code', $keyword);
        $this->db->order_by('ID', 'DESC');
        $this->db->or_like('penerima', $keyword);
        return $this->db->get();
    }

    public function get_keyword_admin($keyword = '', $perpage, $start, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        $this->db->like('qrcode', $keyword);
        $this->db->order_by('ID', 'DESC');
        return $this->db->get();
    }

    public function keyword($keyword = '', $perpage, $start, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        $this->db->like($keyword);
        $this->db->order_by('ID', 'DESC');
        return $this->db->get();
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function insert_lastId($data, $table)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function count_data_pack($table,$like='')
    {
        $this->db->from($table);

        if(!empty($like)){
            $this->db->like('note', $like);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_data($table,$like='')
    {
        $this->db->from($table);

        if(!empty($like)){
            $this->db->like('sn', $like);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    function check_db($key, $table)
    {
        $this->db->where($key);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function check_do($key, $table)
    {
        $this->db->where($key);
        $this->db->where('status', 0);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function check_packing($key, $table)
    {
        $this->db->where($key);
        $this->db->where('status', 1);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function check_packing_lock($key, $table)
    {
        $this->db->where($key);
        $this->db->where('status', 1);
        $this->db->where('reff', 0);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function check_sn_reff($key)
    {
        $this->db->where('sn',$key);
        $this->db->where('reff',0);
        $query = $this->db->get('serial-number');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
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

    public function get_data_table($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_data_packing($where, $table)
    {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->where('status', 1);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all($table)
    {

        return $this->db->get($table)->result(); // Tampilkan semua data yang ada di tabel siswa

    }

    public function get_table($table)
    {

        return $this->db->get($table)->result_array(); // Tampilkan semua data yang ada di tabel siswa

    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function delete_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function test_get($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_qrcode($table, $where)
    {
        $this->db->where('code', $where);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    // public function get_scan()
    // {
    //     $this->db->select('*');
    //     $this->db->from('Album a');
    //     $this->db->join('Category b', 'b.cat_id=a.cat_id', 'left');
    //     $this->db->join('Soundtrack c', 'c.album_id=a.album_id', 'left');
    //     // $this->db->where('c.album_id', $id);
    //     $this->db->order_by('c.track_title', 'asc');
    //     $query = $this->db->get();
    //     if ($query->num_rows() != 0) {
    //         return $query->result_array();
    //     } else {
    //         return false;
    //     }
    // }
    public function get_scan_join()
    {
        $this->db->select('note_deliv.ID,note,no_pack,sn');
        $this->db->from('note_deliv');
        $this->db->join('packing', 'packing.reff_note=note_deliv.ID', 'left');
        $this->db->join('serial-number', 'serial-number.reff=packing.ID', 'left');
        // $this->db->where('c.album_id', $id);
        $this->db->order_by('serial-number.reff', 'packing.ID');

        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $query =  $query->result_array();
            $result = array();
            foreach ($query as $arr) {
                $result[$arr['ID']['ID']] = [
                    'ID'        => $arr['ID'],
                    'note'      => $arr['note'],
                    'packing'   => [$arr['no_pack'] => ['serial-num' => [$arr['sn']]]],

                ];
            }
            return $result;
        } else {
            return false;
        }
    }

    public function get_qrcode_join($perpage=10, $start=1, $where='')
    {
        $this->db->select('serial-number.ID,note_deliv.note,no_pack,sn','id_paket','id_temporary','delivery_order');
        $this->db->from('serial-number');
        $this->db->join('packing', 'serial-number.reff=packing.ID', 'left');
        $this->db->join('note_deliv', 'packing.reff_note=note_deliv.ID', 'left');
        $this->db->join('scan-user', 'packing.reff=scan-user.ID', 'left');
        
        if(!empty($where)){
            $this->db->like('sn', $where);
        }
        
        $this->db->limit($perpage, $start);
        $this->db->order_by('serial-number.reff', 'packing.ID');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function search_qrcode_sn($where='')
    {
        $this->db->select('serial-number.ID,note_deliv.note,no_pack,sn','id_paket','id_temporary','delivery_order');
        $this->db->from('serial-number');
        $this->db->join('packing', 'serial-number.reff=packing.ID', 'left');
        $this->db->join('note_deliv', 'packing.reff_note=note_deliv.ID', 'left');
        $this->db->join('scan-user', 'packing.reff=scan-user.ID', 'left');
        
        if(!empty($where)){
            $this->db->where('sn', $where);
        }
        
        //$this->db->limit($perpage, $start);
        $this->db->order_by('serial-number.reff', 'packing.ID');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function search_qrcode_packing($where='')
    {
        $this->db->select('serial-number.ID,note_deliv.note,no_pack,sn','id_paket','id_temporary','delivery_order');
        $this->db->from('serial-number');
        $this->db->join('packing', 'serial-number.reff=packing.ID', 'left');
        $this->db->join('note_deliv', 'packing.reff_note=note_deliv.ID', 'left');
        $this->db->join('scan-user', 'packing.reff=scan-user.ID', 'left');
        
        if(!empty($where)){
            $this->db->where('no_pack', $where);
        }
        
        //$this->db->limit($perpage, $start);
        $this->db->order_by('serial-number.reff', 'packing.ID');
        $query = $this->db->get();
        return $query->result_array();
    }
}
