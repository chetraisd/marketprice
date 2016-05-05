<?php 
	class C_report_sale extends CI_Controller{ 
		public function __construct(){ 
			parent:: __construct();
			$this->load->model('report/m_report_sale','m');			
			$this->lang->load('general', $this->session->userdata('lang'));
		}

		function index(){ 
			$data['option_pk'] = $this->m->select_pk();
			// $data['ticket_no'] = $this->m->ticket_no();
			$data['country'] = $this->m->select_country();
			$data['opt_agency'] = $this->m->select_agency();
			$this->load->view('header');
			$this->load->view('report/v_report_sale',$data);
			$this->load->view('footer');
		}

		function show_report_sale(){ 
			header('Content-type : application/json');
			echo $this->m->show_report();
		}

		function ticket_no_auto(){ 
			header('Content-type : application/json');
			echo $this->m->ticket_no_auto();
		}
	}


?>