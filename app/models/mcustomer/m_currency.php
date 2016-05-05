<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_currency extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	
	function mshowCurrency(){
		$result = $this->db->query("SELECT
									currencies.curcode,
									currencies.currencyname,
									currencies.country,
									currencies.rate,
									currencies.symbol
									FROM
									currencies");
		
		return $result->result();
	}
	function msave(){
		$h_currencyCode = $this->input->post("h_currencyCode");
		$data = array("curcode"=>$this->input->post("currencyCode"),
					  "currencyname"=>$this->input->post("currencyName"),
					  "country"=>$this->input->post("country"),
					  "rate"=>$this->input->post("exchangeRage"),
					  "symbol"=>$this->input->post("symbol")
					  );
		
		if($h_currencyCode != ""){
			$this->db->update("currencies",$data,array("curcode"=>$h_currencyCode));
		}else{
			$this->db->insert("currencies",$data);
		}
		return "OK";	
	}
	function medite(){
		$currCode = $this->input->post("para_code");
		$result = $this->db->query("SELECT
									currencies.curcode,
									currencies.currencyname,
									currencies.country,
									currencies.rate,
									currencies.symbol
									FROM
									currencies
									WHERE curcode='".$currCode."'")->row();
		return $result;
	}
	function cdelete(){
		$currency = $this->input->post("para_delete");
		$this->db->delete("currencies",array("curcode"=>$currency));
		return "OK";
	}
	
}