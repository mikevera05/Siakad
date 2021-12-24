<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
    }
    public function index()
    {
        $data['title'] = "Data Nasabah";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/index', $data);
        $this->load->view('templates/footer');
    }

    public function kontak()
    {
        $data['title'] = "Daftar Kontak Nasabah";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Kontak_model', 'kontak');
        //pagination
        $this->load->library('pagination');

        //ambil data keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata['keyword'];
        }

        //config pagination
        $this->db->like('nama_nasabah', $data['keyword']);
        $this->db->from('kontak_nasabah');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 7;

        //inisialisai
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['kontak'] = $this->kontak->getKontak($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/kontak', $data);
        $this->load->view('templates/footer');
    }

    public function updateNasabah()
    {
        $this->form_validation->set_rules('nama_nasabah', 'Nama Nasabah', 'required');
        $this->form_validation->set_rules('no_nasabah', 'Kontak Nasabah', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
            Gagal update nasabah !!
        </div>'
            );
            redirect('data/kontak');
        } else {
            $data = array(
                "nama_nasabah" => $_POST['nama_nasabah'],
                "no_nasabah" => $_POST['no_nasabah']
            );
            $this->db->where('id_kontak', $_POST['id_kontak']);
            $this->db->update('kontak_nasabah', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Nasabah Success Update !!
            </div>'
            );
            redirect('data/Kontak');
        }
    }

    public function hapusNasabah($id_kontak)
    {
        $this->load->model('Kontak_model', 'user');
        $this->user->hapusNasabah($id_kontak);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Success Delete Nasabah</div>'
        );
        redirect('data/kontak');
    }
    public function dataTarget()
    {
        $data['title'] = "Data Training";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('data_model', 'dm');
        //load library
        $this->load->library('pagination');
        //config
        $config['base_url'] = 'http://localhost/Project_Pegadaian/data/dataTarget';
        $config['total_rows'] = $this->dm->count_all_training();
        $config['per_page'] = 8;
        //initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['dm'] = $this->dm->getData($config['per_page'], $data['start']);
        // $data['data'] = $this->db->get('data_training')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/dataTarget', $data);
        $this->load->view('templates/footer');
    }
    public function dataUji()
    {
        $data['title'] = "Pengujian";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['data_uji'] = $this->db->get('data_uji')->result_array();
        $this->load->model('data_model', 'du');
        //load library
        $this->load->library('pagination');
        //config
        $config['base_url'] = 'http://localhost/Project_Pegadaian/data/dataUji';
        $config['total_rows'] = $this->du->count_all_training();
        $config['per_page'] = 8;
        //initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['du'] = $this->du->getDataUji($config['per_page'], $data['start']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/dataUji', $data);
        $this->load->view('templates/footer');
    }
}
