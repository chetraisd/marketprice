<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mform_contact extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}
	
	function msave(){
		$get_arr = $this->input->post("arr_contact");
		$type_no = $this->green->nextTran(15,'con_type');
		$user = $this->session->userdata("userid");
		$create_date = date('Y-m-d H:i:s');
		$data = array("con_type"=>15,
					  "con_typeno"=>$type_no,
					  "create_date"=>$create_date,
					  "create_by"=>$user,
					  "contact_firstname"=>$get_arr['first_name'],
					  "contact_lastname"=>$get_arr['last_name'], 
					  "company_name"=>$get_arr['company'],
					  "company_email"=>$get_arr['email'],
					  "address"=>$get_arr['address'],
					  "phone"=>$get_arr['phone'],
					  "vis_type"=>14,
					  "vis_typeno"=>$get_arr['visitor_type']
					  );
		$this->db->insert('set_contact_customer',$data);
		return $type_no;
	}

	function mcust_upload(){
		$image_insert = $this->input->post('image_insert', TRUE);
		$image_edit   = $this->input->post('image_edit', TRUE);
		//if($image_edit != ''){
		if(isset($_FILES['userfile']['name'])){ 
			if($_FILES['userfile']['size'] > 0){
				$path = "assets/upload/customer_photo/";
				if(file_exists($path.$this->input->post('image_edit'))){
					unlink($path.$this->input->post('image_edit'));													
				}
				$name = $_FILES['userfile']['name'];
				$ext  = pathinfo($name, PATHINFO_EXTENSION);
				$exts = $image_insert.'.'.$ext;
				$this->db->update('tran_application', array('photo' => $exts), array('app_typeno' => $image_insert));
				$target = $path.$exts;				
				if(file_exists($target)){
					unlink($target);													
				}
				$tmp_name = $_FILES['userfile']['tmp_name'];							
				move_uploaded_file($tmp_name, $target);
			}
		}
	}
}