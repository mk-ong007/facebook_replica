<?php

class Admin extends CI_Model {

	public function getByEmail($email)
	{
		$this->db->where('email',$email);
		$row = $this->db->get('admin')->row_array();

		return $row;
	}

	public function getAllData($tablename)
	{
		$data = $this->db->get($tablename)->result();

		return $data;
	}
}

?>