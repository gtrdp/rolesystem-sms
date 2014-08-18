<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		redirect('main/login');
	}

	public function dashboard()
	{
		$data['page'] = 'dashboard';

		$this->load->template('dashboard', $data);
	}

	public function users()
	{
		$data['page'] = 'users';

		$this->load->template('users', $data);
	}

	public function logs($id = '')
	{
		if($id != ''){
			$data['page'] = 'logs';

			$this->load->template('logs', $data);
		}else{
			redirect('main/users');
		}
	}

	public function send_sms()
	{
		$data['page'] = 'send_sms';

		$this->load->template('send_sms', $data);
	}

	public function login()
	{
		$data['page'] = 'login';
		$data['notif'] = false;

		$this->load->view('login', $data);
	}

	public function login_processor()
	{

	}

	public function logout()
	{

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */