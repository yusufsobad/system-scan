<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_blueprint');
        $this->load->library('form_validation');
    }

    public function default_data()
    {
        $data = array(
            array(
                'ID'        =>  '',
                'qrcode'    =>  '',
                'jumlah'    =>  '',
                'receiver'    =>  '',
            ),
        );
        return $data;
    }

    public function index()
    {
        $this->load->view('page/custom/instan-scan-js.php');
    }

    public function form_ajax()
    {
        $default_data['data_scan'] = $this->default_data();
        $default_data['qrcode'] = $this->input->post('value');
        $default_data['post_action'] = 'Scan/insert_data';

        $data['qrcode'] = $this->input->post('value');

        $where = array(
            'qrcode' => $data['qrcode']
        );
        $data['data_scan'] = $this->M_blueprint->get_data($where, 'sbd-item');
        $data['post_action'] = 'Scan/update_data';

        if (!empty($data['data_scan'])) {
            $this->load->view('page/custom/form-ajax.php', $data);
            // echo "data ada";
        } else {
            $this->load->view('page/custom/form-ajax.php', $default_data);
            // echo "data tidak ada";
        }
    }


    public function check_data()
    {
        $qrcode = $this->input->post('value');
        $this->M_blueprint->check_db($qrcode);
    }


    public function insert_data()
    {
        $qrcode = $this->input->post('qrcode');
        $qty = $this->input->post('qty');
        $penerima = $this->input->post('penerima');

        $data = array(
            'qrcode'    => $qrcode,
            'jumlah'    => $qty,
            'receiver'  => $penerima
        );


        $this->M_blueprint->insert_data($data);
        $config_alert_success = array(
            array(
                'title'     => 'Data Berhasil Di Validasi',
                'alert_type' => 'alert-success'
            ),
        );
        $allert_success = allert($config_alert_success);
        $this->session->set_flashdata('msg', $allert_success);
        redirect('Scan/index');
    }

    public function update_data()
    {
        $qrcode = $this->input->post('qrcode');
        $qty = $this->input->post('qty');
        $penerima = $this->input->post('penerima');


        $data = array(
            'jumlah'    => $qty,
            'receiver'  => $penerima
        );

        $where = array(
            'qrcode' => $qrcode
        );

        $this->M_blueprint->update_data($where, $data, 'sbd-item');
        $config_alert_success = array(
            array(
                'title'     => 'Data Berhasil Di Edit',
                'alert_type' => 'alert-success'
            ),
        );
        $allert_success = allert($config_alert_success);
        $this->session->set_flashdata('msg', $allert_success);
        redirect('Scan/index');
    }
}
