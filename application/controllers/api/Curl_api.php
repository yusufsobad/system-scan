<?php
defined('BASEPATH') or exit('No direct script allowed');

use chriskacerguis\RestServer\RestController;

class Curl_api extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Api_blueprint');
    }

    public function index_post()
    {
        $id = $this->get('ID');

        $data = $this->Api_blueprint->get_scan_user($id);

        if ($id !== null) {
            $this->response([
                'status' => 'Success',
                'message' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => 'Failed',
                'message' => 'ID Kosong'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}
