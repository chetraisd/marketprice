<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('setting/pagemodel','page');
		$this->load->model('setting/modulemodel','module');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));
        $this->lang->load('general', $this->session->userdata('lang'));
	}
	public function index()
	{	
		$data['query']=$this->page->getpage();
		$this->load->view('header');
		$this->load->view('setting/page/add');
		$this->load->view('setting/page/view',$data);
		$this->load->view('footer');
	}
	function edit($id){
		$data1['query']=$this->page->getpagerow($id);
		$this->load->view('header');
		$this->load->view('setting/page/edit',$data1);
		$data['query']=$this->page->getpage();
		$this->load->view('setting/page/view',$data);
		$this->load->view('footer');
	}
	function search(){
		
		if(isset($_GET['p_name'])){
			$p_name=$_GET['p_name'];
			$moduleid=$_GET['moduleid'];
			$data['query']=$this->page->searchpage($p_name,$moduleid);
			$this->load->view('header');
			$this->load->view('setting/page/add');
			$this->load->view('setting/page/view',$data);
			$this->load->view('footer');
		}
		if(!isset($_GET['p_name'])){
			$p_name=$this->input->post('page_name');
			$moduleid=$this->input->post('m_id');
			$query=$this->page->searchpage($p_name,$moduleid);
				$i=1;
				foreach ($query as $row) {
					echo "
									<tr>
										<td align='center'>$i</td>
										<td>$row->page_name</td>
										<td>$row->link</td>
										<td>$row->module_name</td>
										<td align='center'>";if($row->is_insert>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_delete>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_update>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_show>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_print>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td align='center'>";if($row->is_export>0) echo "<img src='".base_url('assets/images/checked.png')."'/></td>"; else echo "<img src='".base_url('assets/images/unchecked.png')."'/></td>";
										echo "<td>$row->created_by</td>
										<td>".date("d-m-Y", strtotime($row->created_date))."</td>
										<td align='center'><a ><img rel='$row->pageid' onclick='deletepage(event);' src='".base_url('assets/images/icons/delete.png')."'/></a></td><td> <a ><img rel='$row->pageid' onclick='updatepage(event);' src='".base_url('assets/images/icons/edit.png')."'/></a></td>
									</tr>

								";# code...
								$i++;
				}
				echo "<tr>
					<td colspan='12' id='pgt'><div style='text-align:center'><ul class='pagination' style='text-align:center'>".$this->pagination->create_links()."</ul></div></td>
				</tr>";
		}

	}
	function savepage(){
		$is_insert=0;
		$is_delete=0;
		$is_update=0;
		$is_show=0;
		$is_print=0;
		$is_export=0;
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

		$count=$this->page->getpagevalidate($this->input->post('txtp_name'),$this->input->post('cbomodule'));
		if($count!=0){
			$this->load->view('header');
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This Page Name  and Module is already exists Please choose other Name or module </div>");
			$this->load->view('setting/page/add',$data1);
			$data['query']=$this->page->getpage();
			$this->load->view('setting/page/view',$data);
			$this->load->view('footer');
		}else{
			
			$max_order=$this->green->getValue("SELECT MAX(`order`)+1 orders FROM sch_z_page WHERE moduleid='".$this->input->post('cbomodule')."'");
			$data=array(
					'page_name'=>$this->input->post('txtp_name'),
					'link'=>$this->input->post('txtp_link'),
					'moduleid'=>$this->input->post('cbomodule'),
					'is_insert'=>$is_insert,
					'is_delete'=>$is_delete,
					'is_update'=>$is_update,
					'is_print'=>$is_print,
					'is_show'=>$is_show,
					'is_export'=>$is_export,
					'created_by'=>1,
					'created_date'=>date('Y-m-d H:i:s'),
					'is_active'=>1,
					'order'=>$max_order
				);

			$this->db->insert('sch_z_page',$data);
			redirect('setting/page/');
		}
		
	}
	function update(){
		$is_insert=0;
		$is_delete=0;
		$is_update=0;
		$is_show=0;
		$is_print=0;
		$is_export=0;
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
		$pageid=$this->input->post('txtpageid');
		$count=$this->page->getpagevalidateup($this->input->post('txtp_name'),$this->input->post('cbomodule'),$pageid);
		if($count!=0){
			$this->load->view('header');
			$data1['query']=$this->page->getpagerow($pageid);
			$data1['error']=(object) array('error'=>"<div style='text-align:center; color:red;'>This Page Name  and Module is already exists Please choose other Name or module </div>");
			$this->load->view('setting/page/edit',$data1);
			$data['query']=$this->page->getpage();
			$this->load->view('setting/page/view',$data);
			$this->load->view('footer');
		}else{
			
			$data=array(
					'page_name'=>$this->input->post('txtp_name'),
					'link'=>$this->input->post('txtp_link'),
					'moduleid'=>$this->input->post('cbomodule'),
					'is_insert'=>$is_insert,
					'is_delete'=>$is_delete,
					'is_update'=>$is_update,
					'is_print'=>$is_print,
					'is_show'=>$is_show,
					'is_export'=>$is_export,
					'created_by'=>1,
					'created_date'=>date('Y-m-d H:i:s'),
					'is_active'=>1
				);
			$this->db->where('pageid',$pageid);
			$this->db->update('sch_z_page',$data);
			redirect('setting/page/');
		}
		
	}
	function delete($id){
		$data=array('is_active'=>0);
		$this->db->where('pageid',$id);
		$this->db->update('sch_z_page',$data);
		redirect('setting/page/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */