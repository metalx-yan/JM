<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Level_user_c extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('training_parameter');
        $this->load->library('form_validation');
        access_login();
        $this->id = 'level_detail';
    }

    public function index()
    {
        $jabatan = $_SESSION['jabatan']; 

        $data['title_head'] = 'Level User';
        $data['level_user'] = $this->User_model->get_level_user();
        $data['access_crud'] = access_crud($this->id);

        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $this->load->view('Templates/Header_v', $data);
        $this->load->view('Templates/Navbar_v', $data);
        $this->load->view('Setting_parameter/Level_user_v', $data);
        $this->load->view('Templates/Footer_v');
    }

    public function update_level_user()
    {

        $tampil = $this->input->post('tampil');
        $addm = $this->input->post('addm');
        $edit = $this->input->post('edit');
        $del = $this->input->post('del');
        $id_level_user = $this->input->post('id_level');

        $this->_update($tampil, 'tampil', $id_level_user);
        $this->_update($addm, 'addm', $id_level_user);
        $this->_update($edit, 'edit', $id_level_user);
        $this->_update($del, 'del', $id_level_user);

        echo 'Berhasil di Simpan';
        // redirect('Setting_parameter/Level_user_c');

    }

    public function _update($access, $field, $id_level_user)
    {
        $get_parent = $this->User_model->get_level_detail()->result_array();
        if ($access) {
            foreach ($access as $access) {
                $explode_access[] = explode('-', $access);
            }
        } else {
            $explode_access = null;
        }

        $data_kosong = [
            $field => 0
        ];
        $this->db->where('id_level', $id_level_user);
        $this->db->update('level_detail', $data_kosong);

        $data_up_access = [];
        if ($explode_access) {
            foreach ($explode_access as $up_access) {
    
                foreach ($get_parent as $parent) :
                    if ($parent['id_level'] == $up_access[0] && $parent['id_menu'] == $up_access[1]) :
                        $data_up_access[] = [
                            'id_menu' => $up_access[1],
                            $field => $up_access[2]
                        ];
                    endif;
                endforeach;
            }
            $this->db->where('id_level', $id_level_user);
            $this->db->update_batch('level_detail', $data_up_access, 'id_menu');
        }
    }


    public function modal()
    {
        $data['id_level_user'] = $this->input->post('level_user');
        $data['name_level_user'] = $this->User_model->level_user_where($data['id_level_user'])->level_user;
        $data['level_user'] = $this->User_model->get_level_user();
        $data['level_detail'] = $this->User_model->get_parent()->result_array();
        $data['level_detail2'] = $this->User_model->get_menu_name($parent = '')->result_array();
        $data['access_crud'] = access_crud($this->id);

        // var_dump($data['level_deta'])
        foreach ($data['level_detail'] as $parent_) {
            if ($parent_['parent'] !== '') {
                $data['level_detail3'][] = $this->User_model->get_parent2($parent_['parent'])->result_array();
            }
        }
        foreach ($data['level_detail3'] as $id_menu2) {
            foreach ($id_menu2 as $id_menu3) {
                $data['level_detail4'][] = $this->User_model->get_menu_name2($id_menu3['id_menu'])->result_array();
            }
        }
        $html_modal = $this->load->view('Modal/Modal_level_user', $data, TRUE);
        echo $html_modal;
    }


    public function modal_add()
    {
        $modal = $this->input->post('modal');
        $id = $this->input->post('id');
        $level_user = $this->input->post('level_user');
        $data['name_level_user'] = $this->User_model->level_user_where($level_user);
        $data['modal_title'] = $modal;
        $data['id'] = $id;
        $html_modal = $this->load->view('Modal/Modal_level_user_add', $data, TRUE);
        echo $html_modal;
    }


    function validate_keyup()
    {
        $this->form_validation->set_error_delimiters('', '');
        foreach ($_POST as $key => $val) {
            if ($key == $key) {
                if ($key == 'id') {
                   $require ='';
                }else{
                    $require = 'required|trim';
                }
                $this->form_validation->set_rules($key, $key, $require);
            }
        }

        $this->form_validation->set_message('required', 'You missed the input {field}!');
        $this->form_validation->set_message('numeric', 'You input {field} just numeric!');

        if (!$this->form_validation->run()) {
            foreach ($_POST as $key => $val) {
                if ($key == $key) {
                    $json[$key] = form_error($key, '<span class="mt-3 text-danger">', '</span>');
                }
            }
        } else {
            foreach ($_POST as $key => $val) {
                $json = array(
                    $key => '',
                );
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

    function validate(){
        $this->form_validation->set_error_delimiters('', '');
        foreach($_POST as $key => $val){
            if ($key == 'id') {
                $require ='';
             }else{
                 $require = 'required|trim';
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

    function save_(){
        $table = 'level_user';
        $field = 'level_user';
        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }
        // cek kode 
        $cek_kode = $this->training_parameter->where_trms($data[$field],$table,$field)->num_rows();
        if ($cek_kode > 0) {
            $msg = 'Level User Sudah Ada';
        }else{
            $save = $this->training_parameter->save_trms($data,$table);
            $id_level_user = $this->db->insert_id();
            $select = array('id_menu');
            $get_menu = $this->training_parameter->get_trms('menu',$select)->result_array();
            foreach($get_menu as $menu){
                $data_level = [
                    'id_level' => $id_level_user,
                    'id_menu' => $menu['id_menu']
                ];
                $this->training_parameter->save_trms($data_level,'level_detail');
            }
            // var_dump($data_level);die;
            

            if ($save == true) {
                $msg = 'Berhasil di Simpan';
            }else{
                $msg = 'Gagal Menyimpan';
            }
        }
        echo $msg;

    }


    function delete_(){
        $table = 'level_detail';
        $field = 'id_level';

        foreach($_POST as $key => $val){
            $data[$key] = $val;
        }

        // delete
        $delete = $this->training_parameter->delete_trms($data['id'],$table,$field);
        $this->training_parameter->delete_trms($data['id'],'level_user','id');

        if ($delete) {
            $msg = 'Berhasil di Hapus';
        }else{
            $msg = 'Gagal Hapus';
        }
        echo $msg;
    }
}
