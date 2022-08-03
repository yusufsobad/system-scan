<?php
defined('BASEPATH') or exit('No direct script allowed');

use chriskacerguis\RestServer\RestController;

class Send_curl extends RestController
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Api_blueprint');
    }

    public function index_post()
    {
        $data = $this->post();
        $data['scan_user'] = array(
            'id_temporary'  => $data['ID'],
            'delivery_code' => $data['DO_number'],
            'id_paket'      => $data['id_package']
        );

        var_dump($data);

        if ($this->Api_blueprint->insert_data($data['scan_user'], $data['detail']) > 0) {
            $this->response([
                'status' => 'Success',
                'message' => 'Sending data Success'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => 'Failed',
                'message' => 'Gagal Mengirim Data'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
