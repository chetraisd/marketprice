<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcountry extends CI_Model {
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}

	// edit =======
	function edit(){
		$id_countries = $this->input->post('id_countries');
		$row = $this->db->query("SELECT
									cc.id_countries,
									cc.`name`,
									cc.iso_alpha2,
									cc.iso_alpha3,
									cc.iso_numeric,
									cc.currency_code,
									cc.currency_name,
									cc.currrency_symbol,
									LOWER(cc.flag) AS flag,
									cc.nationality,
									cc.create_date,
									cc.create_by,
									cc.modify_by,
									cc.modify_date
								FROM
									countries AS cc
								WHERE
									id_countries = {$id_countries} ")->row();
		return json_encode($row);
	}

	// delete ========
	function delete(){
		$id_countries = $this->input->post('id_countries', TRUE);		
		$image_del = $this->input->post('image_del');
		$this->db->delete('countries', array('id_countries' => $id_countries));	
		// image ======
		if($image_del != ''){
			$target = "assets/upload/".$image_del;
			if(file_exists($target)){
				unlink($target);			
			}
		}
		$arr['success'] = 'true';
		return json_encode($arr);		
	}

	// save =========
	function save(){		
		$id_countries = $this->input->post('id_countries', TRUE);
		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$modify_date = date('Y-m-d H:i:s');		
		$modify_by = $this->session->userdata('userid');		
		$name = trim($this->input->post('name', TRUE));
		$nationality = trim($this->input->post('nationality', TRUE));

		$c = $this->db->query("SELECT
											COUNT(*) AS c
										FROM
											countries AS cc
										WHERE
											cc.name = '{$name}' ")->row()->c - 0;
		
		if($id_countries != ''){
			$name_ = $this->db->query("SELECT
															cc.name AS c_name
														FROM
															countries AS cc
														WHERE
															cc.id_countries = '{$id_countries}' ")->row()->c_name;
			
			$data_upd = array('modify_date' => $modify_date,
										'modify_by' => $modify_by,
										'name' => $name,								
										'nationality' => $nationality								
								);
			if($c == 0){				
				$this->db->update('countries', $data_upd, array('id_countries' => $id_countries));
				$arr['success'] = 'true';
			}else if($name_ == $name){
				$this->db->update('countries', $data_upd, array('id_countries' => $id_countries));
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}	
		}else{
			if($c == 0){				
				$data_ins = array('create_date' => $create_date,
										'create_by' => $create_by,
										'name' => $name,								
										'nationality' => $nationality								
									);
				$this->db->insert('countries', $data_ins);
				$id_countries = $this->db->insert_id() - 0;

				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}						
		}
		$arrs = array('arr' => $arr, 'id_countries' => $id_countries);
		return json_encode($arrs);	
	}

	function country_upload(){
		$image_insert = $this->input->post('image_insert', TRUE);
		$image_edit = $this->input->post('image_edit', TRUE);

		// if($image_insert != ''){
			if($_FILES['flag']['size'] > 0){
				$path = "assets/upload/flag/";
				if(file_exists($path.$this->input->post('image_edit'))){
					unlink($path.$this->input->post('image_edit'));													
				}
				// $name = $_FILES['flag']['name'];
				// $ext = pathinfo($name, PATHINFO_EXTENSION);
				// $exts = $image_insert.'.'.$ext;
				// $this->db->update('countries', array('flag' => $exts), array('id_countries' => $image_insert));
				// $target = $path.$exts;
				$target = $path.$image_edit;								
				if(file_exists($target)){
					unlink($target);													
				}
				$tmp_name = $_FILES['flag']['tmp_name'];							
				move_uploaded_file($tmp_name, $target);
			}
		// }
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
		$search_name = trim($this->input->post('search_name', TRUE));
		$search_nationality = trim($this->input->post('search_nationality', TRUE));
		
		$offset = $this->input->post('offset') - 0;
		$limit = $this->input->post('limit') - 0;
		$fd = $this->input->post('fd');
		$order = $this->input->post('order');		
		
		if($search_name != ''){
			$where .= "AND `name` LIKE '%{$search_name}%' ";				
		}
		if($search_nationality != ''){
			$where .= "AND nationality LIKE '%{$search_nationality}%' ";				
		}	
		
		$total_records = $this->db->query("SELECT
												COUNT(cc.id_countries) AS c
											FROM
												countries AS cc
											WHERE
												1 = 1 {$where} ")->row()->c - 0;
		
		$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

		$result = $this->db->query("SELECT
										cc.id_countries,
										cc.`name`,
										cc.iso_alpha2,
										cc.iso_alpha3,
										cc.iso_numeric,
										cc.currency_code,
										cc.currency_name,
										cc.currrency_symbol,
										LOWER(cc.flag) AS flag,
										cc.nationality,
										cc.create_date,
										cc.create_by,
										cc.modify_by,
										cc.modify_date,
										cc.order_country,
										cc.is_local
									FROM
										countries AS cc
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

	function check_local(){ 

		$value = $this->input->post('value');		
		$id_countries = $this->input->post('id_countries');
		$this->db->update('countries',array('is_local' => 0));
		$this->db->update('countries',array('is_local' => $value),array('id_countries' => $id_countries));
	}

	function check_top(){ 

		$id_countries = $this->input->post('id_countries');
		$checked = $this->input->post('checked');
		if($checked != ""){ 
			$value = $checked;
		}else{ 
			$value = 0;
		}	
		
		$this->db->update('countries',array('order_country' => $value),array('id_countries' => $id_countries));
	}

}