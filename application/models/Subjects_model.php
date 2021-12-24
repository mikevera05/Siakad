<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Subjects_model extends CI_Model
{
    public function getNameTeacher()
    {
        $query = "SELECT `subject`.*,`user`.* 
                    FROM `subject` JOIN `user` 
                    ON `subject`.`id_teacher` = `user`.`id`
                    WHERE `user`.`role_id` = 1";

        return $this->db->query($query)->result_array();
    }
    public function deleteSubject($id)
    {
        $this->db->delete('subject', ['id_subject' => $id]);
    }
    public function percobaan($a)
    {
        $query = "SELECT `subject`,`user`.`name` 
                    FROM `subject` JOIN `user` 
                    ON `subject`.`id_teacher` = `user`.`id` 
                    WHERE `user`.`role_id` = 1 
                    AND `user`.`id`=.'$a'";
        return $this->db->query($query)->result_array();
    }
    public function showStudent()
    {
        $query = "SELECT `student_id`,`name` FROM `user`
                    WHERE `role_id` = 2";
        return $this->db->query($query)->result_array();
    }
    public function showRating($b)
    {
        $this->db->select("*");
        $this->db->where("id_teacher",$b);
        return $this->db->get('rating')->result_array();
    }
    public function showPenilaian()
    {
        $query = "SELECT * FROM `penilaian`";
        return $this->db->query($query)->result_array();
    }
    public function showMurid()
    {
        $query = "SELECT * FROM `user` WHERE role_id = 2";
        return $this->db->query($query)->result();
    }
    public function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function get_email($idUser){
        $this->db->select("*");
        $this->db->where("id_user",$idUser);
        return $this->db->get('user')->row();
    }
    public function viewdropdownpon($id_User){
        $this->db->select('*');
       $this->db->from('subject');
       $this->db->where('id_teacher', $id_User);
       $query = $this->db->get();
       return $query->result();
    }
    public function getList()
    {
       $this->db->select('*');
       $this->db->from('penilaian');
       
       $query = $this->db->get();
       return $query->result();
    }
    // public function delete($id)
    // {
    //     $where = array('id' => $id);
    //     $this->m_data->hapus_data($where,'user');
    // }
    function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
    public function getname()
    {
        $query = "SELECT `id`,`name` FROM `user` WHERE `user`.`role_id`=1";
        return $this->db->query($query)->result();
    }
}
