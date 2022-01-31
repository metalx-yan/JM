<?php

function __construct()
{
    $ci = get_instance();
    $ci->load->model('User_model');
}

function access_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('Login_c');
    } else {
        $access_level = $ci->session->userdata('jabatan');

        $last = $ci->uri->total_segments();
        $record_num = '';
        for ($i = 1; $i <= $last; $i++) {
            $record_num .= $ci->uri->segment($i) . "/";
        }

        $menu_query = $ci->db->get_where('menu', ['file' => $record_num])->row_array();
        if ($menu_query) {
            $menu_id = $menu_query['id_menu'];
            $userAccess_view = $ci->db->get_where('level_detail', [
                'id_level' => $access_level,
                'id_menu' => $menu_id,
                'tampil' => '1'
            ]);

            // action cek acess view
            if ($userAccess_view->num_rows() < 1) {
                redirect('Home_c');
            }
        }
    }
}

function navbar_perent($jabatan)
{
    $ci = get_instance();
    return $ci->User_model->get_navbar_name($jabatan, 'Parent')->result_array();
}

function navbar_child($jabatan)
{
    $ci = get_instance();
    return $ci->User_model->get_navbar_name($jabatan, 'Child')->result_array();
}

function access_crud()
{
    $ci = get_instance();
    $access_level = $ci->session->userdata('jabatan');

    $last = $ci->uri->total_segments();
    $record_num = '';
    for ($i = 1; $i <= $last; $i++) {
        $record_num .= $ci->uri->segment($i) . "/";
    }

    $menu_query = $ci->db->get_where('menu', ['file' => $record_num])->row_array();
    if ($menu_query) {
        $menu_id = $menu_query['id_menu'];
        $userAccess_view = $ci->db->get_where('level_detail', [
            'id_level' => $access_level,
            'id_menu' => $menu_id,
            'tampil' => '1'
        ]);
        $userAccess_add = $ci->db->get_where('level_detail', [
            'id_level' => $access_level,
            'id_menu' => $menu_id,
            'addm' => '1'
        ]);
        $userAccess_edit = $ci->db->get_where('level_detail', [
            'id_level' => $access_level,
            'id_menu' => $menu_id,
            'edit' => '1'
        ]);
        $userAccess_delete = $ci->db->get_where('level_detail', [
            'id_level' => $access_level,
            'id_menu' => $menu_id,
            'del' => '1'
        ]);

        // action cek acess view
        if ($userAccess_view->num_rows() < 1) {
            redirect('Home_c');
        }

        $data_access = [
            'access_add' => '',
            'access_edit' =>  '',
            'access_delete' => ''
        ];

        // action cek acess create
        if ($userAccess_add->num_rows() > 0) {
            $data_access['access_add'] = '1';
        }

        // action cek edit
        if ($userAccess_edit->num_rows() > 0) {
            $data_access['access_edit'] = '1';
        }

        // action cek delete
        if ($userAccess_delete->num_rows() > 0) {
            $data_access['access_delete'] = '1';
        }

        return $data_access;
    }
}
