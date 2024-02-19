<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search_location extends CI_Controller
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
        $view_scan = search_location();
        $content = array($view_scan);
        $data['title'] = 'History Scaner';
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

        $qrcode = explode("\r\n", $qrcode);
        $qrcode = $qrcode[0];

        $qr = explode("-", $qrcode);

        if ($qr[0] == 'PACK') {
            $data_sn = $this->M_blueprint->search_qrcode_packing($qrcode);

            $data = array(
                'allert' => '#allert-success',
                'url'   => base_url('Search_location/check_data'),
                'status' => 'true',
                'data'  => $data_sn
            );
            echo json_encode($data);
        } else {
            $data_sn = $this->M_blueprint->search_qrcode_sn($qrcode);

            $data = array(
                'allert' => '#allert-success',
                'url'   => base_url('Search_location/check_data'),
                'status' => 'true',
                'data'  => $data_sn
            );
            echo json_encode($data);
        }
    }
}
