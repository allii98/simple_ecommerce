<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_m extends CI_Model
{
    public function updateApi($data, $id)
    {
        return $this->db->update('tbuser', $data, ['user_id' => $id]);
    }
}

/* End of file Profile_m.php */