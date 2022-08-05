<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pland_delivery extends CI_Controller
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
        $view_scan = delivery_pland_view();
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
        $note_id = $this->input->post('lastid');
        $qr = explode(".", $qrcode);
        $qr = $qr[0];
        if ($qr == 'PACK') {
            $where = array(
                'no_pack'    => $qrcode
            );
            $data = $this->M_blueprint->check_db($where, 'packing');
            if ($data) {
                $data = array(
                    'reff_note'      => $note_id
                );
                $where = array(
                    'no_pack' => $qrcode
                );
                $this->M_blueprint->update_data($where, $data, 'packing');

                $data_table = $this->M_blueprint->get_where($data, 'packing');
                $data = array(
                    'allert' => '#allert-success',
                    'id'    =>  '',
                    'url'   => base_url('Pland_delivery/check_data'),
                    'status' => 'true',
                    'data'  => $data_table
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'allert' => '#allert-packing',
                    'id'    => '0',
                    'url'   => base_url('Pland_delivery/check_data'),
                    'status' => 'false',
                    'data'  => ''
                );
                echo json_encode($data);
            }
        } else {
            $data = array(
                'allert' => '#allert-qrpack',
                'id'    => '0',
                'url'   => base_url('Pland_delivery/check_data'),
                'status' => 'false',
                'data'  => ''
            );
            echo json_encode($data);
        }
    }

    public function delete_data()
    {
        $id = $this->input->post('id');
        $data = array(
            'reff_note'      => ''
        );
        $where = array(
            'ID' => $id
        );
        $this->M_blueprint->update_data($where, $data, 'packing');

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

    public function save_note()
    {
        $note = $this->input->post('note');
        $data = array(
            'note'  => $note
        );

        $data = $this->M_blueprint->insert_lastId($data, 'note_deliv');
        echo json_encode($data);
    }
}
