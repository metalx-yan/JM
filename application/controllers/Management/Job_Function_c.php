<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Function_c extends CI_Controller {
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
        $this->load->view('Management/Job_Function_v',$data);
        $this->load->view('Templates/Footer_v');
    } 

    public function get(){
        $query = "SELECT
        a.id_job_function,a.job_function,b.job_sub_function,
        CASE
            WHEN a.id_job_function = b.id_job_function  THEN
                concat(a.id_job_function,'-',b.id )
        END	as id_key
        FROM
        job_function a
        JOIN job_sub_function b ON a.id_job_function = b.id_job_function ";
        // $sql = $this->db_jobmanagement->query($query);
        // var_dump($sql->result_array());die;
        $search = array('a.id_job_function','a.job_function', 'b.job_sub_function');
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
        $table_jobfunction = 'job_function';
        $table_sub_jobfunction = 'job_sub_function';
        $kode_job_function = 'Y';
        $field_job_function = 'flagactive =';
        $field_id_key = "concat(job_function.id_job_function,'-',job_sub_function.id)";
        $modal = $this->input->post('modal');
        $id = $this->input->post('id');
        $id_key = $this->input->post('id_key');
        $field_id_job_function = 'id_job_function';
        $select_data = "job_function.id_job_function,job_function.job_function,job_sub_function.job_sub_function,
        CASE
            WHEN job_function.id_job_function = job_sub_function.id_job_function  THEN
             concat(job_function.id_job_function,'-',job_sub_function.id )
        END	as id_key";

        $data['id_job_function'] = $this->training_parameter->join_group_where_select(
            $table_jobfunction,$table_sub_jobfunction,$field_id_job_function,$field_id_job_function,
            $field_job_function,$kode_job_function,$field_id_key,$id_key,$select_data)->row();

        $data['job_function'] = $this->training_parameter->where($kode_job_function,$table_jobfunction,$field_job_function)->result_array();

        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $html_modal = $this->load->view('Modal/Modal_job_function',$data,TRUE);
        echo $html_modal;
    }

    function save_(){
        $table = 'job_sub_function';
        $field1 = 'job_sub_function';
        $field2 = 'id_job_function';
        
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        $data_sub = (['job_sub_function' => $data['job_sub_function'],'id_job_function' => $data['job_function']]);
        // cek kode 
        $cek = $this->training_parameter->where_double($table,$field1,$field2,$data['job_sub_function'],$data['job_function'])->num_rows();
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
        $table = 'job_sub_function';
        $field = 'id';
        $field1 = 'job_sub_function';
        $field2 = 'id_job_function';
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        $extract = explode('-',$data['id_job_function']);
        
        $cek = $this->training_parameter->where_double($table,$field1,$field2,$data['job_sub_function'],$data['job_function'])->num_rows();
        
        $data_update = (['job_sub_function' => $data['job_sub_function'], 'id_job_function' => $data['job_function']]);
        // var_dump($data_update,$extract[1]);die;
        // Update

        if ($cek > 0) {
            $msg = 'Data yang di update ada yang sama';
        }else{
            $msg = 'Berhasil Update';
            $this->training_parameter->update($extract[1],$data_update,$table,$field);
        }
        echo $msg;
        // $table = 'job_function';
        // $field1 = 'flagactive =';
        // $field2 = 'id_job_function =';
        // $field3 = 'job_function =';
        // $field4 = 'job_sub_function =';
        
        // foreach($_POST as $key => $val){
        //     $data[$key] = $val;
        // }

        // $data1 = 'Y';
        // $data2 = $data['id_job_function'];
        // $data_job_function = $this->training_parameter->where($data['job_function'],$table,'id_job_function')->row();
        // $data3 = $data_job_function->job_function;
        // $data4 = $data_job_function->job_sub_function;

        // $dat = $this->training_parameter->subquery($table,$field1,$data1,$field2,$data2,$field3,$data3,$data4)->row();
        // $dat2 = $this->training_parameter->where_job_function($table,$data3,$field3,$data['job_sub_function'],$field4)->row();
        // $ngeif = is_null($dat) ? null : $dat->id_job_function;
        // $ngeif2 = is_null($dat2) ? null : $dat2->id_job_function;
        // // var_dump($ngeif,$ngeif2);die;
        
        // if (is_null($dat) && is_null($dat2)) {
        //     $msg = 'Berhasil Update1';
        //     // $this->training_parameter->update_data($data['id_job_function'],$data['job_sub_function'],$table,$field2,$data_job_function->job_function,'job_function','job_sub_function');
        // } else if($ngeif || $ngeif2) {
        //     $msg = 'Berhasil Update2';
        //     // $this->training_parameter->update_data($data['id_job_function'],$data['job_sub_function'],$table,$field2,$data_job_function->job_function,'job_function','job_sub_function');
        // } else if($ngeif && $ngeif2) {
        //     $msg = 'Berhasil Update3';
        //     // $this->training_parameter->update_data($data['id_job_function'],$data['job_sub_function'],$table,$field2,$data_job_function->job_function,'job_function','job_sub_function');
        // } else if($ngeif != $ngeif2) 
        //     $msg = 'Job Sub Function Ada Yang Sama Harap Di Input Ulang';
        // else if($ngeif == $ngeif2){
        //     $msg = 'Berhasil Update4';
        // } else 
        // {
        //     $msg = 'Gagal Update';
        // }               
        
        // var_dump($msg);die;
        // echo $msg;
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
            if ($key == 'job_sub_function' || $key == 'job_function') {
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
                if ($key == 'job_sub_function') {
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