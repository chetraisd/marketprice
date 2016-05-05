<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('setting/usermodel','user');
		$this->load->model('setting/usermodel','park');
		$this->load->model('setting/usermodel','gate');
		$this->load->model('setting/rolemodel','role');
		$this->load->library('pagination');	
		$this->load->helper(array('form', 'url'));
        $this->lang->load('general', $this->session->userdata('lang'));
	}
	public function index()
	{
		
		$data1['save'] = (object) array('first_name'=>"",
										'last_name'=>"",
										'user_name'=>"",
										'email'=>"",
										'roleid'=>"",
										'error'=>""
										);
		//$data['query']=$this->user->getuser();

		$this->load->view('header');
		$this->load->view('setting/user/add',$data1);
		//$this->load->view('setting/user/view',$data);		
		$this->load->view('footer');
	}
	
	function cEdite(){
		header('Content-type:text/x-json');
		//$data = array('upload_data' => $this->upload->data());
		//$this->load->view('uploadPreview',$data);
		$img_name = $this->input->post("val_edit");
		//$img_show = "<img src='".base_url('assets/upload/"'.$img_name.'"_thumb.png')."' style='width:120px; height:150px; margin-bottom:15px' id='uploadPreview'>";
		
		$img_show = FCPATH.'assets/upload/user_profile/'.$img_name.'_thumb.png';
		if(file_exists($img_show)){
			$img_show = base_url('assets/upload/user_profile/'.$img_name.'_thumb.png');
		}else{
			$img_show = base_url('assets/upload/user_profile/No_person.jpg');
		}
		$val_edit = $this->user->mEdit($img_name);			
		$arr_show['tbl']= $val_edit;
		$arr_show['img']= $img_show;
		$arr_show['user_park']= $this->user->getParkbyUser($img_name);

		echo json_encode($arr_show);
		die();
	}
	function cshow_tbl(){
		$i=1;
		$tr = "";
		$query = $this->user->getuser();
		$show_act = "";
		foreach($query as $row) {
			$ch_admin = $row->is_admin;
			$tr.= "<tr>
						<td align='center'>$i</td>
						<td>$row->first_name</td>
						<td>$row->last_name</td>
						<td>$row->user_name</td> 
						<td>$row->email</td>
						<td>$row->role</td>
						<td>".date("d-m-Y", strtotime($row->last_visit))."</td>
						<td>".date("d-m-Y", strtotime($row->created_date))."</td>
						<td align='center' class='ro_wrap'>";
						if ($this->green->gAction("E")) {
							$tr.= "<a href='javascript:void(0)' id='edite' att_edit='".$row->userid."'>
									<img src='".base_url('assets/images/icons/edit.png')."'/>
								</a>";
						}
						if ($this->green->gAction("D")) {
							$tr.= "	".($row->is_admin == 1?"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;":"
								<a href='javascript:void(0)' id='delete' att_del='".$row->userid."'>
									<img src='".base_url('assets/images/icons/delete.png')."'/></a>")."";
						}
					$tr.= "	</td>
				  </tr>";
			$i++;
		}
		header('Content-type:text/x-json');
		$arr['tr'] = $tr;
		echo json_encode($arr);
		die();
	}
	
	function saveuser(){
		$creat_date = date('Y-m-d H:i:s');
		$year       = date('Y');
		$user_id    = $this->input->post('user_id');
		$f_name     = $this->input->post('txtf_name');
		$l_name     = $this->input->post('txtl_name');
		$username   = $this->input->post('txtu_name');
		$pwd        = md5($this->input->post('txtpwd'));
		$pass_edit  = $this->input->post('pass_edit');
		$email      = $this->input->post('txtemail');
		$role       = $this->input->post('cborole');
		$asignpark  = $this->input->post('cbopark');
		$gate       = $this->input->post('cbogate');
		$dash       = $this->input->post('dashboard');
		$defpage    = $this->input->post('defpage');
		$byUser     = $this->session->userdata('userid');
		$par_type   = '10';
		$gat_type   = '7';
		//$count     = $this->user->getuservalidate($username,$email);
		$default_park = "";
		$park_select = ($asignpark);
		
		$user_maxid ='';

		if($role==1)
			$admin=1;
		else
			$admin=0;
		if($user_id != ""){ // edite

			$ch_user = $this->db->query("SELECT COUNT(*) AS amt_user FROM sch_user WHERE user_name = (SELECT user_name FROM sch_user WHERE userid <>'".$user_id."' AND user_name='".$username."')")->row();
			$countDetail = $this->db->query("SELECT COUNT(*) AS park_user FROM sch_user_detail WHERE userid ='".$user_id."'")->row();

			if($ch_user->amt_user > 0){
				$data1['save'] = (object) array(
												'first_name'=>$f_name,
												'last_name'=>$l_name,
												'user_name'=>$username,
												'email'=>$email,
												'roleid'=>$role,
												'gat_type'=>$gat_type,
												'gat_typeno'=>$gate,
												'def_open_page'=>$defpage,
												'def_dashboard'=>$dash,
												'created_by'=>$byUser,
												'error'=>'this username and your email has been created before Please choose other username '
												);
				$this->load->view('header');
				//$this->load->view('setting/user/saveerror',$data1);
				//$data['query'] = $this->user->getuser();
				$this->load->view('setting/user/add',$data1);
				$this->load->view('footer');
			}else{
				if($pass_edit == ""){
					$data=array('first_name'=>$f_name,
								'last_name'=>$l_name,
								'user_name'=>$username,
								'email'=>$email,
								'roleid'=>$role,
								'created_date'=>$creat_date,
								'gat_type'=>$gat_type,
								'gat_typeno'=>$gate,
								'def_open_page'=>$defpage,
								'def_dashboard'=>$dash,
								'modified_by'=>$byUser,
								'is_active'=>1
								);
					if ($park_select > 0) {
						if ($countDetail->park_user != 0) {
							$this->db->where('userid', $user_id);
							$this->db->delete('sch_user_detail');
							$i = 0;

							foreach ($asignpark AS $park) {
								$data2 = array(
									'userid' => $user_id,
									'par_typeno' => $park
								);
								$i++;
								$this->db->insert('sch_user_detail', $data2);
							}
						}else {
							$i = 0;
							foreach ($asignpark AS $park) {
								$data2 = array(
									'userid' => $user_id,
									'par_typeno' => $park
								);
								$i++;
								$this->db->insert('sch_user_detail', $data2);
							}
						}
					}
				}else{
					$data=array('first_name'=>$f_name,
								'last_name'=>$l_name,
								'user_name'=>$username,
								'password'=>$pwd, 
								'email'=>$email,
								'roleid'=>$role,
								'created_date'=>$creat_date,
								'gat_type'=>$gat_type,
								'gat_typeno'=>$gate,
								'def_open_page'=>$defpage,
								'def_dashboard'=>$dash,
								'modified_by'=>$byUser,
								'is_active'=>1
								);
					if ($park_select > 0) {
						if ($countDetail->park_user != 0) {
								$this->db->where('userid', $user_id);
								$this->db->delete('sch_user_detail');
								$i = 0;
								foreach ($asignpark AS $park) {
									$data2 = array(
										'userid' => $user_id,
										'par_typeno' => $park
									);
									$i++;
									$this->db->insert('sch_user_detail', $data2);
								}
						} else {
							$i = 0;
							foreach ($asignpark AS $park) {
								$data2 = array(
									'userid' => $user_id,
									'par_typeno' => $park
								);
								$i++;
								$this->db->insert('sch_user_detail', $data2);
							}
						}
					}
				}
				
				$this->db->where('userid',$user_id);
				$this->db->update('sch_user',$data);
				$this->do_upload($user_id);
				redirect('setting/user/');
			}
		}else{ // save
			$count = $this->db->query("SELECT COUNT(*) AS amt_name FROM sch_user WHERE user_name ='".$username."'")->row();
			if($count->amt_name > 0){
				$data1['save']=(object) array(
						'first_name'=>$f_name,
						'last_name'=>$l_name,
						'user_name'=>$username,
						'email'=>$email,
						'roleid'=>$role,
						'gat_type'=>$gat_type,
						'gat_typeno'=>$gate,
						'def_open_page'=>$defpage,
						'def_dashboard'=>$dash,
						'created_by'=>$byUser,
						'error'=>'this username and your email has been created before Please choose other username '
					);
				$this->load->view('header');
				$this->load->view('setting/user/add',$data1);
				$this->load->view('footer');
				return false;
			}else{
				$data=array('first_name'=>$f_name,
							'last_name'=>$l_name,
							'user_name'=>$username,
							'password'=>$pwd,
							'email'=>$email,
							'roleid'=>$role,
							'gat_type'=>$gat_type,
							'gat_typeno'=>$gate,
							'created_date'=>$creat_date,
							'def_open_page'=>$defpage,
							'def_dashboard'=>$dash,
							'created_by'=>$byUser,
							'is_active'=>1
							);

				$this->db->insert('sch_user',$data);
				$id_max = $this->db->query("SELECT MAX(userid) AS id_max FROM sch_user")->row();

				//$id=$this->db->insert_id();
				if ($park_select > 0) {
					$i=0;
					foreach($asignpark AS $park){
						$data2=array(
							'userid'=>($id_max->id_max),
							'par_typeno'=>$park
						);
						$i++;
						$this->db->insert('sch_user_detail',$data2);
					}
				}
				$this->do_upload($id_max->id_max);
				redirect('setting/user/');
			}
		}
	}
	function do_upload($id)
	{
		$config['upload_path'] = './assets/upload/user_profile/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = "$id.png";
		$config['overwrite'] = true;
		$config['file_type'] = 'image/png';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());			
		}
		else
		{				
			//$data = array('upload_data' => $this->upload->data());			
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config2['new_image'] = './assets/upload/user_profile/';
			$config2['maintain_ratio'] = TRUE;
			$config2['create_thumb'] = TRUE;
			$config2['thumb_marker'] = '_thumb';
			$config2['width'] = 120;
			$config2['height'] = 180;
			$config2['overwrite']=true;
			$this->load->library('image_lib',$config2); 

			if ( !$this->image_lib->resize()){
				$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
			}else{
				unlink('./assets/upload/user_profile/'.$id.'.png');
				redirect('setting/user');
			}
		}
	}
	
	function cDeleteUser(){
		$att_delete = $this->input->post("att_delete");
		$data=array('is_active'=>0);
		$this->db->where('userid',$att_delete);
		$this->db->update('sch_user',$data);
		$img_del = FCPATH.'assets/upload/user_profile/'.$att_delete.'_thumb.png';
		if(file_exists($img_del)){
			unlink('./assets/upload/user_profile/'.$att_delete.'_thumb.png');
		}
		//redirect('setting/user/');
		echo "OK";
		die();
	}

	function getModule(){
		header('Content-type:text/x-json');
		echo json_encode($this->user->getModule($this->input->post('moduleid')));
	}
	function getPage(){
		header('Content-type:text/x-json');
		echo json_encode($this->user->getPage($this->input->post('moduleid'),$this->input->post('defpage')));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */