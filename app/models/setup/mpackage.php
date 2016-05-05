<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpackage extends CI_Model {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}
	// edit =======
	function edit(){
		$package_typeno = $this->input->post('package_typeno', TRUE);
		$row_pck = $this->db->query("SELECT
												pk.package_typeno,
												pk.package_name,
												pk.package_type,
												pk.par_typeno,
												pk.description,
												pk.is_active,										
												pk.type_of,
												pk.image,
												pk.create_by,
												pk.create_date,
												pk.modify_by,
												pk.modify_date,
												pk.prefix,
												pk.package_name,
												pk.package_type,
												pk.package_typeno,
												pk.par_typeno,
												pk.description,
												pk.type_of,
												pk.image,
												pk.create_by,
												pk.create_date,
												pk.modify_by,
												pk.modify_date,
												-- pk.prefix,
												-- pk.tick_form
												pk.fore_adult_series,
												pk.fore_child_series,
												pk.loc_adult_series,
												pk.loc_child_series,
												pk.fore_adult_form,
												pk.fore_child_form,
												pk.loc_adult_form,
												pk.loc_child_form
											FROM
												set_park_package AS pk
											WHERE 1=1 AND pk.type_of=1
											 AND pk.package_typeno = '{$package_typeno}' ")->row();

		$qr_pckd = $this->db->query("SELECT
											pkd.par_typeno,
											p.park_name,
											p.description,
											pkd.package_typeno
										FROM
											set_park_package_detail AS pkd
										LEFT JOIN set_park AS p ON pkd.par_typeno = p.par_typeno
										WHERE
											pkd.package_typeno = '{$package_typeno}' ")->result();

		$qr_park = $this->db->query("SELECT
											p.par_typeno,
											p.park_name
										FROM
											set_park AS p
										ORDER BY
											p.park_name ASC ")->result();

		$arr = array('row_pck' => $row_pck , 'qr_pckd' => $qr_pckd, 'qr_park' => $qr_park);
		return json_encode($arr);
	}

	// delete ========
	function delete(){
		$package_typeno = $this->input->post('package_typeno', TRUE);
		$package_det = $this->db->query('SELECT COUNT(*) as amt_det FROM tran_ticket WHERE package_typeno="'.$package_typeno.'"')->row();
		
		if($package_det->amt_det > 0){
			$arr['success'] = false;
		}else{
			$image_del = $this->input->post('image_del');
			$this->db->delete('set_park_package', array('package_typeno' => $package_typeno));
			$this->db->delete('set_park_package_detail', array('package_typeno' => $package_typeno));
			$this->db->delete('z_setup_prefix', array('package_typeno' => $package_typeno));	
			if($image_del != ''){
				$target = "assets/upload/packages/".$image_del;
				if(file_exists($target)){
					unlink($target);			
				}
			}
			$arr['success'] = true;
		}
		
		return json_encode($arr);		
	}

	// save =========
	function save(){	
		$package_typeno = $this->input->post('package_typeno');
		$package_name = trim($this->input->post('package_name', TRUE));
		$description = trim($this->input->post('description', TRUE));
		$is_active = trim($this->input->post('is_active', TRUE));
		$prefix = trim($this->input->post('prefix', TRUE));	
		$tick_form = trim($this->input->post('tick_form', TRUE));	
		$arr = $this->input->post('arr');

		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$modify_date = date('Y-m-d H:i:s');		
		$modify_by = $this->session->userdata('userid');

		$fore_adult_series = trim($this->input->post('fore_adult_series',true));
		$fore_child_series  = trim($this->input->post('fore_child_series',true));
		$loc_adult_series  	= trim($this->input->post('loc_adult_series',true));
		$loc_child_series  	= trim($this->input->post('loc_child_series',true));
		$fore_adult_form  	= trim($this->input->post('fore_adult_form',true));
		$fore_child_form  	= trim($this->input->post('fore_child_form',true));
		$loc_adult_form  	= trim($this->input->post('loc_adult_form',true));
		$loc_child_form  	= trim($this->input->post('loc_child_form',true));

		$c = $this->db->query("SELECT
									pk.package_typeno
								FROM
									set_park_package AS pk
								WHERE
									pk.package_name = '{$package_name}' ");
	
		if($package_typeno != ''){

			$package_name_ = $this->db->query("SELECT
													pc.package_name
												FROM
													set_park_package AS pc
												WHERE
													pc.package_typeno = '{$package_typeno}' ")->row()->package_name;
			
			if($c->num_rows == 0 || $package_name_ == $package_name){		
				// package ======
				$data_upd = array('package_name' => $package_name,
										'package_type' => 19,
										'package_typeno' => $package_typeno,
										'par_typeno' => '',										
										'description' => $description,	
										'is_active' => $is_active,												
										'type_of' => 1,
										'modify_date' => $modify_date,
										'modify_by' => $modify_by,
										// 'prefix' => $prefix,
										// 'tick_form'=>$tick_form
										'fore_adult_series'=>$fore_adult_series,
										'fore_child_series'=>$fore_child_series,
										'loc_adult_series'=>$loc_adult_series,
										'loc_child_series'=>$loc_child_series,
										'fore_adult_form'=>$fore_adult_form,
										'fore_child_form'=>$fore_child_form,
										'loc_adult_form'=>$loc_adult_form,
										'loc_child_form'=>$loc_child_form
									);
				$this->db->update('set_park_package', $data_upd, array('package_typeno' => $package_typeno));				
				
				// pck detail =====
				$this->db->delete('set_park_package_detail', array('package_typeno' => $package_typeno));
				if(count($arr) > 0){
					foreach ($arr as $row) {
						$data_ins_d = array('package_type' => 19,
												'package_typeno' => $package_typeno,
												'par_type' => 10,	
												'par_typeno' => $row['par_typeno'],	
												'type_of' => 1,			
												'create_date' => $create_date,
												'create_by' => $create_by								
											);
						$this->db->insert('set_park_package_detail', $data_ins_d);
					}
				}	
						
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}	
		}else{
			if($c->num_rows == 0){
				$package_typeno = $this->green->nextTrans(19, 'package_type');

				$data_ins = array('package_name' => $package_name,
										'package_type' => 19,
										'package_typeno' => $package_typeno,
										'par_typeno' => '',										
										'description' => $description,
										'is_active' => $is_active,		
										'type_of' => 1,
										'create_date' => $create_date,
										'create_by' => $create_by,
										// 'prefix' => $prefix,
										// 'tick_form' => $tick_form
										'fore_adult_series'=>$fore_adult_series,
										'fore_child_series'=>$fore_child_series,
										'loc_adult_series'=>$loc_adult_series,
										'loc_child_series'=>$loc_child_series,
										'fore_adult_form'=>$fore_adult_form,
										'fore_child_form'=>$fore_child_form,
										'loc_adult_form'=>$loc_adult_form,
										'loc_child_form'=>$loc_child_form									
									);

				$this->db->insert('set_park_package', $data_ins);

				// package detail =======
				if(count($arr) > 0){
					foreach ($arr as $row) {
						$data_ins_d = array('package_type' => 19,
											'package_typeno' => $package_typeno,
											'par_type' => 10,	
											'par_typeno' => $row['par_typeno'],	
											'type_of' => 1,								
											'create_date' => $create_date,
											'create_by' => $create_by								
											);
						$this->db->insert('set_park_package_detail', $data_ins_d);
					}
				}

				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}						
		}
		$arrs = array('arr' => $arr, 'package_typeno' => $package_typeno);
		return json_encode($arrs);	
	}

	function package_upload(){
		$image_insert = $this->input->post('image_insert', TRUE);
		$image_edit = $this->input->post('image_edit', TRUE);

		if($image_insert != ''){
			if($_FILES['photo']['size'] > 0){	
				$path = "assets/upload/packages/";

				if(file_exists($path.$this->input->post('image_edit'))){
					unlink($path.$this->input->post('image_edit'));													
				}				

				$name = $_FILES['photo']['name'];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$exts = $image_insert.'.'.$ext;
				$this->db->update('set_park_package', array('image' => $exts), array('package_typeno' => $image_insert));
				$target = $path.$exts;				
				if(file_exists($target)){
					unlink($target);													
				}
				$tmp_name = $_FILES['photo']['tmp_name'];							
				move_uploaded_file($tmp_name, $target);
			}
		}
	}

	// get parks ========
	function get_park(){		
		$result = $this->db->query("SELECT
										p.par_typeno,
										p.park_name
									FROM
										set_park AS p
									ORDER BY
										p.park_name ASC ")->result();
		return $result;
	}

	// show ​data =====
	function grid(){
		$where = '';
		$search_package_name = trim($this->input->post('search_package_name', TRUE));
		$search_description = trim($this->input->post('search_description', TRUE));
		$search_prefix = trim($this->input->post('search_prefix', TRUE));
		$search_park_name = trim($this->input->post('search_park_name', TRUE));
		$search_is_active = trim($this->input->post('search_is_active', TRUE));		

		$offset = $this->input->post('offset') - 0;
		$limit = $this->input->post('limit') - 0;
		$fd = $this->input->post('fd');
		$order = $this->input->post('order');		
		
		if($search_package_name != ''){
			$where .= " AND p.package_name LIKE '%{$search_package_name}%' ";				
		}

		if($search_description != ''){
			$where .= " AND p.description LIKE '%{$search_description}%' ";				
		}

		if($search_prefix != ''){
			$where .= " AND p.prefix LIKE '%{$search_prefix}%' ";				
		}
		
		if($search_park_name != ''){
			$where .= " AND pk.park_name LIKE '%{$search_park_name}%' ";				
		}

		if($search_is_active != ''){
			$where .= " AND p.is_active = '{$search_is_active}' ";				
		}
				
		$where .= " AND p.type_of = 1 ";

		$total_records = $this->db->query("SELECT
													COUNT(p.package_typeno) AS c
												FROM
													set_park_package AS p
												WHERE
													1 = 1 {$where} ")->row()->c - 0;
		
		$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

		$result = $this->db->query("SELECT
											p.package_name,
											p.description,
											p.prefix,
											p.tick_form,
											GROUP_CONCAT(pk.park_name SEPARATOR ', ') AS park_name,
											p.image,
											p.package_typeno,
											p.is_active,
											p.package_typeno,
	 										p.fore_adult_series,
											p.fore_child_series,
											p.loc_adult_series,
											p.loc_child_series,
											p.fore_adult_form,
											p.fore_child_form,
											p.loc_adult_form,
											p.loc_child_form											
										FROM
											set_park_package AS p
										LEFT JOIN set_park_package_detail AS pd ON p.package_typeno = pd.package_typeno
										LEFT JOIN set_park AS pk ON pk.par_typeno = pd.par_typeno
										WHERE
											1 = 1 {$where}
										GROUP BY p.package_typeno
										ORDER BY {$fd} {$order}
										LIMIT {$offset},
										 {$limit} ")->result();

		
		$arr = array('total_records' => $total_records,
					'total_pages' => $total_pages,					
					'result' => $result			
				);
		return json_encode($arr);
		
	}

}