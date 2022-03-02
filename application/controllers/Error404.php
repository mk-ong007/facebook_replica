<?php

class Error404 extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$log_in = $this->session->userdata('user_log_in');
		if($log_in == false)
		{
			redirect(base_url().'login');
		}

	}

	public function index()
	{
		$this->load->view('error404');
	}
	
}

?>