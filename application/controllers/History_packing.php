<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History_packing extends CI_Controller
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
        $view_scan = history_packing();
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
        $where = array(
            'no_pack'   => $qrcode
        );
        $data_qr = $this->M_blueprint->get_where($where, 'packing');
        $qr = explode(".", $qrcode);
        $qr = $qr[0];
        if ($qr == 'PACK') {

            $where_sn = array(
                'reff'  => $data_qr[0]['ID']
            );
            $data_sn = $this->M_blueprint->get_where($where_sn, 'serial-number');
            $note = $this->M_blueprint->get_where(array(
                'ID'    => $data_qr[0]['reff_note']
            ), 'note_deliv');

            $data = array(
                'allert' => '#allert-success',
                'id'    => $data_qr[0]['ID'],
                'url'   => base_url('History_packing/check_data'),
                'status' => 'true',
                'id_pack' => $qrcode,
                'note' => isset($note[0]) ? $note[0]['note'] : '',
                'data'  => $data_sn
            );
            echo json_encode($data);

        } else {
            $data = array(
                'allert' => '#allert-qrpack',
                'id'    => '0',
                'url'   => base_url('History_packing/check_data'),
                'status' => 'false',
                'data'  => ''
            );
            echo json_encode($data);
        }
    }
}
