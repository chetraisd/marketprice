<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sys extends CI_Controller {

	public function __construct(){
		parent::__construct();		
		$this->load->helper(array('form', 'url'));
		$this->load->model('systems/modsys','msys');
		$this->lang->load('general', $this->session->userdata('lang'));
	}
	public function dupcheck()
	{	
		$ref_val=$_POST['ref_val'];
		$ref_field=$_POST['ref_field'];
		$ref_table=$_POST['ref_table'];
		$arrJson=array();
		if($ref_val!="" && $ref_field!="" && $ref_table!=""){
			$arrJson['isDup']=$this->green->getValue("SELECT COUNT({$ref_table}.{$ref_field}) as num 
																FROM {$ref_table} 
																WHERE {$ref_table}.{$ref_field}='{$ref_val}'
															")-0;			
			
		}	

		echo header("Content-type:text/x-json");
		echo json_encode($arrJson) ;
		exit();
	}

	//=========== for run script =========

	public function runMultiQuery($query){

		$mysqli = new mysqli("localhost", "greensim", "GrEEnICT#9999", "greensim_v4_01");
		/* check connection */
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}	
		if($query!=""){
			$mysqli->multi_query($query);
		}


		$mysqli->close();

	}
	function runQuery(){
		$sql="";
		$this->runMultiQuery($sql);
	}
	
	function backupdb(){
		// Load the DB utility class
		$this->load->dbutil();
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/path/to/mybackup.gz', $backup);
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('mybackup.gz', $backup); 
	}

	function cleartransaction(){
		$this->load->view('header');
		$this->load->view('systems/vcleartransaction');
		$this->load->view('footer');
	}
	function  deletedata(){
		$this->msys->deletedata();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */