<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function getContent()
    {
        return $this->db->get('announ')->result();
    }
}