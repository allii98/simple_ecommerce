<?php
class Login_m extends CI_Model
{

    function prosesLogin($username)
    {
        $this->db->where('username', $username);

        return $this->db->get('tb_user')->row();
    }

    public function get($id = null)
    {
        $this->db->from('tb_user');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }


    function viewDataByID($username)
    {
        $query = $this->db->query("SELECT * FROM tb_user WHERE username = '$username'");
        $data = $query->result();

        return $data;
    }



    function checkDataUsrbyID($id, $pass)
    {
        $this->db->where('user_id', $id);
        $this->db->where('password', $pass);

        return $this->db->get('tb_user')->row();
    }
}