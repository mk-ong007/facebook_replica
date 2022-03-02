<?php

class Message extends CI_Controller
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
		//print_r($_POST['recieverId']);
		$this->load->model("User");
		$userData = $this->session->userdata('userData');

		$conditionForRight = array(
							"sender_id" => $userData['id'],
							"receiver_id" => $_POST['recieverId'],
						);

		$conditionForLeft = array(
							"sender_id" => $_POST['recieverId'],
							"receiver_id" => $userData['id'],
						);

		$messagesForRight = $this->User->getMsgsByCondition($conditionForRight);
		$messagesForLeft = $this->User->getMsgsByCondition($conditionForLeft);

		$messages = array_merge($messagesForRight,$messagesForLeft);

		$created_at = array_column($messages, 'created_at');
		array_multisort($created_at, SORT_ASC, $messages);

		echo json_encode($messages);


	}

	public function send_message()
	{
		$this->load->model('User');
		$userData = $this->session->userdata('userData');

		$msgData = array(
						"sender_id" => $userData['id'],
						"receiver_id" => $_POST['recieverId'],
						"message" => $_POST['messsage'],
						"created_at" => time(),
					);

		//print_r($msgData);

		$this->User->sendMessage($msgData);

	}

	public function headerMessanger()
	{
		$this->load->model('User');
		$userData = $this->session->userdata('userData');

		$conditionForRight = array(
							"sender_id" => $userData['id'],
						);

		$conditionForLeft = array(
							"receiver_id" => $userData['id'],
						);

		$messagesForRight = $this->User->getMsgsByCondition($conditionForRight);
		$messagesForLeft = $this->User->getMsgsByCondition($conditionForLeft);

		$messages = array_merge($messagesForRight,$messagesForLeft);

		$created_at = array_column($messages, 'created_at');
		array_multisort($created_at, SORT_DESC, $messages);

		$n=1;
		$end_n=1;
		foreach ($messages as $key1 => $value1) {
			$senderId = $value1->sender_id;
			$receiverId = $value1->receiver_id;

			foreach ($messages as $key2 => $value2) {
				
				if( ((($value2->sender_id == $senderId) && ($value2->receiver_id == $receiverId)) || (($value2->receiver_id == $senderId) && ($value2->sender_id == $receiverId))) && $n>$end_n)
				{

					unset($messages[$n-1]);
				}
				$n++;
			}
			$end_n++;
			$n=$end_n;
			
		}
		

		foreach ($messages as $key => $value) {
			if( $userData['id'] != $value->sender_id )
			{
				$row = $this->User->getById($value->sender_id);
				$value->friend_name = $row['first_name']." ".$row['last_name'];
				$value->friend_id = $row['id'];
				$value->friend_dp = $row['profile_pic']?(base_url("src/uploads/profilePic/").$row['profile_pic']):"https://bit.ly/3g41HcM";

			}elseif ( $userData['id'] != $value->receiver_id ) 
			{
				$row = $this->User->getById($value->receiver_id);
				$value->friend_name = $row['first_name']." ".$row['last_name'];
				$value->friend_id = $row['id'];
				$value->friend_dp = $row['profile_pic']?(base_url("src/uploads/profilePic/").$row['profile_pic']):"https://bit.ly/3g41HcM";
			}
		}


		echo json_encode($messages);

	}
	
}

?>