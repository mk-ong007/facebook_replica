<?php

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$log_in = $this->session->userdata('log_in');
		if($log_in == false)
		{
			redirect(base_url('admin/login'));
		}

	}

	public function index()
	{
		$data['dashboard'] = true;

		$this->load->view('admin/inc_header',$data);
		$this->load->view('admin/index');
		$this->load->view('admin/inc_footer');
	}

	public function users_list()
	{
		$this->load->model('Admin');
		$userData = $this->Admin->getAllData('users');

		$data['user_data'] = $userData;
		$data['users_list'] = true;
		$this->load->view('admin/inc_header',$data);
		$this->load->view('admin/users_list',$data);
		$this->load->view('admin/inc_footer');
	}

	public function user_status_change()
	{
		$this->load->model('User');

		$id = $_POST['userid'];

		$checked = $_POST['checked'];

		$updateData = array("status"=>$checked);
		$this->User->updateUser($updateData,$id);
		
	}

}

?>