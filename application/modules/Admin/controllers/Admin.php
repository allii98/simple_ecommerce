<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
        if (!$this->session->userdata('userlogin')) {
            if ($this->session->userdata('level') != 1) {
                redirect('Home');
                # code...
            } else {

                $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
                $this->session->set_flashdata('pesan', $pemberitahuan);
                redirect('Login');
            }
        }
    }


    public function index()
    {

        $data =
            [
                'title' => 'YS-score|Home',
                'js' => 'core'
            ];

        // var_dump($data) . die();

        $this->template->load('template', 'page/dashboard', $data);
    }

    public function save()
    {
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $dept = $this->input->post('dept');

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $nik . '.png'; //buat name dari qr code sesuai dengan nik

        $params['data'] = $nik; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data = $this->M_data->simpan($nik, $nama, $dept, $image_name); //simpan ke database
        echo json_encode($data);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $dept = $this->input->post('dept');

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $nik . '.png'; //buat name dari qr code sesuai dengan nik

        $params['data'] = $nik; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data = $this->M_data->update($id, $nik, $nama, $dept, $image_name); //simpan ke database
        echo json_encode($data);
    }

    public function hapus()
    {
        $id = $this->input->post('id');
        $data = array('id' => $id);
        $data = $this->M_data->delete($data);
        echo json_encode($data);
    }

    public function check_data()
    {
        $check = $this->input->get('nik');
        $data = $this->M_data->check_data($check);
        echo json_encode($data);
    }
}

/* End of file Home.php */