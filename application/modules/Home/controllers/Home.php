<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_home');
    }


    public function index()
    {


        $data =
            [
                'js' => 'core',
                'isi' => $this->M_home->getProduct()
            ];

        $this->template->load('frontend/template', 'page/content', $data);
    }


    public function cart()
    {

        if (!$this->session->userdata('userlogin')) {
            redirect('Login');
        } else {
            $lop = $this->M_home->getCart();
            $isi = [];
            foreach ($lop as $key => $value) {
                $get_cart_api = $this->M_home->getCartAPI($value['id_product']);
                $isi[] = [
                    'id' => $value['id'],
                    'id_product' => $value['id_product'],
                    'nama_product' => $get_cart_api['title'],
                    'harga' => $get_cart_api['price'],
                    'qty' => $value['qty'],
                    'gambar' => $get_cart_api['image'],
                ];
            }
            // var_dump($isi);
            // die;
            $data =
                [
                    'js' => 'core',
                    'isi' => $isi
                ];


            # code...
            $this->template->load('frontend/template', 'page/cart', $data);
        }
    }

    function add_cart()
    {
        $id = $this->input->post('id');
        $data = $this->M_home->saveProductById($id);
        echo json_encode($data);
    }

    function get_total_cart()
    {
        $id = $this->input->post('id');
        $query = $this->M_home->getTotalCart($id);
        echo json_encode($query);
    }
}

/* End of file Home.php */