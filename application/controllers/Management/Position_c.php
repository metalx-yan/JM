<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position_c extends CI_Controller {
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
        $data['title_head'] = 'Position';
        $jabatan = $_SESSION['jabatan'];
        $username = $_SESSION['username'];
        $data['jabatan'] = $jabatan;
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
        $data['access_crud'] = access_crud($this->id);

        if ($jabatan == '101') {
            $get_branch = "SELECT distinct job_title,branch from tb_user where approval1 in (SELECT nip from list_superiors) and
            status = 1 and job_title like '%Head%' and user_name = '$username';";
            $data_branch = $this->db->query($get_branch)->row();
            $get_singkatan = "SELECT distinct singkatan from branch where id_branch = '$data_branch->branch'";
            $data_singkatan = $this->db->query($get_singkatan)->row();
            $get_posisi = "SELECT distinct position_name from posisi where org_group = '$data_singkatan->singkatan' and position_name != '$data_branch->job_title'";
            $data['position'] = $this->db_jobmanagement->query($get_posisi)->result_array();
        }

        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Management/Position_v',$data);
        $this->load->view('Templates/Footer_v');
    } 

    public function get(){
        $query = "SELECT distinct c.position_id, c.position_name from direktorat a
        join organization b
        on a.id_dir = b.direktorat
        join posisi c
        on b.orgid = c.org_id ";
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        // var_dump($data);die;
        
        // $params = '';
        if( $data['direktorat'] && $data['organisasi']  && $data['posisi']){
            $params = (['a.id_dir' => $data['direktorat'], 'b.orgid' => $data['organisasi'], 'c.position_id' => $data['posisi']]);
        } else if($data['direktorat'] && $data['organisasi']) {
            $params = (['a.id_dir' => $data['direktorat'], 'b.orgid' => $data['organisasi']]);
        } else if($data['direktorat']){
            $params = (['a.id_dir' => $data['direktorat']]);
        } else{
            $params = null;
        }
        
        $search = array('c.position_id','c.position_name');

        $where = $params;
        // $where  = array('nama_kategori' => 'Tutorial');
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
      
        header('Content-Type: application/json');
        echo $this->M_Datatables->get_tables_query_job($query,$search,$where,$isWhere);
    }

    public function get_sec()
    {
        $username = $_SESSION['username'];
        $get_branch = "SELECT distinct job_title,branch from tb_user where approval1 in (SELECT nip from list_superiors) and
        status = 1 and job_title like '%Head%' and user_name = '$username';";
        $data_branch = $this->db->query($get_branch)->row();
        $get_singkatan = "SELECT distinct singkatan from branch where id_branch = '$data_branch->branch'";
        $data_singkatan = $this->db->query($get_singkatan)->row();

        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }

        if ($data['posisi'] == '') {
            $where = "";
        } else {
            $where = " and position_name = " . "'".$data['posisi'] . "'";
        }
        

        $query = "SELECT distinct b.position_id, b.position_name,c.job_title,CASE
        WHEN d.status = 0 THEN 'Belum Ada'
        WHEN d.status = 1 THEN 'Admin'
        END status 
        from list_jobs a
        inner join posisi b
        on a.position_id = b.position_id
        inner join job c
        on a.job_name = c.id_job
        left join status_job d
        on a.id = d.job_list_id 
        where position_name in (select distinct position_name from posisi where org_group = '$data_singkatan->singkatan') and a.id = d.job_list_id $where";

        $data = $this->db_jobmanagement->query($query)->result_array();
        $counts  = $this->db_jobmanagement->query($query)->num_rows();

        $callback = array(    
            'draw' => $_POST['draw'], // Ini dari datatablenya    
            'recordsTotal' => $counts,    
            'recordsFiltered'=> $counts,    
            'data' => $data
        );
        // var_dump(json_encode($callback));die;

        header('Content-Type: application/json');
        echo json_encode($callback); // Convert array $callback ke json
    }

    public function modal(){
        $table_list_job = 'list_jobs';
        $table_job = 'job';
        $table_jobfunction = 'job_function';
        $table_jobfamily = 'job_family';
        $table_jobdiscipline = 'job_discipline';
        $table_position = 'posisi';
        $table_career_band = 'job_level';
        $modal = $this->input->post('modal');
        $id_job2 = $this->input->post('id_job');
        $on_join = 'job_function';
        $on_join2 = 'job_family';
        $on_join3 = 'discipline_code';
        $id = $this->input->post('id');
        $position_kode = $this->input->post('position');
        $data['username_login'] = $_SESSION['username'];
        // var_dump($username_login);die;
        $id_list_job = 'id';
        $kode_job_function = 'Y';
        $field_job_function = 'flagactive';
        $field_position_id = 'position_id';
        $field_func_group = 'func_group_id';
        $field_job_disciline_code = 'Discipline_Code !=';
        $field_job_discipline = 'Discipline_Description';
        if (is_null($id_job2)) {
            $data_id = "''";
        } else {
            $data_id = $id_job2;
        }
        
        $query = "SELECT distinct a.id,b.id_job,b.job_title,c.id_job_function,c.job_function,d.id_job_family,d.job_family,e.id as id_job_sub_function,e.job_sub_function,f.id as id_job_sub_family,f.job_sub_family,g.Discipline_Description,g.Discipline_Code,h.id_job_level,h.Grade_Name,b.func_group_id from list_jobs a
        join job b
        on a.job_name = b.id_job
        join job_function c
        on a.job_function = c.id_job_function
        join job_family d
        on a.job_family = d.id_job_family
        join job_sub_function e
        on a.job_sub_function = e.id
        join job_sub_family f
        on a.job_sub_family = f.id
        join job_discipline g
        on a.job_discipline = concat(g.Discipline_Code,'-',g.Discipline_Description)
        join job_level h
        on a.career_band = h.id_job_level
        where a.id = $data_id";

        // $data['id_job'] = $this->training_parameter->where($id_job2,$table_list_job,$id_list_job)->row();
        $data['id_job'] = $this->db_jobmanagement->query($query)->row();
        $data['position'] = $this->training_parameter->where_distinct($position_kode,$table_position,$field_position_id,'position_id','position_name')->row();
        $data['job'] = $this->training_parameter->get_($table_job)->result_array();
        $data['career_band'] = $this->training_parameter->get_($table_career_band)->result_array();
        $data['functional_group'] = $this->training_parameter->where_distinct_not_null_single_where('func_group_id IS NOT NULL',$table_job,'job.func_group_id','job.func_group_id')->result_array();
        // var_dump($data['functional_group']);die;
        // $data['job_function'] = $this->training_parameter->where_groupby_job_function($kode_job_function,$table_jobfunction,$field_job_function)->result_array();
        $data['job_family'] = $this->training_parameter->where_groupby_job_function($kode_job_function,$table_jobfamily,$field_job_function)->result_array();
        // var_dump($data['job_family']);die;
        $data['job_discipline'] = $this->training_parameter->where_groupby_job_discipline(' ',$table_jobdiscipline,$field_job_disciline_code,$field_job_discipline)->result_array();
        $data['job_function'] = $this->training_parameter->where_group_multipleselect($table_jobfunction,$table_jobfunction
        ,'id_job_function', $table_jobfunction,$field_job_function,$kode_job_function)->result_array();

        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $html_modal = $this->load->view('Modal/Modal_position',$data,TRUE);
        echo $html_modal;
        
    }

    public function modal_send(){
        $table_list_job = 'list_jobs';
        $table_job = 'job';
        $table_jobfunction = 'job_function';
        $table_jobfamily = 'job_family';
        $table_jobdiscipline = 'job_discipline';
        $table_position = 'posisi';
        $table_career_band = 'job_level';
        $modal = $this->input->post('modal');
        $id_job2 = $this->input->post('id_job');
        $on_join = 'job_function';
        $on_join2 = 'job_family';
        $on_join3 = 'discipline_code';
        $id = $this->input->post('id');
        $position_kode = $this->input->post('position');
        $data['username_login'] = $_SESSION['username'];
        // var_dump($username_login);die;
        $id_list_job = 'id';
        $kode_job_function = 'Y';
        $field_job_function = 'flagactive';
        $field_position_id = 'position_id';
        $field_func_group = 'func_group_id';
        $field_job_disciline_code = 'Discipline_Code !=';
        $field_job_discipline = 'Discipline_Description';
        if (is_null($id_job2)) {
            $data_id = "''";
        } else {
            $data_id = $id_job2;
        }
        
        $query = "SELECT distinct a.id,b.id_job,b.job_title,c.id_job_function,c.job_function,d.id_job_family,d.job_family,e.id as id_job_sub_function,e.job_sub_function,f.id as id_job_sub_family,f.job_sub_family,g.Discipline_Description,g.Discipline_Code,h.id_job_level,h.Grade_Name,b.func_group_id from list_jobs a
        join job b
        on a.job_name = b.id_job
        join job_function c
        on a.job_function = c.id_job_function
        join job_family d
        on a.job_family = d.id_job_family
        join job_sub_function e
        on a.job_sub_function = e.id
        join job_sub_family f
        on a.job_sub_family = f.id
        join job_discipline g
        on a.job_discipline = concat(g.Discipline_Code,'-',g.Discipline_Description)
        join job_level h
        on a.career_band = h.id_job_level
        where a.id = $data_id";

        // $data['id_job'] = $this->training_parameter->where($id_job2,$table_list_job,$id_list_job)->row();
        $data['id_job'] = $this->db_jobmanagement->query($query)->row();
        $data['position'] = $this->training_parameter->where_distinct($position_kode,$table_position,$field_position_id,'position_id','position_name')->row();
        $data['job'] = $this->training_parameter->get_($table_job)->result_array();
        $data['career_band'] = $this->training_parameter->get_($table_career_band)->result_array();
        $data['functional_group'] = $this->training_parameter->where_distinct_not_null_single_where('func_group_id IS NOT NULL',$table_job,'job.func_group_id','job.func_group_id')->result_array();
        // var_dump($data['functional_group']);die;
        // $data['job_function'] = $this->training_parameter->where_groupby_job_function($kode_job_function,$table_jobfunction,$field_job_function)->result_array();
        $data['job_family'] = $this->training_parameter->where_groupby_job_function($kode_job_function,$table_jobfamily,$field_job_function)->result_array();
        // var_dump($data['job_family']);die;
        $data['job_discipline'] = $this->training_parameter->where_groupby_job_discipline(' ',$table_jobdiscipline,$field_job_disciline_code,$field_job_discipline)->result_array();
        $data['job_function'] = $this->training_parameter->where_group_multipleselect($table_jobfunction,$table_jobfunction
        ,'id_job_function', $table_jobfunction,$field_job_function,$kode_job_function)->result_array();

        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $html_modal = $this->load->view('Modal/Modal_send_position',$data,TRUE);
        echo $html_modal;
        
    }

    function modal_view()
    {
        $table = 'posisi';
        $table_listjob = 'list_jobs';
        $field1 = 'position_id';
        $field_position_name = 'position_name';
        $modal = $this->input->post('modal');
        $position_id = $this->input->post('position');
        $id = $this->input->post('id');
        $data['posisi'] = $this->training_parameter->where_group($table,$field_position_name,
        $field1,$field_position_name,$position_id)->row();
       
        $query = "SELECT distinct a.id,b.id_job,b.job_title,c.id_job_function,c.job_function,d.id_job_family,d.job_family,e.id as id_job_sub_function,e.job_sub_function,f.id as id_job_sub_family,f.job_sub_family,g.Discipline_Description,g.Discipline_Code,h.id_job_level,h.Grade_Name,a.function_group,a.purpose from list_jobs a
        join job b
        on a.job_name = b.id_job
        join job_function c
        on a.job_function = c.id_job_function
        join job_family d
        on a.job_family = d.id_job_family
        join job_sub_function e
        on a.job_sub_function = e.id
        join job_sub_family f
        on a.job_sub_family = f.id
        join job_discipline g
        on a.job_discipline = concat(g.Discipline_Code,'-',g.Discipline_Description)
        left join job_level h
        on a.career_band = h.id_job_level
        where a.position_id = '$position_id' and a.verify_validasi is null";

        $data['id_job'] = $this->db_jobmanagement->query($query)->result_array();
        // var_dump($data['id_job']);die;

        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $html_modal = $this->load->view('Modal/Modal_list_job',$data,TRUE);
        echo $html_modal;
    }

    function save_(){
        $table = 'list_jobs';
        $table_job = 'job';

        $field = 'id';
        $field_job_title = 'job_title';
        $field_job_id = 'id_job';
        $record_job_title = 'job_name';
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        $this->now;
        // var_dump($data);die;
        $now = date('Y-m-d H:i:s'); 
        $data['created_at'] = $now;
        $cek_job_name = $this->training_parameter->where($data[$record_job_title],$table_job,$field_job_id)->num_rows();
        
        $extract = explode('.',$data['job_name']);
        if ($cek_job_name <= 0) {
            # code...
            if (count($extract) == 1) {
                $num_add = '';
                $max = 'max(created_at) created_at';
                $get_max_id = $this->training_parameter->get_select_max($table_job,$max)->row();
                $cek_id_job = $this->training_parameter->where($get_max_id->created_at,$table_job,'created_at')->row();
    
                if (is_null($get_max_id->created_at)) {
                    $data_job_name = array(
                        'id_job' => 1,
                        'job_title' => $data['job_name'],
                        'created_at' => $data['created_at']
                    );
                } else {
                    $data_job_name = array(
                        'id_job' => $cek_id_job->id_job+1,
                        'job_title' => $data['job_name'],
                        'created_at' => $data['created_at']
                    );
                }
                
            } else {
                if (strlen($extract[2]+1) == 1) {
                    $num_add = '00';
                } else if (strlen($extract[2]+1) == 2) {
                    $num_add = '0';
                } else {
                    $num_add = '';
                }
                
                $get_job_name = $this->training_parameter->where($data[$record_job_title],$table_job,'id_job')->row();
        
                $data_job_name = array(
                    'id_job' => $extract[0].'.'.$extract[1].'.'.$num_add.''.strval($extract[2]+1),
                    'job_title' => $get_job_name->job_title,
                );
            }
        } else {
            $data_job_name = ['id_job' => $data['job_name']];
        }
        // var_dump($data_job_name);die;
        

        if ($cek_job_name <= 0) {
            $this->training_parameter->save($data_job_name,$table_job);
            $msg = 'create';
        }else{
            $msg = 'no';

        }
        
        $cek = $this->training_parameter->where_double($table,'position_id','job_name',$data['position_id'],$data['job_name'])->num_rows();
        
        // cek kode 
        // var_dump($data['position_id'], $data['job_name'],$cek,$data['status']);die;
        if($cek > 0) {
            $msg = 'Job tidak boleh sama dalam 1 posisi';

        } else {

            if ($data['form_'] == 'send') {
                // var_dump($data_job_name['job_title']);die;
                if ($data_job_name['id_job'] == $data['job_name']) {
                    $data_create_job = array(
                        'job_name' => $data_job_name['id_job'],
                        'function_group' => $data['function_group'],
                        'job_function' => $data['job_function'],
                        'job_sub_function' => $data['job_sub_function'],
                        'job_family' => $data['job_family'],
                        'job_sub_family' => $data['job_sub_family'],
                        'job_discipline' => $data['job_discipline'],
                        'purpose' => $data['purpose'],
                        'career_band' => $data['career_band'],
                        // 'career_level' => $data['career_level'],
                        // 'grade' => $data['grade'],
                        'created_at' => $data['created_at'],
                        'position_id' => $data['position_id'],
                        'status' => $data['status'],
                        'user_name' => $data['user_name'],
                    );
                    $save = $this->training_parameter->save_send($data_create_job,$table); 

                    $data_create_status_job = array(
                        'job_list_id' => $save,
                        'status' => 0,
                        'created_at' => $data['created_at']
                    );
                    $save = $this->training_parameter->save($data_create_status_job,'status_job'); 
                    
                    if ($save == true) {
                        $msg = 'Berhasil di Simpan';
                    }else{
                        $msg = 'Gagal Menyimpan';
                    }
                } else {
                    $data_create_job_sec = array(
                        'job_name' => $data_job_name['id_job'],
                        'function_group' => $data['function_group'],
                        'job_function' => $data['job_function'],
                        'job_sub_function' => $data['job_sub_function'],
                        'job_family' => $data['job_family'],
                        'job_sub_family' => $data['job_sub_family'],
                        'job_discipline' => $data['job_discipline'],
                        'purpose' => $data['purpose'],
                        'career_band' => $data['career_band'],
                        // 'career_level' => $data['career_level'],
                        // 'grade' => $data['grade'],
                        'created_at' => $data['created_at'],
                        'position_id' => $data['position_id'],
                        'status' => $data['status'],
                        'user_name' => $data['user_name'],
                    );
                    $save = $this->training_parameter->save_send($data_create_job_sec,$table);

                    $data_create_status_job = array(
                        'job_list_id' => $save,
                        'status' => 0,
                        'created_at' => $data['created_at']
                    );
                    $save = $this->training_parameter->save($data_create_status_job,'status_job'); 
                    
                    if ($save == true) {
                        $msg = 'Berhasil di Simpan';
                    }else{
                        $msg = 'Gagal Menyimpan';
                    }
              
                }

            } else {
                # code...
            
                if ($data_job_name['id_job'] == $data['job_name']) {
                    $data_create_job = array(
                        'job_name' => $data_job_name['id_job'],
                        'function_group' => $data['function_group'],
                        'job_function' => $data['job_function'],
                        'job_sub_function' => $data['job_sub_function'],
                        'job_family' => $data['job_family'],
                        'job_sub_family' => $data['job_sub_family'],
                        'job_discipline' => $data['job_discipline'],
                        'purpose' => $data['purpose'],
                        'career_band' => $data['career_band'],
                        // 'career_level' => $data['career_level'],
                        // 'grade' => $data['grade'],
                        'created_at' => $data['created_at'],
                        'position_id' => $data['position_id'],
                        'status' => $data['status'],
                        'user_name' => $data['user_name'],
                    );
                 
                    $save = $this->training_parameter->save_send($data_create_job,$table);

                    $data_create_status_job = array(
                        'job_list_id' => $save,
                        'status' => 0,
                        'created_at' => $data['created_at']
                    );
                    $save = $this->training_parameter->save($data_create_status_job,'status_job'); 
                    
                    if ($save == true) {
                        $msg = 'Berhasil di Simpan';
                    }else{
                        $msg = 'Gagal Menyimpan';
                    }
                } else {
                    $data_create_job_sec = array(
                        'job_name' => $data_job_name['id_job'],
                        'function_group' => $data['function_group'],
                        'job_function' => $data['job_function'],
                        'job_sub_function' => $data['job_sub_function'],
                        'job_family' => $data['job_family'],
                        'job_sub_family' => $data['job_sub_family'],
                        'job_discipline' => $data['job_discipline'],
                        'purpose' => $data['purpose'],
                        'career_band' => $data['career_band'],
                        // 'career_level' => $data['career_level'],
                        // 'grade' => $data['grade'],
                        'created_at' => $data['created_at'],
                        'position_id' => $data['position_id'],
                        'status' => $data['status'],
                        'user_name' => $data['user_name'],
                    );
                    $save = $this->training_parameter->save_send($data_create_job_sec,$table);

                    $data_create_status_job = array(
                        'job_list_id' => $save,
                        'status' => 0,
                        'created_at' => $data['created_at']
                    );
                    $save = $this->training_parameter->save($data_create_status_job,'status_job'); 
                    
                    if ($save == true) {
                        $msg = 'Berhasil di Simpan';
                    }else{
                        $msg = 'Gagal Menyimpan';
                    }
                }

            }

        }
        
        echo $msg;

    }

    function change_job_function(){
        $table = 'job_sub_function';
        $field = 'id_job_function';
        $type = $this->input->post('job_function');

        $get_menu = $this->training_parameter->where($type,$table,$field)->result_array();
        // var_dump($get_menu);die;
        $loop = '';
        foreach($get_menu as $menu):
            $loop .= '<option value="'.$menu['id'].'">'.$menu['job_sub_function'].'</option>';
        endforeach;
        $html = '<option selected>Select Job Sub Function</option>'.$loop.'';

        echo $html;
    }

    function change_job_family(){
        $table = 'job_sub_family';
        $field = 'id_job_family';
        $type = $this->input->post('job_family');
      
        // var_dump($type);die;        
        $get_menu = $this->training_parameter->where($type,$table,$field)->result_array();

        $loop = '';
        foreach($get_menu as $menu):
            $loop .= '<option value="'.$menu['id'].'">'.$menu['job_sub_family'].'</option>';
        endforeach;
        $html = '<option selected>Select Job Sub Family</option>
                        '.$loop.'
                ';

        echo $html;
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
            if ($key == 'job_function' || $key == 'job_sub_function' || $key == 'job_sub_family' ||  $key == 'job_discipline' || $key == 'job_name' || $key == 'job_family' || $key == 'function_group' || $key == 'purpose' || $key == 'career_band') {
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
                if ($key == 'job_function' || $key == 'job_discipline' || $key == 'job_name') {
                    $require = '';
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