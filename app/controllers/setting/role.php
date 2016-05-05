<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class role extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('setting/rolemodel','role');
		$this->load->model('setting/modulemodel','module');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));
        $this->lang->load('general', $this->session->userdata('lang'));
	}
	public function index()
	{	$data['query']=$this->role->getrole();
		$this->load->view('header');
		$this->load->view('setting/role_module/add');
		$this->load->view('setting/role_module/view',$data);
		$this->load->view('footer');
	}
	function edit($id){
		$data1['query']=$this->role->getrolerow($id);
		$this->load->view('header');
		$this->load->view('setting/role_module/edit',$data1);
		$data['query']=$this->role->getrole();
		$this->load->view('setting/role_module/view',$data);
		$this->load->view('footer');
	}
	function search(){
		
		if(isset($_GET['role'])){
			$role=$_GET['role'];
			$this->load->view('header');
			$this->load->view('setting/role_module/add');
			$data['query']=$this->role->searchrole($role);
			$this->load->view('setting/role_module/view',$data);
			$this->load->view('footer');
		}
		if(!isset($_GET['role'])){
			$role=$this->input->post('role');		
			$query=$this->role->searchrole($role);
				$i=1;
				foreach ($query as $row) {
					echo "
									<tr>
										<td align='center'>$i</td>
										<td>$row->role</td>";
										foreach ($this->module->getmodule() as $rowmo) {
											
											if($this->role->getrolemodule($row->roleid,$rowmo->moduleid)>0) echo "<td align='center'><img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<td align='center'><img src='".base_url('assets/images/unchecked.png')."'/></td>";

										 } 
								   echo "<td align='center'><a><img rel='$row->roleid' onclick='deleterole(event);'  src='".base_url('assets/images/icons/delete.png')."'/></a>   <a ><img  rel='$row->roleid' onclick='updaterole(event);' src='".base_url('assets/images/icons/edit.png')."'/></a></td>
									</tr>

								";# code...
								$i++;
				}
			
				echo "<tr>
							<td colspan='12' id='pgt'><div style='text-align:center'><ul class='pagination' style='text-align:center'>".$this->pagination->create_links()."</ul></div></td>
					  </tr>";
		}
	}
	function saverole(){
		$role=$this->input->post('txtrole_name');
		$count=$this->role->getrolevalidte($role);
		if($count!=0){
			$this->load->view('header');
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This role Name  has been created before Please choose other Role Name </div>");
			$this->load->view('setting/role_module/add',$data1);
			$data['query']=$this->role->getrole();
			$this->load->view('setting/role_module/view',$data);
			$this->load->view('footer');
		}else{
			$data=array(
					'role'=>$this->input->post('txtrole_name'),
					'is_active'=>1
				);
			$this->db->insert('sch_z_role',$data);
			$id=$this->db->insert_id();
			$count_m=$this->input->post('txtm-count');
			for ($i=0; $i <$count_m ; $i++) { 
				if(isset($_POST["ch_$i"]))
					$this->saverolemodule($id,$_POST["ch_$i"]);
			}
			redirect('setting/role/');
		}
	}
	function saverolemodule($role_id,$moduleid){
		$data=array(
					'roleid'=>$role_id,
					'moduleid'=>$moduleid
					);
		$this->db->insert('sch_z_role_module_detail',$data);
	}
	function update(){
		$role=$this->input->post('txtrole_name');
		$roleid=$this->input->post('txtroleid');
		$count=$this->role->getrolevalidteup($role,$roleid);
		if($count!=0){
			$this->load->view('header');
			$data1['query']=$this->role->getrolerow($roleid);
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This role Name  has been created before Please choose other Role Name </div>");
			$this->load->view('setting/role_module/edit',$data1);
			$data['query']=$this->role->getrole();
			$this->load->view('setting/role_module/view',$data);
			$this->load->view('footer');
		}else{
			$data=array(
					'role'=>$this->input->post('txtrole_name'),
					'is_active'=>1
				);
			$this->db->where('roleid',$roleid);
			$this->db->update('sch_z_role',$data);
			$this->deleterolemodule($roleid);
			$count_m=$this->input->post('txtm-count');
			for ($i=0; $i <$count_m ; $i++) { 
				if(isset($_POST["ch_$i"]))
					$this->saverolemodule($roleid,$_POST["ch_$i"]);
			}
			redirect('setting/role/');
		}
	}
	function delete($id){
		$data=array('is_active'=>0);
		$this->db->where('roleid',$id);
		$this->db->update('sch_z_role',$data);
		$this->deleterolemodule($id);
		redirect('setting/role/');
	}
	function deleterolemodule($id){
		$this->db->where('roleid',$id);
		$this->db->delete('sch_z_role_module_detail');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */