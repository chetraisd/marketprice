<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_report_application extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}

	// edit =======
	function edit(){
		$cou_typeno = $this->input->post('cou_typeno');
		$row = $this->db->query("SELECT
												c.create_date,
												c.create_by,
												c.modify_by,
												c.modify_date,
												c.gat_type,
												c.gat_typeno,
												c.cou_type,
												c.cou_typeno,
												c.counter_name,
												c.description
											FROM
												set_counter AS c
											WHERE
												cou_typeno = {$cou_typeno} ")->row();
		return json_encode($row);
	}

	// delete ========
	function delete(){
		$cou_typeno = $this->input->post('cou_typeno', TRUE);		
		$this->db->delete('set_counter', array('cou_typeno' => $cou_typeno));	
		$arr['success'] = 'true';
		return json_encode($arr);		
	}

	// save =========
	function save(){		
		$cou_typeno = $this->input->post('cou_typeno', TRUE);
		$create_date = date('Y-m-d H:i:s');
		$create_by = $this->session->userdata('userid');
		$modify_date = date('Y-m-d H:i:s');		
		$modify_by = $this->session->userdata('userid');		
		$gate = $this->input->post('gate', TRUE);
		$counter_name = trim($this->input->post('counter_name', TRUE));
		$description = trim($this->input->post('description', TRUE));

		$c = $this->db->query("SELECT
											COUNT(*) AS c
										FROM
											set_counter AS cc
										WHERE
											cc.counter_name = '{$counter_name}' ")->row()->c - 0;
		
		if($cou_typeno != ''){
			$counter_name_ = $this->db->query("SELECT
															c.counter_name AS counter_name
														FROM
															set_counter AS c
														WHERE
															c.cou_typeno = '{$cou_typeno}' ")->row()->counter_name;
			
			$data_upd = array('modify_date' => $modify_date,
										'modify_by' => $modify_by,
										'gat_typeno' => $gate,								
										'counter_name' => $counter_name,													
										'description' => $description								
								);
			if($c == 0){				
				$this->db->update('set_counter', $data_upd, array('cou_typeno' => $cou_typeno));
				$arr['success'] = 'true';
			}else if($counter_name_ == $counter_name){
				$this->db->update('set_counter', $data_upd, array('cou_typeno' => $cou_typeno));
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}
		}else{
			if($c == 0){
				$cou_typeno = $this->green->nextTran(10, 'cou_type');
				$data_ins = array('create_date' => $create_date,
										'create_by' => $create_by,
										'gat_type' => 7,
										'gat_typeno' => $gate,								
										'cou_type' => 4,
										'cou_typeno' => $cou_typeno,										
										'counter_name' => $counter_name,													
										'description' => $description								
									);
				$this->db->insert('set_counter', $data_ins);	
				$arr['success'] = 'true';
			}else{
				$arr['success'] = 'false';
			}						
		}
		return json_encode($arr);		
	}

	function park_upload(){
		$image_insert = $this->input->post('image_insert', TRUE);
		$image_edit = $this->input->post('image_edit', TRUE);

		if($image_insert != ''){
			if($_FILES['photo']['size'] > 0){
				$path = "assets/upload/";
				if(file_exists($path.$this->input->post('image_edit'))){
					unlink($path.$this->input->post('image_edit'));													
				}
				$name = $_FILES['photo']['name'];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$exts = $image_insert.'.'.$ext;
				$this->db->update('set_park', array('image' => $exts), array('par_typeno' => $image_insert));
				$target = $path.$exts;				
				if(file_exists($target)){
					unlink($target);													
				}
				$tmp_name = $_FILES['photo']['tmp_name'];							
				move_uploaded_file($tmp_name, $target);
			}
		}
	}

	// get counters ========
	function get_gate(){		
		$result = $this->db->query("SELECT
													g.gat_typeno,
													g.gat_name
												FROM
													set_gate AS g
												ORDER BY
													g.gat_name ASC ")->result();	
		return json_encode($result);
	}

	// get remark ========
	function get_remark(){		
		$result = $this->db->query("SELECT DISTINCT
													a.remark
												FROM
													tran_application AS a
												ORDER BY
													a.remark ASC ")->result();	
		return json_encode($result);
	}

	// get gender ========
	function get_gender(){		
		$result = $this->db->query("SELECT DISTINCT
													a.gender
												FROM
													tran_application AS a
												ORDER BY
													a.remark ASC ")->result();	
		return json_encode($result);
	}

	// get visitor type ========
	function get_visitor_type(){		
		$result = $this->db->query("SELECT DISTINCT
													v.vistor_name
												FROM
													set_visitor_type AS v
												ORDER BY
													v.vistor_name ASC ")->result();	
		return json_encode($result);
	}

	// get country ========
	function get_country(){		
		$result = $this->db->query("SELECT DISTINCT
													a.country,
													countries.`name`
												FROM
													tran_application AS a
												INNER JOIN countries ON countries.id_countries = a.country
												ORDER BY
													countries.`name` ASC ")->result();	
		return json_encode($result);
	}

	// show ​data =====
	function grid(){
		$where = '';
		$from_date = trim($this->input->post('from_date', TRUE));
		$to_date = trim($this->input->post('to_date', TRUE));
		$contact_name = trim($this->input->post('contact_name', TRUE));
		$customer_name = trim($this->input->post('customer_name', TRUE));
		$country = trim($this->input->post('country', TRUE));
		$gender = trim($this->input->post('gender', TRUE));
		$remark = trim($this->input->post('remark', TRUE));
		$visitor_type = trim($this->input->post('visitor_type', TRUE));
		$age = trim($this->input->post('age', TRUE));
		$sort_by = trim($this->input->post('sort_by', TRUE));
		$sort_type = trim($this->input->post('sort_type', TRUE));
			
		if(trim($from_date) != ''){
			$where .= "AND a.create_date >= '{$from_date}' ";				
		}
		if(trim($to_date) != ''){
			$where .= "AND a.create_date <= '{$to_date}' ";				
		}
		if(trim($contact_name) != ''){
			$where .= "AND CONCAT(c.contact_firstname, ' ', c.contact_lastname) LIKE '%{$contact_name}%' ";				
		}
		if(trim($customer_name) != ''){
			$where .= "AND CONCAT(a.customer_firstname, ' ', a.customer_lastname) LIKE '%{$customer_name}%' ";				
		}	
		if(trim($country) != ''){
			$where .= "AND a.`country` = '{$country}' ";				
		}	
		if(trim($gender) != ''){
			$where .= "AND a.gender = '{$gender}' ";				
		}
		if(trim($remark) != ''){
			$where .= "AND a.remark = '{$remark}' ";				
		}
		if(trim($visitor_type) != ''){
			$where .= "AND v.vistor_name = '{$visitor_type}' ";				
		}
		if(trim($age) != ''){
			$where .= "AND a.age = '{$age}' ";				
		}
		$where .= "AND c.status = 1 ";

		$qr = $this->db->query("SELECT
												a.create_date,
												CONCAT(
													c.contact_firstname,
													' ',
													c.contact_lastname
												) AS contact_name,
												v.vistor_name,
												c.company_email,
												CONCAT(
													a.customer_firstname,
													' ',
													a.customer_lastname
												) AS customer_name,
												a.country,
												a.nationality,
												a.gender,
												a.age,
												a.remark
											FROM
												tran_application AS a
											RIGHT JOIN set_contact_customer AS c ON a.con_typeno = c.con_typeno
											LEFT JOIN set_visitor_type AS v ON c.vis_typeno = v.vis_typeno
											WHERE
												1 = 1 {$where}
											ORDER BY
												{$sort_by} {$sort_type} ");

		$tr = "";
		$i = 1;
		if ($qr->num_rows() > 0){
		   foreach ($qr->result() as $row){
		   	$qr_country = $this->db->query("SELECT DISTINCT
																c.id_countries,
																c.`name`
															FROM
																countries AS c
															WHERE
																c.id_countries = '{$row->country}'
															ORDER BY
																c.`name` ASC ")->row()->name;
		   	$tr .= "<tr>".
		   					"<td>".$i."</td>".
		   					"<td>".($row->create_date != null ? ($this->green->gdate_format($row->create_date, 0)) : '')."</td>".
		   					"<td>".($row->contact_name != null ? $row->contact_name : '')."</td>".		   					
		   					"<td>".($row->vistor_name != null ? $row->vistor_name: '')."</td>".
		   					"<td>".($row->company_email != null ? $row->company_email : '')."</td>".
		   					"<td>".($row->customer_name != null ? $row->customer_name : '')."</td>".
		   					"<td>".($qr_country != null ? $qr_country : '')."</td>".
		   					"<td>".($row->nationality != null ? $row->nationality : '')."</td>".
		   					"<td>".($row->gender != null ? $row->gender : '')."</td>".
		   					"<td>".($row->age - 0 > 0 ? $row->age : 0)."</td>".
		   					"<td>".($row->remark == '1' ? 'Adult' : 'Children')."</td>".		   							   					
	   					"</tr>";
		   }
		}else{
			$tr .= "<tr>". 
                     "<td colspan='11' style='font-size: 14px;text-align: center;font-weight: bold;'>No Results</td>".
                  "</tr>";
		}
		return $tr;
	}
	
}