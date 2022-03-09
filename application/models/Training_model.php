<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Training_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->auth = ['admin', '1234'];
        $this->app_key = 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73';

        $this->client = new Client([
            'base_uri' => 'https://memodev.bankmega.local/ci_rest_server/index.php/Training/',
            'auth' => $this->auth,
            // 'query' => ['api_auth_key' => $this->app_key],
        ]);
    }

    public function read_data($start, $length, $search, $no_md, $status_proses)
    {

        $draw = ((!isset($_POST['draw'])) ? null : $_POST['draw']);

        $read_data = $this->client->request('POST', 'TrainingMd/', [
            'verify' => false,
            'form_params' => [
                'no_md' => $no_md,
                'search' => $search,
                'length' => $length,
                'start' => $start,
                'draw' => $draw,
                'api_auth_key' => 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73',
                'status' => $status_proses
            ]
        ]);

        if ($read_data->getStatusCode() == '200') {
            $result = $read_data->getBody()->getContents();
            return $result;
        } else {
            return false;
        }
    }

    public function get_staff()
    {
        $data = ['verify' => false, 'query' => ['api_auth_key' => $this->app_key]];
        $read_staff = $this->client->request('GET', 'staff/', $data);
        if ($read_staff) {
            $result = $read_staff->getBody()->getContents();
            return $result;
        } else {
            return false;
        }
    }

    public function save_staff($no_md, $admin_hcmg)
    {
        $save_staff = $this->client->request('POST', 'TrainingMd/', [
            'verify' => false,
            'form_params' => [
                'no_md' => $no_md,
                'admin_hcmg' => $admin_hcmg,
                'api_auth_key' => 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73'
                // 'status' => 'ADMIN NON MEMO'
            ]
        ]);

        if ($save_staff->getStatusCode() == '200') {
            $result = $save_staff->getBody()->getContents();
            return $result;
        } else {
            return false;
        }
    }

    public function peserta_train($no_md)
    {
        $get_peserta_train = $this->client->request('POST', 'peserta/', [
            'verify' => false,
            'form_params' => [
                'no_md' => $no_md,
                'api_auth_key' => 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73'
                // 'status' => 'ADMIN NON MEMO'
            ]
        ]);

        if ($get_peserta_train->getStatusCode() == '200') {
            $result = $get_peserta_train->getBody()->getContents();
            return $result;
        } else {
            return false;
        }
        // return $this->db->get_where('training_peserta',['nomor_pengajuan' => $no_md])->result_array();
    }

    public function status_data()
    {
        $data = ['verify' => false, 'query' => ['api_auth_key' => $this->app_key]];
        $status_data = $this->client->request('GET', 'statusData/', $data);
        if ($status_data) {
            $result = $status_data->getBody()->getContents();
            return $result;
        } else {
            return false;
        }
    }

    public function read_proses_data($start, $length, $search, $no_md, $status_proses, $status_non)
    {
        $draw = ((!isset($_POST['draw'])) ? null : $_POST['draw']);

        $read_data = $this->client->request('POST', 'prosesPengajuan/', [
            'verify' => false,
            'form_params' => [
                'no_md' => $no_md,
                'search' => $search,
                'length' => $length,
                'start' => $start,
                'draw' => $draw,
                'api_auth_key' => 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73',
                'status' => $status_proses,
                'status_non' => $status_non
            ]
        ]);

        if ($read_data->getStatusCode() == '200') {
            $result = $read_data->getBody()->getContents();
            return $result;
        } else {
            return false;
        }
    }
}
