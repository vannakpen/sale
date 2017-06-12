<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		if($this->session->userdata('user_info')) redirect(base_url('dashboard'));
		$this->session->set_userdata('site_lang',(($this->session->userdata('site_lang'))?$this->session->userdata('site_lang'):$this->config->item('language')));
		$this->lang->load('label',$this->session->userdata('site_lang'));
	}
	public function index()
	{
		$this->load->view('landingpage');
	}
	public function page_404(){
		$this->load->view('master/page_404');
	}
}