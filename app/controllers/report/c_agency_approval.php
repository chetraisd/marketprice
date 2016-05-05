<?php 
	class C_agency_approval extends CI_Controller{ 
		public function __construct(){ 
			parent:: __construct();
			$this->lang->load('general',$this->session->userdata('lang'));
			$this->load->model('report/m_agency_approval','m');
		}

		function index(){ 
			$data['option_tour_guide'] = $this->m->select_tour_guide();
			$data['option_parkage'] = $this->m->select_package();
			$data['option_agency'] = $this->m->select_agency();
			$this->load->view('header');
			$this->load->view('report/v_agency_approval',$data);
			$this->load->view('footer');
		}

		function query_approval(){ 
			header('Content-type : application/json');
			echo $this->m->query_appeoval();
		}

		function delete_approval(){ 
			header('Content-type : application/json');
			echo $this->m->delete_approval();
		}
	}

?>