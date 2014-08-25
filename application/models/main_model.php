<?php
class Main_model extends CI_Model {

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
}