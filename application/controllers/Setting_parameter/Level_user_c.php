<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level_user_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        access_login();
    }

    public function index(){
        $jabatan = $_SESSION['jabatan'];

        $data['title_head'] = 'Level User';
        $data['level_user'] = $this->User_model->get_level_user();
        $data['level_detail'] = $this->User_model->get_parent()->result_array();
        $data['level_detail2'] = $this->User_model->get_menu_name($parent = '')->result_array();
        // var_dump($data['level_detail2']);die;
        foreach( $data['level_detail'] as $parent_){
            if ($parent_['parent'] !== '') {
                $data['level_detail3'][] = $this->User_model->get_parent2($parent_['parent'])->result_array();
            }
        }
        foreach($data['level_detail3'] as $id_menu2){
            foreach($id_menu2 as $id_menu3){
                $data['level_detail4'][] = $this->User_model->get_menu_name2($id_menu3['id_menu'])->result_array();
            }
        }

        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Setting_parameter/Level_user_v',$data);
        $this->load->view('Templates/Footer_v');
    }

    public function update_level_user(){

        $tampil = $this->input->post('tampil');
        $addm = $this->input->post('addm');
        $edit = $this->input->post('edit');
        $del = $this->input->post('del');
        $id_level_user = $this->input->post('id_level');
        
        $this->_update($tampil,'tampil',$id_level_user);
        $this->_update($addm,'addm',$id_level_user);
        $this->_update($edit,'edit',$id_level_user);
        $this->_update($del,'del',$id_level_user);
      
        redirect('Setting_parameter/Level_user_c');
        
    }

    public function _update($tampil,$field,$id_level_user){
        $get_parent = $this->User_model->get_level_detail()->result_array();
        if ($tampil) {
            foreach($tampil as $tmpl){
                $explode_tampil[] = explode('-',$tmpl);
            }
        }else{
            $explode_tampil = [];
        }
        
        $i = 0;
        $data_up_tmpl =[];
        foreach($explode_tampil as $up_tmpl){

            foreach($get_parent as $parent):
                if($parent['id_level'] == $up_tmpl[0] && $parent['id_menu'] == $up_tmpl[1]):
                    // var_dump($up_tmpl[0]);die;
                    $data_up_tmpl[] = [
                        'id_menu' => $up_tmpl[1],
                        $field => $up_tmpl[2]
                    ];
                    
                    $id_level = $up_tmpl[0];
                ;else:
                    $data_kosong = [
                        $field => 0
                    ];
                    $this->db->where('id_level',$id_level_user);
                    $this->db->where('id_menu',$parent['id_menu']);
                    $this->db->update('level_detail',$data_kosong);
                endif;
            endforeach;
        }

        // var_dump($data_up_tmpl);die;
        $this->db->where('id_level',$id_level_user);
        $this->db->update_batch('level_detail',$data_up_tmpl,'id_menu');
    }

}