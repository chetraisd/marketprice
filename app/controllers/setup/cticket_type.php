<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cticket_type extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("setup/mticket_type","m");
        $this->lang->load('general', $this->session->userdata('lang'));
        $this->lang->load('ticket', $this->session->userdata('lang'));		
	}

	function index(){
		$data['option_park'] = $this->m->select_park();
		$data['option_localtion'] = $this->m->select_location();
		$this->load->view('header');
		$this->load->view('setup/ticket_type/vticket_type',$data);
		$this->load->view('footer');
	}

	function save_ticket(){ 
		$this->m->save();
	}

	function show_ticket(){
		header('Content-type: application/json');
		$show = $this->m->show(); 
		echo $show;
		exit();
	}

	function edit_ticket(){ 
		header('Content-type: application/json');
		$edit = $this->m->edit(); 
		echo json_encode($edit);
		exit();
	}

	function delete_ticket(){ 
		$this->m->delete_t();
	}

	function check_duplicat(){ 
		$this->m->check_duplicat();
	}

	function save_new(){ 
		$this->m->save_new();
	}
	
}