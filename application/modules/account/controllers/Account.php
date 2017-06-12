<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('../mod_global');
		$this->lang->load('label',$this->session->userdata('site_lang'));
	}
	public function reset_password()
	{
		$this->load->view('reset_password');
		//echo 'Hello from HMVC';
	}
	
	public function login(){
		
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$data = array(
			'merUseEmail' => $email,
			'merUsePassword' => md5($password)
		);
		$validate_data = $this->mod_global->select_row_array('merchants_users',$data);
		if(count($validate_data) > 0){
			$this->session->set_userdata('user_info',json_encode($validate_data[0]));
			echo 'TRUE';
		}else{
			echo 'FALSE';
		}
		die;
		//echo 'You account with '.$email.' password = '.$password;
	}
	
	public function logout(){
		if($this->session->userdata['user_info']) $this->session->unset_userdata('user_info');
		redirect(base_url());
	}
}