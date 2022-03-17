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
            $query = "SELECT distinct a.job_name,a.position_id,c.position_name,d.user_name,d.nama,e.jabatan from list_jobs a
            inner join posisi c
            on a.position_id = c.position_id
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

}
