<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpark extends CI_Model {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}
	// edit =======
	function edit(){
		$par_typeno = $this->input->post('par_typeno');
		$row = $this->db->query("SELECT
										p.create_date,
										p.create_by,
										p.modify_by,
										p.modify_date,
										p.par_type,
										p.par_typeno,
										p.loc_type,
										p.loc_typeno,
										p.park_name,
										p.description,
										p.image,
										p.is_active, 
										spp.fore_adult_series,
										spp.fore_child_series,
										spp.loc_adult_series,
										spp.loc_child_series,
										spp.fore_adult_form,
										spp.fore_child_form,
										spp.loc_adult_form,
										spp.loc_child_form,
										spp.notforsale
									FROM
										set_park AS p
									INNER JOIN set_park_package AS spp ON p.par_typeno = spp.par_typeno
									WHERE
										p.par_typeno = {$par_typeno} AND spp.type_of = 0")->row();
		return json_encode($row);
	}

	// delete ========
	function delete(){
		$par_typeno = $this->input->post('par_typeno', TRUE);	

		// $qr_tt = $this->db->query("SELECT
		// 									tt.par_typeno
		// 								FROM
		// 									tran_ticket AS tt
		// 								WHERE		
		// 									tt.par_typeno = '{$par_typeno}' ");

		$qr_pg = $this->db->query("SELECT
											pg.par_typeno
										FROM
											set_park_gate AS pg
										WHERE
											pg.par_typeno = '{$par_typeno}' ");

		// $qr_pp = $this->db->query("SELECT
		// 									pp.par_typeno
		// 								FROM
		// 									set_park_package AS pp
		// 								WHERE 1=1
		// 									pp.par_typeno = '{$par_typeno}' ");
		$qr_tran = $this->db->query("SELECT
										set_park.par_typeno,
										tran_ticket.package_typeno
										FROM
										set_park
										INNER JOIN set_park_package ON set_park.par_typeno = set_park_package.par_typeno
										INNER JOIN tran_ticket ON set_park_package.package_typeno = tran_ticket.package_typeno
										WHERE 1=1 AND set_park.par_typeno={$par_typeno}
										GROUP BY tran_ticket.package_typeno");
		$qr_ppd = $this->db->query("SELECT
											ppd.par_typeno
										FROM
											set_park_package_detail AS ppd
										WHERE
											ppd.par_typeno = '{$par_typeno}' AND ppd.type_of=1 ");

		// $qr_tt->num_rows() > 0 || 
		if($qr_pg->num_rows() > 0 || $qr_tran->num_rows() > 0 || $qr_ppd->num_rows() > 0){	
			$arr['success'] = 'false';
		}else{

			/*table transection delete
				- set_park
				- set_park_package
				- z_setup_prefix
			*/

			$image_del = $this->input->post('image_del');
			$this->db->delete('set_park', array('par_typeno' => $par_typeno));	
			$this->db->delete('set_park_package', array('par_typeno' => $par_typeno));
			$this->db->delete('set_park_package_detail', array('par_typeno' => $par_typeno,'type_of'=>0));	
			$this->db->query('DELETE FROM z_setup_prefix WHERE package_typeno=(SELECT package_typeno FROM set_park_package_detail WHERE par_typeno="'.$par_typeno.'" AND type_of=0)');
			if($image_del != ''){
				$target = "assets/upload/packages/".$image_del;
				if(file_exists($target)){
					unlink($target);			
				}
			}
			$arr['success'] = 'true';
		}

		return json_encode($arr);		
	}

	// save =========
	function save(){	
		$par_typeno = $this->input->post('par_typeno', TRUE);
		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$modify_date = date('Y-m-d H:i:s');		
		$modify_by = $this->session->userdata('userid');		
		$location  = trim($this->input->post('location', TRUE));
		$park_name = trim($this->input->post('park_name', TRUE));
		$description = trim($this->input->post('description', TRUE));
		//$prefix = trim($this->input->post('prefix', TRUE));
		//$tick_form = trim($this->input->post('tick_form', TRUE));		
		$is_active = trim($this->input->post('is_active', TRUE));
		$notforsale = trim($this->input->post('notforsale', TRUE));

		$fore_adult_series = trim($this->input->post('fore_adult_series',true));
		$fore_child_series  = trim($this->input->post('fore_child_series',true));
		$loc_adult_series  	= trim($this->input->post('loc_adult_series',true));
		$loc_child_series  	= trim($this->input->post('loc_child_series',true));
		$fore_adult_form  	= trim($this->input->post('fore_adult_form',true));
		$fore_child_form  	= trim($this->input->post('fore_child_form',true));
		$loc_adult_form  	= trim($this->input->post('loc_adult_form',true));
		$loc_child_form  	= trim($this->input->post('loc_child_form',true));

		$c = $this->db->query("SELECT
									COUNT(*) AS c
								FROM
									set_park AS p
								WHERE
									p.park_name = '{$park_name}' ")->row()->c - 0;
		
		if($par_typeno != ''){
			$park_name_ = $this->db->query("SELECT
												p.park_name AS park_name
											FROM
												set_park AS p
											WHERE
												p.par_typeno = '{$par_typeno}' ")->row()->park_name;
			
			$data_upd = array('modify_date' => $modify_date,
							'modify_by' => $modify_by,
							'loc_typeno' => $location,								
							'park_name' => $park_name,	
							'description' => $description,
							//'prefix' => $prefix,
							//'tick_form' => $tick_form,
							'is_active' => $is_active
						);	

			// set park package ======
			$data_upd_pp = array('package_name' => $park_name,
									'description' => $description,
									'type_of' => 0,	
									'image' => $this->input->post('image_edit'),	
									'modify_date' => $modify_date,
									'modify_by' => $modify_by,
									'notforsale' => $notforsale,
									'fore_adult_series'=>$fore_adult_series,
									'fore_child_series'=>$fore_child_series,
									'loc_adult_series'=>$loc_adult_series,
									'loc_child_series'=>$loc_child_series,
									'fore_adult_form'=>$fore_adult_form,
									'fore_child_form'=>$fore_child_form,
									'loc_adult_form'=>$loc_adult_form,
									'loc_child_form'=>$loc_child_form								
								);

			$package_typeno = $this->green->nextTrans(19, 'package_type');	
			//'tick_form' => $tick_form,		
			$data_ins_pp = array('package_name' => $park_name,
									'package_type' => 19,
									'package_typeno' => $package_typeno,
									'par_typeno' => $par_typeno,
									'description' => $description,
									'type_of' => 0,
									'image' => $this->input->post('image_edit'),
									'create_date' => $create_date,
									'create_by' => $create_by,									
									'notforsale' => $notforsale,
									'fore_adult_series'=>$fore_adult_series,
									'fore_child_series'=>$fore_child_series,
									'loc_adult_series'=>$loc_adult_series,
									'loc_child_series'=>$loc_child_series,
									'fore_adult_form'=>$fore_adult_form,
									'fore_child_form'=>$fore_child_form,
									'loc_adult_form'=>$loc_adult_form,
									'loc_child_form'=>$loc_child_form								
								);
			$qr_pp = $this->db->query("SELECT
											pp.par_typeno
										FROM
											set_park_package AS pp
										WHERE
											pp.par_typeno = '{$par_typeno}' ");

			if($qr_pp->num_rows() > 0){
				$this->db->update('set_park_package', $data_upd_pp, array('par_typeno' => $par_typeno));
			}else{
				$this->db->insert('set_park_package', $data_ins_pp);
			}

			// set park package detail ======
			$data_upd_ppd = array('package_type' => 19,
									'par_type' => 10,
									'par_typeno' => $par_typeno,										
									'type_of' => 0,
									'modify_date' => $modify_date,
									'modify_by' => $modify_by										
								);

			$data_ins_ppd = array('package_type' => 19,
									'package_typeno' => $package_typeno,
									'par_type' => 10,
									'par_typeno' => $par_typeno,										
									'type_of' => 0,
									'create_date' => $create_date,
									'create_by' => $create_by										
								);		
			$qr_ppd = $this->db->query("SELECT
											ppd.par_typeno
										FROM
											set_park_package_detail AS ppd
										WHERE
											ppd.par_typeno = '{$par_typeno}' ");

			if($qr_ppd->num_rows() > 0){
				$this->db->update('set_park_package_detail', $data_upd_ppd, array('par_typeno' => $par_typeno));
			}else{
				$this->db->insert('set_park_package_detail', $data_ins_ppd);
			}
			// ======================

			if($c == 0){
				$this->db->update('set_park', $data_upd, array('par_typeno' => $par_typeno));				
				$arr['success'] = 'true';
			}else if($park_name_ == $park_name){
				$this->db->update('set_park', $data_upd, array('par_typeno' => $par_typeno));
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}	
		}else{
			if($c == 0){
				$par_typeno = $this->green->nextTransParks(10, 'par_type', $location);
				$data_ins = array('create_date' => $create_date,
								'create_by' => $create_by,
								'loc_type' => 9,
								'loc_typeno' => $location,
								'par_type' => 10,
								'par_typeno' => $par_typeno,										
								'park_name' => $park_name,													
								'description' => $description,
								//'prefix' => $prefix,												
								//'tick_form' => $tick_form,
								'is_active' => $is_active
								);
				$this->db->insert('set_park', $data_ins);

				// set park package ======
				$package_typeno = $this->green->nextTrans(19, 'package_type');

				$data_ins_pp = array('package_name' => $park_name,
										'package_type' => 19,
										'package_typeno' => $package_typeno,
										'par_typeno' => $par_typeno,
										'description' => $description,
										'type_of' => 0,
										'create_date' => $create_date,
										'create_by' => $create_by,
										'notforsale' => $notforsale,
										//'tick_form' => $tick_form	
										'fore_adult_series'=>$fore_adult_series,
										'fore_child_series'=>$fore_child_series,
										'loc_adult_series'=>$loc_adult_series,
										'loc_child_series'=>$loc_child_series,
										'fore_adult_form'=>$fore_adult_form,
										'fore_child_form'=>$fore_child_form,
										'loc_adult_form'=>$loc_adult_form,
										'loc_child_form'=>$loc_child_form									
									);				
				$this->db->insert('set_park_package', $data_ins_pp);

				// set park package detail ======
				$data_ins_ppd = array('package_type' => 19,
										'package_typeno' => $package_typeno,
										'par_type' => 10,
										'par_typeno' => $par_typeno,										
										'type_of' => 0,
										'create_date' => $create_date,
										'create_by' => $create_by										
									);				
				$this->db->insert('set_park_package_detail', $data_ins_ppd);

				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}						
		}
		$arrs = array('arr' => $arr, 'par_typeno' => $par_typeno);
		return json_encode($arrs);	
	}

	function park_upload(){
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
				$this->db->update('set_park', array('image' => $exts), array('par_typeno' => $image_insert));
				
				// set park package ======
				$this->db->update('set_park_package', array('image' => $exts), array('par_typeno' => $image_insert));
				
				$target = $path.$exts;				
				if(file_exists($target)){
					unlink($target);													
				}
				$tmp_name = $_FILES['photo']['tmp_name'];							
				move_uploaded_file($tmp_name, $target);
			}
		}
	}

	// get locations ========
	function get_location(){		
		$result = $this->db->query("SELECT
										l.loc_typeno,
										l.loc_name
									FROM
										set_location AS l
									ORDER BY
										l.loc_name ASC ")->result();	
		return json_encode($result);
	}

	// show ​data =====
	function grid(){
		$where = '';
		$search_park_name = trim($this->input->post('search_park_name', TRUE));
		$search_description = trim($this->input->post('search_description', TRUE));
		$search_location = trim($this->input->post('search_location', TRUE));
		$search_is_active = trim($this->input->post('search_is_active', TRUE));

		$offset = $this->input->post('offset') - 0;
		$limit = $this->input->post('limit') - 0;
		$fd = $this->input->post('fd');
		$order = $this->input->post('order');		
		
		if($search_park_name != ''){
			$where .= " AND p.park_name LIKE '%{$search_park_name}%' ";				
		}
		if($search_description != ''){
			$where .= " AND p.description LIKE '%{$search_description}%' ";				
		}		
		if($search_location != ''){
			$where .= " AND l.loc_name LIKE '%{$search_location}%' ";				
		}
		if($search_is_active != ''){
			$where .= " AND p.is_active = '{$search_is_active}' ";
		}
		$total_records = $this->db->query("SELECT
											COUNT(p.par_typeno) AS c
										FROM
											set_park AS p
										LEFT JOIN set_location AS l ON p.loc_typeno = l.loc_typeno
										WHERE
											1 = 1 {$where} ")->row()->c - 0;
		
		$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

		$result = $this->db->query("SELECT
										p.create_date,
										p.create_by,
										p.modify_by,
										p.modify_date,
										p.par_type,
										p.par_typeno,
										p.loc_type,
										p.loc_typeno,
										p.park_name,
										p.description,
										p.image,
										-- p.prefix,
										-- p.tick_form,
										l.loc_name,
										spp.fore_adult_series,
										spp.fore_child_series,
										spp.loc_adult_series,
										spp.loc_child_series,
										spp.fore_adult_form,
										spp.fore_child_form,
										spp.loc_adult_form,
										spp.loc_child_form
									FROM
										set_park AS p
									LEFT JOIN set_location AS l ON p.loc_typeno = l.loc_typeno
									LEFT JOIN set_park_package AS spp ON p.par_typeno = spp.par_typeno
									WHERE
										1 = 1 {$where}
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