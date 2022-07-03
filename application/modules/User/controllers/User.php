<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('bcrypt');
        $this->load->model('M_user');
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
                'title' => 'YS-score | User',
                'js' => 'core'
            ];

        $this->template->load('template', 'page/v_user', $data);
    }

    function data()
    {
        $list = $this->M_user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $hasil) {
            $row   = array();
            $no++;
            $row[] = '<a href="javascript:;">
            <button type="button" onclick="updatemodal(' . $hasil->user_id . ');" class="btn btn-warning"><i class="fa fa-edit"></i></button>
            <button type="button" onclick="hapus(' . $hasil->user_id . ');" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            
            </a>';
            $row[] =  $no . ".";
            $row[] = $hasil->user_nama;
            $row[] = $hasil->username;
            $row[] = $hasil->level == 1 ? 'Admin' : 'User';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_user->count_all(),
            "recordsFiltered" => $this->M_user->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function js()
    {

        $this->load->view('user/js/core');
    }

    function save_user()
    {
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $level = $this->input->post('level');
        $pass = $this->input->post('password');
        $password = $this->bcrypt->hash_password($pass);

        $data = array(
            'user_nama' => $nama,
            'username' => $username,
            'level' => $level,
            'user_pass' => $password,
        );

        $done = $this->M_user->saveUser($data);
        echo json_encode($done);
    }


    public function update_user()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $level = $this->input->post('level');

        $data = array(
            'user_nama' => $nama,
            'username' => $username,
            'level' => $level,
        );

        $done = $this->M_user->updateUser(array('user_id' => $id), $data);
        echo json_encode($done);
    }



    public function delete()
    {
        $id = $this->input->post('id');
        $this->M_user->deleteUser($id);
        echo json_encode(array("status" => TRUE));
    }


    function get_data_by_id()
    {
        $id = $this->input->post('id');
        $data = $this->M_user->get_data_by_id($id);
        echo json_encode($data);
    }
}

/* End of file User.php */