<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_product');
        if (!$this->session->userdata('userlogin')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }
    }



    public function index()
    {
        $data =
            [
                'title' => 'YS-score | Pertandingan',
                'js' => 'core',
                'isi' => $this->M_product->getProduct(),
            ];


        // echo "<pre>";
        // print_r($data['isi']);
        // echo "</pre>";


        $this->template->load('template', 'page/v_product', $data);
    }
    public function detail()
    {
        $data =
            [
                'title' => 'YS-score | Detail Data Pertandingan',
                'js' => 'detail'
            ];

        $this->template->load('template', 'page/v_detail', $data);
    }

    public function save()
    {
        $tgl = $this->input->post('tgl');
        $jam = $this->input->post('jam');
        $nama1 = $this->input->post('nama1');
        $nama2 = $this->input->post('nama2');
        $time = $this->input->post('time');
        $trend = $this->input->post('trend');


        $data = array(
            'tgl' => $tgl,
            'jam' => $jam,
            'nama_club1' => $nama1,
            'nama_club2' => $nama2,
            'waktu' => $time,
            'trending' => $trend

        );

        if (!empty($_FILES['icon1']['name'])) {
            $upload = $this->_do_upload();
            $data['icon_club1'] = $upload;
        }
        if (!empty($_FILES['icon2']['name'])) {
            $upload = $this->_do_upload2();
            $data['icon_club2'] = $upload;
        }


        $done = $this->M_product->save_pertandingan($data);
        echo json_encode($done);
    }

    public function update_pertandingan()
    {
        $id = $this->input->post('id');
        $tgl = $this->input->post('tgl');
        $jam = $this->input->post('jam');
        $nama1 = $this->input->post('nama1');
        $nama2 = $this->input->post('nama2');
        $time = $this->input->post('time');
        $trend = $this->input->post('trend');

        $data = array(
            'tgl' => $tgl,
            'jam' => $jam,
            'nama_club1' => $nama1,
            'nama_club2' => $nama2,
            'waktu' => $time,
            'trending' => $trend
        );

        $cek_pertandingan = $this->M_product->get_data_by_id($id);

        if (!empty($_FILES['icon1']['name'])) {
            if ($_FILES['icon1']['name'] != '') {
                unlink('assets/uploads/club/' . $cek_pertandingan->icon_club1);
            }
            if ($_FILES['icon1']['name'] != '') {
                # code...
                $upload = $this->_do_upload();
                $data['icon_club1'] = $upload;
            } else {
                $data['icon_club1'] = $cek_pertandingan->icon_club1;
                # code...
            }
        }

        if (!empty($_FILES['icon2']['name'])) {
            if ($_FILES['icon2']['name'] != '') {
                unlink('assets/uploads/club/' . $cek_pertandingan->icon_club2);
            }
            if ($_FILES['icon2']['name'] != '') {
                # code...
                $upload = $this->_do_upload2();
                $data['icon_club2'] = $upload;
            } else {
                $data['icon_club2'] = $cek_pertandingan->icon_club2;
                # code...
            }
        }



        $done = $this->M_product->update_pertandingan(array('id' => $id), $data);
        echo json_encode($done);
    }
    public function update_score()
    {
        $id = $this->input->post('id');
        $score1 = $this->input->post('score1');
        $score2 = $this->input->post('score2');

        $data = array(
            'score_club1' => $score1,
            'score_club2' => $score2,
        );

        $done = $this->M_product->update_pertandingan(array('id' => $id), $data);
        echo json_encode($done);
    }
    public function update_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');


        $data = array(
            'status' => $status
        );


        $done = $this->M_product->update_pertandingan(array('id' => $id), $data);
        echo json_encode($done);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $cek_pertandingan = $this->M_product->get_data_by_id($id);
        if ($cek_pertandingan->icon_club1 != '') {
            unlink('assets/uploads/club/' . $cek_pertandingan->icon_club1);
        }
        if ($cek_pertandingan->icon_club2 != '') {
            unlink('assets/uploads/club/' . $cek_pertandingan->icon_club2);
        }
        $done = $this->M_product->delete_pertandingan($id);
        echo json_encode($done);
    }

    public function get_data_by_id()
    {
        $id = $this->input->post('id');
        $data = $this->M_product->get_data_by_id($id);
        echo json_encode($data);
    }

    private function _do_upload()
    {
        $config['upload_path']          = './assets/uploads/club/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 500; //set max size allowed in Kilobyte
        $config['max_width']            = 5000; // set max width image allowed
        $config['max_height']           = 5000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('icon1')) //upload and validate
        {
            $data['inputerror'][] = 'icon1';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
    }
    private function _do_upload2()
    {
        $config['upload_path']          = './assets/uploads/club/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 500; //set max size allowed in Kilobyte
        $config['max_width']            = 5000; // set max width image allowed
        $config['max_height']           = 5000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('icon2')) //upload and validate
        {
            $data['inputerror'][] = 'icon2';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }

        return $this->upload->data('file_name');
    }
}

/* End of file Controllername.php */