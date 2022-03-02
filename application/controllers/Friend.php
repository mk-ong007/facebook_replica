<?php

class Friend extends CI_Controller
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
		$currentPage = "friends";
		$this->load->model('User');

		$userData = $this->session->userdata('userData');

		$data['allUsers'] = $this->User->getAllUsers();
		//print_r($data['allUsers']);exit;
		$data['userData'] = $this->User->getById($userData['id']);
		$data['currentPage'] = $currentPage;

		$this->load->view('inc_header', $data);
		$this->load->view('friends', $data);
	}

	public function friend_requests()
	{
		$currentPage = "friend_requests";
		$this->load->model('User');

		$userData = $this->session->userdata('userData');

		$data['allUsers'] = $this->User->getAllUsers();
		$data['userData'] = $this->User->getById($userData['id']);
		$data['currentPage'] = $currentPage;

		$this->load->view('inc_header', $data);
		$this->load->view('friend_request',$data);
	}

	public function user_friends()
	{
		$currentPage = "user_friends";
		$this->load->model('User');

		$userData = $this->session->userdata('userData');

		$data['allUsers'] = $this->User->getAllUsers();
		$data['userData'] = $this->User->getById($userData['id']);
		$data['currentPage'] = $currentPage;

		$this->load->view('inc_header', $data);
		$this->load->view('user_friend_list');
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

		redirect("friend");	
	}

	public function confirm_request($requestId)
	{
		$this->load->model('User');

		$userData = $this->session->userdata('userData');
		$currentUserData = $this->User->getById($userData['id']);
		$friendData = $this->User->getById($requestId);

		$updateUserData = array();
		if( !empty($currentUserData['friends_id']) )
		{
			$updateUserData['friends_id'] = $currentUserData['friends_id'].",".$friendData['id'];

			$currentUserFRid = explode(",", $currentUserData['friend_request_id']);
			$removeKey = array_search($requestId, $currentUserFRid);
			unset($currentUserFRid[$removeKey]);

			$updateUserData['friend_request_id'] = implode(",", $currentUserFRid);
		}
		else{
			$updateUserData['friends_id'] = $friendData['id'];

			$currentUserFRid = explode(",", $currentUserData['friend_request_id']);
			$removeKey = array_search($requestId, $currentUserFRid);
			unset($currentUserFRid[$removeKey]);

			$updateUserData['friend_request_id'] = implode(",", $currentUserFRid);
		}

		$updateFriendData = array();
		if(!empty($friendData['friends_id']))
		{
			$updateFriendData['friends_id'] = $friendData['friends_id'].",".$currentUserData['id'];

			$friendFRSid = explode(",", $friendData['friend_request_send_id']);
			$removeKey = array_search($currentUserData['id'], $friendFRSid);
			unset($friendFRSid[$removeKey]);

			$updateFriendData['friend_request_send_id'] = implode(",", $friendFRSid);
		}
		else{
			$updateFriendData['friends_id'] = $currentUserData['id'];

			$friendFRSid = explode(",", $friendData['friend_request_send_id']);
			$removeKey = array_search($currentUserData['id'], $friendFRSid);
			unset($friendFRSid[$removeKey]);

			$updateFriendData['friend_request_send_id'] = implode(",", $friendFRSid);
		}

		//echo "<pre>"; print_r($updateUserData); exit;

		$this->User->updateUser($updateUserData,$currentUserData['id']);
		$this->User->updateUser($updateFriendData,$requestId);
		$this->session->set_flashdata('msg', $friendData['first_name']." is added in your friend list.");
		redirect("friend/friend_requests");		
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

		redirect("friend");
		
	}

	public function delete_request($requestId)
	{
		$this->load->model("User");
		$userData = $this->session->userdata("userData");

		$friendData = $this->User->getById($requestId);
		$currentUserData = $this->User->getById($userData['id']);

		$updateUserData = array();
		$userFRid = explode(",", $currentUserData['friend_request_id']);
		$removeKey = array_search(($friendData['id']), $userFRid);
		unset($userFRid[$removeKey]);
		$updateUserData['friend_request_id'] = implode(",", $userFRid);	

		$updateFriendData = array();	
		$friendFRSid = explode(",", $friendData['friend_request_send_id']);
		$removeKey = array_search(($currentUserData['id']), $friendFRSid);
		unset($friendFRSid[$removeKey]);
		$updateFriendData['friend_request_send_id'] = implode(",", $friendFRSid);

		$this->User->updateUser($updateUserData,$currentUserData['id']);
		$this->User->updateUser($updateFriendData,$requestId);

		redirect("friend/friend_requests");
		
	}

	public function unfriend($requestId)
	{
		$this->load->model("User");
		$userData = $this->session->userdata("userData");

		$friendData = $this->User->getById($requestId);
		$currentUserData = $this->User->getById($userData['id']);

		$updateUserData = array();
		$userFid = explode(",", $currentUserData['friends_id']);
		$removeKey = array_search(($friendData['id']), $userFid);
		unset($userFid[$removeKey]);
		$updateUserData['friends_id'] = implode(",", $userFid);	

		$updateFriendData = array();	
		$friendFid = explode(",", $friendData['friends_id']);
		$removeKey = array_search(($currentUserData['id']), $friendFid);
		unset($friendFid[$removeKey]);
		$updateFriendData['friends_id'] = implode(",", $friendFid);

		$this->User->updateUser($updateUserData,$currentUserData['id']);
		$this->User->updateUser($updateFriendData,$requestId);
		$this->session->set_flashdata('msg', $friendData['first_name']." is remove in your friend list.");
		redirect("friend/user_friends");
	}

	
}