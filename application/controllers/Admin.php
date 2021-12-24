<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
    }

    public function index()
    {
        $data['title'] = "Dashboard Teacher";
        $this->load->model('Subjects_model', 'subject');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $b=$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row()->student_id;
        $data['student'] = $this->subject->showRating($b);
        $this->load->model('User_model', 'announ');
        $data['announ'] = $this->announ->getContent();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->update(
                'announ',
                ['isi' => $this->input->post('isi')]
            );
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Announcement Success Changed!!
            </div>'
            );
            redirect('admin/index');
        }
    }
    public function role()
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                New Role Added!!
            </div>'
            );
            redirect('admin/role');
        }
    }
    public function hapus($id)
    {
        $this->load->model('Menu_model', 'role');
        $this->role->hapusrole($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Role Success Delete !!
        </div>'
        );
        redirect('admin/role');
    }
    public function ubahdataRole()
    {
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
            Gagal update role !!
        </div>'
            );
            redirect('admin/role');
        } else {
            $data = array(
                "role" => $_POST['role'],
            );
            $this->db->where('id', $_POST['id']);
            $this->db->update('user_role', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Role Success Update !!
            </div>'
            );
            redirect('admin/role');
        }
    }
    public function roleAccess($role_id)
    {
        $data['title'] = "Role Access";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }
    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_Id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_acces_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_acces_menu', $data);
        } else {
            $this->db->delete('user_acces_menu', $data);
        }
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Access Changed!
        </div>'
        );
    }
    public function subjects()
    {
        $data['title'] = "Subjects";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Subjects_model', 'subject'); //buat koneksi biar 
        $data['sub'] = $this->subject->getname();
        $data['subjects'] = $this->subject->getNameTeacher();

        $data['subject'] = $this->db->get('user')->result_array();

        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('id_teacher', 'Name', 'required');

        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/subjects', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'subject' => $this->input->post('subject'),
                'id_teacher' => $this->input->post('id_teacher')
            ];
            $this->db->insert('subject', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                New Subject Added!!
            </div>'
            );
            redirect('admin/subjects');
        }
    }
    public function updateSubject()
    {
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('id_teacher', 'Name', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
            Gagal update subject !!
        </div>'
            );
            redirect('admin/subjects');
        } else {
            $data = array(
                "subject" => $_POST['subject'],
                "id_teacher" => $_POST['id_teacher']
            );
            $this->db->where('id_subject', $_POST['id_subject']);
            $this->db->update('subject', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Subject Success Update !!
            </div>'
            );
            redirect('admin/subjects');
        }
    }
    public function deleteSubject($id)
    {
        $this->load->model('Subjects_model', 'subject');
        $this->subject->deleteSubject($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Success Delete Subject</div>'
        );
        redirect('admin/subjects');
    }
    public function studscore()
    {
        $data['title'] = "Student Scores";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->model('Subjects_model', 'subject');
        //$data['subject'] = $this->subject->percobaan();
        $this->load->model('Subjects_model', 'student');
        $role= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row()->student_id;
        $idUser= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row()->id;
        $data['student'] = $this->student->showPenilaian();
        $data['drd'] = $this->student->viewdropdownpon($idUser);
        $data['murid'] = $this->student->showMurid();
        $data['penilaian'] = $this->student->getList();
       
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/studscore', $data);
        $this->load->view('templates/footer');
    }
    public function tambahstud(){
        $idUser= $this->db->get_where('user', [
            'id' => $this->input->post('murid')])->row()->name;
        $iddas= $this->db->get_where('user', [
            'id' => $this->input->post('murid')])->row()->student_id;
        $subject= $this->db->get_where('subject', ['id_subject' => $this->input->post('pon')])->row()->subject;
        $this->load->model('Subjects_model', 'student');
        $cek = $this->db->query("SELECT * FROM penilaian WHERE id_user= '$iddas' AND mata_kuliah = '$subject'");
        if($cek->num_rows() >= 1){
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
                Score is already exists!!
        </div>');
            redirect('admin/studscore');
        }else{
            $data = array(
                'mata_kuliah' => $subject,
                'nilai' => $this->input->post('score'),
                'nama' => $idUser,
                'teacher_name' => $this->input->post('hidden'),
                'id_user' => $iddas,
                'noted' => $this->input->post('noted'),
                'status' => 0
            );
            // var_dump($data);die();
        $this->student->input_data($data, 'penilaian');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Score is saved successfully!!
    </div>');
        redirect('admin/studscore');
        }
    }
    public function updatePenilaian(){
        $this->form_validation->set_rules('nilai', 'Nilai','required');
        $this->form_validation->set_rules('noted', 'Note','required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
            Failed to Update!!
        </div>');
        redirect('admin/studscore');
        }else{
            $data = array(
                "noted" => $_POST['noted'],
                "nilai" => $_POST['nilai']
            );
            $this->db->where('id_penilaian', $_POST['hidden']);
            $this->db->update('penilaian', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Subject Success Update !!
            </div>'
            );
            redirect('admin/studscore');
        }
        
    }
    public function deletePenilaian(){
        $this->load->model('Subjects_model', 'student');
       
        $where = array('id_penilaian' => $_POST['hidden']);
        $this->student->hapus_data($where,'penilaian');
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Subject Success Delete !!
        </div>'
        );
        redirect('admin/studscore');
    }
    
    public function listStudent()
    {
        $data['title'] = "List Student";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->model('Subjects_model', 'student');
        $data['student'] = $this->student->showStudent();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/listStudent', $data);
        $this->load->view('templates/footer');
    }
    public function prof()
    {
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/prof', $data);
        $this->load->view('templates/footer');
    }

    public function changePass()
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
                    redirect('admin/changepass');
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
                    redirect('admin/changepass');
                }
            }
        }
    }


}
