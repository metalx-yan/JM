<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_c extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('User_model');
    }

    public function index(){
        // $session = $_SESSION;
        // var_dump($session);die;
        $data['title_head'] = 'Login';
        $this->load->view('Templates/Header_v',$data);
        $this->load->view('Templates/Navbar_v',$data);
        $this->load->view('Loginv');
        $this->load->view('Templates/Footer_v');
    }

    public function do_login(){
        $msg = '';
        $icon = '';
        $action = '';
        $nip = $this->input->post('nip');
        $password = $this->input->post('password');
        $get_user = $this->User_model->get_user($nip);
        if ($get_user) {
            if ($get_user['employee'] == 1) {
                // karyawan Bank Mega
                if ($get_user['status'] == 1) {
                    // status aktif
                    // -->Selanjutnya Cek LDAP
                    // --> encrypt Passsowrd
                    // --> Password verify
                    $this->User_model->update_last_login($get_user['user_name']);
                    $get_user_update = $this->User_model->get_user($get_user['user_name']);
                    // var_dump($get_user_update['last_login']);die;
                    $data = [
                        'jabatan' => $get_user_update['jabatan'],
                        'username' => $nip,
                        'last_login' => $get_user_update['last_login'],
                        'user_logged' => 'login'
                    ];
                    $this->session->set_userdata($data);
                    $msg .= 'Berhasil Login';
                    $icon .= 'success';
                    $action .= 'Home_c';
                }else{
                    // status tidak aktif atau sudah resign
                    $msg .= 'Maaf Kamu tidak Mempunyai akses';
                    $icon .= 'error';
                    $action .= 'Login_c';
                }
            }else{
                // bukan karyawan bank mega
                $msg .= 'Maaf Kamu tidak Mempunyai akses';
                $icon .= 'error';
                $action .= 'Login_c';
            }
        }else{
            // username belum terdaftar
            $msg .= 'Maaf NIP Kamu Belum Terdaftar';
            $icon .= 'error';
            $action .= 'Login_c';
        }
        $this->message_action($msg,$icon,$action);
    }

    public function message_action($msg,$icon,$action){
        $this->session->set_flashdata('msg','<script>Swal.fire("","'.$msg.'","'.$icon.'")</script>');
        redirect($action);
    }

    public function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('msg','<script>Swal.fire("","Success Logout","success")</script>');
        redirect('Login_c');
    }
}