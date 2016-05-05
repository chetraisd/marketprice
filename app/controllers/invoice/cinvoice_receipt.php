<?php 
	class Cinvoice_receipt extends CI_Controller{ 
		public function __construct(){ 
			parent:: __construct();

		}

		function index(){ 
			$this->load->view('invoice/vinvoice_receipt');
		}
	}
?>