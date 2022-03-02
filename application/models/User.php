<?php

class User extends CI_Model {

	public function getByEmail($email)
	{
		$this->db->where('email',$email);
		$row = $this->db->get('users')->row_array();

		return $row;
	}

	public function getByMobile($mobile_number)
	{
		$this->db->where('mobile_number',$mobile_number);
		$row = $this->db->get('users')->row_array();

		return $row;
	}

	public function getById($id)
	{
		$this->db->where('id',$id);
		$row = $this->db->get('users')->row_array();

		return $row;
	}

	public function getAllUsers()
	{
		//$this->db->order_by('id','RANDOM');
		$row = $this->db->get('users')->result();

		return $row;
	}


	public function createUser($userData)
	{
		$this->db->insert('users',$userData);

		return true;
	}

	public function updateUser($updateData,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('users',$updateData);
	}

	public function createPost($postData)
	{
		$this->db->insert('post',$postData);

		return true;
	}

	public function getAllPosts()
	{
		//$this->db->order_by('id','RANDOM');
		$this->db->order_by("id", "desc");
		$row = $this->db->get('post')->result();

		return $row;
	}

	public function getPostByWriterId($id)
	{
		$this->db->order_by("id", "desc");
		$this->db->where('writer_id',$id);
		$row = $this->db->get('post')->result();

		return $row;
	}

	public function getPostById($id)
	{
		$this->db->where('id',$id);
		$row = $this->db->get('post')->row_array();

		return $row;
	}

	public function updatePost($updateData,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('post',$updateData);
	}

	//messages
	public function sendMessage($msgData)
	{
		$this->db->insert('messages',$msgData);

		return true;
	}

	public function getMsgsByCondition($conditionArray)
	{
		$this->db->where($conditionArray);
		$row = $this->db->get('messages')->result();

		return $row;
	}

	//comments
	public function writeComment($insert_data)
	{
		$this->db->insert('comments',$insert_data);

		return true;
	}

	public function getAllCommentByPostid($post_id)
	{
		//$this->db->order_by('id','RANDOM');
		$this->db->where('post_id', $post_id);
		$row = $this->db->get('comments')->result();

		return $row;
	}


}

?>