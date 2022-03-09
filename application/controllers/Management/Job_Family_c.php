<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Family_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('M_Datatables');
        $this->load->model('training_parameter');
        $this->load->library('form_validation');
        $this->db_jobmanagement = $this->load->database('jobmanagement', TRUE);
        access_login();
        $this->id = 'id_key';
    }

    public function index(){
        $data['title_head'] = 'Job';
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['list_menu'] = $this->db->get('menu')->result_array();
        $data['access_crud'] = access_crud($this->id);

        // var_dump($data['access_crud']);die; 
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Management/Job_Family_v',$data);
        $this->load->view('Templates/Footer_v');
    } 

    public function get(){
        $query = "SELECT
        a.id_job_family,a.job_family,b.job_sub_family,
        CASE
            WHEN a.id_job_family = b.id_job_family  THEN
                concat(a.id_job_family,'-',b.id )
        END	as id_key
        FROM
        job_family a
        JOIN job_sub_family b ON a.id_job_family = b.id_job_family ";
        // $sql = $this->db_jobmanagement->query($query);
        // var_dump($sql->result_array());die;
        $search = array('a.id_job_family','a.job_family', 'b.job_sub_family');
        $where  = null; 
        // $where  = array('nama_kategori' => 'Tutorial');
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
        // $tes = $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
        header('Content-Type: application/json');
        echo $this->M_Datatables->get_tables_query_job($query,$search,$where,$isWhere);
    }

    public function modal(){
        $table_jobfamily = 'job_family';
        $table_sub_jobfamily = 'job_sub_family';
        $kode_job_family = 'Y';
        $field_job_family = 'flagactive =';
        $field_id_key = "concat(job_family.id_job_family,'-',job_sub_family.id)";
        $modal = $this->input->post('modal');
        $id = $this->input->post('id');
        $id_key = $this->input->post('id_key');
        $field_id_job_family = 'id_job_family';
        $select_data = "job_family.id_job_family,job_family.job_family,job_sub_family.job_sub_family,
        CASE
            WHEN job_family.id_job_family = job_sub_family.id_job_family  THEN
             concat(job_family.id_job_family,'-',job_sub_family.id )
        END	as id_key";

        $data['id_job_family'] = $this->training_parameter->join_group_where_select(
            $table_jobfamily,$table_sub_jobfamily,$field_id_job_family,$field_id_job_family,
            $field_job_family,$kode_job_family,$field_id_key,$id_key,$select_data)->row();
        // var_dump($id_key);die;
        $data['job_family'] = $this->training_parameter->where($kode_job_family,$table_jobfamily,$field_job_family)->result_array();

        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $html_modal = $this->load->view('Modal/Modal_job_family',$data,TRUE);
        echo $html_modal;
    }

    function save_(){
        $table = 'job_sub_family';
        $field1 = 'job_sub_family';
        $field2 = 'id_job_family';
        
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        $data_sub = (['job_sub_family' => $data['job_sub_family'],'id_job_family' => $data['job_family']]);
        // cek kode 
        $cek = $this->training_parameter->where_double($table,$field1,$field2,$data['job_sub_family'],$data['job_family'])->num_rows();
        if ($cek > 0) {
            $msg = 'Data Sudah Ada';
        }else{
            $save = $this->training_parameter->save($data_sub,$table);
            // $del = $this->training_parameter->delete_($job_f,$table,$field2,$field3,$kode_notnull,$falseNull,$field,$kode);

            if ($save == true) {
                $msg = 'Berhasil di Simpan';
            }else{
                $msg = 'Gagal Menyimpan';
            }
        }

        echo $msg;
    }

    function edit_(){
        $table = 'job_sub_family';
        $field = 'id';
        $field1 = 'job_sub_family';
        $field2 = 'id_job_family';
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        $extract = explode('-',$data['id_job_family']);
        
        $cek = $this->training_parameter->where_double($table,$field1,$field2,$data['job_sub_family'],$data['job_family'])->num_rows();
        
        $data_update = (['job_sub_family' => $data['job_sub_family'], 'id_job_family' => $data['job_family']]);
        // var_dump($data_update,$extract[1]);die;
        // Update

        if ($cek > 0) {
            $msg = 'Data yang di update ada yang sama';
        }else{
            $msg = 'Berhasil Update';
            $this->training_parameter->update($extract[1],$data_update,$table,$field);
        }
        echo $msg;
      
    }

    function delete_(){
        $table = 'fasilitas_biaya_training';
        $field = 'kode_fasilitas';
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
            if ($key == 'job_sub_family' || $key == 'job_family') {
                $require = 'required';
            }else{
                $require = '';
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
            // var_dump($key);
            if ($key == $key) {
                if ($key == 'job_sub_family') {
                    $require = 'required';
                }else{
                    $require = '';
                }
                $this->form_validation->set_rules($key,$key,$require);
            }
        }

        $this->form_validation->set_message('required', 'You missed the input {field}!');
        // $this->form_validation->set_message('min_length', 'You input {field} kurang!');

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