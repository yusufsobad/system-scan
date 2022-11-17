<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan_pengiriman_group extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Helper
        $acces_page = $this->acces_this_page();
        acces_page($acces_page);
        is_logged_in();
        $this->load->model('M_blueprint');
        $this->load->library('form_validation');
    }

    public function acces_this_page()
    {
        $data = array(
            'key_id'   => array(
                '15',
                '10',
            ),
        );
        return $data;
    }

    public function default_data()
    {
        $data = array(
            array(
                'ID'           =>  '',
                'no_pack'      =>  '',
                'status'       =>  '',
                'reff'         =>  '',
            ),
        );
        return $data;
    }

    public function index()
    {
        $data_session = data_session();

        $config_card = $this->config_card();
        $view_scan = Scan_do_group();
        $content = array($view_scan);
        $data['title'] = 'Data Scaner';
        // Get Sidebar
        $data['sidebar'] = config_sidebar();

        // All Config
        $data['card'] = card_2($config_card, $content);

        $this->load->view('theme/veltrix/header');
        $this->load->view('theme/veltrix/topbar');
        $this->load->view('theme/veltrix/sidebar', $data);
        $this->load->view('theme/veltrix/content');
        $this->load->view('theme/veltrix/footer');
    }

    public function config_card()
    {
        $data = array(
            array(
                'title'    => 'Scan Admin',

            )
        );
        return $data;
    }

    public function check_data()
    {
        $qrcode = $this->input->post('value');
        $where = array(
            'delivery_code' => $qrcode
        );
        $data_scan = $this->M_blueprint->get_where($where, 'scan-user');
        $qr = explode("/", $qrcode);
        $qr_order = explode("ORDER#", $qrcode);
        $qr_order = $qr_order[0];
        $qr = $qr[1];
        if ($qr == 'DO' || $qr_order == '') {
            $where = array(
                'delivery_code'    => $qrcode
            );
            $data = $this->M_blueprint->check_db($where, 'scan-user');

            if ($data) {
                $data_where = array(
                    'reff' => $data_scan[0]['ID']
                );
                $data_packing = $this->M_blueprint->get_where($data_where, 'packing');
                $data = array(
                    'allert' => '',
                    'id'    =>  $data_scan[0]['ID'],
                    'url'   => base_url('Scan_pengiriman_group/check_data_pack'),
                    'status' => 'true',
                    'data'  => $data_packing
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'delivery_code'   => $qrcode,
                    'status'    => 0, // status 1 jika sudah terlock dengan do
                );
                $last_id = $this->M_blueprint->insert_lastId($data, 'scan-user');
                $data = array(
                    'allert' => '#allert-success',
                    'id'    =>  $last_id,
                    'url'   => base_url('Scan_pengiriman_group/check_data_pack'),
                    'status' => 'true',
                    'data'  => ''
                );
                echo json_encode($data);
            }
        } else {
            $data = array(
                'allert' => '#allert-do',
                'id'    => '0',
                'url'   => base_url('Scan_pengiriman_group/check_data'),
                'status' => 'false',
                'data'  => ''
            );
            echo json_encode($data);
        }
    }

    public function check_data_pack()
    {
        $id_note = $this->input->post('idnote');
        $last_id = $this->input->post('lastid');

        $where_get = array(
            'reff' => $last_id
        );

        $get_packing = $this->M_blueprint->get_where($where_get, 'packing');

        foreach ($get_packing as $val) {
            $where_note = array(
                'ID' => $val['reff_note']
            );

            $reset_note = array(
                'status' => 0
            );

            $this->M_blueprint->update_data($where_note, $reset_note, 'note_deliv');
        }


        $where_reset = array(
            'reff' => $last_id
        );

        $data_reset = array(
            'reff' => 0,
            'status' => 0
        );

        $this->M_blueprint->update_data($where_reset, $data_reset, 'packing');

        $where = array(
            'reff_note' => $id_note
        );
        $data_update = array(
            'reff' => $last_id,
            'status' => 1
        );

        $this->M_blueprint->update_data($where, $data_update, 'packing');

        $where_do = array(
            'ID' => $last_id
        );
        $update_do = array(
            'status' => 1
        );
        $this->M_blueprint->update_data($where_do, $update_do, 'scan-user');

        $where_note = array(
            'ID' => $id_note
        );

        $data_note = array(
            'status' => 1
        );
        $this->M_blueprint->update_data($where_note, $data_note, 'note_deliv');

        $data = array(
            'allert' => '#allert-save',
            'id'    => '0',
            'url'   => base_url('Scan_pengiriman_group/check_data'),
            'status' => 'false',
            'data'  => ''
        );
        echo json_encode($data);
        exit();
    }

    public function delete_sn()
    {
        $id = $this->input->post('id');
        $where = array(
            'ID' =>  $id
        );
        $data = array(
            'reff' => ''
        );
        $this->M_blueprint->update_data($where, $data, 'packing');

        $data = array(
            'allert' => '#allert-delete',
        );
        echo json_encode($data);
    }
}
