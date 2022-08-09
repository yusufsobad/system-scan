<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //check_not_login();
        $this->load->model('m_auth', 'm_auth');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('theme/veltrix/login');
        } else {
            $this->login();
        }
    }

    private function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek_data = $this->m_auth->curl_login($username, $password);

        if (isset($cek_data['msg'][0]['ID'])) {
            $data_user = $this->m_auth->cek_data($cek_data['msg'][0]['ID']);
        } else {
            $data_user = null;
        }

        if (isset($data_user) && $data_user['ID'] == '15' || $data_user['ID'] == '10') {
            $data = [
                'data_session' => $data_user,
            ];
            $this->session->set_userdata($data);
            if ($data_user['ID'] == '10') {
                redirect('Data_packing');
            } elseif ($data_user['ID'] == '15') {
                redirect('Admin');
            }
        } else if (isset($data_user)) {
            $this->session->set_flashdata('message', '<div class="d-flex flex-row-reverse"><div class="alert alert-danger animated fadeInDown mr-5 position-absolute">
                Anda tidak memiliki akses!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                </div>');
            redirect('login');
        } else {
            $this->session->set_flashdata('message', '<div class="d-flex flex-row-reverse"><div class="alert alert-danger animated fadeInDown mr-5 position-absolute">
                    Username & Password salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    </div>');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('data_session');
        $this->session->set_flashdata('message', '<div class="d-flex flex-row-reverse"><div class="alert alert-danger animated fadeInDown  position-absolute mr-5">
            Kamu Telah Logout!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            </div>');
        redirect('login');
    }
}
