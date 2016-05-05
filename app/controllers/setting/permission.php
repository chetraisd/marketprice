<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class permission extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('setting/pagepermissionmodel','pagepermis');
		$this->load->model('setting/pagemodel','page');
		$this->load->model('setting/rolemodel','role');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));
        $this->lang->load('general', $this->session->userdata('lang'));
	}
	public function index()
	{	
		$data['query']=$this->pagepermis->getpagepermission();
		$this->load->view('header');
		$this->load->view('setting/pagepermission/add');
		$this->load->view('setting/pagepermission/view',$data);
		$this->load->view('footer');
	}
	function edit($id){
		$data1['query']=$this->pagepermis->getpagepermisrow($id);
		$this->load->view('header');
		$this->load->view('setting/pagepermission/edit',$data1);
		$data['query']=$this->pagepermis->getpagepermission();
		$this->load->view('setting/pagepermission/view',$data);
		$this->load->view('footer');
	}
	function search(){
		
		if(isset($_GET['pageid'])){
			$pageid=$_GET['pageid'];
			$roleid=$_GET['role_id'];
			$data['query']=$this->pagepermis->searchpagepermis($roleid,$pageid);
			$this->load->view('header');
			$this->load->view('setting/pagepermission/add');
			$this->load->view('setting/pagepermission/view',$data);
			$this->load->view('footer');
		}
		if(!isset($_GET['pageid'])){
			$role_id=$this->input->post('role_id');
			$page_id=$this->input->post('page_id');
			$query=$this->pagepermis->searchpagepermis($role_id,$page_id);
				$i=1;
				foreach ($query as $row) {
					echo "
										<tr>
											<td align='center'>$i</td>
											<td>$row->role</td>
											<td>$row->page_name</td>
											<td>$row->created_by</td>
											<td>".date("d-m-Y", strtotime($row->created_date))."</td>
											<td align='center'>";if($row->is_insert>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_delete>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_update>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_read>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_print>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_export>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'>";if($row->is_import>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
											echo "<td align='center'><a><img  rel='$row->role_page_id' onclick='deletepermission(event);' src='".base_url('assets/images/icons/delete.png')."'/></a></td><td align='center'> <a ><img rel='$row->role_page_id' onclick='updatepermission(event);' src='".base_url('assets/images/icons/edit.png')."'/></a></td>
										</tr>

									";# code...
				}
				echo "<tr>
					<td colspan='12' id='pgt'><div style='text-align:center'><ul class='pagination' style='text-align:center'>".$this->pagination->create_links()."</ul></div></td>
				</tr>";
		}

	}
	function save(){
		$is_insert=0;
		$is_delete=0;
		$is_update=0;
		$is_show=0;
		$is_print=0;
		$is_export=0;
		$is_import=0;
		if(isset($_POST['is_insert']))
			$is_insert=1;
		if(isset($_POST['is_delete']))
			$is_delete=1;
		if(isset($_POST['is_update']))
			$is_update=1;
		if(isset($_POST['is_show']))
			$is_show=1;
		if(isset($_POST['is_print']))
			$is_print=1;
		if(isset($_POST['is_export']))
			$is_export=1;
		if(isset($_POST['is_import']))
			$is_import=1;
		$count=$this->pagepermis->getpagepermisvalidate($this->input->post('cborole_as'),$this->input->post('cbopage_as'));
		if($count!=0){
			$this->load->view('header');
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This Role exists Please choose other role or Page </div>");
			$this->load->view('setting/pagepermission/add',$data1);
			$data['query']=$this->pagepermis->getpagepermission();
			$this->load->view('setting/pagepermission/view',$data);
			$this->load->view('footer');
		}else{
			
			$data=array(
					'roleid'=>$this->input->post('cborole_as'),
					'pageid'=>$this->input->post('cbopage_as'),
					'moduleid'=>$this->input->post('cbomodule_as'),
					'is_insert'=>$is_insert,
					'is_delete'=>$is_delete,
					'is_update'=>$is_update,
					'is_print'=>$is_print,
					'is_read'=>$is_show,
					'is_export'=>$is_export,
					'is_import'=>$is_import,
					'created_by'=>1,
					'created_date'=>date('Y-m-d H:i:s'),
					
				);
			$this->db->insert('sch_z_role_page',$data);
			redirect('setting/permission/');
		}
		
	}
	function update(){
		$is_insert=0;
		$is_delete=0;
		$is_update=0;
		$is_show=0;
		$is_print=0;
		$is_export=0;
		$is_import=0;
		if(isset($_POST['is_insert']))
			$is_insert=1;
		if(isset($_POST['is_delete']))
			$is_delete=1;
		if(isset($_POST['is_update']))
			$is_update=1;
		if(isset($_POST['is_show']))
			$is_show=1;
		if(isset($_POST['is_print']))
			$is_print=1;
		if(isset($_POST['is_export']))
			$is_export=1;
		if(isset($_POST['is_import']))
			$is_import=1;
		$rolepageid=$this->input->post('txtrolepageid');
		$count=$this->pagepermis->getpagepermisvalidateu($this->input->post('cborole_as'),$this->input->post('cbopage_as'),$rolepageid);
		if($count!=0){
			
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This Role exists Please choose other role or Page </div>");
			$data1['query']=$this->pagepermis->getpagepermisrow($rolepageid);
			$this->load->view('header');
			$this->load->view('setting/pagepermission/edit',$data1);
			$data['query']=$this->pagepermis->getpagepermission();
			$this->load->view('setting/pagepermission/view',$data);
			$this->load->view('footer');
		}else{
			
			$data=array(
					'roleid'=>$this->input->post('cborole_as'),
					'pageid'=>$this->input->post('cbopage_as'),
					'moduleid'=>$this->input->post('cbomodule_as'),
					'is_insert'=>$is_insert,
					'is_delete'=>$is_delete,
					'is_update'=>$is_update,
					'is_print'=>$is_print,
					'is_read'=>$is_show,
					'is_export'=>$is_export,
					'is_import'=>$is_import,
					'created_by'=>1,
					'created_date'=>date('Y-m-d H:i:s'),
					
				);
			$this->db->where('role_page_id',$rolepageid);
			$this->db->update('sch_z_role_page',$data);
			redirect('setting/permission/');
		}
		
	}
	function fillmodule(){
		$role=$this->input->post('roleid');
		//echo $role;
		$query=$this->pagepermis->getmodulebyrole($role);
		echo "<option value='0'>Select Module</option>";
		foreach ($query as $row) {
			echo "<option value='$row->moduleid'>$row->module_name</option>";
			# code...
		}
	}
	function fillpage(){
		$module=$this->input->post('moduleid');
		//echo $role;
		$query=$this->pagepermis->getpagebymodule($module);
		echo "<option value='0'>Select Module</option>";
		foreach ($query as $row) {
			echo "<option value='$row->pageid'>$row->page_name</option>";
			# code...
		}
	}
	function delete($id){
		$this->db->where('role_page_id',$id);
		$this->db->delete('sch_z_role_page');
		redirect('setting/permission/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */