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
                'ID'                =>  '',
                'id_paket'          =>  '',
                'delivery_code'     =>  '',
                'qty'               =>  '',
                'no_telp'           =>  '',
                'penerima'          =>  '',
                'note'              =>  '',
            ),
        );
        return $data;
    }

    public function index()
    {
        $this->load->view('page/custom/scan-package.php');
    }

    public function form_ajax()
    {
        $default_data['data_scan'] = $this->default_data();
        $default_data['delivery_code'] = $this->input->post('value');
        $default_data['post_action'] = 'Scan/insert_data';

        $data['delivery_code'] = $this->input->post('value');

        $where = array(
            'delivery_code' => $data['delivery_code']
        );
        $data['data_scan'] = $this->M_blueprint->get_data($where, 'scan-user');
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
        $delivery_code = $this->input->post('value');
        $this->M_blueprint->check_db($delivery_code);
    }


    public function insert_data()
    {
        $delivery_code = $this->input->post('delivery_code');
        $qty = $this->input->post('qty');
        $penerima = $this->input->post('penerima');
        $no_telp = $this->input->post('no_telp');
        $note = $this->input->post('note');


        $data = array(
            'delivery_code'    => $delivery_code,
            'qty'    => $qty,
            'penerima'  => $penerima,
            'no_telp'   => $no_telp,
            'note'      => $note
        );


        $this->M_blueprint->insert_data($data, 'scan-user');
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
        $delivery_code = $this->input->post('delivery_code');
        $qty = $this->input->post('qty');
        $penerima = $this->input->post('penerima');
        $no_telp = $this->input->post('no_telp');
        $note = $this->input->post('note');


        $data = array(
            'delivery_code'   => $delivery_code,
            'qty'             => $qty,
            'penerima'        => $penerima,
            'no_telp'         => $no_telp,
            'note'            => $note
        );

        $where = array(
            'delivery_code' => $delivery_code
        );

        $this->M_blueprint->update_data($where, $data, 'scan-user');
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
