<?php
class Main_model extends CI_Model {

	public function __constructor()
	{
		parent::__constructor();
	}

	public function login_check($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);

		$result = $this->db->get('users');

		if($result->num_rows() > 0)
			return $result->row()->id;
		else
			return false;
	}

	public function get_clients()
	{
		return $this->db->get('clients');
	}

	public function send_sms($phone_number, $message)
	{
		$data = array(	'DestinationNumber' => $phone_number,
						'TextDecoded' => $message,
						'CreatorID' => 'Gammu'
					);

		$this->db->insert('outbox', $data);
	}

	public function get_stats()
	{
		$result = array();

		$stats = $this->db->get('stats')->row();

		$result['case_solved'] = $stats->case_solved;
		$result['sms_count'] = $stats->sms_count;
		$result['total_balance'] = $result['sms_count'] * $stats->sms_tariff;
		$result['spam_counter'] = $stats->spam_counter;

		$total_user = $this->db->get('clients');
		$result['registered_number'] = $total_user->num_rows();

		$rolesystem = new mysqli('localhost', 'root', 'root', 'rolesystem');
		$total_case = $rolesystem->query("SELECT COUNT('id') total_case FROM tab_kasus")->fetch_object();

		$result['total_case'] = $total_case->total_case;

		return $result;
	}
}