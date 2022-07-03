<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_product extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://fakestoreapi.com/products'
        ]);
    }

    public function getProduct()
    {
        // if ($id === null) {
        // } else {
        // }
        $response = $this->_client->request('GET');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function save_pertandingan($data)
    {
        $this->db->insert($this->table, $data);
        return true;
    }

    public function get_data_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update_pertandingan($id, $data)
    {
        $this->db->update($this->table, $data, $id);
        return true;
    }

    public function delete_pertandingan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}

/* End of file M_product.php */