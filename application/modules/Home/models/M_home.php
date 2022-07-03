<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_home extends CI_Model
{

    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://fakestoreapi.com/products/'
        ]);
    }

    public function getCart()
    {
        $result = $this->db->query("SELECT * FROM tb_cart WHERE id_user = '" . $this->session->userdata('id_user') . "'")->result_array();

        return $result;
    }

    public function getProduct()
    {
        $response = $this->_client->request('GET');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getCartAPI($id)
    {
        $response = $this->_client->request('GET', '' . $id .   '');
        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    function saveProductById($id)
    {
        $id_user = $this->session->userdata('id_user');
        $cek =  $this->db->query("SELECT * FROM tb_cart WHERE id_user='$id_user' AND id_product='$id'")->num_rows();
        if ($cek == 0) {
            $data = array(
                'id_user' => $id_user,
                'id_product' => $id,
                'qty' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'modifed_at' => date('Y-m-d H:i:s')

            );
            $this->db->insert('tb_cart', $data);
        } else {
            $qty = $cek + 1;
            $data = array(
                'qty' => $qty,
                'modifed_at' => date('Y-m-d H:i:s')
            );
            $this->db->where('id_user', $id_user);
            $this->db->where('id_product', $id);
            $this->db->update('tb_cart', $data);
        }

        $get_cart = $this->db->query("SELECT * FROM tb_cart WHERE id_user='$id_user'")->num_rows();

        return $get_cart;
    }

    public function getTotalCart($id)
    {
        $get_cart = $this->db->query("SELECT * FROM tb_cart WHERE id_user='$id'")->num_rows();

        return $get_cart;
    }
}