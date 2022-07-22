<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{

    //PROSES CURL TO ARRAY------------------------------------------------------
    public function auth_curl($url = '', $data = array())
    {
        if (empty($url)) {
            return '';
        }

        $check = array_filter($data);
        if (empty($check)) {
            return '';
        }

        $ch = curl_init($url);
        # Setup request to send json via POST.
        $payload = json_encode($data);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        # Return response instead of printing.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function _check_curl($data = array())
    {
        if ($data['status'] == 'success') {
            return $data['msg'];
        }
    }

    public function curl_login($username = '', $password = '')
    {
        $url = 'http://s.soloabadi.com/system-absen/include/curl.php';
        $data = array(
            'object' => 'sobad_user',
            'func' => 'check_login',
            'data' => array($username, md5($password))
        );
        $data = $this->auth_curl($url, $data);
        $login = json_decode($data, true);
        return $login;
    }

    public function data_employe()
    {
        $url = 'http://s.soloabadi.com/system-absen/include/curl.php';
        $data = array(
            'object' => 'sobad_user',
            'func' => 'get_all',
            'msg' => array()
        );
        $data = $this->auth_curl($url, $data);
        $login = json_decode($data, true);
        $login = $this->_check_curl($login);
        return $login;
    }

    public function cek_data($id)
    {
        $data_all_employe = $this->data_employe();

        foreach ($data_all_employe as $val) {
            if ($val['ID'] == $id) {
                $data = $val;
            } else {
            }
        }
        return $data;
    }

    public function get_id($id = 0)
    {

        $url = 'http://s.soloabadi.com/system-absen/include/curl.php';
        $data = array(
            'object' => 'sobad_user',
            'func' => 'get_id',
            'msg' => array($id)
        );
        $data = $this->auth_curl($url, $data);
        $login = json_decode($data, true);
        $login = $this->_check_curl($login);

        return $login;
    }
}
