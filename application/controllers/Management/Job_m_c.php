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
        $this->load->view('Management/Job_m_v',$data);
        $this->load->view('Templates/Footer_v');
    } 

    public function get(){
        $query = "SELECT distinct a.id,a.position_id, b.position_name,c.id_job,c.job_title from list_jobs a
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
        $isWhere = 'a.verify_validasi IS NULL';
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
        

        $query = "SELECT distinct a.id,b.position_id, b.position_name,c.job_title,CASE
        WHEN d.status = 0 THEN 'Belum Ada'
        WHEN d.status = 1 THEN 'Admin'
        END status , d.status status_awal, e.status status_akhir
        from list_jobs a
        inner join posisi b
        on a.position_id = b.position_id
        inner join job c
        on a.job_name = c.id_job
        left join status_job d
        on a.id = d.job_list_id 
        left join status_job_profile e
        on a.id = e.job_list_id
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

    function send_admin(){
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        
        $search = $this->training_parameter->where($data['id'],'status_job_profile','job_list_id')->num_rows();
        if ($search > 0) {
            $data_update = ['status' => 0];
            $save = $this->training_parameter->update($data['id'],$data_update,'status_job_profile','job_list_id');
        } else {
            $data_job = $this->training_parameter->where($data['id'],'list_jobs','id')->row();
            $now = date('Y-m-d H:i:s');
            $data_arr = array(
                'job_list_id' => $data_job->id,
                'status' => 0,
                'created_at' => $now,
            );
            
            $save = $this->training_parameter->save($data_arr, 'status_job_profile');
        }
        
        if ($save == true) {
            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
        }
        echo $msg;
    }

    function delegate_modal(){
        $table = 'job';
        $table_posisi = 'posisi';
        $table_listjob = 'list_jobs';
        
        $on1 = 'job_name';
        $on2 = 'id_job';
        $field_id = 'list_jobs.id';
        $on3 = 'position_id';
        $username = $_SESSION['username'];
        $modal = $this->input->post('modal');
        $position_id = $this->input->post('position');
        // var_dump($position_id);die;
        $id = $this->input->post('id');
        
        $query_search_delegate = "SELECT * from status_job_profile a inner join db_jrms.tb_user b on a.delegate_to = b.user_name inner join db_jrms.branch c on b.branch = c.id_branch";
        $query_delegate = $this->db_jobmanagement->query($query_search_delegate)->row();
        // var_dump($query_delegate);die;
        $data['id_job'] = $this->training_parameter->join_2_distinct(
            $table_listjob,$table_posisi,$table,$on3,$on3,$on1,$on2
            ,$field_id,$position_id,'list_jobs.id,job.id_job,job.job_title,posisi.position_name'
        )->row();

        $data['position'] = $position_id;
        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $data['username'] = $username;

        $query = "SELECT user_name,nama,job_title,branch,b.singkatan from db_jrms.tb_user a
        inner join db_jrms.branch b
        on a.branch = b.id_branch where approval1 = '$username' and
        status = 1 and job_title like '%head%'
        UNION 
        SELECT user_name,nama,job_title,branch,d.singkatan from db_jrms.tb_user c
        inner join db_jrms.branch d
        on c.branch = d.id_branch
        where approval1 in (SELECT user_name from db_jrms.tb_user where approval1 = '$username' and
        status = 1 and job_title like '%head%') and status = 1";

        $data['status_job_profile'] = $this->training_parameter->where($position_id,'status_job_profile','job_list_id')->row();
        
        $data['position_id'] = $position_id;
        $data['delegate'] = $this->db_jobmanagement->query($query)->result_array();
        $data['query_delegate'] = $query_delegate;
        $html_modal = $this->load->view('Modal/Modal_delegate',$data,TRUE);
        echo $html_modal;
    }

    function delegate_()
    {
        $table = 'status_job_profile';
        $field = 'id';
        $save = '';
      
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }

        $count = $this->training_parameter->where($data['id'],$table,'job_list_id')->num_rows();
        // var_dump($data);die;
        if ($count > 0) {
            $this->now;
            $now = date('Y-m-d H:i:s');

            $data_update = array(
                'delegate_to' => $data['delegate'],
                'updated_at' => $now
            );
            $update = $this->training_parameter->update($data['id'],$data_update,$table,'job_list_id');
        } else {
        //     # code...
            $this->now;
            $now = date('Y-m-d H:i:s');
            $data_arr = array(
                'job_list_id' => $data['id'],
                'status' => NULL,
                'created_at' => $now,
            );
            $save = $this->training_parameter->save_send($data_arr, 'status_job_profile');

            $data_update = array(
                'delegate_to' => $data['delegate'],
                'updated_at' => $now
            );
            $update = $this->training_parameter->update($save,$data_update,$table,$field);
        }
        
        if ($update == true) {
            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
        }

        echo $msg;
    }

    function send_admin_modal()
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
        
        $data['cek_send_admin'] = $this->training_parameter->where_double('status_job_profile','job_list_id','delegate_to',$position_id,NULL)->num_rows();

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
        $data['status_job_profile'] = $this->training_parameter->where($position_id,'status_job_profile','job_list_id')->row();
        
        // var_dump($data['status_job_profile']);die;
        $data['position'] = $position_id;
        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $data['tujuan'] = $tujuan;
        $data['tugas'] = $tugas;
        $data['kewenangan'] = $kewenangan;
        $data['kompetensi'] = $kompetensi;
        $data['kpi'] = $kpi;
        $data['kualifikasi'] = $kualifikasi;
        $html_modal = $this->load->view('Modal/Modal_edit_job_delegate',$data,TRUE);
        echo $html_modal;
    }

    function mapping_(){
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        // var_dump($data);die;
        $this->now;
        $now = date('Y-m-d H:i:s');
        $map = explode('-',$data['mapping']);
        $array = ['user_name' => $map[1], 'job_list_id' => $data['job'], 'mapping_by' => $data['mapping_to'], 'created_at' => $now];
        $save = $this->training_parameter->save($array,'mapping_job');
          
        if ($save == true) {
            $msg = 'Berhasil di Simpan';
        }else{
            $msg = 'Gagal Menyimpan';
        }

        echo $msg;
    }

    function mapping_job()
    {
        $modal = $this->input->post('modal');
        $job_id = $this->input->post('job');
        $id = $this->input->post('id');
        $data['job'] = $job_id;
        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $username = $_SESSION['username'];
        // var_dump($data['job']);die;

        $query_job = "SELECT distinct a.id,a.position_id, b.position_name,c.id_job,c.job_title from list_jobs a
        join posisi b
        on a.position_id = b.position_id
        join job c
        on a.job_name = c.id_job
        where a.id = '$job_id'";

        $query_name = "SELECT user_name,nama,job_title,branch,b.singkatan from db_jrms.tb_user a
        inner join db_jrms.branch b
        on a.branch = b.id_branch where approval1 = '$username' and
        status = 1 and job_title like '%head%'
        UNION 
        SELECT user_name,nama,job_title,branch,d.singkatan from db_jrms.tb_user c
        inner join db_jrms.branch d
        on c.branch = d.id_branch
        where approval1 in (SELECT user_name from db_jrms.tb_user where approval1 = '$username' and
        status = 1 and job_title like '%head%') and status = 1";

        $query_get = "SELECT a.user_name,b.nama,b.job_title, c.singkatan from mapping_job a
        inner join db_jrms.tb_user b
        on a.user_name = b.user_name
        inner join db_jrms.branch c
        on b.branch = c.id_branch
        where a.job_list_id = '$job_id'";

        $data['mapping_to'] = $username;
        $data['job_position'] = $this->db_jobmanagement->query($query_job)->row();
        $data['id_job'] = $this->db_jobmanagement->query($query_get)->row();
        $data['people'] = $this->db_jobmanagement->query($query_name)->result_array();
        $data['user_onjob'] = $this->training_parameter->get_('mapping_job')->result_array();

        $html_modal = $this->load->view('Modal/Modal_mapping',$data,TRUE);
        echo $html_modal;
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

    function view_job()
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
        // $this->load->view('Templates/Header_v',$data);
        // $this->load->view('Templates/Navbar_v',$data);
        // $this->load->view('Job/Job_v',$data);
        // $this->load->view('Templates/Footer_v');
        $html_modal = $this->load->view('Modal/Modal_view_job',$data,TRUE);
        echo $html_modal;
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