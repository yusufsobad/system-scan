<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search_qrcode extends CI_Controller
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
                'ID'       =>  '',
                'note'    =>  '',
            ),
        );
        return $data;
    }

    public function index()
    {
        $keyword = $this->input->post('search');

        $data_session = data_session();
        $config_search = $this->config_search();
        $config_card = $this->config_card();
        $config_table = $this->config_table();
        $table = data_table($config_table);
        $search = search($config_search,$keyword);
        $pagination =  $this->pagination->create_links();
        $content = array(
            $search,
            $table,
            $pagination
        );
        $data['title'] = 'Search QRcode';
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
                'action'    => 'Search_qrcode',
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
        $perpage  = 5;
        $keyword = $this->input->post('search');
        
        // $data_keyword = array(
        //     'note'   => $keyword
        // );
        // $data_search = $this->M_blueprint->keyword($data_keyword, $perpage, $start, 'serial-number')->result_array();

        $data_table = $this->M_blueprint->get_qrcode_join($perpage, $start, $keyword);
        $config_pagination = $this->config_pagination();
        $config = pagination($config_pagination);
        $this->pagination->initialize($config);

        $data['t_head'] = array(
            array(
                'NO',
                'QRcode',
                'ID Packing',
                'Lokasi',
            )
        );

        if (isset($data_table)) {
            foreach ($data_table as $index => $key) {
                $data['t_body'][$index] = array(
                    ++$start,
                    $key['sn'],
                    $key['no_pack'],
                    $key['note']
                );
            }
        }
        return $data;
    }

    public function config_pagination()
    {
        $keyword = $this->input->post('search');

        $total_row = $this->M_blueprint->count_data('serial-number',$keyword);
        $data = array(
            array(
                'base_url'   => base_url('Search_qrcode/index'),
                'total_rows' => $total_row,
                'per_page'  => 5,
            ),
        );
        return $data;
    }
}
