<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Trending extends REST_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pertandingan_m');
    }


    public function index_get()
    {
        $tgl = $this->get('tgl');
        if ($tgl == null) {

            $pertandingan = $this->Pertandingan_m->getDataToday();
        } else {
            $pertandingan = $this->Pertandingan_m->getData($tgl);
        }

        if ($pertandingan) {
            $this->response([
                'status' => true,
                'data' => $pertandingan
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        } elseif (empty($pertandingan)) {
            $this->response([
                'status' => true,
                'data' => $pertandingan
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