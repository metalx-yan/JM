<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fasilitator_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('M_Datatables');
        $this->load->model('training_parameter');
        $this->load->library('form_validation');
        $this->db_training = $this->load->database('training', TRUE);
        access_login();
        $this->id = 'kode_fasilitator';
    }

    public function index(){
        $data['title_head'] = 'Fasilitator';
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['list_menu'] = $this->db->get('menu')->result_array();
        $data['access_crud'] = access_crud($this->id);

        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Setting_parameter/fasilitator_v',$data);
        $this->load->view('Templates/Footer_v');
    } 

    public function get(){
        $query = 	"SELECT kode_fasilitator, nama_fasilitator, fasilitator.no_telepon, vendor.nama, kategori, id_internal, jenis_fasilitator, no_rekening, status FROM fasilitator LEFT JOIN vendor on vendor.kode_vendor = fasilitator.kode_vendor";
        $search = array('kode_fasilitator', 'nama_fasilitator','fasilitator.no_telepon','vendor.nama','kategori','id_internal','jenis_fasilitator','no_rekening','status');
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
        $table = 'fasilitator';
        $field = 'kode_fasilitator';
        $modal = $this->input->post('modal');
        $on_join = 'kode_vendor';
        $join = 'vendor';
        $id = $this->input->post('id');
        $kode_ = $this->input->post('kode_fasilitator');
        $data['kode_fasilitator'] = $this->training_parameter->select_join($kode_,$table,$field,$join, $on_join)->row();
        $data['vendor'] = $this->training_parameter->get_('vendor')->result_array();
        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $html_modal = $this->load->view('Modal/Modal_fasilitator',$data,TRUE);
        echo $html_modal;
    }

    function save_(){
        $table = 'fasilitator';
        $field = 'kode_fasilitator';
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        
        // cek kode 
        $cek_kode = $this->training_parameter->where($data[$field],$table,$field)->num_rows();
        if ($cek_kode > 0) {
            $msg = 'Kode Ruangan Sudah Ada';
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
        $table = 'fasilitator';
        $field = 'kode_fasilitator';
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
        $table = 'fasilitator';
        $field = 'kode_fasilitator';
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
            if ($key == 'no_telepon') {
                $require = 'required|trim|numeric';
            }elseif ($key == 'kode_vendor' || $key == 'id_internal'  || $key == 'no_rekening') {
                $require = 'numeric';
            }elseif ($key == 'kode_fasilitator') {
                $require = '';
            }
            else{
                $require = 'required|trim';
            }
            $this->form_validation->set_rules($key,$key,$require);
        }

        if (!$this->form_validation->run()) {
            foreach($_POST as $key => $val){
                $json[$key] = form_error($key, '<span class="mt-3 text-danger">', '</span>');
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
                if ($key == 'no_telepon') {
                    $require = 'required|trim|numeric';
                }elseif ($key == 'kode_vendor' || $key == 'id_internal'  || $key == 'no_rekening') {
                    $require = 'numeric';
                }elseif ($key == 'kode_fasilitator') {
                    $require = '';
                }
                else{
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
                    $json[$key] = form_error($key, '<span class="mt-3 text-danger">', '</span>');
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