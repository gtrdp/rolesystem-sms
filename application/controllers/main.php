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
		$data['notif'] = $this->session->flashdata('notif');

		$this->load->view('login', $data);
	}

	public function login_processor()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$this->load->model('main_model');
		$result = $this->main_model->login_check($username, $password);

		if($result){
			$this->session->set_userdata('userid', $result);
			redirect('main/dashboard');
		}else{
			$this->session->set_flashdata('notif', 'Wrong username or password, please try again.');
			redirect('main/login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main/login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */