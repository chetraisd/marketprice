<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_qrcode extends CI_Controller {
	
	function qrcode_test(){

		// 	//echo APPPATH."sf";
		// //echo "<h1>PHP QR Code</h1><hr/>";

		// //set it to writable location, a place for temp generated PNG files
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
		echo $PNG_TEMP_DIR;
		// //html PNG location prefix
		

		include APPPATH."libraries/qrcode/qrlib.php";
		$filename = $PNG_TEMP_DIR.'/test9999.png';
		QRcode::png("kfhghhwerrwrwrwrwrrwerrww", $filename, "L", 4, 4);
		$PNG_WEB_DIR = base_url('app/controllers/test1/temp/');
		echo "<img src='".$PNG_WEB_DIR."/".basename($filename)."'>";

		// //ofcourse we need rights to create temp dir
		// if (!file_exists($PNG_TEMP_DIR))
		// 	mkdir($PNG_TEMP_DIR);

		// $filename = $PNG_TEMP_DIR.'/test111.png';

		// //processing form input
		// //remember to sanitize user input in real-life solution !!!
		// $errorCorrectionLevel = 'L';
		// if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
		// 	$errorCorrectionLevel = $_REQUEST['level'];

		// $matrixPointSize = 1;
		// if (isset($_REQUEST['size']))
		// 	$matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


		// if (isset($_REQUEST['data'])) {
		// 	//it's very important!
		// 	if (trim($_REQUEST['data']) == '')
		// 		die('data cannot be empty! <a href="?">back</a>');

		// 	// user data
		// 	$filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
		// 	QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);

		// } else {

		// 	//default data
		// 	echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';
		// 	//QRcode::png('your code here', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		// 	QRcode::png('your code here', $filename, 'H', $matrixPointSize, 2);
		// }
		// //display generated file
		// echo '<img src="'.$PNG_WEB_DIR.'/'.basename($filename).'" /><hr/>';

		//config form

		// echo '<form action="'.site_url('test1/welcome/qrcode').'" method="post">
		// 		        Data:&nbsp;<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp;
		// 		        ECC:&nbsp;<select name="level">
		// 		            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
		// 		            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
		// 		            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
		// 		            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
		// 		        </select>&nbsp;
		// 		        Size:&nbsp;<select name="size">';

		// for($i=1;$i<=10;$i++)
		// 	echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';

		// echo '</select>&nbsp;
  //       <input type="submit" value="GENERATE"></form><hr/>';

		// benchmark
		//QRtools::timeBenchmark();

	}
}