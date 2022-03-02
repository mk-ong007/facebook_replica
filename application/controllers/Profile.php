<?php

class Profile extends CI_Controller
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

	public function index($id)
	{
		$currentPage = "profile".$id;
		$this->load->model('User');

		$userData = $this->session->userdata('userData');

		$data['userData'] = $this->User->getById($userData['id']);
		$data['profileData'] = $this->User->getById($id);
		$data['userPost'] = $this->User->getPostByWriterId($id);
		$data['currentPage'] = $currentPage;
		if(!empty($data['profileData']))
		{
			//print_r($data); exit;
			$this->load->view('inc_header', $data);
			$this->load->view('profile.php', $data);
		}
		else{
			redirect('Error404');
		}
	}

	public function send_friend_request($requestId)
	{
		$currentPage = "profile";
		$this->load->model('User');
		$friendData = $this->User->getById($requestId);

		$userData = $this->session->userdata('userData'); 
		$currentUserData = $this->User->getById($userData['id']);
		$updateFriendData = array();
		$updateUserData = array();
		if(!empty($friendData['friend_request_id']))
		{
			$updateFriendData['friend_request_id'] = $friendData['friend_request_id'].",".$currentUserData['id'];
		}
		else
		{
			$updateFriendData['friend_request_id'] = $currentUserData['id'];
		}

		if(!empty($currentUserData['friend_request_send_id']))
		{
			$updateUserData['friend_request_send_id'] = $currentUserData['friend_request_send_id'].",".$friendData['id'];
		}
		else
		{
			$updateUserData['friend_request_send_id'] = $friendData['id'];
		}

		$this->User->updateUser($updateUserData,$currentUserData['id']);
		$this->User->updateUser($updateFriendData,$requestId);

		redirect("profile/index/".$requestId);	
	}

	public function profile_pic_update()
	{
		$this->load->model("User");
		$id = $_POST['id'];

		$config['upload_path']    = './src/uploads/profilePic/';
        $config['allowed_types']  = 'gif|jpg|png';
        $config['encrypt_name']   =  TRUE;
        $this->load->library('upload', $config);

        $response = 0;
        if ($this->upload->do_upload('profile_image')) 
        {
        	$imgData = $this->upload->data();
        	$this->User->updateUser(array("profile_pic"=>$imgData['file_name']), $id);

        	$response = base_url()."src/uploads/profilePic/".$imgData['file_name'];
        }
        else
        {
        	echo $this->upload->display_errors();
        }

        echo $response; 

	}

	public function profile_edit($id)
	{
		$this->load->model("User");
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile_number', 'Mobile number', 'trim|required|min_length[10]|max_length[10]');		
		$this->form_validation->set_rules('dob', 'DOB', 'trim|required');

		if($this->form_validation->run())
		{
			$uploadData = array(
								"first_name"    => $_POST['first_name'],
								"last_name"     => $_POST['last_name'],
								"email" => $_POST['email_address'],
								"mobile_number" => $_POST['mobile_number'],
								"dob"           => $_POST['dob'] 
								);
			$this->User->updateUser($uploadData, $id);
			echo 1;
		}
		else
		{	
			echo validation_errors();
		}



	}

	public function cancel_friend_request($requestId)
	{
		$this->load->model("User");
		$userData = $this->session->userdata("userData");

		$friendData = $this->User->getById($requestId);
		$currentUserData = $this->User->getById($userData['id']);

		$updateFriendData = array();
		$friendFRid = explode(",", $friendData['friend_request_id']);
		$removeKey = array_search(($userData['id']), $friendFRid);
		unset($friendFRid[$removeKey]);
		$updateFriendData['friend_request_id'] = implode(",", $friendFRid);	

		$updateUserData = array();	
		$userFRSid = explode(",", $currentUserData['friend_request_send_id']);
		$removeKey = array_search(($friendData['id']), $userFRSid);
		unset($userFRSid[$removeKey]);
		$updateUserData['friend_request_send_id'] = implode(",", $userFRSid);

		$this->User->updateUser($updateUserData,$currentUserData['id']);
		$this->User->updateUser($updateFriendData,$requestId);

		redirect("profile/index/".$friendData['id']);
		
	}

	
}

?>