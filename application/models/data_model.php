<?php
class data_model extends CI_Model
{
    public function getdata_training()
    {
        return $this->db->get('data_training')->result_array();
    }
    public function getdata_uji()
    {
        return $this->db->get('data_uji')->result_array();
    }
    // public function getDataTraining()
    // {
    //     return $this->db->get('data_training')->result();
    // }
    public function getData($limit, $start)
    {
        // if ($keyword) {
        //     $this->db->like('sub_produk', $keyword);
        // }
        return $this->db->get('data_training', $limit, $start)->result_array();
    }
    public function getDataUji($limit, $start)
    {
        // if ($keyword) {
        //     $this->db->like('sub_produk', $keyword);
        // }
        return $this->db->get('data_uji', $limit, $start)->result_array();
    }
    public function count_all_training()
    {
        return $this->db->get('data_training')->num_rows();
    }
    public function count_all_uji()
    {
        return $this->db->get('data_uji')->num_rows();
    }
    public function convertPinjaman($pinjaman)
    {
        if ($pinjaman <= 10000000) {
            return "1";
        } else if ($pinjaman > 10000000 && $pinjaman <= 25000000) {
            return "2";
        } else if ($pinjaman > 25000000 && $pinjaman <= 100000000) {
            return "3";
        } else if ($pinjaman > 100000000 && $pinjaman <= 250000000) {
            return "4";
        }
    }
    function convertTenor($tenor)
    {
        if ($tenor <= 12) {
            return "C";
        } else if ($tenor > 12 && $tenor <= 24) {
            return "B";
        } else if ($tenor > 24 && $tenor <= 36) {
            return "A";
        }
    }
}
