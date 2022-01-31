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
        $this->db_training = $this->load->database('training', TRUE);
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
        return $this->db_training->get_where($table,[$field=>$kode]);
    }

    function save($data,$table){
        $save = $this->db_training->insert($table,$data);
        if ($save) {
            return true;
        }else{
            return false;
        }
    }

    function update($kode_key,$data,$table,$field){
        $this->db_training->where($field,$kode_key);
        $update = $this->db_training->update($table,$data);
        if($update){
            return true;
        }else{
            return false;
        }
    }

    function delete_($kode_key,$table,$field){
        $this->db_training->where($field,$kode_key);
        $delete = $this->db_training->delete($table);
        if($delete){
            return true;
        }else{
            return false;
        }
    }
    
    function get_($table){
        return $this->db_training->get($table);
    }

    function join_($kode,$table,$field,$join,$on_join){
        $this->db_training->join($join,"$join.$on_join = $table.$on_join",'left');
        $this->db_training->where($table.'.'.$field,$kode);
        return $this->db_training->get($table);
    }

    function join_2($kode,$table,$field,$join,$on_join,$join2,$on_join2){
        $this->db_training->join($join,"$join.$on_join = $table.$on_join",'left');
        $this->db_training->join($join2,"$join2.$on_join2 = $table.$on_join2",'left');
        $this->db_training->where($table.'.'.$field,$kode);
        return $this->db_training->get($table);
    }

}

?>