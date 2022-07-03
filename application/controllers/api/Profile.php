<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Profile extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_m');
    }


    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'user_nama' => $this->put('nama'),
            'username' => $this->put('username'),
            'user_foto' => $this->put('foto'),
            'email' => $this->put('email')
        ];
        $done = [
            'user_id' => $this->put('id'),
            'user_nama' => $this->put('nama'),
            'username' => $this->put('username'),
            'user_foto' => $this->put('foto'),
            'email' => $this->put('email')
        ];

        if ($this->Profile_m->updateApi($data, $id)) {
            $this->response([
                'status' => true,
                'message' => 'update karyawan has bee updated.',
                'data' => $done
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update new data!',
                'data' => 0
            ], REST_Controller::HTTP_OK);
        }
    }
}

/* End of file Karyawna.php */