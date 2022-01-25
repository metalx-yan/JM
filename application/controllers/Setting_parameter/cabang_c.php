<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cabang_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('M_Datatables');
        $this->load->model('training_parameter');
        $this->load->library('form_validation');
        $this->db_training = $this->load->database('training', TRUE);
    }

    public function index(){
        $data['title_head'] = 'Cabang';
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = $this->User_model->get_navbar_name($jabatan,'Parent')->result_array();
        $data['navbar_child'] = $this->User_model->get_child_name($jabatan,'Child')->result_array();
        $data['list_menu'] = $this->db->get('menu')->result_array();

        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Setting_parameter/cabang_v',$data);
        $this->load->view('Templates/Footer_v');
    } 

    public function get(){
        $query = 	"SELECT * FROM cabang";
        $search = array('kode_cabang', 'nama_cabang', 'regional');
        $where  = null; 
        // $where  = array('nama_kategori' => 'Tutorial');
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
        // $tes = $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
        header('Content-Type: application/json');
        echo $this->M_Datatables->get_tables_query_train($query,$search,$where,$isWhere);
    }

    public function modal(){
        $table = 'cabang';
        $field = 'kode_cabang';
        $modal = $this->input->post('modal');
        $id = $this->input->post('id');
        $kode_ = $this->input->post('kode_cabang');
        $data['kode_cabang'] = $this->training_parameter->where($kode_,$table,$field)->row();
        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $html_modal = $this->load->view('Modal/Modal_cabang',$data,TRUE);
        echo $html_modal;
    }

    function save_(){
        $table = 'cabang';
        $field = 'kode_cabang';
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        
        // cek kode 
        $cek_kode = $this->training_parameter->where($data[$field],$table,$field)->num_rows();
        if ($cek_kode > 0) {
            $msg = 'Kode Sudah Ada';
        }else{
            $save = $this->training_parameter->save($data,$table);
            if ($save == true) {
                $msg = 'Berhasil di Simpan';
            }else{
                $msg = 'Gagal Menyimpan';
            }
        }
        echo $msg;

    }

    function edit_(){
        $table = 'cabang';
        $field = 'kode_cabang';
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        // Update
        $Update = $this->training_parameter->update($data[$field],$data,$table,$field);
        if ($Update) {
            $msg = 'Berhasil Update';
        }else{
            $msg = 'Gagal Update';
        }
        echo $msg;
    }

    function delete_(){
        $table = 'cabang';
        $field = 'kode_cabang';
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }

        // delete
        $delete = $this->training_parameter->delete_($data[$field],$table,$field);
        if ($delete) {
            $msg = 'Berhasil di Hapus';
        }else{
            $msg = 'Gagal Hapus';
        }
        echo $msg;
    }

    function validate(){
        $this->form_validation->set_error_delimiters('', '');
        foreach($_POST as $key => $val){
            if ($key == 'kode_cabang') {
                $require = 'required|trim|numeric';
            }else{
                $require = 'required|trim';
            }
            $this->form_validation->set_rules($key,$key,$require);
        }

        if (!$this->form_validation->run()) {
            foreach($_POST as $key => $val){
                $json[$key] = form_error($key, '<p class="mt-3 text-danger">', '</p>');
            }
        }else{
            $json = array(
                'action' => 'ok',
            );
        }

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
    }

    function validate_keyup(){
        $this->form_validation->set_error_delimiters('', '');
        foreach($_POST as $key => $val){
            if ($key == $key) {
                if ($key == 'kode_cabang') {
                    $require = 'required|trim|numeric';
                }else{
                    $require = 'required|trim';
                }
                $this->form_validation->set_rules($key,$key,$require);
            }
        }

        $this->form_validation->set_message('required', 'You missed the input {field}!');
        $this->form_validation->set_message('numeric', 'You input {field} just numeric!');

        if (!$this->form_validation->run()) {
            foreach($_POST as $key => $val){
                if ($key == $key) {
                    $json[$key] = form_error($key, '<p class="mt-3 text-danger">', '</p>');
                }
            }
        }else{
            foreach($_POST as $key => $val){
                $json = array(
                    $key => '',
                );
            }
        }
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
    }

   

   
    

}