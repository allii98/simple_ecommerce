<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Histori extends REST_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pertandingan_m');
    }


    public function index_get()
    {

        $histori = $this->Pertandingan_m->getHistori();

        if ($histori) {
            $this->response([
                'status' => true,
                'data' => $histori
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        } elseif (empty($histori)) {
            $this->response([
                'status' => true,
                'data' => $histori
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data not found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}

/* End of file Karyawan.php */