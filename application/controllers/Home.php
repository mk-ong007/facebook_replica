<?php

class Home extends CI_Controller
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
		$currentPage = "home";
		$this->load->model('User');

		$userData = $this->session->userdata('userData');

		$data['userData'] = $this->User->getById($userData['id']);
		$data['posts'] = $this->User->getAllPosts();
		$data['currentPage'] = $currentPage;

		$this->load->view('inc_header', $data);
		$this->load->view('dashboard.php', $data);
	}

	
}

?>