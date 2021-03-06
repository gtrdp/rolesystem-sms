<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('main_model');
	}

	private function check_login_session()
	{
		if($this->session->userdata('userid') == ''){
			redirect('main/index');
		}
	}

	public function index()
	{
		redirect('main/login');
	}

	public function dashboard()
	{
		$this->check_login_session();

		$data['page'] = 'dashboard';
		$data['page_title'] = 'Dashboard';

		// load statistics
		$data['stats'] = $this->main_model->get_stats();

		$this->load->template('dashboard', $data);
	}

	public function users()
	{
		$this->check_login_session();

		$data['page'] = 'users';
		$data['page_title'] = 'Users';
		$data['notif'] = $this->session->flashdata('notif');

		$data['clients'] = $this->main_model->get_clients();

		$this->load->template('users', $data);
	}

	public function logs($id = '')
	{
		$this->check_login_session();

		if($id != ''){
			$sorting = strtoupper($this->input->get('sorting'));
			$phone_number = $this->main_model->get_number_from_id($id);
			$data['logs'] = $this->main_model->get_logs($phone_number, $sorting);
			
			if($sorting == 'ASC')
				$data['sorting_link'] = site_url('main/logs/'.$id.'/?sorting=desc');
			else
				$data['sorting_link'] = site_url('main/logs/'.$id.'/?sorting=asc');

			$data['page'] = 'logs';
			$data['page_title'] = 'Logs';

			$this->load->template('logs', $data);
		}else{
			$this->session->set_flashdata('notif', 'Please open from the "See logs" links in registered numbers table!');
			redirect('main/users');
		}
	}

	public function send_sms()
	{
		$this->check_login_session();

		$data['page'] = 'send_sms';
		$data['page_title'] = 'Send SMS';

		$data['notif'] = $this->session->flashdata('notif');

		$this->load->template('send_sms', $data);
	}

	public function sms_sender()
	{
		$this->check_login_session();

		$phone_number = $this->input->post('phone_number');
		$message = $this->input->post('message');

		if($phone_number != '' && $message != '') {
			$this->main_model->send_sms($phone_number, $message);

			$this->session->set_flashdata('notif', 'SMS has been sent!');
			redirect('main/send_sms');
		}
	}

	public function login()
	{
		$data['page'] = 'login';
		$data['page_title'] = 'Login';
		$data['notif'] = $this->session->flashdata('notif');

		$this->load->view('login', $data);
	}

	public function login_processor()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

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