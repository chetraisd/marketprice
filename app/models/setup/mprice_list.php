<?php 
	class Mprice_list extends CI_Model{ 
		public function __construct(){ 
			parent:: __construct();
			date_default_timezone_set("Asia/Bangkok");
		}

		function select_package(){ 
			$sql = $this->db->query("SELECT
										set_park_package.package_name,
										set_park_package.package_typeno
									FROM
										set_park_package")->result();
			if(COUNT($sql) > 0){ 
				$option = '<option></option>';
				foreach($sql as $row){ 
					$option .='<option value="'.$row->package_typeno.'">'.$row->package_name.'</option>';
				}
				return $option;
			}
		}

		function save_price(){ 
			$select_parkage = $this->input->post('select_parkage'); 
			$select_tourclass  = $this->input->post('select_tourclass');           
			$select_old = $this->input->post('select_old');
			$price = $this->input->post('price');
			$discount = $this->input->post('discount');
			$pric_code = $this->input->post('pric_code');
			$session_user = $this->session->userdata('userid');
			$pric_typeno   = $this->green->nextTran(20,'pric_type');

			if($pric_code == ''){ 

				$data_save = array( 
					'pric_type' => 20,
					'pric_typeno' => $pric_typeno,
					'package_type' => 19,
					'package_typeno' => $select_parkage,
					'is_local' => $select_tourclass,
					'old_type' => $select_old,
					'price' => $price,
					'discount' => $discount,
					'is_group' => 0,
					'create_by' => $session_user,
					'create_date' => date('Y-m-d H:i:s')
				);

				$count_pri = $this->db->query('SELECT 
													COUNT(*) AS pri 
												FROM 
													set_price_list 
												WHERE 
													package_typeno = "'.$select_parkage.'" 
													AND is_local = "'.$select_tourclass.'" 
													AND old_type = "'.$select_old.'"')->row()->pri;
				if($count_pri == 0){ 
					$this->db->insert('set_price_list',$data_save);
					$arr['success'] = 'true';
				}else{ 
					$arr['success'] = 'false';
				}

			}else{ 

				$data_update = array( 
					'package_typeno' => $select_parkage,
					'is_local' => $select_tourclass,
					'old_type' => $select_old,
					'price' => $price,
					'discount' => $discount,
					'is_group' => 0,
					'modify_by' => $session_user,
					'modify_date' => date('Y-m-d H:i:s')
				);

				$count_pri = $this->db->query('SELECT 
													COUNT(*) AS pri 
												FROM 
													set_price_list 
												WHERE 
													package_typeno = "'.$select_parkage.'" 
													AND is_local = "'.$select_tourclass.'" 
													AND old_type = "'.$select_old.'"')->row()->pri;

				
				$check_package = $this->db->query("SELECT set_price_list.package_typeno FROM set_price_list WHERE pric_typeno = '".$pric_code."'")->row()->package_typeno;
				$check_is_local = $this->db->query("SELECT set_price_list.is_local FROM set_price_list WHERE pric_typeno = '".$pric_code."'")->row()->is_local;
				$check_old_type = $this->db->query("SELECT set_price_list.old_type FROM set_price_list WHERE pric_typeno = '".$pric_code."'")->row()->old_type;										

				if($count_pri == 0){
					$this->db->update('set_price_list',$data_update,array('pric_typeno' => $pric_code));
					$arr['success'] = 'true';
				}else if($check_package == $select_parkage && $check_is_local == $select_tourclass && $check_old_type == $select_old){ 
					$this->db->update('set_price_list',$data_update,array('pric_typeno' => $pric_code));
					$arr['success'] = 'true';
				}else{ 
					$arr['success'] = 'false';
				}
				
			}
			
			return json_encode($arr);

		}

		function show_price(){ 

			$sql_query = $this->db->query('SELECT
											set_price_list.pric_type,
											set_price_list.pric_typeno,
											set_price_list.package_type,
											set_price_list.package_typeno,
											set_price_list.is_local,
											set_price_list.old_type,
											FORMAT(set_price_list.price,0) AS price,
											FORMAT(set_price_list.discount,0) AS discount,
											set_park_package.package_name
											FROM
											set_price_list
											INNER JOIN set_park_package ON set_price_list.package_typeno = set_park_package.package_typeno')->result();

			$arr_data['sql_query'] = $sql_query;

			return json_encode($arr_data);
		}

		function edit_price(){ 
			$pric_typeno = $this->input->post('pric_typeno');
			$query_edit = $this->db->query('SELECT
											set_price_list.pric_type,
											set_price_list.pric_typeno,
											set_price_list.package_type,
											set_price_list.package_typeno,
											set_price_list.is_local,
											set_price_list.old_type,
											set_price_list.price,
											set_price_list.discount
											
										FROM
											set_price_list
										WHERE pric_typeno = "'.$pric_typeno.'"')->result();
			
			return json_encode($query_edit);
		}

		function delete_price(){ 
			$pric_typeno = $this->input->post('pric_typeno');
			$pric_typeno = $this->db->delete('set_price_list',array('pric_typeno' => $pric_typeno));
			if(COUNT($pric_typeno) > 0){ 
				$success = 'true';
			}else{ 
				$success = 'false';
			}
			return json_encode($success);
		}
	}
?>
