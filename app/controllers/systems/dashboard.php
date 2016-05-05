<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	protected $thead;
	protected $idfield;
	protected $searchrow;	
	function __construct(){
		
		parent::__construct();
		$this->load->library('pagination');			
		$this->load->model('system/ModDashBoard','dash');
        $this->lang->load('general', $this->session->userdata('lang'));
	}
	function index(){

		$data['thead']=	$this->thead;
		$data['page_header']="";
		$this->parser->parse('header', $data);
		$this->parser->parse('system/dashboard_form', $data);
		$this->parser->parse('footer', $data);
	}
	function search($year,$s_date='',$e_date='',$s_minage='',$s_maxage=''){
		if($s_date=='')
			$s_date=date('Y-m-d',strtotime("-3 months"));
		if($e_date=='')
			$e_date=date('Y-m-d');

		$data['data']=$this->dash->getstudentdash($year);
		$data['social']=$this->dash->getsocialdash($s_date,$e_date);
		$data['health']=$this->dash->gethealthdash($s_date,$e_date);
		$data['date']=array('s_date'=>$s_date,'e_date'=>$e_date,'year'=>$year);
		$data['age']=array('s_minage'=>$s_minage,'s_maxage'=>$s_maxage);
		$data['frevenue']=$this->dash->getFamRevenu();
		
		$data['dis']=$this->dash->getdistribut($s_date,$e_date);

		$data['emp']=$this->dash->getempdash($year);
		$data['thead']=	$this->thead;
		$data['page_header']="Disease List";	
		$this->parser->parse('header', $data);
		$this->parser->parse('system/dashboard_form', $data);
		$this->parser->parse('footer', $data);
	}
	function view_std($yearid){
		$data['date']=array('year'=>$yearid);
		$data['data']=$this->dash->getstudentdash($yearid);
		$data['page_header']="Disease List";	
		$this->parser->parse('header', $data);
		$this->parser->parse('system/student_detail', $data);
		$this->parser->parse('footer', $data);
	}
	function viewstdleave(){
		$year=$this->session->userdata('year');
		$data['data']=$this->db->query("SELECT * 
										FROM v_student_profile s 
										INNER JOIN sch_student st 
										ON(s.studentid=st.studentid)
										where s.leave_school='1' 
										AND s.yearid='$year'")->result();
		$data['page_header']="Disease List";
		$this->parser->parse('header', $data);
		$this->parser->parse('system/list_stdleave', $data);
		$this->parser->parse('footer', $data);
	}
	function view_staff($yearid){
		$data['date']=array('year'=>$yearid);
		$data['data']=$this->dash->getempdetail($yearid);
		$data['getall']=$this->dash->getallpostion($yearid);
		$data['page_header']="Disease List";	
		$this->parser->parse('header', $data);
		$this->parser->parse('system/employee_detail', $data);
		$this->parser->parse('footer', $data);
	}
	function view_health($s_date,$e_date){	
		$data['page_header']="Social Summary Report";
		$data['date']=array('s_date'=>$s_date,'e_date'=>$e_date);	
		$data['health']=$this->dash->gethealthdash($s_date,$e_date);
		$this->parser->parse('header', $data);
		$this->parser->parse('system/healthdash_view', $data);
		$this->parser->parse('footer', $data);
	}
	function view_soc($yearid){
		$data['date']=array('year'=>$yearid);		
		$data['page_header']="Social Summary Report";	
		$data['data']=$this->socdash->getStdbyFam($yearid);
		$data['datarice']=$this->socdash->familyRice();
		$data['totalrice']=$this->socdash->familyRicetotal();
		$data['member']=$this->dash->getfmem();
		$data['femalemem']=$this->dash->getFemaleMem();
		$data['frevenue']=$this->dash->getFamRevenu();
		$this->parser->parse('header', $data);
		$this->parser->parse('social/vsocialdash', $data);
		$this->parser->parse('footer', $data);
	}
}