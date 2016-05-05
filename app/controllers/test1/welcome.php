<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		//$this->load->view('header');
		$this->load->view('test/sample');
		//$this->load->view('footer');		
	}
	public function jqueryUi()
	{
		//$this->load->view('header');
		$this->load->view('test/jquery_ui');
		//$this->load->view('footer');
	}
	function table(){
		$data['page_header']='Table';
		$this->load->view('header',$data);
		$this->load->view('test/table');
		$this->load->view('footer');
	}
	public function dash_bootstrap()
	{
		//$this->load->view('header');
		$this->load->view('test/dash_bootstrap');
		//$this->load->view('footer');
	}
	public function modal()
	{
		//$this->load->view('header');
		$this->load->view('test/modal');
		//$this->load->view('footer');
	}
	public function simdash()
	{
		//$this->load->view('header');
		$this->load->view('test/simdash');
		//$this->load->view('footer');
	}
	public function ajax()
	{
		//$this->load->view('header');
		$this->load->view('test/ajax_respond');
		//$this->load->view('footer');
	}
	/* --- ajax pagination ---- */
	function searchStdAjax(){
		
		$name=(isset($_POST['name']))?$_POST['name']:"";

		$WHERE="";
		if($name!=""){
			$WHERE.=" AND (disease_code like '%".$name."%'
						OR disease like '%".$name."%'	

						)";
		}		

		$sql="SELECT * FROM sch_medi_disease WHERE 1=1 {$WHERE}";
		$total_row=$this->green->getValue("select count(*) as numrow FROM ($sql) as cc ");
		$paging=$this->green->ajax_pagination($total_row,site_url("test/welcome/searchStdAjax"),4);
		$data=$this->green->getTable("$sql limit {$paging['start']}, {$paging['limit']}");

		$arrJson['paging']=$paging;
		$tr="";
		if(count($data)>0){
			foreach ($data as $value) {
				$tr.='<tr>
						<td>'.$value['disease_code'].'</td>
						<td>'.$value['disease'].'</td>
						<td>'.$value['disease'].'</td>
					</tr>';
			}
		}
		$arrJson['datas']=$tr;
		header("Content-type:text/x-json");
		echo json_encode($arrJson);
		exit();
		
	}

	function getAjaxPage(){
		$this->load->view('header');
		$this->load->view('test/ajax_pagination');
		$this->load->view('footer');	
					
	}
	/*---- end of ajax pagination  */
	function temtable(){
		$this->green->create_temp("CREATE TEMPORARY TABLE IF NOT EXISTS tem_vstdpro as SELECT * FROM v_student_profile ");
		print_r($this->green->getTable("SELECT * FROM tem_vstdpro limit 0,100"));
		$this->green->drop_temp("tem_vstdpro");
	} 

	public function autoData()
	{
		//$this->load->view('header');
			
		$result = array("ActionScript",
						"AppleScript",
						"Asp",
						"BASIC",
						"C",
						"C++",
						"Clojure",
						"COBOL",
						"ColdFusion",
						"Erlang",
						"Fortran",
						"Groovy",
						"Haskell",
						"Java",
						"JavaScript",
						"Lisp",
						"Perl",
						"PHP",
						"Python",
						"Ruby",
						"Scala",
						"Scheme");
	         
	     echo json_encode($result);
		//$this->load->view('footer');
	}
	public function autocomplete()
	{
		$this->load->view('header');
		$this->load->view('test/autocomplet');
		$this->load->view('footer');
	}
	
	public function validate()
	{
		$this->load->view('header');
		$this->load->view('test/validate');
		$this->load->view('footer');
	}
	public function import(){
		$this->load->view('header');
		$this->load->view('test/import_excel');
		$this->load->view('footer');
	}
	public function importexcel(){
		
		if (isset($_FILES['file']) && $_FILES['file']["tmp_name"][0]!="") {
			$_xfile = $_FILES['file']["tmp_name"];		
			
			function str($str){
				return str_replace("'","''",$str);
			}
			if($_FILES['file']['tmp_name']==""){
				$error="<font color='red'>Please Choose your Excel file!</font>";
			}
			else{
				$html="";					
				require_once(APPPATH.'libraries/simplexlsx.php' );								
				foreach($_xfile as $index => $value){					
					$xlsx = new SimpleXLSX($value);				
					$_data = $xlsx->rows();					
					array_splice($_data,0,1);
					$error_record_exist="";
					foreach( $_data as $k => $r) {					
						$_check_exist = $this->green->getTable("SELECT * FROM sch_student WHERE studentid = '{$r[0]}'");					
						$seachspance = strpos(trim(str($r[0]))," ");
						if (count($_check_exist)> 0)
						{
							$error_record_exist .='<div class="success" style=" padding:5px; margin-top:5px;">
													<font style="color:red;">Code already exist'.$r[0].' exist aleady !</font><br>
													</div>';					
						}else if($seachspance !== false){
							$error_record_exist .='<div class="success" style=" padding:5px; margin-top:5px;">
												<font style="color:red;">Error Code'.str($r[0]).' is incorrect. Please try again !</font></div>';
						}
						else {
							$counts=$this->green->runSQL("INSERT into sch_student set 
															studentid='".trim(str($r[0]))."'");									
							$html='<div class="success" style="padding:5px;">Successful!</div>';
						}					
					}
				}				
			}
		}
	}	


	function getScoreRank($transno,$studentid){
		
		$this->green->runSQL("SET @rnk=0");
		$this->green->runSQL("SET @rank=0");
		$this->green->runSQL("SET @curscore=0");
		$sql="SELECT type,transno,studentid,totalscore,rank FROM
		    (
		        SELECT TRANKS.*,
							TRERANK.studentid,
							TRERANK.type,TRERANK.transno,
						 (@rnk:=@rnk+1) rnk,
						(@rank:=IF(@curscore=totalscore,@rank,@rnk)) rank,
						(@curscore:=totalscore) newscore
		        FROM
		       (
		            SELECT * FROM
		            (SELECT COUNT(1) scorecount,v_total_score.totalscore
		            FROM v_total_score GROUP BY totalscore
		        ) CS
		        ORDER BY totalscore DESC
		     ) TRANKS LEFT JOIN v_total_score TRERANK USING (totalscore)) A";
		$data=$this->green->getTable($sql);
		
		/*$tr="";

		foreach ($data as $value) {
			$tr.="<tr>
						<td>".$value['studentid']."</td>
						<td>".$value['totalscore']."</td>
						<td>".$value['rank']."</td>						
					</tr>";
		}
		echo "<table class='table' border='1'>
				$tr
			</table>";*/
	}

    function ajaxScroll(){
        $this->load->view('header');
        $this->load->view('test/ajax_scroll');
        $this->load->view('footer');
    }
    function ajaxScrollData()
    {
        // item per page
        $limit = 5;
        $page = (int)(!isset($_GET['p'])) ? 1 : $_GET['p'];

        // sql query
        $sql = "SELECT * FROM sch_student ORDER BY studentid DESC";

        // find out query stat point
        $start = ($page * $limit) - $limit;

        // query for page navigation
        if (count($this->green->getTable($sql)) > ($page * $limit)) {
            $next = ++$page;
        }

        $data = $this->green->getTable($sql . " LIMIT {$start}, {$limit}");
        if (count($data) == 0) {
            echo 'Page not found!';
            exit();
        }


        //<!-- loop row data -->

        foreach ($data as $row) {
            echo '<div class="item" id="item-' . $row['studentid'] . '">
                    <h2>' . $row['student_num'] . '</h2>
                    <p>' . $row['first_name'] . '</p>
                </div>';

            //<!--page navigation-->
            if (isset($next)) {
                echo '<div class="nav">
                    <a href="' . base_url('test/welcome/ajaxScrollData') . '?p=' . $next . '">Next</a>
                </div>';
            }

        }
    }
	function qrcode(){
		//echo APPPATH."sf";
		echo "<h1>PHP QR Code</h1><hr/>";

		//set it to writable location, a place for temp generated PNG files
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

		//html PNG location prefix
		$PNG_WEB_DIR = base_url('app/controllers/test1/temp/');

		include APPPATH."libraries/qrcode/qrlib.php";

		//ofcourse we need rights to create temp dir
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);

		$filename = $PNG_TEMP_DIR.'/test22.png';

		//processing form input
		//remember to sanitize user input in real-life solution !!!
		$errorCorrectionLevel = 'L';
		if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
			$errorCorrectionLevel = $_REQUEST['level'];

		$matrixPointSize = 4;
		if (isset($_REQUEST['size']))
			$matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


		if (isset($_REQUEST['data'])) {
			//it's very important!
			if (trim($_REQUEST['data']) == '')
				die('data cannot be empty! <a href="?">back</a>');

			// user data
			$filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
			QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);

		} else {

			//default data
			echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';
			QRcode::png('your code here', $filename, $errorCorrectionLevel, $matrixPointSize, 2);

		}
		//display generated file
		echo '<img src="'.$PNG_WEB_DIR.'/'.basename($filename).'" /><hr/>';

		//config form
		echo '<form action="'.site_url('test1/welcome/qrcode').'" method="post">
        Data:&nbsp;<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp;
        ECC:&nbsp;<select name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
        </select>&nbsp;
        Size:&nbsp;<select name="size">';

		for($i=1;$i<=10;$i++)
			echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';

		echo '</select>&nbsp;
        <input type="submit" value="GENERATE"></form><hr/>';

		// benchmark
		QRtools::timeBenchmark();

	}
	function screenprop(){
		$this->load->view('header');
        $this->load->view('test/screenprop');
        $this->load->view('footer');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */