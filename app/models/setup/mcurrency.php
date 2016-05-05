<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mcurrency extends CI_Model{
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
	}

	function show(){ 

		$sql = $this->db->query("SELECT
									set_currencies.cur_typeno,
									set_currencies.cur_type,
									set_currencies.create_date,
									set_currencies.create_by,
									set_currencies.modify_date,
									set_currencies.modify_by,
									set_currencies.curcode,
									set_currencies.currencyname,
									set_currencies.country,
									set_currencies.rate,
									set_currencies.symbol,
									set_currencies.reciept_payment,
									set_currencies.cur_default,
									countries.`name`
								FROM
									set_currencies
								INNER JOIN countries ON set_currencies.country = countries.id_countries")->result();

									
		return $sql;
	}

	function ch_curr(){ 

		$cur_typeno = $this->input->post('cur_typeno');
		// $value_ch  = $this->input->post('value_ch');
		$this->db->update('set_currencies',array('cur_default' => 0));
		$data = array('cur_default' => 1,'reciept_payment' => 1);
		$where = array('cur_typeno' => $cur_typeno);
		$this->db->update('set_currencies',$data,$where);
	}

	function ch_curr_payment(){ 

		$cur_typeno = $this->input->post('cur_typeno');
		$value_ch  = $this->input->post('value_ch');
		$data = array('reciept_payment' => $value_ch);
		$where = array('cur_typeno' => $cur_typeno);
		$this->db->update('set_currencies',$data,$where);
	}

	function save(){
		$session_user = $this->session->userdata('userid');
		$h_typeno = $this->input->post('h_typeno');
		$where  = array('cur_typeno' => $h_typeno);
		$array_data = $this->input->post('data_curr');
		$curr_code = $array_data['curr_code'];
		$h_value_code = $this->input->post('h_value_code');
		$type_no = $this->green->nextTran(5,'cur_type');

		if($h_typeno ==""){ 

			$data_insert = array( 
				'curcode'      => $array_data['curr_code'],
				'currencyname' => $array_data['curr_name'],
				'country'      => $array_data['country'],
				'rate'         => $array_data['exchange_rate'],
				'symbol'       => $array_data['symbol'],
				'create_by'    => $session_user,
				'create_date'  => date('Y-m-d H:i:s'),
				'cur_type'     => 5,
				'cur_typeno'   => $type_no
			);

			$check_code = $this->db->query("SELECT COUNT(*) AS curr FROM set_currencies WHERE curcode = '".$curr_code."'")->row()->curr;
			if($check_code == 0){ 
				$this->db->insert('set_currencies',$data_insert);
				$arr['success'] = "true";	
			}else{ 
				$arr['success'] = "false";
			}
			
		}else{ 

			$data_update = array( 
				'curcode'      => $array_data['curr_code'],
				'currencyname' => $array_data['curr_name'],
				'country'      => $array_data['country'],
				'rate'         => $array_data['exchange_rate'],
				'symbol'       => $array_data['symbol'],
				'modify_date'  => date('Y-m-d H:i:s'),
				'modify_by'    => $session_user

			);

			$check_code = $this->db->query("SELECT COUNT(*) AS curr FROM set_currencies WHERE curcode = '".$curr_code."'")->row()->curr;
			$check_code_ = $this->db->query("SELECT set_currencies.curcode FROM set_currencies WHERE cur_typeno = '".$h_typeno."'")->row()->curcode;
			
			if($check_code == 0){ 
				$this->db->update('set_currencies',$data_update,$where);
				$arr['success'] = "true";	
			}else if($check_code_ == $curr_code){ 
				$this->db->update('set_currencies',$data_update,$where);
				$arr['success'] = "true";
			}else{ 
				$arr['success'] = "false";
				$arr['value_code'] = $h_value_code;
			}
			
		}

		
		return $arr;
	}

	function edit(){ 

		$cur_typeno = $this->input->post('cur_typeno');
		$sql = $this->db->query("SELECT
										set_currencies.cur_typeno,
										set_currencies.cur_type,
										set_currencies.create_date,
										set_currencies.create_by,
										set_currencies.modify_date,
										set_currencies.modify_by,
										set_currencies.curcode,
										set_currencies.currencyname,
										set_currencies.country,
										set_currencies.rate,
										set_currencies.symbol,
										set_currencies.reciept_payment
										FROM
										set_currencies
		 							WHERE cur_typeno = ".$cur_typeno."")->row();
		return $sql;

	}

	function delete(){
		$cur_typeno = $this->input->post('cur_typeno');
		$this->db->delete('set_currencies',array('cur_typeno' => $cur_typeno));
		if($cur_typeno !=""){ 
			header('Content-type : application/json');
			$json['success'] = "true";
			echo json_encode($json);
		} 
		
	}

	function select_country(){ 
		$sql_select = $this->db->query("SELECT
											countries.id_countries,
											countries.`name`
										FROM
											countries")->result();
		
		$option = '';
		if(COUNT($sql_select) > 0){ 
			foreach($sql_select as $value){ 
				$option .="<option value='".$value->id_countries."'>".$value->name."</option>"; 
			}
		}
		return $option;
	}

	function change_country(){ 
		$country_id = $this->input->post('country_id');
		$select_country = $this->db->query("SELECT
												countries.iso_alpha2,
												countries.iso_alpha3,
												countries.iso_numeric,
												countries.currency_code,
												countries.currency_name,
												countries.currrency_symbol,
												countries.flag
											FROM
												countries 
											WHERE id_countries = '".$country_id."'")->result();
		return $select_country;
	}

}
