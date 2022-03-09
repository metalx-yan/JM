<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soap extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'Master/user',
			'Master/menu',
			'Master/alertpopup'
		]);
		$this->_getNocache();
	}

	/* 
		Disable back on browser after logout
		- nocache
	*/
	function _getNocache()
	{
		// CodeIgniter Framework version:
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
	}

	public function actionIndex()
	{
		if ($this->session->userdata('STATUS_LOGIN') != 'loggedIn') {
			redirect('/site/login', 'refresh', 401);
		}

		$this->layout->layout = 'main';
		$this->layout->view_js = '_partial/index_js';
		$this->layout->view_css = '_partial/index_css';
		$this->layout->render('index', []);
	}

	public function actionLogin()
	{
		$this->layout->layout = 'login';
		$this->layout->title = 'Login';

		$this->layout->render('login', []);
	}

	public function actionAuthLogin()
	{
		if ($data = $this->input->post('login')) {
			$user = $this->User_model->get(['nip' => $data['nip']]);

			// $result = [
			// 	'status' => true,
			// 	'message' => 'Login Berhasil'
			// ];

			// $this->session->set_userdata([
			// 	'STATUS_LOGIN' => 'loggedIn',
			// 	'identity' => $user,
			// ]);
			if (!empty($data['nip']) && !empty($data['password'])) {
				/* cekdatabase */
				$verfy['user'] = $data['nip'];
				$verfy['password'] = $data['password'];
				$rx = $this->soapid->Verify($verfy);
				var_dump($rx);
				die;


				if (!empty($rx->ResponseDescription)) {
					if ($rx->ResponseDescription === 'SUCCESS') {

						$user = $this->user->get(['nip' => $verfy['user']]);

						if (!empty($user)) {

							if ($user->status == '1') {
								$result = [
									'status' => true,
									'message' => 'Login Berhasil'
								];

								$this->session->set_userdata([
									'STATUS_LOGIN' => 'loggedIn',
									'identity' => $user,
								]);
							} else {
								$result = [
									'status' => false,
									'message' => 'Info user status user tidak aktif'
								];
							}
						} else {
							$result = [
								'status' => false,
								'message' => 'Info user tidak terdaftar'
							];
						}
					} else {
						$result = [
							'status' => false,
							'message' => 'Info (User/Password) yang Anda masukkan salah.'
						];
					}
				} else {
					$result = [
						'status' => false,
						'message' => 'Info (User/Password) yang Anda masukkan salah.'
					];
				}
			} else {
				$result = [
					'status' => false,
					'message' => 'Info Mohon Isi (User/Password)'
				];
			}
		}
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200) // Return status
			->set_output(json_encode($result));
	}

	public function actionLogout()
	{
		// $user_data = $this->session->all_userdata();
		$this->session->sess_destroy();
		return redirect('/site/login');
	}

	public function actionForgetPassword()
	{
		$this->layout->layout = 'login';
		$this->layout->title = 'Forget Password';

		$this->layout->render('forget_pass', []);
	}

	public function actionVerifikasi()
	{
		$this->layout->layout = 'login';
		$this->layout->title = 'OTP Verifikasi';

		$this->layout->render('otp_verifikasi', []);
	}

	public function actionConfirmPassword()
	{
		$this->layout->layout = 'login';
		$this->layout->title = 'Konfirmasi Password';

		$this->layout->render('confirm_pass', []);
	}

	public function actionRefreshCsrf()
	{
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200) // Return status
			->set_output(json_encode([
				'csrfName' => $this->security->get_csrf_token_name(),
				'csrfHash' => $this->security->get_csrf_hash()
			]));
	}
}

/* End of file SiteController.php */
/* Location: ./application/controllers/SiteController.php */