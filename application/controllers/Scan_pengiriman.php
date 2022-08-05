<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan_pengiriman extends CI_Controller
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
        $view_scan = Scan_do();
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
        $qr = explode("/", $qrcode);
        $qr_order = explode("ORDER#", $qrcode);
        $qr_order = $qr_order[0];
        $qr = $qr[1];
        if ($qr == 'DO' || isset($qr_order)) {
            $where = array(
                'delivery_code'    => $qrcode
            );
            $data = $this->M_blueprint->check_db($where, 'scan-user');
            if ($data) {
                $data = array(
                    'allert' => '#allert-warning',
                    'id'    => '0',
                    'url'   => base_url('Scan_pengiriman/check_data'),
                    'status' => 'false',
                    'data'  => ''
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
                    'url'   => base_url('Scan_pengiriman/check_data_pack'),
                    'status' => 'true',
                    'data'  => ''
                );
                echo json_encode($data);
            }
        } else {
            $data = array(
                'allert' => '#allert-do',
                'id'    => '0',
                'url'   => base_url('Scan_pengiriman/check_data'),
                'status' => 'false',
                'data'  => ''
            );
            echo json_encode($data);
        }
    }

    public function check_data_pack()
    {
        $qrcode = $this->input->post('value');
        $last_id = $this->input->post('lastid');
        $qr = explode(".", $qrcode);
        if ($qr[0] == 'PACK') {
            $where = array(
                'no_pack'    => $qrcode
            );
            $data = $this->M_blueprint->check_db($where, 'packing');
            $where_tbl = array(
                'no_pack'  => $qrcode
            );
            $data_table = $this->M_blueprint->get_data($where_tbl, 'packing');

            if ($data) {
                $check_pack = $this->M_blueprint->check_packing($where, 'packing');
                if ($check_pack) {
                    $data = array(
                        'allert' => '#allert-lock',
                        'id'    =>  '',
                        'url'   => base_url('Scan_pengiriman/check_data_pack'),
                        'status' => 'true',
                        'data'  => ''
                    );
                    echo json_encode($data);
                } else {
                    $data_update = array(
                        'status'    => 1,
                        'reff'      => $last_id,
                    );
                    $this->M_blueprint->update_data($where_tbl, $data_update, 'packing');

                    $data_update_do = array(
                        'status'    => 1,
                    );
                    $where_do = array(
                        'ID'    => $last_id
                    );
                    $this->M_blueprint->update_data($where_do, $data_update_do, 'scan-user');
                    $data = array(
                        'allert' => '#allert-success',
                        'id'    => '0',
                        'url'   => base_url('Scan_pengiriman/check_data_pack'),
                        'status' => 'true',
                        'data'  => $data_table,
                    );
                    echo json_encode($data);
                }
            } else {
                $data = array(
                    'allert' => '#allert-packing',
                    'id'    =>  $last_id,
                    'url'   => base_url('Scan_pengiriman/check_data_pack'),
                    'status' => '',
                    'data'  => ''
                );
                echo json_encode($data);
            }
        } else {
            $data = array(
                'allert' => '#allert-qrpack',
                'id'    =>  $last_id,
                'url'   => base_url('Scan_pengiriman/check_data_pack'),
                'status' => 'true',
                'data'  => ''
            );
            echo json_encode($data);
        }
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
