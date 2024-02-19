<?php
defined('BASEPATH') or exit('No direct script allowed');

use chriskacerguis\RestServer\RestController;

class Qrcode_info_curl extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_blueprint');
    }

    public function index_post()
    {
        $data = $this->post('data');

        $data_args = $this->M_blueprint->search_qrcode_sn($data);
        if ($data !== null) {
            $this->response([
                'status' => 'Success',
                'message' => $data_args
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => 'Failed',
                'message' => 'Data Not Found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}