<?php
defined('BASEPATH') or exit('No direct script allowed');

use chriskacerguis\RestServer\RestController;

class Packing_curl extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Api_blueprint');
    }

    public function index_post()
    {
        $where = 'reff';
        $data = $this->post('data');
        $table = 'packing';

        $data_args = $this->Api_blueprint->get_data($where, $data, $table);
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
