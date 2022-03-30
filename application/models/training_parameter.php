<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Client;
class training_parameter extends CI_Model {

    public function __construct(){
        parent::__construct();

        $this->auth = ['admin','1234'];
        $this->app_key = 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73';

        $this->client = new Client([
            'base_uri' => 'https://memodev.bankmega.local/ci_rest_server/index.php/Training_parameter/',
            'auth' => $this->auth,
            // 'query' => ['api_auth_key' => $this->app_key],
            ]);
        $this->db_jobmanagement = $this->load->database('jobmanagement', TRUE);
    }

    public function read_data($start,$length,$search,$kode_fasilitas,$kode_lokasi,$kode_cabang_peserta){

        $draw = ((!isset($_POST['draw']) )? null : $_POST['draw']);

        $read_data = $this->client->request('POST','fasilitasBiayaTraining/', ['verify' => false,
            'form_params' => [
                                'kode_fasilitas' => $kode_fasilitas,
                                'kode_lokasi' => $kode_lokasi,
                                'kode_cabang_peserta' => $kode_cabang_peserta,
                                'search' => $search,
                                'length' => $length,
                                'start' => $start,
                                'draw' => $draw,
                                'api_auth_key' => 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73',
                            ]
        ]);

        if ($read_data->getStatusCode() == '200') {
            $result = $read_data->getBody()->getContents();
            return $result;
        }else {
            return false;
        }        
    }

    function save_data($kode_fasilitas,$kode_lokasi,$kode_cabang_peserta){
        $save_data = $this->client->request('POST','save_data/', ['verify' => false,
        'form_params' => [
                            'kode_fasilitas' => $kode_fasilitas,
                            'kode_lokasi' => $kode_lokasi,
                            'kode_cabang_peserta' => $kode_cabang_peserta,
                            'api_auth_key' => 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73',
                        ]
        ]);
        if ($save_data->getStatusCode() == '200') {
            $result = $save_data->getBody()->getContents();
            return $result;
        }else {
            return false;
        }       
    }

    function where($kode,$table,$field){
        return $this->db_jobmanagement->get_where($table,[$field=>$kode]);
    }

    function where_null($table,$field,$select){
        $this->db_jobmanagement->select("$select");
        $this->db_jobmanagement->where("$field IS NULL");
        return $this->db_jobmanagement->get($table);
    }

    function where_double($table,$field1,$field2,$data1,$data2){
        $this->db_jobmanagement->where($field1,$data1)->where($field2,$data2); 
        return $this->db_jobmanagement->get($table);
    }
    
    function where_distinct($kode,$table,$field,$select1,$select2){
        return $this->db_jobmanagement->distinct()->select("$select1,$select2")->get_where($table,[$field=>$kode]);
    }

    function where_distinct_not_null_single_where($kode,$table,$select1,$select2){
        $this->db_jobmanagement->where($kode);
        return $this->db_jobmanagement->distinct()->select("$select1,$select2")->get($table);
    }

    function where_groupby_job_function($kode,$table,$field){
        $this->db_jobmanagement->group_by($table); 
        return $this->db_jobmanagement->get_where($table,[$field=>$kode]);
    }

    function where_groupby_job_discipline($kode,$table,$field,$field2){
        $this->db_jobmanagement->group_by($field2); 
        return $this->db_jobmanagement->get_where($table,[$field=>$kode]);
    }

    function where_groupby($table,$field2,$select1,$select2){
        $this->db_jobmanagement->group_by($field2); 
        $this->db_jobmanagement->select("$select1,$select2");
        return $this->db_jobmanagement->get($table);
    }

    function where_group($table,$field2,$select1,$select2,$record){
        $this->db_jobmanagement->where($select1,$record);
        $this->db_jobmanagement->group_by($field2); 
        $this->db_jobmanagement->select("$select1,$select2");
        return $this->db_jobmanagement->get($table);
    }

    function where_group_multipleselect($table,$field2,$select1,$select2,$select3,$record){
        $this->db_jobmanagement->where($select3,$record);
        $this->db_jobmanagement->group_by($field2); 
        $this->db_jobmanagement->select("$select1,$select2");
        return $this->db_jobmanagement->get($table);
    }
    
    function where_job_function($table,$kode,$field,$kode2,$field2){
        return $this->db_jobmanagement->where($field,$kode)->where($field2,$kode2)->get($table);
    }

    function where_triple($table,$kode,$field,$kode2,$field2,$kode3,$field3){
        return $this->db_jobmanagement->where($field,$kode)->where($field2,$kode2)->where($field3,$kode3)->get($table);
    }
    // db_trms
    function where_trms($kode,$table,$field){
        return $this->db->get_where($table,[$field=>$kode]);
    }

    function save($data,$table){
        $save = $this->db_jobmanagement->insert($table,$data);
        if ($save) {
            return true;
        }else{
            return false;
        }
    }

    function save_send($data,$table){
        $save = $this->db_jobmanagement->insert($table,$data);
        $get_id = $this->db_jobmanagement->insert_id();
        if ($save) {
            return $get_id;
        }else{
            return false;
        }
    }

    // db trms
    function save_trms($data,$table){
        $save = $this->db->insert($table,$data);
        if ($save) {
            return true;
        }else{
            return false;
        }
    }

    function update($kode_key,$data,$table,$field){
        $this->db_jobmanagement->where($field,$kode_key);
        return $this->db_jobmanagement->update($table,$data);
    }

    function update_data($kode_key,$data,$table,$field,$data2,$field2,$field3)
    {
        $this->db_jobmanagement->set($field3, $data);
        $this->db_jobmanagement->set($field2, $data2);
        $this->db_jobmanagement->where($field, $kode_key);
        return $this->db_jobmanagement->update($table);
    }

    function subquery($table,$field1,$data1,$field2,$data2,$field3,$data3,$data4){
        $this->db_jobmanagement->select('*')->from($table);
        return  $this->db_jobmanagement->where($field1,$data1)->where($field2,$data2)
        ->where($field3,$data3)
        ->where("`job_sub_function` IN (SELECT `job_sub_function` FROM $table WHERE `job_function` = '$data3' and job_sub_function = '$data4')", NULL, FALSE)->get();
    }

    function delete_($kode_key,$table,$field,$field2,$kode_key2,$falseNull,$field3,$kode3){
        $this->db_jobmanagement->where($field,$kode_key)->where($field3,$kode3)->where($field2, $kode_key2,$falseNull);
        return $this->db_jobmanagement->delete($table);
   
    }

    function delete_single($kode_key,$table,$field){
        $this->db_jobmanagement->where($field,$kode_key);
        return $this->db_jobmanagement->delete($table);
    }

    // delete trms
    function delete_trms($kode_key,$table,$field){
        $this->db->where($field,$kode_key);
        $delete = $this->db->delete($table);
        if($delete){
            return true;
        }else{
            return false;
        }
    }
    
    function get_($table){
        return $this->db_jobmanagement->get($table);
    }

    function gets($table, $select){
        return $this->db_jobmanagement->distinct()->select("$select")->get($table);
    }

    function get_select_max($table,$select){
        $this->db_jobmanagement->select("$select");
        return $this->db_jobmanagement->get($table);
    }

    function get_select_distinct($table,$select1,$select2){
        $this->db_jobmanagement->distinct()->select("$select1,$select2");
        $this->db_jobmanagement->order_by($select2, "asc");
        return $this->db_jobmanagement->get($table);
    }

    function get_distinct($table){
        return $this->db_jobmanagement->distinct()->where( 'discipline_description !=', '')->get($table);
    }

    public function get_job_sub_function($type){
        $this->db_jobmanagement->select('*');
        $this->db_jobmanagement->where('id_job_function =',$type);
        $this->db_jobmanagement->where('flagactive =','Y');
        return $this->db_jobmanagement->get('job_function');
    //    
    }
    // get trms
    function get_trms($table,$select){
        $select_to = implode(',',$select);
        $this->db->select($select_to);
        return $this->db->get($table);
    }

    function join_distinct($table1,$table2,$on_join1,$on_join2,$field1,$record1,$select){
        $this->db_jobmanagement->distinct()->select("$select");
        $this->db_jobmanagement->join($table2,"$table1.$on_join1 = $table2.$on_join2");
        $this->db_jobmanagement->where($field1,$record1);
        return $this->db_jobmanagement->get($table1);
    }

    function join($kode,$table,$field,$join,$on_join,$on_join2,$select){
        $this->db_jobmanagement->select("$select");
        $this->db_jobmanagement->join($join,"$join.$on_join = $table.$on_join2");
        $this->db_jobmanagement->where($table.'.'.$field,$kode);
        return $this->db_jobmanagement->get($table);
    }

    function join_($kode,$table,$field,$join,$on_join){
        $this->db_jobmanagement->join($join,"$join.$on_join = $table.$on_join",'left');
        $this->db_jobmanagement->where($table.'.'.$field,$kode);
        return $this->db_jobmanagement->get($table);
    }
    
    function join_group_where_select($table1,$table2,$on_join1,$on_join2,$field1,$record1,$field2,$record2,$select){
        $this->db_jobmanagement->select("$select");
        $this->db_jobmanagement->join($table2,"$table1.$on_join1 = $table2.$on_join2");
        $this->db_jobmanagement->where($table1.'.'.$field1,$record1)->where($field2,$record2);
        // $this->db_jobmanagement->group_by($field2);
        return $this->db_jobmanagement->get($table1);
    }

    function join_group_where_distinct_select($table1,$table2,$on_join1,$on_join2,$field1,$record1,$select){
        $this->db_jobmanagement->distinct()->select("$select");
        $this->db_jobmanagement->join($table2,"$table1.$on_join1 = $table2.$on_join2");
        $this->db_jobmanagement->where($field1,$record1);
        return $this->db_jobmanagement->get($table1);
    }

    function join_group_distinct_select($table1,$table2,$on_join1,$on_join2,$select){
        $this->db_jobmanagement->distinct()->select("$select");
        $this->db_jobmanagement->join($table2,"$table1.$on_join1 = $table2.$on_join2");
        return $this->db_jobmanagement->get($table1);
    }

    function join_group_where($kode,$table,$field,$join,$on_join1,$on_join2,$field2){
        $this->db_jobmanagement->join($join,"$join.$on_join2 = $table.$on_join1");
        $this->db_jobmanagement->where($table.'.'.$field,$kode);
        $this->db_jobmanagement->group_by($field2);
        return $this->db_jobmanagement->get($table);
    }

    function join_2($kode,$table,$field,$join,$on_join,$join2,$on_join2){
        $this->db_jobmanagement->join($join,"$join.$on_join = $table.$on_join",'left');
        $this->db_jobmanagement->join($join2,"$join2.$on_join2 = $table.$on_join2",'left');
        $this->db_jobmanagement->where($table.'.'.$field,$kode);
        return $this->db_jobmanagement->get($table);
    }

    function join_2_distinct($table1,$table2,$table3,$on_join1,$on_join2,$on_join3,$on_join4,$field1,$record1,$select){
        $this->db_jobmanagement->distinct()->select("$select");
        $this->db_jobmanagement->join($table2,"$table1.$on_join1 = $table2.$on_join2");
        $this->db_jobmanagement->join($table3,"$table1.$on_join3 = $table3.$on_join4");
        $this->db_jobmanagement->where($field1,$record1);
        return $this->db_jobmanagement->get($table1);
    }

    function join_3_distinct($table1,$table2,$table3,$table4,$on_join1,$on_join2,$on_join3,$on_join4,$on_join5,$on_join6,$field1,$record1,$select){
        $this->db_jobmanagement->distinct()->select("$select");
        $this->db_jobmanagement->join($table2,"$table1.$on_join1 = $table2.$on_join2");
        $this->db_jobmanagement->join($table3,"$table1.$on_join3 = $table3.$on_join4");
        $this->db_jobmanagement->join($table4,"$table1.$on_join6 = $table4.$on_join5");
        $this->db_jobmanagement->where($field1,$record1);
        return $this->db_jobmanagement->get($table1);
    }

    function join_3($kode,$table,$field,$join,$on_join,$join2,$on_join2,$join3,$on_join3){
        $this->db_jobmanagement->join($join,"$join.$on_join = $table.$on_join");
        $this->db_jobmanagement->join($join2,"$join2.$on_join2 = $table.$on_join2");
        $this->db_jobmanagement->join($join3,"$join3.$on_join3 = $table.$on_join3");
        $this->db_jobmanagement->where($table.'.'.$field,$kode);
        return $this->db_jobmanagement->get($table);
    }

    function select_join($kode,$table,$field,$join,$on_join){
        $select = array('kode_fasilitator', 'nama_fasilitator','fasilitator.no_telepon as no_telp','vendor.nama as nama_vendor','kategori','id_internal','jenis_fasilitator','no_rekening','status','vendor.kode_vendor as kode_vendor');
        $select_to = implode(',',$select);
        $this->db_jobmanagement->select($select_to);
        $this->db_jobmanagement->join($join,"$join.$on_join = $table.$on_join",'left');
        $this->db_jobmanagement->where($table.'.'.$field,$kode);
        return $this->db_jobmanagement->get($table);
        
    }

    

}

?>