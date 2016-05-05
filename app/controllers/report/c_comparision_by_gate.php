<?php 
	class C_comparision_by_gate extends CI_Controller{ 
		public function __construct(){ 
			parent:: __construct();
			$this->load->model('report/m_comparision_by_gate','m');
			$this->lang->load('general',$this->session->userdata('lang'));
		}

		function index(){ 
			$data['option_gate'] = $this->m->select_gate();
			// $data['option_park'] = $this->m->select_park();
			$this->load->view('header');
			$this->load->view('report/v_comparision_by_gate',$data);
			$this->load->view('footer');
		}

		function show_report_Comparision(){ 
			header('Content-type: application/json');
			echo $this->m->show();
			die();
		}
	}
?>