<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_menu_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
        $this->load->model('M_Datatables');
        access_login();
        $this->id = 'menu_name';
    }

    public function index(){
        $data['title_head'] = 'Manage Menu';
        $jabatan = $_SESSION['jabatan'];
        $data['navbar_parent'] = navbar_perent($jabatan);
        $data['navbar_child'] = navbar_child($jabatan);
        $data['list_menu'] = $this->db->get('menu')->result_array();
        $data['access_crud'] = access_crud($this->id);

        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Setting_parameter/Manage_menu_v',$data);
        $this->load->view('Templates/Footer_v');
    }

    public function parent_menu(){
        $type = $this->input->post('type');
        if ($type == 'Child') {
            $type = 'Parent';
        }elseif ($type == 'Child2') {
            $type = 'Child';
        }else{
            $type = 'Child2';
        }
        $get_menu = $this->User_model->get_parent_name($type)->result_array();
        $loop = '';
        foreach($get_menu as $menu):
            $loop .= '<option value="'.$menu['id_menu'].'">'.$menu['menu_name'].'</option>';
        endforeach;
        $html = '<label class="col-sm-5 col-form-label">Parent Menu</label>
                    <div class="col-sm-7">
                    <select id="type_menu" class="form-select" aria-label="Default select example">
                        <option selected>Open this select Parent Menu</option>
                        '.$loop.'
                    </select>
                    </div>';

        echo $html;
    }

    function list_menu()
    {
            $query = 	"SELECT * FROM menu";
            $search = array('menu_name', 'type');
            $where  = null; 
            // $where  = array('nama_kategori' => 'Tutorial');
            // jika memakai IS NULL pada where sql
            $isWhere = null;
            // $isWhere = 'artikel.deleted_at IS NULL';
            // $tes = $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
            header('Content-Type: application/json');
            echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);
    }

    
}