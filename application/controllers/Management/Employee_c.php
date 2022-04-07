<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_c extends CI_Controller {
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
        $data['title_head'] = 'Employee';
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
        $this->load->view('Management/Employee_v',$data);
        $this->load->view('Templates/Footer_v');
    } 

    public function get(){
        $query = "SELECT DISTINCT
        q.user_name,
        q.nama,
        CASE
            
            WHEN q.STATUS = 1 THEN
            'Dibaca' ELSE 'Belum Dibaca' 
            END status_job,
            q.singkatan,
            p.position_name,w.job_title,w.id_job
        FROM
            (
        SELECT
            a.user_name,
            a.nama,
            b.STATUS,
            c.position_id,
            g.singkatan,
            c.job_name 
        FROM
            db_jrms.tb_user a
            LEFT JOIN mapping_job b ON a.user_name = b.user_name
            LEFT JOIN list_jobs c ON b.job_list_id = c.id
            INNER JOIN db_jrms.branch g ON a.branch = g.id_branch 
        WHERE
            a.STATUS = 1 
            ) q
            LEFT JOIN (
        SELECT DISTINCT
            x.position_id,
            x.position_name,
            z.direktorat,
            x.org_id 
        FROM
        posisi x
        INNER JOIN job k ON x.job_id = k.id_job
        INNER JOIN organization z ON z.orgid = x.org_id 
        ) p ON q.position_id = p.position_id
        LEFT JOIN ( SELECT DISTINCT k.id_job, k.job_title FROM posisi x INNER JOIN job k ON x.job_id = k.id_job ) w ON q.job_name = w.id_job";

        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        
        $params = '';
        if( $data['direktorat'] && $data['organisasi']  && $data['posisi']){
            $params = (['p.direktorat' => $data['direktorat'], 'p.org_id' => $data['organisasi'], 'p.position_id' => $data['posisi']]);
        } else if($data['direktorat'] && $data['organisasi']) {
            $params = (['p.direktorat' => $data['direktorat'], 'p.org_id' => $data['organisasi']]);
        } else if($data['direktorat']){
            $params = (['p.direktorat' => $data['direktorat']]);
        } else{
            $params = null;
        }
        $search = array('q.user_name', 'q.nama','q.singkatan' , 'p.position_name');

        $where = $params;
        // $where  = array('nama_kategori' => 'Tutorial');
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
      
        header('Content-Type: application/json');
        echo $this->M_Datatables->get_tables_query_job($query,$search,$where,$isWhere);
    }

    function modal_view()
    {
        $modal = $this->input->post('modal');
        $id = $this->input->post('id');
        $id_job = $this->input->post('job');
        $table_tugas_tanggung_jawab = 'tugas_tanggung_jawab';
        $table_kewenangan = 'kewenangan';
        $table_kompetensi = 'kompetensi';
        $table_kpi = 'kpi';
        $table_listjob = 'list_jobs';

        $data['tanggung_jawab'] = $this->training_parameter->join($id_job,$table_listjob,'job_name',$table_tugas_tanggung_jawab,'job_list_id','id','tugas_tanggung_jawab.description')->result_array();
        
        $data['kewenangan'] = $this->training_parameter->join($id_job,$table_listjob,'job_name',$table_kewenangan,'job_list_id','id','kewenangan.kewenangan')->result_array();

        $data['kompetensi'] = $this->training_parameter->join($id_job,$table_listjob,'job_name',$table_kompetensi,'job_list_id','id','kompetensi.kompetensi')->result_array();

        $data['kpi'] = $this->training_parameter->join($id_job,$table_listjob,'job_name',$table_kpi,'job_list_id','id','kpi.kpi')->result_array();

        $field_id_job = $this->training_parameter->where($id_job,$table_listjob,'job_name')->row();

        if(is_null($field_id_job)){
            $data_ = "''";
        } else {
            $data_ = $field_id_job->id;
        }
        // var_dump($data_);die;

        $query_pengalaman_kerja = "SELECT
        kualifikasi.id, z.description   
        FROM
            numbers INNER JOIN kualifikasi
            ON CHAR_LENGTH(kualifikasi.work_experience)
            -CHAR_LENGTH(REPLACE(kualifikasi.work_experience, '-', ''))>=numbers.n-1
            join work_experience z
            on SUBSTRING_INDEX(SUBSTRING_INDEX(kualifikasi.work_experience, '-', numbers.n), '-', -1) = z.id
        where kualifikasi.job_list_id = $data_
        group by z.id
        ORDER BY
            id, n";

        $data['pengalaman_kerja'] = $this->db_jobmanagement->query($query_pengalaman_kerja)->result_array();

        $data['modal_title'] = $modal;
        $data['id'] = $id;
       
        $html_modal = $this->load->view('Modal/Modal_view_emp_job',$data,TRUE);
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
