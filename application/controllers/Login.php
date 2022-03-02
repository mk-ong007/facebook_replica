<?php
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $language = $this->session->userdata('language');
        $this->lang->load('general', $language);
	}

	public function index()
	{
        // echo $this->lang->line('name');
        $language = $this->session->userdata('language');
        $this->lang->load('login', $language);

		$log_in = $this->session->userdata('user_log_in');
		if($log_in == true)
		{
			redirect(base_url().'home');
		}
    	$this->load->library('form_validation');
		$this->load->view('login.php');
	}

	public function authenticate()
	{
    	$this->load->library('form_validation');
    	$this->load->model('User');

    	$this->form_validation->set_rules('loginEmailMobile','Email or mobile','trim|required');
    	$this->form_validation->set_rules('loginPassword','Password','trim|required');

    	if($this->form_validation->run() == true)
    	{
    		//success
    		$loginEmailMobile = $this->input->post('loginEmailMobile');
    		$password = $this->input->post('loginPassword');

            if ( filter_var( $loginEmailMobile, FILTER_VALIDATE_EMAIL ) )
            {
                $email = filter_var( $loginEmailMobile, FILTER_SANITIZE_EMAIL);
                $row = $this->User->getByEmail($email);
                if($row)
                {
                    if(password_verify($password, $row['password']))
                    {
                        if($row['status'] == 1){
                            $this->session->set_userdata('user_log_in',true);
                            $this->session->set_userdata('userData',$row);  
                            redirect(base_url().'home');
                        }else{
                            $this->session->set_flashdata('msg','Need to active, <br>Please contact admin click <a href="mailto:pro.manish007@gmail.com">here</a>.');
                            redirect(base_url().'login');
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Either email or password is incorrect!');
                        redirect(base_url().'login');
                    }

                }
                else
                {
                    $this->session->set_flashdata('msg','Either email or password is incorrect!');
                    redirect(base_url().'login');
                }

            }
            elseif( preg_match("/^[6-9]{1}[0-9]{9}$/", $loginEmailMobile) )
            {
                $mobileNo = $loginEmailMobile;
                $row = $this->User->getByMobile($mobileNo);
                if($row)
                {
                    if(password_verify($password, $row['password']))
                    {
                        if($row['status'] == 1){
                            $this->session->set_userdata('user_log_in',true);
                            $this->session->set_userdata('userData',$row);  
                            redirect(base_url().'home');
                        }else{
                            $this->session->set_flashdata('msg','Need to active, <br>Please contact admin click <a href="mailto:pro.manish007@gmail.com">here</a>.');
                            redirect(base_url().'login');
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('msg','Either email or password is incorrect!');
                        redirect(base_url().'login');
                    }

                }
                else
                {
                    $this->session->set_flashdata('msg','Either email or password is incorrect!');
                    redirect(base_url().'login');
                }
                
            } else{
                $this->session->set_flashdata('msg','Either email or password is incorrect!');
                redirect(base_url().'login');
            }

    		
    	}
    	else
    	{
    		//form error
    		$this->load->view('login');
    	}
	}

	public function logout()
	{
		$this->session->unset_userdata('user_log_in');
		redirect(base_url().'login');
	}


    public function signup()
    {

        $this->load->library('form_validation');
        $this->load->model('User');

        $this->form_validation->set_rules('firstName','First name','trim|required');
        $this->form_validation->set_rules('lastName','Last name','trim|required');
        $this->form_validation->set_rules('emailMobile','Email or mobile','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        $this->form_validation->set_rules('gender','Gender','trim|required');
        $this->form_validation->set_rules('dob','Dob','trim|required');


        if($this->form_validation->run() == true)
        {
           
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $emailMobile = $_POST['emailMobile'];
            $password = $_POST['password'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];


            //validate email
            if ( filter_var( $emailMobile, FILTER_VALIDATE_EMAIL ) )
            {
                $_POST['email'] = filter_var( $emailMobile, FILTER_SANITIZE_EMAIL);
                unset($_POST['emailMobile']);
                $_POST['mobile_number'] = "";

                $row = $this->User->getByEmail($emailMobile);
                if($row)
                {
                    echo "<div class='alert alert-success'>Account already exist!</div>";
                    exit;
                }
            }

            //validate mobile no.
            $mob="/^[6-9]{1}[0-9]{9}$/";
            if ( preg_match($mob, $emailMobile) )
            {
                $_POST['mobile_number'] = $emailMobile;
                unset($_POST['emailMobile']);
                $_POST['email'] = "";                

                $row = $this->User->getByMobile($emailMobile);
                if( $row )
                {
                    echo "<div class='alert alert-success'>Account already exist!</div>";
                    exit;
                }
            }



            //validate password
            $number = preg_match('@[0-9]@', $password);
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            
            $error = false;
            if( (strlen($password) < 6) || !$number || !$uppercase || !$lowercase || !$specialChars ) 
            {
                $error = true;
            } 

            $password = password_hash($password, PASSWORD_DEFAULT);

            if( $error == false)
            {
                $userData = array(
                                    'first_name' => $_POST['firstName'],
                                    'last_name' => $_POST['lastName'],
                                    'email' => $_POST['email'],
                                    'mobile_number' => $_POST['mobile_number'],
                                    'password' => $password,
                                    'dob' => $dob,
                                    'gender' => $gender,
                                    'created_at' => time()
                                );

                if( $this->User->createUser($userData )){
                    echo "<div class='alert alert-success'>Account created successfully</div>";
                }
                else{
                    echo "Something went wrong!";
                }
            }
            else{
                echo "Something went wrong!";
            }

        }
        else
        {
            $this->load->view('login');
        }

    }


    public function forget_identify()
    {
        $this->load->view('forget_identify');
    }

    public function set_language()
    {
        $language = $this->input->post('lang');
        $this->session->set_userdata('language', $language);
    }
 
}
?>