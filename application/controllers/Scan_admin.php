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
                'title'    => 'Scan Admin',
                'action'    => 'Admin',
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
}
