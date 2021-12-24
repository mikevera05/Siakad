<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        
    }

    public function index()
    {
        $notif = $this->db->query("SELECT COUNT(status) as jmlh FROM penilaian WHERE status = '0'");
					$notifscore = $notif->row('jmlh');
                    $data['scorenotices']= $notifscore;
        $data['title'] = "Dashboard Student";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('User_model', 'announ');
        $data['announ'] = $this->announ->getContent();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/dashboard', $data);
            $this->load->view('templates/footer');
        }
        //  else {
        //     $this->db->update(
        //         'announ',
        //         ['isi' => $this->input->post('isi')]
        //     );
        //     $this->session->set_flashdata(
        //         'message',
        //         '<div class="alert alert-success" role="alert">
        //         Announcement Success Changed!!
        //     </div>'
        //     );
        //     redirect('user');
        // }
    }

    public function profile()
    {
        $notif = $this->db->query("SELECT COUNT(status) as jmlh FROM penilaian WHERE status = '0'");
					$notifscore = $notif->row('jmlh');
                    $data['scorenotices']= $notifscore;
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    // public function beranda()
    // {
    //     $data['title'] = "Beranda";
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     //nampilin nama user yg masuk sesuia di DB
    //     //echo 'Selamat datang ' . $data['user']['name'];
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('user/beranda', $data);
    //     $this->load->view('templates/footer');
    // }

    public function edit()
    {
        $data['title'] = "Edit Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar yg akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = 'assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        //menghilangkan foto lama yg akan diganti
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Your profile has been updated!!
            </div>'
            );
            redirect('user/profile');
        }
    }
    
    // public function report()
    // {
    //     $data['title'] = "Report";
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     //nampilin nama user yg masuk sesuia di DB
    //     //echo 'Selamat datang ' . $data['user']['name'];
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('user/report', $data);
    //     $this->load->view('templates/footer');
    // }
    
    // public function simpan()
    // {
    // }

    public function changePassword()
    {
        $data['title'] = "Change Password";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[5]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Wrong Current Password!!!
                </div>'
                );
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                        New Password cannot be the sama as current password!!!
                    </div>'
                    );
                    redirect('user/changepassword');
                } else {
                    //pasw yg bener
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Password Changed!!!
                    </div>'
                    );
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function announcement()
    {
        $data['title'] = "Announcement";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->model('User_model', 'announ');
        $data['announ'] = $this->announ->getContent();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/announcement', $data);
        $this->load->view('templates/footer');
    }

    public function studentscore()
    {
        //Menghitung berapa banyak kolom penilaian yg statusnya 0
        $check = $this->db->query("SELECT COUNT(status) as jmlh FROM penilaian WHERE status = '0'")->num_rows(); 
        if($check>0){
            $a=$this->db->query("SELECT id_penilaian FROM penilaian WHERE status = '0'")->result_array();
            // var_dump($a);die();
            foreach ($a as $row) {
            $this->db->set('status', 1);
            $this->db->where('id_penilaian', $row['id_penilaian']);
            $this->db->update('penilaian');
            }
            $data['title'] = "Student Score";
        
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $a= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row()->student_id;
        // $role= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row()->student_id;
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        //$data['subject'] = $this->subject->percobaan();
        $notif = $this->db->query("SELECT COUNT(status) as jmlh FROM penilaian WHERE status = '0'");
					$notifscore = $notif->row('jmlh');
                    $data['scorenotices']= $notifscore;
					
                    // var_dump($data['hasilgudang']);die();
                //     $query = $this->db->query("SELECT COUNT(status) as jmlh FROM penilaian WHERE status = '0'");
                // $hasil = $query->row();
                // $i = $hasil->role;
        $this->load->model('Studscore_model', 'student');
        $data['penilaian'] = $this->student->getList($a);
        $data['drd'] = $this->student->getListdrd($a);
        $data['student'] = $this->student->showPenilaian();
        // var_dump($data['penilaian']); die();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tio', $data);
        $this->load->view('templates/footer');
        }else{
            $data['title'] = "Student Score";
        
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $a= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row()->student_id;
        // $role= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row()->student_id;
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        //$data['subject'] = $this->subject->percobaan();
        $notif = $this->db->query("SELECT COUNT(status) as jmlh FROM penilaian WHERE status = '0'");
		$notifscore = $notif->row('jmlh');
		$data['scorenotices']= $notifscore;
                    // var_dump($data['hasilgudang']);die();
                //     $query = $this->db->query("SELECT COUNT(status) as jmlh FROM penilaian WHERE status = '0'");
                // $hasil = $query->row();
                // $i = $hasil->role;
        $this->load->model('Studscore_model', 'student');
        $data['penilaian'] = $this->student->getList($a);
        $data['drd'] = $this->student->getListdrd($a);
        $data['student'] = $this->student->showPenilaian();
        // var_dump($data['penilaian']); die();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/tio', $data);
        $this->load->view('templates/footer');
        }
       
        
    }
    public function sendPenilaianGuru(){
        $a= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row()->name;
        $namaguru = $this->input->post('pon');
        $subject= $this->db->get_where('subject', ['subject' => $namaguru])->row()->id_teacher;
        $subject= $this->db->get_where('user', ['id' => $subject])->row()->student_id;
        $rating = $this->input->post('rating');
        $pesan = $this->input->post('pesan');
        $this->load->model('Subjects_model', 'student');
        $data = array(
            'subject' => $namaguru,
            'rate' => $rating,
            'message' => $pesan,
            'id_teacher' => $subject,
            'student_name' => $a
        );
        // var_dump($data);die();
        $this->student->input_data($data, 'rating');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Message Success Send!!
        </div>'
        );
        redirect('user/studentscore');
    }
    
    
}
