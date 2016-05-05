<?php 
	class Cprice_list extends CI_Controller{ 
		public function __construct(){ 
			parent:: __construct();
			$this->load->model('setup/mprice_list','m');
			$this->lang->load('general', $this->session->userdata('lang'));
			
		}

		function index(){ 
			$data['option_package'] = $this->m->select_package();
			$this->load->view('header');
			$this->load->view('setup/price_list/vprice_list',$data);
			$this->load->view('footer');
		}

		function setup_price(){ 
			header('Content-type: application/json');
			echo $this->m->save_price();
			die();
		}

		function show_price_list(){ 
			header('Content-type: application/json');
			echo $this->m->show_price();
			die();
		}

		function edit_price_list(){ 
			header('Content-type: application/json');
			echo $this->m->edit_price();
			die();
		}

		function delete_price_list(){ 
			header('Content-type: application/json');
			echo $this->m->delete_price();
			die();
		}
		
	}

?>