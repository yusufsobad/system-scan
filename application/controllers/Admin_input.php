<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_input extends CI_Controller
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
                'ID'        =>  '',
                'qrcode'    =>  '',
                'jumlah'    =>  '',
                'receiver'  =>  '',
                'no_telp'   =>  '',
                'note'      =>  '',
            ),
        );
        return $data;
    }

    public function index()
    {
        $data_session = data_session();
        $config_search = $this->config_search();
        $config_card = $this->config_card();
        $config_table = $this->config_table();
        $table = data_table($config_table);
        $search = search($config_search);
        $pagination =  $this->pagination->create_links();
        $content = array(
            $search,
            $table,
            $pagination
        );
        $data['title'] = 'Data Scaner';
        // Get Sidebar
        $data['sidebar'] = config_sidebar();

        // All Config
        $data['card'] = card($config_card, $content);

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
                'title'    => 'Data Scaner',
                'action'    => 'Admin',
                // Optional Button
                'button' => array(
                    'button_link'      => 'Admin_input/form',
                    'button_title'    => 'Tambah Data',
                    'button_color'     => 'primary'
                ),
            )
        );
        return $data;
    }

    public function config_search()
    {
        $data = array(
            array(
                'id'    => 'search',
                'name'  => 'search'
            ),
        );
        return $data;
    }

    public function config_table()
    {
        $data_session = data_session();
        $this->load->library('pagination');
        $start = $this->uri->segment(3);
        $perpage  = 10;
        $keyword = $this->input->post('search');
        $data_search = $this->M_blueprint->get_keyword($keyword, $perpage, $start)->result_array();
        $data_args = $this->M_blueprint->get_sbd_item($perpage, $start)->result_array();
        $config_pagination = $this->config_pagination();
        $config = pagination($config_pagination);
        $this->pagination->initialize($config);


        $no = 0;
        $data['t_head'] = array(
            array(
                'NO',
                'ID Paket',
                'Qrcode',
                'Quantity',
                'Penerima',
                'No Telp',
                'Note',
                'Action'
            )
        );
        if ($data_search == '') {
            $data_table = $data_args;
        } elseif ($data_search !== '') {
            $data_table = $data_search;
        }
        if (isset($data)) {
            foreach ($data_table as $index => $key) {
                // Config button Edit
                $config_button_edit = array(
                    array(
                        'button' => array(
                            'button_link'      => 'Admin/form/' . $key['ID'],
                            'button_title'    => 'Edit',
                            'button_color'     => 'warning'
                        ),
                    )
                );
                $button_edit = button_edit($config_button_edit);
                $data['t_body'][$index] = array(
                    ++$start,
                    $key['id_paket'],
                    $key['qrcode'],
                    $key['jumlah'],
                    $key['receiver'],
                    $key['no_telp'],
                    $key['note'],
                    $button_edit
                );
            }
        }

        return $data;
    }

    public function config_pagination()
    {
        $total_row = $this->M_blueprint->count_data();
        $data = array(
            array(
                'base_url'   => base_url('Admin/index'),
                'total_rows' => $total_row,
                'per_page'  => 10,
            ),
        );
        return $data;
    }

    public function form($id = '')
    {
        $config_form = $this->config_form($id);
        $config_card = $this->card_form($id);

        // Function View Helper
        $form = form($config_form);

        $data['title'] = "Form Scann";
        $data['card'] = card($config_card, $form);
        $data['sidebar'] = config_sidebar();

        // Base View
        $this->load->view('theme/veltrix/header');
        $this->load->view('theme/veltrix/sidebar', $data);
        $this->load->view('theme/veltrix/topbar');
        $this->load->view('theme/veltrix/content', $data);
        $this->load->view('theme/veltrix/footer');
    }

    public function card_form($id)
    {
        $data = array(
            array(
                'title'    => 'Form Admin',
                'action'    =>  $id == '' ? 'Admin_input/add_data' : 'Admin_input/update_data',
                'button_save' => array(
                    'button_title'    => 'Save',
                    'button_color'     => 'success',
                    'button_action'      => '#',
                ),
                'button_cancel' => array(
                    'button_title'    => 'Cancel',
                    'button_color'     => 'danger',
                    'button_action'      => 'Admin_input',
                ),
            )
        );
        return $data;
    }

    public function config_form($id)
    {
        $default_data = $this->default_data();
        $where = array(
            'ID' =>  @$id
        );

        $data =  $this->M_blueprint->get_data($where, 'sbd-item');

        if (is_array($data) && isset($data) && empty($data)) {
            $query = $default_data;
        } else {
            $query = $data;
        }
        foreach ($query as  $key) {
            $data = array(
                array(
                    'column'    => 'col-lg-12',
                    'form' => array(
                        array(
                            'form_title'   => '', // Judul Form
                            'place_holder'  => '', // Isi PlaceHolder
                            'note'          => '', // Note form
                            'type'          => 'hidden',
                            'id'            => 'id_data',
                            'name'          => 'id_data',
                            'value'         =>  @$key['ID'],
                            'validation'    =>  'false',
                            'input-type'     => 'form',
                            'readonly'      => ''
                        ),
                        array(
                            'form_title'   => 'ID Packet', // Judul Form
                            'place_holder'  => 'Silahkan isi ID Packet', // Isi PlaceHolder
                            'note'          => '', // Note form
                            'type'          => 'text',
                            'id'            => 'id_packet',
                            'name'          => 'id_packet',
                            'validation'    =>  'false',
                            'value'         =>  @$key['id_paket'],
                            'input-type'     => 'form',
                            'readonly'      => ''
                        ),
                    ),
                ),
            );
        }
        return $data;
    }

    public function update_data()
    {
        $id = $this->input->post('id_data');
        $id_packet = $this->input->post('id_packet');


        $data = array(
            'id_paket' => $id_packet
        );

        $where = array(
            'ID' => $id
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
        redirect('Admin/index');
    }
}
