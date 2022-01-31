<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function get_user($nip){
        return $this->db->get_where('tb_user',['user_name'=>$nip])->row_array();
    }

    public function update_last_login($nip){
        $this->db->set('last_login','NOW()',FALSE);
        $this->db->where('user_name',$nip);
        $this->db->update('tb_user');
    }

    public function get_level_user(){
        return $this->db->get('level_user')->result_array();
    }

    public function level_user_where($id){
        return $this->db->get_where('level_user',['id'=>$id])->row_array();
    }

   public function get_parent(){
       $this->db->select('parent');
    //    $this->db->where('id_menu','Parent');
       $this->db->group_by('parent');
       return $this->db->get('menu');
   }

   public function get_navbar_name($jabatan,$type){
        $this->db->select('menu.menu_name,type,file,parent,menu.id_menu');
        $this->db->join('level_detail','level_detail.id_menu = menu.id_menu','left');
        $this->db->where('type',$type);
        $this->db->where('is_menu','Yes');
        $this->db->where('level_detail.id_level',$jabatan);
        $this->db->where('level_detail.tampil','1');
        $this->db->order_by('menu.position','ASC');
        return $this->db->get('menu');
   }

   public function get_child_name($jabatan,$type){
        $this->db->select('menu.menu_name,type,file,parent,menu.id_menu');
        $this->db->join('level_detail','level_detail.id_menu = menu.id_menu','inner');
        $this->db->where('type',$type);
        $this->db->where('is_menu','Yes');
        $this->db->where('level_detail.id_level',$jabatan);
        $this->db->where('level_detail.tampil','1');
        $this->db->group_by('id_menu');
        $this->db->order_by('menu.position','ASC');
        return $this->db->get('menu');
    }

    public function get_menu_name($parent){
        $this->db->select('*');
        $this->db->join('level_detail','level_detail.id_menu = menu.id_menu','left');
        $this->db->where('parent',$parent);
        $this->db->where('is_menu','Yes');
        return $this->db->get('menu');
    //    
    }

    public function get_parent2($parent){
        $this->db->select('menu_name,id_menu');
        $this->db->where('id_menu',$parent); 
        $this->db->where('is_menu','Yes');
        return $this->db->get('menu');
    }
    public function get_menu_name2($parent){
        $this->db->select('*');
        $this->db->join('level_detail','level_detail.id_menu = menu.id_menu','inner');
        $this->db->where('parent',$parent);
        $this->db->where('is_menu','Yes');
        // $this->db->group_by('menu.id_menu');
        return $this->db->get('menu');
    //    
    }

    public function get_parent_name($type){
        $this->db->select('*');
        $this->db->where('type',$type);
        $this->db->where('is_menu','Yes');
        // $this->db->group_by('menu.id_menu');
        return $this->db->get('menu');
    //    
    }

    public function get_level_detail(){
        // $this->db->select('*');
        // $this->db->where('id_level',$id_level);
        // $this->db->where('id_menu',$id_menu);
        return $this->db->get('level_detail');
    }

}