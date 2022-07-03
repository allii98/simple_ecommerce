<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pertandingan_m extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("asia/jakarta");
    }


    public function getData($tgl)
    {
        return $this->db->get_where('tbpertandingan', ['trending' => '1', 'tgl' => $tgl])->result_array();
    }

    public function getDataToday()
    {
        $tgl = date('Y-m-d');
        return $this->db->query("SELECT * FROM tbpertandingan WHERE trending = '1' AND tgl ='$tgl' ")->result_array();
    }
    public function getPertandingan($tgl)
    {
        return $this->db->get_where('tbpertandingan', ['tgl' => $tgl])->result_array();
    }

    public function getPertandingaToday()
    {
        $tgl = date('Y-m-d');
        return $this->db->query("SELECT * FROM tbpertandingan WHERE tgl ='$tgl' ")->result_array();
    }

    public function getMasukKeluarToday()
    {
        $tgl = date('Y-m-d');
        return $this->db->query("SELECT nama_club1, nama_club2, icon_club1, icon_club2, masuk, keluar FROM tbpertandingan WHERE tgl ='$tgl' ")->result_array();
    }
    public function getMasukKeluar($tgl)
    {
        return $this->db->query("SELECT nama_club1, nama_club2, icon_club1, icon_club2, masuk, keluar FROM tbpertandingan WHERE tgl ='$tgl' ")->result_array();
    }
    public function getHistori()
    {
        return $this->db->query("SELECT * FROM tb_sejarah")->row_array();
    }
    public function getAbout()
    {
        return $this->db->query("SELECT * FROM tb_about")->row_array();
    }
}

/* End of file M_karyawan.php */