<?php 
	class C_tour_group_ticket extends CI_Controller{ 
		public function __construct(){ 
			parent:: __construct();
		}

		function index(){ 
			$data['agency_trans_typeno'] = $_GET['agency_trans_typeno'];
			$data['package_typeno']      = $_GET['package_typeno'];
			$this->load->view('invoice/tour_ticket/v_tour_group_ticket',$data);
		}
	}
?>