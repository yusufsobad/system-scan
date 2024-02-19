<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan_packing extends CI_Controller
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
        $view_scan = scan_packing();
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
            'no_pack'   => $qrcode
        );
        $data_qr = $this->M_blueprint->get_where($where, 'packing');
        $qr = explode(".", $qrcode);
        $qr = $qr[0];
        if ($qr == 'PACK') {
            $where = array(
                'no_pack'    => $qrcode
            );
            $data = $this->M_blueprint->check_db($where, 'packing');
            if ($data) {
                $where_sn = array(
                    'reff'  => $data_qr[0]['ID']
                );
                $data_sn = $this->M_blueprint->get_where($where_sn, 'serial-number');

                $data = array(
                    'allert' => '#allert-warning',
                    'id'    => $data_qr[0]['ID'],
                    'url'   => base_url('Scan_packing/check_data_sn'),
                    'status' => 'true',
                    'data'  => $data_sn
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'no_pack'   => $qrcode,
                    'status'    => 0, // status 1 jika sudah terlock dengan do
                    'reff'      => ''
                );
                $last_id = $this->M_blueprint->insert_lastId($data, 'packing');
                $data = array(
                    'allert' => '#allert-success',
                    'id'    =>  $last_id,
                    'url'   => base_url('Scan_packing/check_data_sn'),
                    'status' => 'true',
                    'data'  => ''
                );
                echo json_encode($data);
            }
        } else {
            $data = array(
                'allert' => '#allert-qrpack',
                'id'    => '0',
                'url'   => base_url('Scan_packing/check_data'),
                'status' => 'false',
                'data'  => ''
            );
            echo json_encode($data);
        }
    }

    public function check_data_sn()
    {
        $qrcode = $this->input->post('value');
        $last_id = $this->input->post('lastid');

        $qrcode = explode("\r\n", $qrcode);
        $qrcode = $qrcode[0];

        $qr = explode("-", $qrcode);
        if ($qr[0] == 'PACK') {
            $data = array(
                'allert' => '#allert-warning',
                'id'    =>  $last_id,
                'url'   => base_url('Scan_packing/check_data_sn'),
                'status' => 'true',
                'data'  => ''
            );
            echo json_encode($data);
        } else {
            $cnt = count($qr);
            $code = $qr[0];
            $no_sn = $qr[1];

            if($cnt > 2 ){
                $no_sn = $qr[$cnt - 1];

                unset($qr[$cnt - 1]);
                $code = implode('-', $qr);
            }

            $lib_qrcode = $this->M_blueprint->get_qrcode('code-setting', $code);
            if ($lib_qrcode) {
                $where = array(
                    'sn'    => $qrcode
                );

                $data = $this->M_blueprint->check_db($where, 'serial-number');
                $where_tbl = array(
                    'reff'  => $last_id
                );
                $data_table = $this->M_blueprint->get_data($where_tbl, 'serial-number');
                if ($data) {
                    // Check sn ada atau tidak
                    $check = $this->M_blueprint->check_sn_reff($qrcode);
    
                    if($check){
                        // Update data
                        $where = array(
                            'sn'    => $qrcode,
                        );

                        $dt = array(
                            'reff'  => $last_id
                        );

                        $this->M_blueprint->update_data($where,$dt, 'serial-number');

                        $data = array(
                            'allert' => '#allert-success',
                            'id'    =>  $last_id,
                            'url'   => base_url('Scan_packing/check_data_sn'),
                            'status' => 'true',
                            'data'  => $data_table
                        );
                    }else{
                        $data = array(
                            'allert' => '#allert-warning',
                            'id'    => $last_id,
                            'url'   => base_url('Scan_packing/check_data_sn'),
                            'status' => 'true',
                            'data'  => $data_table
                        );
                    }

                    echo json_encode($data);
                } else {
                    $data = array(
                        'sn'    => $qrcode,
                        'reff'  => $last_id,
                        'no_sn' => $no_sn,
                        'sku'   => $code
                    );
                    $this->M_blueprint->insert_data($data, 'serial-number');
                    $where_tbl = array(
                        'reff'  => $last_id
                    );
                    $data_table = $this->M_blueprint->get_data($where_tbl, 'serial-number');
                    $data = array(
                        'allert' => '#allert-success',
                        'id'    =>  $last_id,
                        'url'   => base_url('Scan_packing/check_data_sn'),
                        'status' => 'true',
                        'data'  => $data_table
                    );
                    echo json_encode($data);
                }
            } else {
                $data = array(
                    'allert' => '#allert-qrsn',
                    'id'    => $last_id,
                    'url'   => base_url('Scan_packing/check_data_sn'),
                    'status' => 'true',
                    'data'  => ''
                );

                echo json_encode($data);
            }
        }
    }

    public function delete_sn()
    {
        $id = $this->input->post('id');
        $where = array(
            'ID' =>  $id
        );
        $this->M_blueprint->delete_data($where, 'serial-number');

        $data = array(
            'allert' => '#allert-delete',
        );
        echo json_encode($data);
    }

    public function save_all_pack()
    {
        $data = $this->input->post('form');
        $id = $this->input->post('lastId');
        $where = array(
            'ID'   => $id
        );
        $update = array(
            'note'  => $data
        );

        $this->M_blueprint->update_data($where, $update, 'packing');

        echo $data;
    }
}
