<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usermodelprofile extends CI_Model {
	
	public function mEdit($val_edit){
		
		$val_query = $this->db->query("SELECT
											sch_user.userid,
											sch_user.user_name,
											sch_user.`password`,
											sch_user.email,
											sch_user.last_visit,
											sch_user.last_visit_ip,
											sch_user.created_date,
											sch_user.created_by,
											sch_user.modified_by,
											sch_user.modified_date,
											sch_user.roleid,
											sch_user.last_name,
											sch_user.first_name,
											sch_user.is_admin,
											sch_user.par_type,
											sch_user.gat_typeno,
											sch_user.gat_type,
											sch_user.gat_typeno,
											sch_user.def_dashboard,
											sch_user.def_open_page
										FROM
											sch_user
										WHERE userid='".$val_edit."'")->row();
		return $val_query;		
	}	
	public function getuser($userid)
	{	
		/*$per_page='';
		if(isset($_GET['per_page']))
		$per_page=$_GET['per_page'];
		$config['base_url']=site_url("setting/user/index?");
		$config['per_page']=10;
		$config['full_tag_open'] = '<li>';
		$config['full_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a><u>';
		$config['cur_tag_close'] = '</u></a>';
		$config['page_query_string']=TRUE;
		$config['num_link']=3;
		$this->db->where('is_active',1);
		$config['total_rows'] = $this->db->get('sch_user')->num_rows();
		$this->pagination->initialize($config);
		$this->db->select('*');
		$this->db->from('sch_user u');
		$this->db->join('sch_z_role r','u.roleid=r.roleid','inner');
		$this->db->where('u.is_active',1);
		$this->db->order_by("u.userid", "desc"); 
		$this->db->limit($config['per_page'],$per_page);
		$query=$this->db->get();
		return $query->result();*/
		
		$this->green->setActiveRole($this->session->userdata('roleid'));  
		$this->green->setActiveModule($this->session->userdata('m'));  
		$this->green->setActiveModule($this->session->userdata('m'));  
		$this->green->setActivePage($this->session->userdata('p'));
		//echo "Daaaa".$userid;
		$query = $this->db->query("SELECT
										us.userid,
										us.user_name,
										us.`password`,
										us.email,
										us.last_visit,
										us.last_visit_ip,
										us.created_date,
										us.roleid,
										us.last_name,
										us.first_name,
										us.is_admin,
										us.is_active,
										us.par_typeno,
										us.gat_typeno,
										rus.role
									FROM
									sch_user us
									INNER JOIN sch_z_role rus ON us.roleid = rus.roleid
									WHERE us.is_active > 0 AND us.userid='".$userid."'")->result();
		
		return $query;
	}
	
	function getallpark(){
		$query=$this->db->get('set_park');
		return $query->result();
	}

	function getallrole(){
		$userid =$this->session->userdata('userid');
		$getUser = $this->db->query("SELECT
										us.roleid,
										us.is_admin,
										rus.role
									FROM
									sch_user us
									INNER JOIN sch_z_role rus ON us.roleid = rus.roleid
									WHERE us.is_active > 0 AND us.userid='".$userid."'")->row();
		
		$is_admin = $getUser->is_admin;		
		if($is_admin == 1){
			
			$this->db->where('is_active',1);
			$query=$this->db->get('sch_z_role');
			return $query->result();
		}else{
			
			$this->db->where('roleid', $getUser->roleid);
			$query=$this->db->get('sch_z_role');
			return $query->result();
		}		
	}

	function getParkbyUser($userid){
		$query=$this->db->get('set_park_package');
		$user_park=$this->userPark($userid);
		$allpark=$query->result();
		$op="";
		if(count($allpark)>0){
			foreach ($allpark as $row) {
				$selected="";
				if(isset($user_park[$row->package_typeno])){
					$selected="selected";
				}
				$op.='<option value="'.$row->package_typeno.'" '.$selected.'>'.$row->package_name.'</option>';
			}
		}		
		return $op;
	}
	function userPark($userid){		

		$arr=array();
		if($userid !=""){
			$query=$this->db->query("SELECT par_typeno FROM sch_user_detail WHERE userid='".$userid."'");
			$results=$query->result();
			if(count($results)>0){
				foreach ($results as $row) {
					$arr[$row->par_typeno]=$row->par_typeno;
				}
			}
		}
		return $arr;
	}
	
	function getallgate(){	
		$userid =$this->session->userdata('userid');
		$getGate = $this->db->query("SELECT
										us.gat_typeno,
										us.is_admin,
										rus.role
									FROM
									sch_user us
									INNER JOIN sch_z_role rus ON us.roleid = rus.roleid
									WHERE us.is_active > 0 AND us.userid='".$userid."'")->row();

		$is_admin = $getGate->is_admin;		
		if($is_admin == 1){			
			$query=$this->db->get('set_gate');
			return $query->result();
		}else{			
			$this->db->where('gat_typeno', $getGate->gat_typeno);
			$query=$this->db->get('set_gate');
			return $query->result();
		}										
				
	}
	
	function getModule($selected=''){
		$roleid   = $this->input->post('roleid');
		$moduleid = $this->db->query("SELECT moduleid FROM sch_z_role_module_detail WHERE roleid='".$roleid."'")->result();
		
		$arrModule =  array();
		$i=0;
		foreach($moduleid as $row){
			$arrModule[$i] = $row->moduleid;
			$i++;
		}
		$module = $this->db->query("SELECT sch_z_module.moduleid, sch_z_module.module_name FROM sch_z_module WHERE is_active=1 AND moduleid IN (".implode(',',$arrModule).")");
		$op = '';
		foreach($module->result() as $row){
			$op .= '<option '.($row->moduleid == $selected?"selected":"").' value="'.$row->moduleid.'">'.$row->module_name.'</option>';
		}
		$first_module = $module->first_row()->moduleid;
		$getoppage = $this->getPage($first_module,"");
		$rray= array();
		$rray['op']     = $op;
		$rray['oppage'] = $getoppage;
		return $rray;
	}
	function getPage($moduleid,$selected=''){
		$moduleidChange   = $this->input->post('moduleid');
		if($moduleidChange !=""){
			$moduleid=$moduleidChange;
			//echo $moduleid; 		
		}
		
		$page   = $this->db->query("SELECT
										sch_z_page.link,
										sch_z_page.page_name,
										sch_z_page.pageid,
										sch_z_page.moduleid
									FROM
										sch_z_page WHERE is_active=1 AND moduleid='".$moduleid."'");
		$op = '';
		foreach($page->result() as $row){
			//$val = $row->link."/saveuser".'?y='.$this->session->userdata('year').'&m='.$row->moduleid.'&p='.$row->pageid;
			$val = $row->link;
			$op .= '<option '.($val == $selected?"selected":"").' value="'.$val.'">'.$row->page_name.'</option>';
		}
		return $op;
	}
	/*
	function getuservalidate($username,$email){
		$this->db->select('count(*)');
		$this->db->from('sch_user');
		$this->db->where('user_name',$username);
		$this->db->where('email',$email);
		$this->db->where('is_active',1);
		return $this->db->count_all_results();
	}
	function getuservalidateup($username,$email,$userid){
		$this->db->select('count(*)');
		$this->db->from('sch_user');
		$this->db->where('user_name',$username);
		$this->db->where('email',$email);
		$this->db->where_not_in('userid',$userid);
		$this->db->where('is_active',1);
		return $this->db->count_all_results();
	}
	function getuserrow($id){
		$this->db->select('*');
		$this->db->from('sch_user u');
		$this->db->join('sch_z_role r','u.roleid=r.roleid','inner');
		$this->db->where('u.is_active',1);
		$this->db->where('u.userid',$id);
		$this->db->order_by("u.userid", "desc"); 
		$query=$this->db->get();
		
		return $query->row();
	}*/
	
}