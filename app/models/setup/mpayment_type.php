<?php 
	class Mpayment_type extends CI_Model{ 
		function __construct(){ 
			parent:: __construct();
			date_default_timezone_set("Asia/Bangkok");
		}

		function save(){ 
			$session_user = $this->session->userdata('userid');
			$arr_data = $this->input->post('arr_data');
			$h_typeno = trim($this->input->post('h_typeno'));
			$h_pn     = trim($this->input->post('h_pn'));
			$typeno   = $this->green->nextTran(11,'pay_type');
			if($h_typeno == ""){
				
				$data_save = array( 
					'payment_name' => trim($arr_data['pt_name']),
					'description'  => trim($arr_data['pt_description']),
					'create_date'  => date('Y-m-d H:i:s'),
					'create_by'    => $session_user,
					'pay_typeno'   => $typeno,
					'pay_type'     => 11
				);
				$count_name = $this->db->query("SELECT COUNT(*) as pt FROM set_payment_type WHERE payment_name = '".$arr_data['pt_name']."'")->row()->pt;
				if($count_name == 0){ 
					$this->db->insert('set_payment_type',$data_save);
					$arr['success'] = "true";	
				}else{ 
					$arr['success'] = "false";
				}

			}else{
				
				$data_update = array( 
					'payment_name' => trim($arr_data['pt_name']),
					'description'  => trim($arr_data['pt_description']),
					'modify_date'  => date('Y-m-d H:i:s'),
					'modify_by'    => $session_user
				);
				$count_name = $this->db->query("SELECT COUNT(*) as pt FROM set_payment_type WHERE payment_name = '".$arr_data['pt_name']."'")->row()->pt;
				$check_name = $this->db->query("SELECT set_payment_type.payment_name FROM set_payment_type WHERE pay_typeno = '".$h_typeno."'")->row()->payment_name;
				if($count_name == 0){ 
					$this->db->update('set_payment_type',$data_update,array('pay_typeno' => $h_typeno));
					$arr['success']	= "true";
				}else if($check_name == $arr_data['pt_name']){ 
					$this->db->update('set_payment_type',$data_update,array('pay_typeno' => $h_typeno));
					$arr['success']	= "true";
				}else{ 
					$arr['success']	= "false";
					$arr['value_n'] = $h_pn;
				}
				
			}

			header('Content-type : application/json'); 
			echo json_encode($arr);
		}

		function edit(){ 
			$pay_typeno = $this->input->post('pay_typeno');
			$sql = $this->db->query("SELECT
										set_payment_type.pay_type,
										set_payment_type.pay_typeno,
										set_payment_type.description,
										set_payment_type.payment_name
									FROM
										set_payment_type
									WHERE 
										pay_typeno = ".$pay_typeno."")->row();
			
			return json_encode($sql);						
		}

		function show(){ 
			$ftbl = $this->input->post('ftbl');
			$order = $this->input->post('order');
			$sh_pt_name = trim($this->input->post('sh_pt_name'));
			$sh_pt_description = trim($this->input->post('sh_pt_description'));

			$offset = $this->input->post('offset') - 0;
			$limit = $this->input->post('limit') - 0;

			$search = '';
			if($sh_pt_name != ""){ 
				$search .= "AND p.payment_name like'%".$sh_pt_name."'";
			}
			if($sh_pt_description != ""){ 
				$search .= "AND p.description like'%".$sh_pt_description."'";
			}

			$total_records = $this->db->query("SELECT
												COUNT(p.pay_typeno) AS c
											FROM
												set_payment_type AS p
											WHERE
												1=1 {$search} ")->row()->c - 0;

			$total_pages = ceil($limit > 0 ? $total_records/$limit : $total_records/5) - 0;

			$result_sql = $this->db->query("SELECT
										p.pay_typeno,
										p.description,
										p.payment_name
									FROM
										set_payment_type AS p
									WHERE 1=1 {$search} 
									ORDER BY {$ftbl} {$order}
									lIMIT {$offset}, {$limit}")->result();

			$arr['total_records'] = $total_records;
			$arr['total_pages'] = $total_pages;
			$arr['result_sql'] = $result_sql;
			return json_encode($arr);
		}

		function delete(){ 
			$pay_typeno = $this->input->post('pay_typeno');
			$this->db->delete('set_payment_type',array('pay_typeno' => $pay_typeno));
			if($pay_typeno != ""){ 
				$arr['success'] = "true";
			}
			header('Content-type : application/json');
			echo json_encode($arr);
		}
		
	}
?>
