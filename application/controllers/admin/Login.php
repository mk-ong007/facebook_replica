<?php
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$log_in = $this->session->userdata('log_in');
		if($log_in == true)
		{
			redirect(base_url().'admin/home');
		}
    	$this->load->library('form_validation');
		$this->load->view('admin/login');
	}

	public function authenticate()
	{
    	$this->load->library('form_validation');
    	$this->load->model('Admin');

    	$this->form_validation->set_rules('email','Email','trim|required|valid_email');
    	$this->form_validation->set_rules('password','Password','trim|required');

    	if($this->form_validation->run() == true)
    	{
    		//success
    		$email = $this->input->post('email');
    		$password = $this->input->post('password');

    		$row = $this->Admin->getByEmail($email);

    		if($row)
    		{
    			if(password_verify($password, $row['password']))
    			{
                    if( $this->input->post('rememberMe') == 'on')
                    {
                        setcookie('email', $email, time()+ strtotime("30 Days"));
                        setcookie('password', $password, time()+strtotime("30 Days"));
                    }
                    else{
                        setcookie('email', "");
                        setcookie('password', "");
                    }
    				$this->session->set_userdata('log_in',true);
    				redirect(base_url().'admin/home');
    			}
    			else
    			{
    				$this->session->set_flashdata('msg','Either email or password is incorrect!');
    				redirect(base_url().'admin/login');
    			}

    		}
    		else
    		{
    			$this->session->set_flashdata('msg','Either email or password is incorrect!');
    			redirect(base_url('admin/login'));
    		}
    	}
    	else
    	{
    		//form error
    		$this->load->view('admin/login');
    	}
	}

	public function logout()
	{
		$this->session->unset_userdata('log_in');
		redirect(base_url().'admin/login');
	}
}
?>