<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
		//load the models;
		$this->load->model("Login_model");
		// $this->load->helper('url');
        $this->load->database();

	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{  
		if(isset($_SESSION['user_id'])){
			redirect('admin/dashboard');
		}
		$data=[];   
		if(isset($_SESSION['error'])){
			// die($_SESSION['error']);
			$data['error']=$_SESSION['error'];
		}else{
			$data['error']='';

		}
		$this->load->view('admin_panel/login_view',$data);
	}
	public function login_post(){
		if(isset($_POST)){
			$email=$_POST['email'];
			$password=$_POST['password'];
			$query=$this->db->query("SELECT * FROM `backenduser` WHERE `username`='$email' AND `password`='$password'");
			if($query->num_rows()){
				$row = $query->result_array();
				$data = array(
				  'email'           => $row[0]['username'],
				  'password'        => $row[0]['password'],
				  'user_id'      => $row[0]['uid'],
				);
				$this->session->set_userdata($data);
				redirect('admin/dashboard');
			}else{
				$this->session->set_flashdata('error','Invalid credentials');
				redirect('admin/login');

			}
		}else{
			die("Invalid inputs!");
		}
	}
	function logout(){
		session_destroy();
		redirect('admin/login');

	}
}
