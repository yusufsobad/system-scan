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

    public function index_get()
    {
        $id = $this->get('ID');

        $data = $this->Api_blueprint->get_scan_user($id);

        if ($id !== null) {
            $this->response([
                'status' => 'Success',
                'message' => $data
            ], 200);
        } else {
            $this->response([
                'status' => 'Failed',
                'message' => 'ID Kosong'
            ], 404);
        }
    }
}
