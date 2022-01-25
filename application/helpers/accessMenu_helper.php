<?php

function access_login(){
    $ci = get_instance();
    if(!$ci->session->userdata('username')){
    redirect('Login_c');
    }else{
        $access_level = $ci->session->userdata('jabatan');

        $last = $ci->uri->total_segments();
        $record_num = '';
        for ($i= 1; $i <= $last ; $i++) { 
            $record_num .= $ci->uri->segment($i)."/";
        }
        
        $menu_query = $ci->db->get_where('menu',['file'=>$record_num])->row_array();
        if ($menu_query) {
            $menu_id = $menu_query['id_menu'];
            $userAccess = $ci->db->get_where('level_detail', [
                'id_level' => $access_level,
                'id_menu' => $menu_id,
                'tampil' => '1'
            ]);
            if ($userAccess->num_rows() < 1) {
                    redirect('Home_c');
            }
        }
        // else{
        //     $last_segment = array_slice(explode('/', $record_num),-2,1);
        //     $check_uri = array_slice(explode('_',$last_segment[0]),0,1);
        //     if ($check_uri[0] == 'update' || $check_uri[0] == 'delete' || $check_uri[0] == 'add' || $check_uri[0] == 'detail') {
        //         // cek action
        //     }else{
        //         redirect('Home_c');
        //     }
        // }

        
    }
}


?>