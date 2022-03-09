<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_m_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('M_Datatables');
        $this->load->model('training_parameter');
        $this->load->library('form_validation');
        $this->db_jobmanagement = $this->load->database('jobmanagement', TRUE);
        access_login();
        $this->id = 'id';
        $this->now = date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
    }

    public function index(){
        $data['title_head'] = 'Job';
        $jabatan = $_SESSION['jabatan'];
        $table_direktorat = 'direktorat'; 
        $table_organization = 'organization'; 
        $table_posisi = 'posisi'; 
        $field_direktorat = 'dir_group_name'; 
        $field_organization = 'organization_name'; 
        $field_posisi = 'position_name'; 
        $select_direktorat1 = 'id_dir';
        $select_direktorat2 = 'dir_group_name';
        $select_organization1 = 'orgid';
        $select_organization2 = 'organization_name';
        $select_position1 = 'position_id';
        $select_position2 = 'position_name';
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['list_menu'] = $this->db->get('menu')->result_array();
        $data['direktorat'] = $this->training_parameter->where_groupby($table_direktorat,$field_direktorat,$select_direktorat1,$select_direktorat2)->result_array();
        $data['organisasi'] = $this->training_parameter->where_groupby($table_organization,$field_organization,$select_organization1,$select_organization2)->result_array();
        $data['posisi'] = $this->training_parameter->where_groupby($table_posisi,$field_posisi,$select_position1,$select_position2)->result_array();
        // var_dump($data['posisi']);
        $data['access_crud'] = access_crud($this->id);
        $table_tingkatpendidikan = 'edu_lvl';
        $field_hide = 'hide';
        $data['tingkat_pendidikan'] = $this->training_parameter->where_null($table_tingkatpendidikan,$field_hide,'id,edu_name')->result_array();
     
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Management/Job_m_v',$data);
        $this->load->view('Templates/Footer_v');
    } 

    public function get(){
        $query = " SELECT distinct a.id,a.position_id, b.position_name,c.id_job,c.job_title from list_jobs a
        join posisi b
        on a.position_id = b.position_id
        join job c
        on a.job_name = c.id_job
        join organization d
        on d.orgid = b.org_id
        join direktorat e
        on d.direktorat = e.id_dir";
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        
        $params = '';
        if( $data['direktorat'] && $data['organisasi']  && $data['posisi']){
            $params = (['e.id_dir' => $data['direktorat'], 'd.orgid' => $data['organisasi'], 'b.position_id' => $data['posisi']]);
        } else if($data['direktorat'] && $data['organisasi']) {
            $params = (['e.id_dir' => $data['direktorat'], 'd.orgid' => $data['organisasi']]);
        } else if($data['direktorat']){
            $params = (['e.id_dir' => $data['direktorat']]);
        } else{
            $params = null;
        }
        $search = array('a.position_id','b.position_name','c.job_title');

        $where = $params;
        // $where  = array('nama_kategori' => 'Tutorial');
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
      
        header('Content-Type: application/json');
        echo $this->M_Datatables->get_tables_query_job($query,$search,$where,$isWhere);
    }

    function save_(){
        $table = 'tujuan_jabatan';
        $field = 'id';
        $save = '';
      
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        // cek kode 
        $cek = $this->training_parameter->where($data['id'],$table,$field)->num_rows();
        if ($cek > 0) {
            $save = $this->training_parameter->update($data['id'],$data,$table,$field);
        }else{
            $save = $this->training_parameter->save($data,$table);
            // $del = $this->training_parameter->delete_($job_f,$table,$field2,$field3,$kode_notnull,$falseNull,$field,$kode);
        }
        
        if ($save == true) {
            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
        }

        echo $msg;
    }

    function save_multiple_(){
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        // var_dump($data);die;
        $this->training_parameter->delete_single($data['job_list_id'],$_POST['eksekutor'],'job_list_id');
        // $this->training_parameter->delete_single($data['job_list_id'],$_POST['eksekutor'],'job_list_id');
        
        if ($data['eksekutor'] == 'kualifikasi') {
            $result = [];
            for ($i=0; $i < count($data['syarat']); $i++) { 
                $result[$i]['tingkat_pendidikan'] = $data['tingkat_pendidikan'][$i];
                $result[$i]['jurusan'] = $data['jurusan'][$i];
                $result[$i]['persyaratan_khusus'] = $data['syarat'][$i];
                $result[$i]['job_list_id'] = $data['job_list_id'];
                $result[$i]['work_experience'] = implode('-',$data['description']);
            }
            
                $save = $this->db_jobmanagement->insert_batch($_POST['eksekutor'],$result);

        } else {
            foreach($_POST['field_'.$_POST['eksekutor']] as $key => $val){
                $data_arr[$_POST['eksekutor']] = $val;
                $data_arr['job_list_id'] = $_POST['job_list_id'];
                $save = $this->training_parameter->save($data_arr,$_POST['eksekutor']);
            }
            
        }
        // var_dump($save);die;

        if ($data['eksekutor'] == 'kualifikasi') {
            if ($save == true) {
                $msg = 'Berhasil di Simpan';
            }else{
                $msg = 'Gagal Menyimpan';
            }
        } else if (count($_POST['field_'.$_POST['eksekutor']]) > 0 ) {
            if ($save == true) {
                $msg = 'Berhasil di Simpan';
            }else{
                $msg = 'Gagal Menyimpan';
            }
        }else {
            $msg = 'Field Harus di Isi';
        }
        

        echo $msg;
    }

    function modal_edit()
    {
        $table = 'job';
        $table_posisi = 'posisi';
        $table_listjob = 'list_jobs';
        $table_tujuan_jabatan = 'tujuan_jabatan';
        $table_kewenangan = 'kewenangan';
        $table_kompetensi = 'kompetensi';
        $table_kpi = 'kpi';
        $table_kualifikasi = 'kualifikasi';
        $table_workexperience = 'work_experience';
        $table_tingkatpendidikan = 'edu_lvl';
        $on1 = 'job_name';
        $on2 = 'id_job';
        $field_id = 'list_jobs.id';
        $on3 = 'position_id';
        $on4 = 'job_list_id';
        $on5 = 'id';
        $field_hide = 'hide';
        $modal = $this->input->post('modal');
        $position_id = $this->input->post('position');
        $id = $this->input->post('id');
        $tujuan = $this->input->post('tujuan');
        $tugas = $this->input->post('tugas');
        $kewenangan = $this->input->post('kewenangan');
        $kompetensi = $this->input->post('kompetensi');
        $kpi = $this->input->post('kpi');
        $kualifikasi = $this->input->post('kualifikasi');
        
        $data['id_job'] = $this->training_parameter->join_2_distinct(
            $table_listjob,$table_posisi,$table,$on3,$on3,$on1,$on2
            ,$field_id,$position_id,'list_jobs.id,job.id_job,job.job_title,posisi.position_name'
        )->row();
        $data['work_experience'] = $this->training_parameter->get_($table_workexperience)->result_array();
        $data['tingkat_pendidikan'] = $this->training_parameter->where_null($table_tingkatpendidikan,$field_hide,'id,edu_name')->result_array();

        $data['tujuan_id'] = $this->training_parameter->join_distinct(
           $table_tujuan_jabatan,$table_listjob,$on4,$on5,'list_jobs.id',$position_id,'tujuan_jabatan.id id_tujuan_jabatan,tujuan_jabatan.tujuan,list_jobs.id'
        )->row();
        $data['kewenangan_id'] = $this->training_parameter->join_distinct(
            $table_kewenangan,$table_listjob,$on4,$on5,'list_jobs.id',$position_id,'kewenangan.id id_kewenangan,kewenangan.kewenangan,list_jobs.id'
         )->result_array();

        $data['kompetensi_id'] = $this->training_parameter->join_distinct(
        $table_kompetensi,$table_listjob,$on4,$on5,'list_jobs.id',$position_id,'kompetensi.id id_kompetensi,kompetensi.kompetensi,list_jobs.id'
        )->result_array();

        $data['kpi_id'] = $this->training_parameter->join_distinct(
            $table_kpi,$table_listjob,$on4,$on5,'list_jobs.id',$position_id,'kpi.id id_kpi,kpi.kpi,list_jobs.id'
            )->result_array();
        
        $query = "SELECT a.id id_kualifikasi,a.persyaratan_khusus, b.id id_tingkat_pendidikan, b.edu_name, c.id id_jurusan, c.edu_mjr,a.work_experience from kualifikasi a
        join edu_lvl b
        on a.tingkat_pendidikan = b.id
        join edu_mjr c
        on a.jurusan = c.id
        where a.job_list_id = $position_id ";

        $data['kualifikasi_id'] = $this->db_jobmanagement->query($query)->result_array();

        $data_kualifikasi = '';
        foreach ($data['kualifikasi_id'] as $key => $value) {
            $data_kualifikasi = explode('-',$value['work_experience']);
        }
        
        if ($data_kualifikasi == '') {
            $data_kual = array();
        } else {
            $data_kual = $data_kualifikasi;
        }

        $data['data_description'] = $data_kual;
        
        // var_dump($data['data_description']);die;

        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $data['tujuan'] = $tujuan;
        $data['tugas'] = $tugas;
        $data['kewenangan'] = $kewenangan;
        $data['kompetensi'] = $kompetensi;
        $data['kpi'] = $kpi;
        $data['kualifikasi'] = $kualifikasi;
        $html_modal = $this->load->view('Modal/Modal_edit_job',$data,TRUE);
        echo $html_modal;
    }

    function change_direktorat(){
        $table = 'organization';
        $field = 'direktorat';
        $kode = $this->input->post('direktorat');
        $select1 = 'orgid';
        $select2 = 'organization_name';
        
        $get_data = $this->training_parameter->where_distinct($kode,$table,$field,$select1,$select2)->result_array();
        // var_dump($get_data);die;
        $loop = '';
        foreach($get_data as $data):
            $loop .= '<option value="'.$data[$select1].'">'.$data[$select2].'</option>';
        endforeach;
        $html = '<option value="" selected>Select Organisasi</option>'.$loop.'';

        echo $html;
    }

    function change_organisasi(){
        $table = 'posisi';
        $field = 'org_id';
        $kode = $this->input->post('organisasi');
        $select1 = 'position_id';
        $select2 = 'position_name';
        
        $get_data = $this->training_parameter->where_distinct($kode,$table,$field,$select1,$select2)->result_array();
        // var_dump($get_data);die;
        $loop = '';
        foreach($get_data as $data):
            $loop .= '<option value="'.$data[$select1].'">'.$data[$select2].'</option>';
        endforeach;
        $html = '<option value="" selected>Select Posisi</option>'.$loop.'';

        echo $html;
    }

    function change_jurusan(){
        $table = 'edu_mjr';
        $field = 'edu_lvl';
        $kode = $this->input->post('tingkat_pendidikan');
        $select1 = 'id';
        $select2 = 'edu_mjr';
        
        $get_data = $this->training_parameter->where_distinct($kode,$table,$field,$select1,$select2)->result_array();
        // var_dump($get_data);die;
        $loop = '';
        foreach($get_data as $data):
            $loop .= '<option value="'.$data[$select1].'">'.$data[$select2].'</option>';
        endforeach;
        $html = '<option value="" selected>Select Jurusan</option>'.$loop.'';

        echo $html;
    }

    function validate(){
        $this->form_validation->set_error_delimiters('', '');
        foreach($_POST as $key => $val){
            if ($key == 'tujuan') {
                $require = 'required';
            }elseif ($key == 'field_kewenangan' || $key == 'field_kompetensi' || $key == 'field_kpi'  || $key == 'id' ) {
                $require = '';
            }else{
                $require = 'required';
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

    function validate_kual(){
        $json = array(
            'action' => 'ok',
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
    }

    function validate_keyup(){
        $this->form_validation->set_error_delimiters('', '');
        foreach($_POST as $key => $val){
            if ($key == $key) {
                if ($key == 'tujuan') {
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