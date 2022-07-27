<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan_admin extends CI_Controller
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
                'ID'             =>  '',
                'qrcode'         =>  '',
            ),
        );
        return $data;
    }

    public function check_data()
    {
        $qrcode = $this->input->post('value');

        $where = array(
            'qrcode'    => $qrcode
        );
        $this->M_blueprint->check_db($where, 'scan-admin');
    }

    public function form_ajax()
    {
        $default_data['data_scan'] = $this->default_data();
        $default_data['qrcode'] = $this->input->post('value');
        $default_data['post_action'] = 'Scan_admin/insert_data';

        $data['qrcode'] = $this->input->post('value');

        $where = array(
            'qrcode' => $data['qrcode']
        );
        $data['data_scan'] = $this->M_blueprint->get_data($where, 'scan-admin');
        $data['post_action'] = 'Scan_admin/update_data';


        if (!empty($data['data_scan'])) {
            $this->load->view('page/custom/form-scan-admin.php', $data);
            // echo "data ada";
        } else {
            $this->load->view('page/custom/form-scan-admin.php', $default_data);
            // echo "data tidak ada";
        }
    }

    public function index()
    {
        $data_session = data_session();

        $config_card = $this->config_card();
        $view_scan = scan();
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
                // 'action'    => '',
                // Optional Button
                // 'button' => array(
                //     'button_link'      => 'Activity/form',
                //     'button_title'    => 'Tambah Data',
                //     'button_color'     => 'primary'
                // ),
            )
        );
        return $data;
    }

    public function insert_data()
    {
        $qrcode = $this->input->post('qrcode');


        $data = array(
            'qrcode'    => $qrcode,
        );


        $this->M_blueprint->insert_data($data, 'scan-admin');
        $config_alert_success = array(
            array(
                'title'     => 'Data Berhasil Di Validasi',
                'alert_type' => 'alert-success'
            ),
        );
        $allert_success = allert($config_alert_success);
        $this->session->set_flashdata('msg', $allert_success);
        redirect('Admin_ppic/index');
    }

    public function update_data()
    {
        $qrcode = $this->input->post('qrcode');



        $data = array(
            'qrcode'    => $qrcode,
        );

        $where = array(
            'qrcode' => $qrcode
        );

        $this->M_blueprint->update_data($where, $data, 'scan-admin');
        $config_alert_success = array(
            array(
                'title'     => 'Data Berhasil Di Edit',
                'alert_type' => 'alert-success'
            ),
        );
        $allert_success = allert($config_alert_success);
        $this->session->set_flashdata('msg', $allert_success);
        redirect('Admin_ppic/index');
    }
}
