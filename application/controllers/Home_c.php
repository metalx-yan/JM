<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_c extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('M_Datatables');
        $this->load->model('training_parameter');
        $this->load->library('form_validation');
        $this->db_jobmanagement = $this->load->database('jobmanagement', TRUE);
        access_login();
        $this->now = date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
    }

    public function index()
    {
        $data['title_head'] = 'Home';
        $jabatan = $_SESSION['jabatan'];
        $username = $_SESSION['username'];
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['username'] = $username;
        $data['jabatan'] = $jabatan;

        
        $this->load->view('Templates/Header_v', $data);
        $this->load->view('Templates/Navbar_v', $data);
        $this->load->view('Homev');
        $this->load->view('Templates/Footer_v');
    }

    public function get()
    {
        $jabatan = $_SESSION['jabatan'];
        

        if ($jabatan == 100) {
            # code...
            // , CASE WHEN b.status = 0 THEN 'Belum Ada' WHEN b.status = 1 THEN 'Admin' END status_job 
            $query = "SELECT distinct a.id, a.job_name,g.job_title,a.position_id,c.position_name,d.user_name,d.nama,e.jabatan, $jabatan as role
            from list_jobs a
            inner join posisi c
            on a.position_id = c.position_id
            inner join job g
            on a.job_name = g.id_job
            inner join db_jrms.tb_user d
            on a.user_name = d.user_name
            inner join db_jrms.jrms_user_access e
            on a.user_name = e.user_name
            left join status_job b
            on a.id = b.job_list_id
            where a.id = b.job_list_id";

            $data = $this->db_jobmanagement->query($query)->result_array();
            $counts  = $this->db_jobmanagement->query($query)->num_rows();
            
            $callback = array(    
                'draw' => 1, // Ini dari datatablenya    
                'recordsTotal' => $counts,    
                'recordsFiltered'=> $counts,    
                'data' => $data
            );
            // var_dump(json_encode($callback));die;

            header('Content-Type: application/json');
            echo json_encode($callback); // Convert array $callback ke json

        } else if ($jabatan == 101) {
            
            $username = $_SESSION['username'];
            $get_branch = "SELECT distinct job_title,branch from tb_user where approval1 in (SELECT nip from list_superiors) and
            status = 1 and job_title like '%Head%' and user_name = '$username';";
            $data_branch = $this->db->query($get_branch)->row();
            $get_singkatan = "SELECT distinct singkatan from branch where id_branch = '$data_branch->branch'";
            $data_singkatan = $this->db->query($get_singkatan)->row();
            $query = "SELECT distinct a.id, a.job_name,g.job_title,a.position_id,c.position_name,d.user_name,d.nama,e.jabatan, $jabatan as role
            from list_jobs a
            inner join posisi c
            on a.position_id = c.position_id
            inner join job g
            on a.job_name = g.id_job
            inner join db_jrms.tb_user d
            on a.user_name = d.user_name
            inner join db_jrms.jrms_user_access e
            on a.user_name = e.user_name
            left join status_job b
            on a.id = b.job_list_id
            where position_name in (select distinct position_name from posisi where org_group = '$data_singkatan->singkatan') and a.id = b.job_list_id";

            $data = $this->db_jobmanagement->query($query)->result_array();
            $counts  = $this->db_jobmanagement->query($query)->num_rows();
            $callback = array(    
                'draw' => 1, // Ini dari datatablenya    
                'recordsTotal' => $counts,    
                'recordsFiltered'=> $counts,    
                'data' => $data
            );
            // var_dump(json_encode($callback));die;

            header('Content-Type: application/json');
            echo json_encode($callback); // Convert array $callback ke json
        }

    }

   

    function modal_view()
    {
        $job_id = $this->input->post('job');
        $id = $this->input->post('id');
        $approve = $this->input->post('approve');
        $table_job = 'job';
        $table_jobfunction = 'job_function';
        $table_jobfamily = 'job_family';
        $table_jobdiscipline = 'job_discipline';
        $modal = $this->input->post('modal');
        $table_career_band = 'job_level';
       
        $data['username_login'] = $_SESSION['username'];
        $kode_job_function = 'Y';
        $field_job_function = 'flagactive';
        $field_job_disciline_code = 'Discipline_Code !=';
        $field_job_discipline = 'Discipline_Description';
       
        $query = "SELECT distinct a.id,b.id_job,b.job_title,c.id_job_function,c.job_function,d.id_job_family,d.job_family,e.id as id_job_sub_function,e.job_sub_function,f.id as id_job_sub_family,f.job_sub_family,g.Discipline_Description,g.Discipline_Code,z.id_job_level,z.Grade_Name,a.function_group,a.purpose,j.status status_job from list_jobs a
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
        join job_level z
        on a.career_band = z.id_job_level
        inner join db_jrms.tb_user h
        on a.user_name = h.user_name
        inner join db_jrms.jrms_user_access i
        on a.user_name = i.user_name
        left join status_job j
        on a.id = j.job_list_id
        where  a.id = '$job_id'";

        $data['id_job'] = $this->db_jobmanagement->query($query)->row();

        $data['job'] = $this->training_parameter->get_($table_job)->result_array();
        $data['functional_group'] = $this->training_parameter->where_distinct_not_null_single_where('func_group_id IS NOT NULL',$table_job,'job.func_group_id','job.func_group_id')->result_array();
        $data['job_family'] = $this->training_parameter->where_groupby_job_function($kode_job_function,$table_jobfamily,$field_job_function)->result_array();
        $data['job_discipline'] = $this->training_parameter->where_groupby_job_discipline(' ',$table_jobdiscipline,$field_job_disciline_code,$field_job_discipline)->result_array();
        $data['job_function'] = $this->training_parameter->where_group_multipleselect($table_jobfunction,$table_jobfunction
        ,'id_job_function', $table_jobfunction,$field_job_function,$kode_job_function)->result_array();
        $data['career_band'] = $this->training_parameter->get_($table_career_band)->result_array();
 
        // var_dump($data['id_job']);die;

        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $data['approve'] = $approve;
        $html_modal = $this->load->view('Modal/Modal_validasi_job',$data,TRUE);
        echo $html_modal;
    }

    function approve() {
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        $status_job_change = ['status' => 1];
        $save = $this->training_parameter->update($data['id'],$status_job_change,'status_job','job_list_id'); 

        if ($save == true) {

            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
        }

        echo $msg;
    }

    function save(){
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
        $now = date('Y-m-d H:i:s'); 
        $data['created_at'] = $now;
        $cek_job_name = $this->training_parameter->where($data[$record_job_title],$table_job,$field_job_id)->num_rows();
        
        $extract = explode('.',$data['job_name']);
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

        if ($cek_job_name <= 0) {
            $this->training_parameter->save($data_job_name,$table_job);
            $msg = 'create';
        }else{
            $msg = 'no';

        }

        $get_before_id = $this->training_parameter->where($data['before_id'],$table,'id')->row();

        // $cek = $this->training_parameter->where_double($table,'position_id','job_name',$get_before_id->position_id,$data['job_name'])->num_rows();
    
        // if($cek > 0) {
        //     $msg = 'Job tidak boleh sama';

        // } else {
            // $get_before_id = $this->training_parameter->where($data['before_id'],$table,'id')->row();
        //    var_dump($data);die;
            if ($data_job_name['job_title'] == $data['job_name']) {
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
                        'position_id' => $get_before_id->position_id,
                        'status' => $data['status'],
                        'user_name' => $get_before_id->user_name,
                        'before_id' => $get_before_id->id,
                    );
                    
                    $saving = $this->training_parameter->save_send($data_create_job,$table);
                    
                    $status_job_change = ['job_list_id' => $saving];
                    $save = $this->training_parameter->update($get_before_id->id,$status_job_change,'status_job','job_list_id'); 
                    $verify_vals = ['verify_validasi' => 'YES'];
                    $this->training_parameter->update($get_before_id->id,$verify_vals,$table,'id'); 
                    $verify_vals = ['verify_validasi' => NULL];
                    $this->training_parameter->update('YES',$verify_vals,$table,'verify_validasi !='); 
                    $verify_valaaa = ['edited_by' => $_SESSION['username']];
                    $this->training_parameter->update($saving,$verify_valaaa,$table,'id'); 
                    if ($save == true) {
                    
                        $msg = 'Berhasil di Simpan';
                    }else{
                        $msg = 'Gagal Menyimpan';
                    }
            } else {
                // $get_before_id = $this->training_parameter->where($data['before_id'],$table,'id')->row();

                $data_create_job_sec = array(
                    'job_name' => $data['job_name'],
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
                    'position_id' => $get_before_id->position_id,
                    'status' => $data['status'],
                    'user_name' => $get_before_id->user_name,
                    'before_id' => $get_before_id->id,
                );
               
                $saving = $this->training_parameter->save_send($data_create_job_sec,$table);
                
                $status_job_change = ['job_list_id' => $saving];
                $save = $this->training_parameter->update($get_before_id->id,$status_job_change,'status_job','job_list_id'); 
                $verify_vals = ['verify_validasi' => 'YES'];
                $this->training_parameter->update($get_before_id->id,$verify_vals,$table,'id'); 
                $verify_vals = ['verify_validasi' => NULL];
                $this->training_parameter->update('YES',$verify_vals,$table,'verify_validasi !='); 
                $verify_valaaa = ['edited_by' => $_SESSION['username']];
                $this->training_parameter->update($saving,$verify_valaaa,$table,'id'); 
                if ($save == true) {

                    $msg = 'Berhasil di Simpan';
                }else{
                    $msg = 'Gagal Menyimpan';
                }
               
            // }


        }
        
        echo $msg;

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
