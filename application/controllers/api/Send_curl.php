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
        $data['update'] = array(
            'id_paket'      => $data['id_package']
        );

        $check =  $this->Api_blueprint->check_db($data['ID']);

        if ($check == 'false') {
            if ($this->Api_blueprint->insert_data($data['scan_user'], $data['detail']) > 0) {
                $this->response([
                    'status' => 'Success',
                    'message' => 'Berhasil Mengirim Data' //'Sending data Success'
                ], RestController::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => 'Failed',
                    'message' => 'Gagal Mengirim Data'
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else if ($check == 'true') {
            // if ($this->Api_blueprint->update_data($data['update'], $data['ID']) > 0) {
            //     $this->response([
            //         'status' => 'Success',
            //         'message' => 'Berhasil Update Data' //'Sending data Success'
            //     ], RestController::HTTP_OK);
            // } else {
            //     $this->response([
            //         'status' => 'Failed',
            //         'message' => 'Gagal Update Data'
            //     ], RestController::HTTP_BAD_REQUEST);
            // }

            if ($this->Api_blueprint->update_data($data['update'], $data['ID']) > 0) {
                $this->response([
                    'status' => 'Success',
                    'message' => 'Berhasil Update Data' //'Sending data Success'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => 'Success',
                    'message' => 'Berhasil Update Data' //'Sending data Success'
                ], RestController::HTTP_OK);
            }
        }
    }
}
