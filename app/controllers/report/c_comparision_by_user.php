<?php 
	Class C_comparision_by_user	extends CI_Controller{ 
		public function __construct(){ 
			parent:: __construct();
			$this->load->model('report/m_comparision_by_user','m');
			$this->lang->load('general',$this->session->userdata('lang'));
		}

		function index(){ 
			$data['option_gat'] = $this->m->select_gate();
			$data['option_user'] = $this->m->select_user();
			$this->load->view('header');
			$this->load->view('report/v_comparision_by_user',$data);
			$this->load->view('footer');
		}

		function show_comparision_report(){ 
			header('Content-type: application/json');
			echo $this->m->show();
			die();
		}
	}
?>