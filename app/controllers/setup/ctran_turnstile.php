<?php 
	class Ctran_turnstile extends CI_Controller{ 
		public function __construct(){ 
			parent:: __construct();
			$this->lang->load('general', $this->session->userdata('lang'));
			$this->load->model('setup/mtran_turnstile','m');
		}

		function index(){ 
			$data['option_turnstile'] = $this->m->select_turnstile();
			$data['search_turnstile'] = $this->m->turnstile_search();
			$this->load->view('header');
			$this->load->view('setup/tran_turnstile/vtran_turnstile',$data);
			$this->load->view('footer');
		}

		function save_turnstile(){ 
			header('Content-type : application/json');
			echo $this->m->save_turnstile();
			die();
		}

		function show_list_turnstile(){ 
			header('Content-type : application/json');
			echo $this->m->show_list_turnstile();
			die();
		}

		function select_old_value(){ 
			header('Content-type : application/json');
			echo $this->m->select_old_value();
			die();
		}
	}
?>