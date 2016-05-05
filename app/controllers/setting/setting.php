<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('setting/usermodel','user');
		$this->load->model('setting/rolemodel','role');
		$this->load->library('pagination');	
		$this->load->helper(array('form', 'url'));
        $this->lang->load('general', $this->session->userdata('lang'));
	}
	public function index()
	{	
		$data['query']=$this->user->getuser();
		$this->load->view('header');		
		$this->load->view('setting/vsetting',$data);
		$this->load->view('footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */