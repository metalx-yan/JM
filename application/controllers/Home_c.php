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
        $this->id = 'id';
        $this->now = date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
    }

    public function index()
    {
        $data['title_head'] = 'Home';
        $jabatan = $_SESSION['jabatan'];
        $username = $_SESSION['username'];
        $data['username'] = $username;
        $username = $_SESSION['username'];
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
        $data['jabatan'] = $jabatan;
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
        
        $this->load->view('Templates/Header_v', $data);
        $this->load->view('Templates/Navbar_v', $data);
        $this->load->view('Homev');
        $this->load->view('Templates/Footer_v');
    }

    public function get()
    {
        $jabatan = $_SESSION['jabatan'];
        if ($jabatan == '100') {
            $username = $_SESSION['username'];

            # code...
            // , CASE WHEN b.status = 0 THEN 'Belum Ada' WHEN b.status = 1 THEN 'Admin' END status_job 
            $query = "SELECT distinct a.id, a.job_name,g.job_title,a.position_id,c.position_name,d.user_name,d.nama,e.jabatan,b.status, z.status status_akhir, $jabatan as role,null mapping_by,null nip,null status_del_read
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
            left join status_job_profile z
            on a.id = z.job_list_id
            where a.id = b.job_list_id and e.jabatan != '100' and d.status ='1'
            union
            SELECT distinct a.id, a.job_name,g.job_title,a.position_id,c.position_name,d.user_name,d.nama,e.jabatan , k.status status_individu, null,null,u.mapping_by, u.user_name nip,'read' status_del_read
            from list_jobs a
            inner join posisi c
            on a.position_id = c.position_id
            inner join job g
            on a.job_name = g.id_job
            inner join db_jrms.tb_user d
            on a.user_name = d.user_name
            inner join db_jrms.jrms_user_access e
            on a.user_name = e.user_name						
            left join (select x.id,z.nama,x.status,x.job_list_id,z.status status_aktif from status_job x
            join db_jrms.tb_user z
            on x.approved_by = z.user_name)  b
            on a.id = b.job_list_id
            left join status_job_profile k
            on a.id = k.job_list_id
            left join mapping_job u
            on a.id = u.job_list_id
            where b.status_aktif = 1 and u.user_name = '$username' 
            union
            SELECT distinct a.id, a.job_name,g.job_title,a.position_id,c.position_name,d.user_name,d.nama,e.jabatan , k.status status_individu, null,null,u.mapping_by, u.user_name nip,'delegate' status_del_read
            from list_jobs a
            inner join posisi c
            on a.position_id = c.position_id
            inner join job g
            on a.job_name = g.id_job
            inner join db_jrms.tb_user d
            on a.user_name = d.user_name
            inner join db_jrms.jrms_user_access e
            on a.user_name = e.user_name						
            left join (select x.id,z.nama,x.status,x.job_list_id,z.status status_aktif from status_job x
            join db_jrms.tb_user z
            on x.approved_by = z.user_name)  b
            on a.id = b.job_list_id
            left join status_job_profile k
            on a.id = k.job_list_id
            left join mapping_job u
            on a.id = u.job_list_id
            where b.status_aktif = 1 and  k.delegate_to = '$username'
            ";

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

        } else if ($jabatan == '101') {
            
            $username = $_SESSION['username'];
            $get_branch = "SELECT distinct job_title,branch from tb_user where approval1 in (SELECT nip from list_superiors) and
            status = 1 and job_title like '%Head%' and user_name = '$username';";
            $data_branch = $this->db->query($get_branch)->row();
            $get_singkatan = "SELECT distinct singkatan from branch where id_branch = '$data_branch->branch'";
            $data_singkatan = $this->db->query($get_singkatan)->row();
            $query = "SELECT distinct a.id, a.job_name,g.job_title,a.position_id,c.position_name,d.user_name,b.nama,e.jabatan,b.status, k.status status_akhir ,$jabatan as role
            from list_jobs a
            inner join posisi c
            on a.position_id = c.position_id
            inner join job g
            on a.job_name = g.id_job
            inner join db_jrms.tb_user d
            on a.user_name = d.user_name
            inner join db_jrms.jrms_user_access e
            on a.user_name = e.user_name						
            left join (select x.id,z.nama,x.status,x.job_list_id,z.status status_aktif from status_job x
            join db_jrms.tb_user z
            on x.approved_by = z.user_name)  b
            on a.id = b.job_list_id
            left join status_job_profile k
            on a.id = k.job_list_id
            where position_name in (select distinct position_name from posisi where org_group = '$data_singkatan->singkatan') and b.status = 1 and b.status_aktif = 1";

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
            $username = $_SESSION['username'];
            
            $query = "SELECT distinct a.id, a.job_name,g.job_title,a.position_id,c.position_name,d.user_name,d.nama , k.status status_individu, u.mapping_by, u.user_name nip,'read' status_del_read
            from list_jobs a
            inner join posisi c
            on a.position_id = c.position_id
            inner join job g
            on a.job_name = g.id_job
            inner join db_jrms.tb_user d
            on a.user_name = d.user_name
            inner join db_jrms.jrms_user_access e
            on a.user_name = e.user_name						
            left join (select x.id,z.nama,x.status,x.job_list_id,z.status status_aktif from status_job x
            join db_jrms.tb_user z
            on x.approved_by = z.user_name)  b
            on a.id = b.job_list_id
            left join status_job_profile k
            on a.id = k.job_list_id
            left join mapping_job u
            on a.id = u.job_list_id
            where b.status_aktif = 1 and u.user_name = '$username' 
            union
            SELECT distinct a.id, a.job_name,g.job_title,a.position_id,c.position_name,d.user_name,d.nama , k.status status_individu, u.mapping_by, u.user_name nip,'delegate' status_del_read
            from list_jobs a
            inner join posisi c
            on a.position_id = c.position_id
            inner join job g
            on a.job_name = g.id_job
            inner join db_jrms.tb_user d
            on a.user_name = d.user_name
            inner join db_jrms.jrms_user_access e
            on a.user_name = e.user_name						
            left join (select x.id,z.nama,x.status,x.job_list_id,z.status status_aktif from status_job x
            join db_jrms.tb_user z
            on x.approved_by = z.user_name)  b
            on a.id = b.job_list_id
            left join status_job_profile k
            on a.id = k.job_list_id
            left join mapping_job u
            on a.id = u.job_list_id
            where b.status_aktif = 1 and  k.delegate_to = '$username'";

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
        $approve_job_profile = $this->input->post('approve_job_profile');
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
       
        $query = "SELECT distinct a.id,b.id_job,b.job_title,c.id_job_function,c.job_function,d.id_job_family,d.job_family,e.id as id_job_sub_function,e.job_sub_function,f.id as id_job_sub_family,f.job_sub_family,g.Discipline_Description,g.Discipline_Code,z.id_job_level,z.Grade_Name,a.function_group,a.purpose,j.status status_job, x.status status_akhir from list_jobs a
        inner join job b
        on a.job_name = b.id_job
        inner join job_function c
        on a.job_function = c.id_job_function
        inner join job_family d
        on a.job_family = d.id_job_family
        inner join job_sub_function e
        on a.job_sub_function = e.id
        inner join job_sub_family f
        on a.job_sub_family = f.id
        inner join job_discipline g
        on a.job_discipline = concat(g.Discipline_Code,'-',g.Discipline_Description)
        inner join job_level z
        on a.career_band = z.id_job_level
        inner join db_jrms.tb_user h
        on a.user_name = h.user_name
        inner join db_jrms.jrms_user_access i
        on a.user_name = i.user_name
        left join status_job j
        on a.id = j.job_list_id
        left join status_job_profile x
        on a.id = x.job_list_id
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
        $data['approve_job_profile'] = $approve_job_profile;
        $html_modal = $this->load->view('Modal/Modal_validasi_job',$data,TRUE);
        echo $html_modal;
    }

    function read_save(){
      
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        $data_update = ['status' => $data['status']];
        // cek kode 
        $save = $this->training_parameter->update($data['id'],$data_update,'mapping_job','job_list_id');
        
        if ($save == true) {
            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
        }

        echo $msg;
    }

    function read_job()
    {
        $id_job = $this->input->post('job');
        $table = 'job';
        $table_posisi = 'posisi';
        $table_tugas_tanggung_jawab = 'tugas_tanggung_jawab';
        $table_kewenangan = 'kewenangan';
        $table_kompetensi = 'kompetensi';
        $modal = $this->input->post('modal');
        $table_listjob = 'list_jobs';
        $on1 = 'job_name';
        $on2 = 'id_job';
        $field_id = 'list_jobs.id';
        $on3 = 'position_id';
        $id = $this->input->post('id');
        
        $data['job_profile'] = $this->training_parameter->where($id_job,'mapping_job','job_list_id')->row();

        $data['data_job'] = $this->training_parameter->join_2_distinct(
            $table_listjob,$table_posisi,$table,$on3,$on3,$on1,$on2
            ,$field_id,$id_job,'list_jobs.id,job.id_job,job.job_title,posisi.position_name'
        )->row();

        $data['tanggung_jawab'] = $this->training_parameter->join($id_job,$table_listjob,'id',$table_tugas_tanggung_jawab,'job_list_id','id','tugas_tanggung_jawab.description')->result_array();

        $data['kewenangan'] = $this->training_parameter->join($id_job,$table_listjob,'id',$table_kewenangan,'job_list_id','id','kewenangan.kewenangan')->result_array();

        $data['kompetensi'] = $this->training_parameter->join($id_job,$table_listjob,'id',$table_kompetensi,'job_list_id','id','kompetensi.kompetensi')->result_array();

        $query_pengalaman_kerja = "SELECT
        kualifikasi.id, z.description   
        FROM
            numbers INNER JOIN kualifikasi
            ON CHAR_LENGTH(kualifikasi.work_experience)
            -CHAR_LENGTH(REPLACE(kualifikasi.work_experience, '-', ''))>=numbers.n-1
            join work_experience z
            on SUBSTRING_INDEX(SUBSTRING_INDEX(kualifikasi.work_experience, '-', numbers.n), '-', -1) = z.id
        where kualifikasi.job_list_id = $id_job
        group by z.id
        ORDER BY
            id, n";

        $query = "SELECT distinct a.id id_list_job,c.id_job,c.job_title,b.position_name, d.Discipline_Description,
        e.job_family,f.job_sub_family,g.job_function,h.job_sub_function
        from list_jobs a
        join posisi b
        on a.position_id = b.position_id
        join job c
        on a.job_name = c.id_job
        join job_discipline d
        on a.job_discipline = concat(d.Discipline_Code, '-' , d.Discipline_Description)
        join job_family e
        on a.job_family = e.id_job_family
        join job_sub_family f
        on a.job_sub_family = f.id
        join job_function g
        on a.job_function = g.id_job_function
        join job_sub_function h
        on a.job_sub_function = h.id
        where a.id = $id_job";
        $data['data_profile'] = $this->db_jobmanagement->query($query)->row();
        $data['pengalaman_kerja'] = $this->db_jobmanagement->query($query_pengalaman_kerja)->result_array();
        // var_dump($data['pengalaman_kerja']);die;
        $data['id'] = $id;

        $data['title_head'] = 'View Job';
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['list_menu'] = $this->db->get('menu')->result_array();
        $data['access_crud'] = access_crud($this->id);

        $data['modal_title'] = $modal;
        $data['job_profile_id'] = $id_job;
        // $this->load->view('Templates/Header_v',$data);
        // $this->load->view('Templates/Navbar_v',$data);
        // $this->load->view('Job/Job_v',$data);
        // $this->load->view('Templates/Footer_v');
        $html_modal = $this->load->view('Modal/Modal_read_job',$data,TRUE);
        echo $html_modal;
    }

    function modal_delegate() {
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
        $table_jobfamily = 'job_family';
        $table_tugas_tanggung_jawab = 'tugas_tanggung_jawab';
        $table_category = 'job_category';
        $on1 = 'job_name';
        $on2 = 'id_job';
        $field_id = 'list_jobs.id';
        $on3 = 'position_id';
        $on4 = 'job_list_id';
        $on5 = 'id';
        $field_hide = 'hide';
        $modal = $this->input->post('modal');
        $position_id = $this->input->post('position');
        // var_dump($position_id);die;
        $id = $this->input->post('id');
        $tujuan = $this->input->post('tujuan');
        $tugas = $this->input->post('tugas');
        $kewenangan = $this->input->post('kewenangan');
        $kompetensi = $this->input->post('kompetensi');
        $kpi = $this->input->post('kpi');
        $kualifikasi = $this->input->post('kualifikasi');
        $kode_job_function = 'Y';
        $field_job_function = 'flagactive';
        $data['status_job_profile'] = $this->training_parameter->where($position_id,'status_job_profile','job_list_id')->row();
        // var_dump($data['status_job_profile']);die;
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
        
        $data['desc_tugas_tanggung_jawab_id'] = $this->training_parameter->join_distinct(
            $table_tugas_tanggung_jawab,$table_listjob,$on4,$on5,'list_jobs.id',$position_id,'tugas_tanggung_jawab.description,list_jobs.id'
            )->result_array();

        $data['job_family'] = $this->training_parameter->where_groupby_job_function($kode_job_function,$table_jobfamily,$field_job_function)->result_array();

        $data['job_category'] = $this->training_parameter->get_($table_category)->result_array();

        $query_tugas = "SELECT a.id id_list_job , c.id_job_family, c.job_family, d.id id_job_cateogory, d.job_category from list_jobs a
        join tugas_tanggung_jawab b
        on a.id = b.job_list_id
        join job_family c
        on b.job_family = c.id_job_family
        join job_category d
        on b.job_category = d.id
        where b.job_list_id = $position_id";

        $query = "SELECT a.id id_kualifikasi,a.persyaratan_khusus, b.id id_tingkat_pendidikan, b.edu_name, c.id id_jurusan, c.edu_mjr,a.work_experience from kualifikasi a
        join edu_lvl b
        on a.tingkat_pendidikan = b.id
        join edu_mjr c
        on a.jurusan = c.id
        where a.job_list_id = $position_id ";

        $data['tugas_tanggung_jawab_id'] = $this->db_jobmanagement->query($query_tugas)->row();

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
        
        

        $data['modal_title'] = $modal;
        $data['position_id'] = $position_id;
        $data['id'] = $id;
        $data['tujuan'] = $tujuan;
        $data['tugas'] = $tugas;
        $data['kewenangan'] = $kewenangan;
        $data['kompetensi'] = $kompetensi;
        $data['kpi'] = $kpi;
        $data['kualifikasi'] = $kualifikasi;
        $html_modal = $this->load->view('Modal/Modal_edit_job_individu',$data,TRUE);
        echo $html_modal;
    }

    function modal_review()
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
        $table_jobfamily = 'job_family';
        $table_tugas_tanggung_jawab = 'tugas_tanggung_jawab';
        $table_category = 'job_category';
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
        $kode_job_function = 'Y';
        $field_job_function = 'flagactive';
        
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
        
        $data['desc_tugas_tanggung_jawab_id'] = $this->training_parameter->join_distinct(
            $table_tugas_tanggung_jawab,$table_listjob,$on4,$on5,'list_jobs.id',$position_id,'tugas_tanggung_jawab.description,list_jobs.id'
            )->result_array();

        $data['job_family'] = $this->training_parameter->where_groupby_job_function($kode_job_function,$table_jobfamily,$field_job_function)->result_array();

        $data['job_category'] = $this->training_parameter->get_($table_category)->result_array();

        $query_tugas = "SELECT a.id id_list_job , c.id_job_family, c.job_family, d.id id_job_cateogory, d.job_category from list_jobs a
        join tugas_tanggung_jawab b
        on a.id = b.job_list_id
        join job_family c
        on b.job_family = c.id_job_family
        join job_category d
        on b.job_category = d.id
        where b.job_list_id = $position_id";

        $query = "SELECT a.id id_kualifikasi,a.persyaratan_khusus, b.id id_tingkat_pendidikan, b.edu_name, c.id id_jurusan, c.edu_mjr,a.work_experience from kualifikasi a
        join edu_lvl b
        on a.tingkat_pendidikan = b.id
        join edu_mjr c
        on a.jurusan = c.id
        where a.job_list_id = $position_id ";

        $data['tugas_tanggung_jawab_id'] = $this->db_jobmanagement->query($query_tugas)->row();

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
        $html_modal = $this->load->view('Modal/Modal_review_job',$data,TRUE);
        echo $html_modal;
    }

    function approve() {
        $get_nip = $_SESSION['username'];
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        $status_job_change = ['status' => 1];
        $this->training_parameter->update($data['id'],$status_job_change,'status_job','job_list_id'); 

        $status_approved = ['approved_by' => $get_nip];
        $save = $this->training_parameter->update($data['id'],$status_approved,'status_job','job_list_id'); 

        if ($save == true) {

            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
        }

        echo $msg;
    }
    function saving(){
        $table = 'tujuan_jabatan';
        $field = 'id';
        $save = '';
      
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        // var_dump($_POST);die;
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
        if ($data['eksekutor'] == 'tugas') {
            $this->training_parameter->delete_single($data['job_list_id'],'tugas_tanggung_jawab','job_list_id');
        } else {
            $this->training_parameter->delete_single($data['job_list_id'],$_POST['eksekutor'],'job_list_id');
        }
        
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

        } else if ($data['eksekutor'] == 'tugas') {
            $result = [];
            for ($i=0; $i < count($data['field_tugas']); $i++) { 
                $result[$i]['job_list_id'] = $data['job_list_id'];
                $result[$i]['job_family'] = $data['job_family'];
                $result[$i]['job_category'] = $data['job_category'];
                $result[$i]['description'] = $data['field_tugas'][$i];
            }
            $save = $this->db_jobmanagement->insert_batch('tugas_tanggung_jawab',$result);

        } else {
            foreach($_POST['field_'.$_POST['eksekutor']] as $key => $val){
                $data_arr[$_POST['eksekutor']] = $val;
                $data_arr['job_list_id'] = $_POST['job_list_id'];
                $save = $this->training_parameter->save($data_arr,$_POST['eksekutor']);
            }
            
        }

        if ($data['eksekutor'] == 'kualifikasi' || $data['eksekutor'] == 'tugas') {
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
        // var_dump($data);die;
        $this->now;
        $now = date('Y-m-d H:i:s'); 
        $data['created_at'] = $now;
        $cek_job_name = $this->training_parameter->where($data[$record_job_title],$table_job,$field_job_id)->num_rows();
        
        $extract = explode('.',$data['job_name']);
        if ($cek_job_name <= 0) {
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

        if ($cek_job_name <= 0) {
            $this->training_parameter->save($data_job_name,$table_job);
            $msg = 'create';
        }else{
            $msg = 'no';

        }
        

        // var_dump($get_job_profile_id);die;


        $get_before_id = $this->training_parameter->where($data['before_id'],$table,'id')->row();

        // $cek = $this->training_parameter->where_double($table,'position_id','job_name',$get_before_id->position_id,$data['job_name'])->num_rows();
    
        // if($cek > 0) {
        //     $msg = 'Job tidak boleh sama';

        // } else {
            // $get_before_id = $this->training_parameter->where($data['before_id'],$table,'id')->row();
        //    var_dump($data);die;
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
                        'position_id' => $get_before_id->position_id,
                        'status' => $data['status'],
                        'user_name' => $get_before_id->user_name,
                        'before_id' => $get_before_id->id,
                    );
                    
                    $saving = $this->training_parameter->save_send($data_create_job,$table);
                    
                    $status_job_change = ['job_list_id' => $saving];
                    $save = $this->training_parameter->update($get_before_id->id,$status_job_change,'status_job','job_list_id');
                    $get_job_profile_id = $this->training_parameter->where($data['id'],'status_job_profile','job_list_id')->num_rows();

                    if ($get_job_profile_id > 0) {
                        $id_job_prof = ['job_list_id' => $saving];
                        $this->training_parameter->update($data['id'],$id_job_prof,'status_job_profile','job_list_id');
                    } else {
                        
                    }
                    
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
                    'position_id' => $get_before_id->position_id,
                    'status' => $data['status'],
                    'user_name' => $get_before_id->user_name,
                    'before_id' => $get_before_id->id,
                );
               
                $saving = $this->training_parameter->save_send($data_create_job_sec,$table);
                
                $status_job_change = ['job_list_id' => $saving];
                $save = $this->training_parameter->update($get_before_id->id,$status_job_change,'status_job','job_list_id'); 
                $get_job_profile_id = $this->training_parameter->where($data['id'],'status_job_profile','job_list_id')->num_rows();

                if ($get_job_profile_id > 0) {
                    $id_job_prof = ['job_list_id' => $saving];
                    $this->training_parameter->update($data['id'],$id_job_prof,'status_job_profile','job_list_id');
                } else {
                    
                }
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

        }
        
        echo $msg;

    }

    function delegate_individu_to_admin(){
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }

        $id_job_prof = ['status' => '3'];
        $save = $this->training_parameter->update($data['position_id'],$id_job_prof,'status_job_profile','job_list_id');

        if ($save == true) {
            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
        }

        echo $msg;
    }

    function save_job_profile(){
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }

        $username = $_SESSION['username'];
        $get_job_profile_id = $this->training_parameter->where($data['id'],'status_job_profile','job_list_id')->num_rows();

        if ($get_job_profile_id > 0) {
            $id_job_prof = ['status' => '1', 'approved_by' => $username];
            $save = $this->training_parameter->update($data['id'],$id_job_prof,'status_job_profile','job_list_id');
        } else {
            
        }
        if ($save == true) {

            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
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
