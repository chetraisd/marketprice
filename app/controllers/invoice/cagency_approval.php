<?php 
	class Cagency_approval extends CI_Controller{ 
		public function __construct(){ 
			parent:: __construct();
			$this->load->model('invoice/magency_approval','m');
			$this->lang->load('general',$this->session->userdata('lang'));
			
		}

		function index(){
			
			if(isset($_GET['agecy_trans_typeno'])){ 
				$data['agecy_trans_typeno'] = $_GET['agecy_trans_typeno'];	
			}else{ 
				$data['agecy_trans_typeno'] = '';
			}
			
			$data['option_package'] = $this->m->select_package();
			// $data['option_agency'] = $this->m->select_agency();
			$data['option_user'] = $this->m->select_user($data['agecy_trans_typeno']);
			$this->load->view('header');
			$this->load->view('invoice/vagency_approval',$data);
			$this->load->view('footer');
		}

		function save_approval(){ 
			header('Content-type : application/json');
			echo $this->m->save_approval();
		}

		function check_package(){ 
			header('Content-type : application/json');
			echo $this->m->check_package();
		}

		function agency_auto(){ 
			header('Content-type : application/json');
			echo $this->m->agency_auto();
			
		}

		function check_agency(){ 
			header('Content-type : application/json');
			echo $this->m->check_agency();
		}
		
	}
?>