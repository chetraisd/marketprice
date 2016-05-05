<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modulemodel extends CI_Model {

	public function getmodule()
	{	$this->db->order_by('moduleid','asc');
		$this->db->where('is_active','1');
		$query=$this->db->get('sch_z_module');
		return $query->result();
		
	}
}