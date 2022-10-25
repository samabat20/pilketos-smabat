<?php
class User_Model extends CI_Model
{
	public function login($username, $password)
	{
		$condition	= "username=" . "'" . $username . "'" . " AND " . "password=" . "'" . $password . "'";
		$select		= array('username', 'password');
		$this->db->select($select);
		$this->db->from('tb_siswa');
		$this->db->where($condition);
		$login 		= $this->db->get();

		if ($login->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function valid($username)
	{
		$condition	= "username=" . "'" . $username . "'";
		$select		= array('username');
		$this->db->select($select);
		$this->db->from('view_vote');
		$this->db->where($condition);
		$login 		= $this->db->get();

		if ($login->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function datamodel()
	{
		$load	= $this->db->query("SELECT * FROM tb_pilihan ORDER BY no ASC");
		return $load->result_Array();
	}
	public function vote($nisn, $username)
	{
		$data			= array(
			'nisn'		=> $nisn,
			'username'	=> $username
		);
		$query = $this->db->get_where('tb_pilih', array(
			'username'	=> $username
		));

		$count = $query->num_rows();
		if ($count) {
			// $this->session->set_flashdata('error', 'Such User exists. Please try again!');
			return false;
		}
		$insert = $this->db->insert('tb_pilih', $data);
		return $insert;
	}
	public function hadir($username)
	{
		$update = $this->db->query("UPDATE tb_siswa SET hadir='Hadir' WHERE username='$username'");
		return $update;
	}
}
