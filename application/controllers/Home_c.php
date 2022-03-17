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
        $this->db_jobmanagement = $this->load->database('jobmanagement', TRUE);
        access_login();
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
            $query = "SELECT distinct a.id, a.job_name,g.job_title,a.position_id,c.position_name,d.user_name,d.nama,e.jabatan from list_jobs a
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
            where b.status = 0";

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
        } else {
            $callback = array(    
                'draw' => 1, // Ini dari datatablenya    
                'recordsTotal' => 0,    
                'recordsFiltered'=> 0,    
                'data' => []
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
        $table_job = 'job';
        $table_jobfunction = 'job_function';
        $table_jobfamily = 'job_family';
        $table_jobdiscipline = 'job_discipline';
        $modal = $this->input->post('modal');
        $table_career_band = 'job_level';
       
        $kode_job_function = 'Y';
        $field_job_function = 'flagactive';
        $field_job_disciline_code = 'Discipline_Code !=';
        $field_job_discipline = 'Discipline_Description';
       
        $query = "SELECT distinct a.id,b.id_job,b.job_title,c.id_job_function,c.job_function,d.id_job_family,d.job_family,e.id as id_job_sub_function,e.job_sub_function,f.id as id_job_sub_family,f.job_sub_family,g.Discipline_Description,g.Discipline_Code,z.id_job_level,z.Grade_Name,a.function_group,a.purpose from list_jobs a
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
        where j.status = 0 and a.id = '$job_id'";

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
        $html_modal = $this->load->view('Modal/Modal_validasi_job',$data,TRUE);
        echo $html_modal;
    }

}
