<?php

class Post extends CI_Controller
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
		// $currentPage = "home";
		// $this->load->model('User');

		// $userData = $this->session->userdata('userData');

		// $data['userData'] = $this->User->getById($userData['id']);
		// $data['currentPage'] = $currentPage;

		// $this->load->view('inc_header', $data);
		// $this->load->view('dashboard.php', $data);
	}

	public function write_post($id)
	{		
		$currentPage = "home";
		$this->load->model('User');

		$userData = $this->User->getById($id);

		$config['upload_path']    = './src/uploads/postPics/';
        $config['allowed_types']  = 'gif|jpg|jpeg|png|gif';
        $config['encrypt_name']   =  TRUE;
        $this->load->library('upload', $config);

        $post_image = "";
        if ($this->upload->do_upload('postPhoto')) 
        {
        	$imgData = $this->upload->data();
        	$post_image_url = base_url()."src/uploads/postPics/".$imgData['file_name'];
        	$post_image = "<br><img class='img-fluid img-thumbnail'  src=".$post_image_url.">";
        }

        //echo $post_image;


		$postData = array(
						"writer_id"    => $id,
						"writer_name"  => $userData['first_name']." ".$userData['last_name'],
						"writer_dp"    => $userData['profile_pic'],
						"post_content" => $_POST['postContent'].$post_image,
						"created_at"   => time(),
					);

		if($this->User->createPost($postData))
		{
			$this->session->set_flashdata("msg", "Post created successfully." );
		}		
		redirect("home");

	}

	public function post_like()
	{
		 // print_r($_POST); exit;
		$this->load->model('User');

		if( isset($_POST['postId']) && isset($_POST['like']) )
		{
			$postId = $_POST['postId'];
			$like = $_POST['like'];

			$userData = $this->session->userdata("userData");
			$postData = $this->User->getPostById($postId);

			$updateData = array();
			if($like == 1)
			{
				$updateData['likes'] = $postData['likes']+1;

				if(!empty($postData['liker_id']))
				{
					$updateData['liker_id'] = $postData['liker_id'].",".$userData['id'];
				}else{
					$updateData['liker_id'] = $userData['id'];
				}
				echo "liked";
			}
			elseif ($like == 0) {
				$updateData['likes'] = $postData['likes']-1;

				if(!empty($postData['liker_id']))
				{
					$liker_id = explode(",", $postData['liker_id']);
					$removeKey = array_search($userData['id'], $liker_id);
					unset($liker_id[$removeKey]);
					$updateData['liker_id'] = implode(",", $liker_id);
				}
				echo "disliked";
			}

			// print_r($updateData); exit;

			$this->User->updatePost($updateData, $postId);
		}
	}

	public function write_comment(){
		// echo "<pre>";
		// print_r($_POST);
		if( isset($_POST['post_id']) && isset($_POST['author_id']) && isset($_POST['content']) ){
				$this->load->model('User');
		
				$insert_data = array(
										"post_id"   => $_POST['post_id'],
										"author_id" => $_POST['author_id'],
										"content"   => $_POST['content'],
										"created_at"=> time(),
									);
				$this->User->writeComment($insert_data);
		
				$comments = $this->User->getAllCommentByPostid($_POST['post_id']);

				foreach($comments as $value)
				{
					$userData = $this->User->getById($value->author_id);
					$comments->author_name = $userData['first_name']." ".$userData['last_name'];
					$comments->auther_dp = $userData['profile_pic'];
				}
		
				echo json_encode($comments);
		}
	}

	

	
}

?>