<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->model("mcustomer/m_model","m");
        $this->lang->load('general', $this->session->userdata('lang'));
		$this->lang->load('customer', $this->session->userdata('lang'));
	}
	function index(){
		$this->load->view('header');
		$this->load->view('dashboard/vdashboard');
		$this->load->view('footer');
	}
	function search_data(){
		$fdata  = $this->green->convertSQLDate(trim($this->input->post("fdata")),true);
		$todate = $this->green->convertSQLDate(trim($this->input->post("todate")),true);
		$WHERE  = "";
		$WHERE_BY_COUNTRY = "";
		if($fdata != ""){
			$WHERE.= " AND DATE(create_date) >='".$fdata."'";
			$WHERE_BY_COUNTRY.= " AND DATE(tt.create_date) >='".$fdata."'";
		}
		if($todate != ""){
			$WHERE.= " AND DATE(create_date) <='".$todate."'";
			$WHERE_BY_COUNTRY.= " AND DATE(tt.create_date) <='".$todate."'";
		}
		// show total tour ============================
		$sql_tour = $this->db->query("SELECT 
											spp.package_typeno,
											spp.package_name,
											IFNULL(ttr.amt,0) AS amt_tour,
											IFNULL(amtad.amt_adult,0) AS adult,
											IFNULL(amtch.amt_ch,0) AS child
									FROM set_park_package AS spp
									LEFT JOIN(SELECT COUNT(*) AS amt,package_typeno FROM tran_ticket WHERE vis_typeno=1 {$WHERE} GROUP BY package_typeno) AS ttr ON spp.package_typeno = ttr.package_typeno
									LEFT JOIN(SELECT COUNT(*) as amt_adult,package_typeno FROM tran_ticket WHERE 1=1 AND old_type='0' {$WHERE} AND vis_typeno='1' GROUP BY old_type,package_typeno) AS amtad ON spp.package_typeno=amtad.package_typeno
									LEFT JOIN(SELECT COUNT(*) as amt_ch,package_typeno FROM tran_ticket WHERE 1=1 AND old_type='1' {$WHERE} AND vis_typeno='1' GROUP BY old_type,package_typeno) AS amtch ON spp.package_typeno=amtch.package_typeno
									WHERE spp.notforsale=0
									ORDER BY ttr.amt DESC");

		$tr= "";
		$total_tour = 0;
		$k = 1;
		$total_adult = 0;
		$total_child = 0;
		if($sql_tour->num_rows() > 0){
			foreach($sql_tour->result() as $row_tour){
				$tr.="<tr>
	    				<td style='text-align: left;'>".($k++).".&nbsp;&nbsp;".$row_tour->package_name."</td>
	    				<td style='text-align: center;'>".$row_tour->adult."</td>
	    				<td style='text-align: center;'>".$row_tour->child."</td>
	    				<td style='text-align: center;'><b>".$row_tour->amt_tour."</b></td>
	    			</tr>";

	    		$total_tour+= $row_tour->amt_tour;
	    		$total_adult+=$row_tour->adult;
	    		$total_child+=$row_tour->child;
			}

		}
		$tr_total_tour = '<thead>
								<th>Park/Package</th>
								<th style="text-align: center;">Adult</th>
								<th style="text-align: center;">Child</th>
								<th style="text-align: center;">Total</th>
				    		</thead>
				    		<tbody>
				    			'.$tr.'
				    		</tbody>
				    		<tfoot class="panel-footer">
				    			<tr>
				    				<td style="text-align: right;"><b>Total All Parks</b></td>
				    				<td style="text-align: center;"><b>'.$total_adult.'</b></td>
									<td style="text-align: center;"><b>'.$total_child.'</b></td>
				    				<td style="text-align: center;"><b>'.$total_tour.'</b></td>
				    			</tr>
				    		</tfoot>';
	    // end show total tours ========================================================

	    // show total tours by country =================================================
	    $sql_country = $this->db->query("SELECT
											tt.country,
											tt.vis_typeno,
											tt.is_local,
											Count(*) AS amt_country,
											countries.`name`
											FROM
											tran_ticket AS tt
											INNER JOIN countries ON tt.country = countries.id_countries
											WHERE tt.vis_typeno = 1 {$WHERE_BY_COUNTRY}
											GROUP BY tt.country 
											ORDER BY Count(*) DESC");
		$total_internation = 0;
		$total_local       = 0;
		$tr_internation = "";
		$tr_local       = "";
		$d = 1;
		$p = 1;
		if($sql_country->num_rows() > 0){
			foreach($sql_country->result() as $row_country){
				if($row_country->is_local == 0){
					$tr_internation.="<tr>
					    				<td style='text-align: left;'>&nbsp;&nbsp;&nbsp;&nbsp;".($d++).".&nbsp;&nbsp;".$row_country->name."</td>
					    				<td style='text-align: center;'>".$row_country->amt_country."</td>
					    			</tr>";
		    		$total_internation+= $row_country->amt_country;
		    	}else{
		    		$tr_local.="<tr>
				    				<td style='text-align: left;'>&nbsp;&nbsp;&nbsp;&nbsp;".($p++).".&nbsp;&nbsp;".$row_country->name."</td>
				    				<td style='text-align: center;'>".$row_country->amt_country."</td>
				    			</tr>";
		    		$total_local+= $row_country->amt_country;
		    	}
			}
		}
		$tr_tour_bycountry = '<thead>
					    			<th><b>Foreigner</b></th>
					    			<th style="text-align: center;">Number of Tourist</th>
					    		</thead>
					    		<tbody>

					    			'.$tr_internation.'
					    			<tr>
					    				<td style="text-align: right;"><b>Total Foreigner</b></td>
					    				<td style="text-align: center;"><b>'.$total_internation.'</b></td>
					    			</tr>
					    			<tr>
					    				<td><b>Local</b></td>
					    				<td style="text-align: center;"><b>Number of Tourist</b></td>
					    			</tr>
					    			'.$tr_local.'
					    			<tr>
					    				<td style="text-align: right;"><b>Total Local</b></td>
					    				<td style="text-align: center;"><b>'.$total_local.'</b></td>
					    			</tr>
					    		</tbody>
					    		<tfoot class="panel-footer">
					    			<tr>
					    				<td style="text-align: right;"><b>Total All Countries</b></td>
					    				<td style="text-align: center;"><b>'.($total_internation+$total_local).'</b></td>
					    			</tr>
					    		</tfoot>';
	    // end show tatal tours by country ============================

		header("Content-type:text/x-json");
		$arr['total_tour'] = $tr_total_tour;
		$arr['total_tour_bycountry'] = $tr_tour_bycountry;
		echo json_encode($arr);
	    
		die();
	}
	
}