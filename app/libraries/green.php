<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Green
{

    public $roleid;
    public $roleinfor;
    public $moduleids;
    public $moduleinfos;
    public $pageids;
    public $pageinfos;

    public $active_role;
    public $active_module;
    public $active_page;
    public $active_user;
    public $totaluser;    

    public function runSQL($sql)
    {
        $ci =& get_instance();
        $query = $ci->db->query($sql);
        return $query;
    }

    public function getTable($sql)
    {
        $arrDatas = array();

        $query = $this->runSQL($sql);
        foreach ($query->result_array() as $row) {
            $arrDatas[] = $row;
        }
        return $arrDatas;
    }

    public function getOneRow($sql)
    {
        $row = $this->runSQL($sql)->row_array();
        return $row;
    }

    public function getValue($sql)
    {
        $row = $this->runSQL($sql)->row_array();
        $num_arr = array_values($row);
        return isset($num_arr[0]) ? $num_arr[0] : "";
    }

    public function getTotalRow($sql)
    {
        $row = $this->runSQL($sql)->num_rows();
        return $row;
    }

    public function getFieldName($sql)
    {
        $query = $this->runSQL($sql)->list_fields();
        return $query;
    }

    public function create_temp($sql)
    {
        return $this->runSQL($sql);
    }

    public function drop_temp($tem_name)
    {
        $ci =& get_instance();
        $query = $this->runSQL("DROP TEMPORARY TABLE IF EXISTS $tem_name");
    }

    public function gictEnc($str)
    {
        $ci =& get_instance();
        $key = $ci->config->item('encryption_key');
        return $ci->encrypt->encode($str, $key);
    }

    public function gictDec($str)
    {
        $ci =& get_instance();
        $key = $ci->config->item('encryption_key');
        return $ci->encrypt->decode($str, $key);
    }

    public function goToPage($page)
    {
        redirect($page, 'refresh');
    }

    public function clearSession()
    {
        $ci =& get_instance();
        foreach (array_keys($ci->session->userdata) as $key) {
            $ci->session->unset_userdata($key);
        }
    }

    public function exportToXls($data, $fileName = "Sheet")
    {
        header('ETag: etagforie7download'); //IE7 requires this header
        header('Content-type: application/octet_stream');
        header('Content-disposition: attachment;filename="' . $fileName . ' ' . date('Y-m-d') . '.xls');
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        echo $data;
        die();
    }


    public function myUpload($file, $new_name, $is_thumb = 0)
    {
        $ci =& get_instance();
        //================================ upload image ============================
        $path = $ci->config->item('image_upload_path') . "/Promotions";
        $sqlcheck = "SELECT * FROM folder where foldername='Promotions' and folderpath='" . $path . "'";
        $folder_check = $ci->db->query($sqlcheck);
        if ($folder_check->num_rows() <= 0) {
            $sqlinsert = "INSERT INTO folder SET  foldername='Promotions',folderpath='" . $path . "'";
            $ci->db->query($sqlinsert);
            mkdir($path, 0777);
        }
        //============= Checking File To Upload ==============================
        if (isset($_FILES[$file]) AND $_FILES[$file]['name'] != '') {
            $AllowType = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/bmp");
            $result = $_FILES[$file]['error'];
            $UploadTheFile = 'Yes';
            $filename = $path . '/' . $new_name;
            if ($_FILES[$file]['size'] > $ci->config->item('max_size_upload') * 1024) {
                $UploadTheFile = 'No';
                echo 'size';
            } elseif (!(in_array($_FILES[$file]['type'], $AllowType))) {
                $UploadTheFile = 'No';
                echo 'Type';
            } elseif (file_exists($filename)) {
                $result = unlink($filename);
                if (!$result) {
                    $UploadTheFile = 'No';
                }
            }
            if ($UploadTheFile == 'Yes') {
                $result = move_uploaded_file($_FILES[$file]['tmp_name'], $filename);
            }
        }
        if ($is_thumb == 1) {
            createThumbImg($new_name);
        }

    }

    public function createThumbImg($source_image, $height = 70, $width = 60)
    {
        $ci =& get_instance();
        #============= Create Thumb Image ============
        $path = $ci->config->item('image_upload_path') . "/Promotions";
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path . '/' . $source_image;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
        $config['height'] = $height;

        #$config['new_image'] = $path.'/'.$filename;

        $ci->load->library('image_lib', $config);
        $ci->image_lib->initialize($config);
        $ci->image_lib->resize();

        if (!$ci->image_lib->resize()) {
            echo $ci->image_lib->display_errors();
        }
    }

    public function getCombo($source = "", $key = "", $display = "", $sql = "")
    {
        #==== $source=tablename,$key=idfield,display=field for show
        $result = array();
        if ($sql == "") {
            $data = $this->getTable("SELECT `{$key}`,`{$display}` FROM `{$source}` ORDER BY `{$display}`");
        } else {
            $data = $this->getTable($sql);
        }
        if (count($data) > 0) {
            foreach ($data as $rkey => $rval) {
                $result[$rkey] = $rval;
            }
        }
        return $result;
    }


    public function getModule($roleid)
    {

        $this->roleinfor = $this->getOneRow("SELECT
													sch_z_role.roleid,
													sch_z_role.role,
													sch_z_role.is_admin
												FROM
													sch_z_role
												WHERE
													is_active = 1
												AND roleid = '" . $roleid . "'
											");

        $where = " WHERE roleid = '" . $roleid . "'";
        if ($roleid == 1) {
            $where = "";
        }
        $arrModules = $this->getTable("SELECT
                                            DISTINCT
                                            rolmod.moduleid
                                        FROM
                                            sch_z_role_module_detail as rolmod
                                            INNER JOIN sch_z_module zmod ON zmod.moduleid=rolmod.moduleid
                                        {$where}
                                        ORDER BY zmod.`order`
										");
        $this->moduleids = $arrModules;
        $this->roleid = $this->roleinfor['roleid'];

    }

    public function getModuleInfo($moduleid)
    {

        $where = " AND moduleid = '" . $moduleid . "'";

        $arrModule = $this->getOneRow("SELECT
											sch_z_module.moduleid,
											sch_z_module.module_name,
											sch_z_module.sort_mod,
											sch_z_module.mod_position,
											sch_z_module.icon
											FROM
											sch_z_module											
											WHERE
												is_active = 1

											{$where}
											ORDER BY `order`;
										");
        return $arrModule;
    }

    public function getRolePage($moduleid)
    {
        $where = "";
        if ($this->roleid == 1) {
            $where .= " AND moduleid = '" . $moduleid . "'";

            $arrPages = $this->getTable("SELECT
											page.pageid,
											page.page_name,
											page.link,
											page.moduleid,
											page.`order`,
											page.is_insert,
											page.is_update,
											page.is_delete,
											page.is_show as is_read,
											page.is_print,
											page.is_export,
											page.created_by,
											page.created_date
										FROM
											sch_z_page AS page
										WHERE
											is_active = 1											
										{$where}										
										ORDER BY moduleid,`order`																				
									");
        } else {
            $where .= " AND rolepage.roleid = '" . $this->roleid . "'";
            $where .= " AND page.moduleid = '" . $moduleid . "'";

            $arrPages = $this->getTable("SELECT
                                            rolepage.pageid,
                                            rolepage.moduleid,
                                            rolepage.roleid,
                                            rolepage.is_read,
                                            rolepage.is_insert,
                                            rolepage.is_delete,
                                            rolepage.is_update,
                                            rolepage.is_print,
                                            rolepage.is_export,
                                            rolepage.is_import
                                        FROM
                                            sch_z_role_page as rolepage 
                                        INNER JOIN sch_z_page page ON page.pageid=rolepage.pageid                           
                                        WHERE
                                            1 = 1
                                        {$where}    
                                        ORDER BY page.moduleid,page.`order` 										
									");
        }

        $this->pageids = $arrPages;

    }

    public function getPageInfo($pageid)
    {
        $where = " AND pageid = '" . $pageid . "'";
        $arrPages = $this->getOneRow("SELECT
											page.pageid,
											page.page_name,
											page.link,
											page.moduleid,
											page.`order`,
											page.is_insert,
											page.is_update,
											page.is_delete,
											page.is_show,
											page.is_print,
											page.is_export,
											page.created_by,
											page.created_date,
											page.icon,
											page.route_url
										FROM
											sch_z_page AS page
										WHERE
											is_active = 1											
										{$where}
										ORDER BY moduleid,`order`										
									");
        $this->pageinfos = $arrPages;
    }

    function setActiveRole($role)
    {
        $this->active_role = $role;
    }

    function getActiveRole()
    {
        return $this->active_role;
    }

    function setActiveModule($module)
    {
        $this->active_module = $module;
    }

    function getActiveModule()
    {
        return $this->active_module;
    }

    function setActivePage($page)
    {
        $this->active_page = $page;
    }

    function getActivePage()
    {
        return $this->active_page;
    }

    function setActiveUser($user)
    {
        $this->active_user = $user;
    }

    function getActiveUser()
    {
        return $this->active_user;
    }

    public function gAction($action)
    {
        $arrAct = array('C' => 'is_insert',
            'D' => 'is_delete',
            'U' => 'is_update',
            'R' => 'is_read',
            'E' => 'is_export',
            'P' => 'is_print',
            'I' => 'is_import'
        );

        $sqlAction = "SELECT " . $arrAct[$action] . "
							FROM sch_z_role_page 
							WHERE roleid='" . $this->getActiveRole() . "'
							AND moduleid='" . $this->getActiveModule() . "'
							AND pageid='" . $this->getActivePage() . "'";

        $res = $this->getValue($sqlAction) - 0;

        if ($res == 1 || $this->getActiveRole() == 1) {
            return true;
        } else {
            return false;
        }


    }

    public function displayDate($date)
    {
        $date = date_create($date);
        return date_format($date, "d-m-Y");
    }    

    function getEmpInf($empid)
    {
        if ($empid != "") {
            return $this->getOneRow("SELECT empcode,last_name,first_name,last_name_kh,first_name_kh FROM sch_emp_profile WHERE empid='" . $empid . "'");
        }
    }

    function getEmpID($empcode)
    {
        $empid = '';
        if ($empcode != "") {
            $data = $this->getTable("SELECT empid FROM sch_emp_profile WHERE empcode like '" . $empcode . "%'");
            if (count($data) > 0) {
                foreach ($data as $row) {
                    $empid .= $row['empid'] . ',';
                }
                $empid = trim($empid, ",");
            }
        }
        return $empid;
    }

    function getStatusOp($isblank, $selected, $isYesNo)
    {
        $opStat = "";
        if ($isblank == 1) {
            //$opStat.="<option value=''></option>";
        }

        if ($isYesNo == 1) {
            $active = "Yes";
            $inactive = "No";
        } else {
            $active = "Active";
            $inactive = "Inactive";
        }

        $opStat .= "<option value='1' " . ($selected == 1 ? 'selected="selected"' : '') . ">" . $active . "</option>";
        $opStat .= "<option value='0' " . ($selected == 0 ? 'selected=selected' : '') . ">" . $inactive . "</option>";
        echo $opStat;
    }

    function gOption($arr, $selected)
    {
        if (count($arr) > 0) {
            $op = "";
            foreach ($arr as $key => $value) {
                $op .= "<option value='" . $key . "' " . ($key == $selected ? "selected" : "") . ">$value</option>";
            }
        }
        return $op;
    }

    function formatSQLDate($date)
    {
        if ($date != "") {
            if (strpos($date, "-") !== false) {
                $datepart = explode("-", $date);
            } else if (strpos($date, ".") !== false) {
                $datepart = explode(".", $date);
            } else {
                $datepart = explode("/", $date);
            }
            return $datepart[2] . '-' . $datepart[1] . '-' . $datepart[0];
        } else {
            return "";
        }
    }
    

    function nextTran($typeid, $type)
    {
        date_default_timezone_set("Asia/Bangkok");
        $ci =& get_instance();        
        // $transno=nextTran("14","Time Table");
        $last_seq = $this->getValue("SELECT typeno FROM set_z_systype WHERE sys_typeid='" . $typeid . "'");
        if ($last_seq == 0) {
            $this->runSQL("UPDATE set_z_systype SET typeno = 1 WHERE typename = '" . $type . "' AND sys_typeid='" . $typeid . "'");
            $last_seq = 1;
        }else{
            $this->runSQL("UPDATE set_z_systype SET typeno = $last_seq + 1 WHERE sys_typeid = '" . $typeid . "'");
        }       
        $userid = $ci->session->userdata('userid');
        $datetime = date('y').date('m').date('d').date('H').date('i').date('s');        
        return ($userid.$datetime.($last_seq + 1));
    }
    function nextTrans($typeid, $type)
    {
        $ci =& get_instance(); 
        $userid = $ci->session->userdata('userid');
        //$transno=nextTran("14","Time Table");
        $last_seq = $this->getValue("SELECT typeno FROM set_z_systype WHERE sys_typeid='" . $typeid . "'");
        if ($last_seq == "") {
            $this->runSQL("INSERT INTO set_z_systype SET typeno=1,typename='" . $type . "',sys_typeid='" . $typeid . "'");
            $last_seq = 1;
        }
        $this->runSQL("UPDATE set_z_systype SET typeno=typeno+1 WHERE sys_typeid='" . $typeid . "'");

        return ($userid."".date("ymdhis")."".$last_seq);
    }

     function nextTransParks($typeid, $type,$locationid)
    {
          $ci =& get_instance(); 
        $userid = $ci->session->userdata('userid');
        //$transno=nextTran("14","Time Table");
        $last_seq = $this->getValue("SELECT typeno FROM set_z_systype WHERE sys_typeid='" . $typeid . "'");
        if ($last_seq == "") {
            $this->runSQL("INSERT INTO set_z_systype SET typeno=1,typename='" . $type . "',sys_typeid='" . $typeid . "'");
            $last_seq = 1;
        }
        $this->runSQL("UPDATE set_z_systype SET typeno=typeno+1 WHERE sys_typeid='" . $typeid . "'");

        return ($userid."".$locationid."".$last_seq);
    }
    
    function nextTransLocations($typeid, $type)
    {
        $ci =& get_instance(); 
        $userid = $ci->session->userdata('userid');
        //$transno=nextTran("14","Time Table");
       $last_seq = $this->getValue("SELECT typeno FROM set_z_systype WHERE sys_typeid='" . $typeid . "'");
        if ($last_seq == "") {
            $this->runSQL("INSERT INTO set_z_systype SET typeno=1,typename='" . $type . "',sys_typeid='" . $typeid . "'");
            $last_seq = 1;
        }
        $this->runSQL("UPDATE set_z_systype SET typeno=typeno+1 WHERE sys_typeid='" . $typeid . "'");

        return ($userid."".$last_seq);
    }
    function nextTransApproval($typeid, $type)
    { 

        //$transno = $this->green->nextTransApproval("22","agency_trans_type");

        $ci =& get_instance(); 
        $userid = $ci->session->userdata('userid');
       
        $last_seq = $this->getValue("SELECT typeno FROM set_z_systype WHERE sys_typeid='" . $typeid . "'");
        if ($last_seq == "") {
            $this->runSQL("INSERT INTO set_z_systype SET typeno=1,typename='" . $type . "',sys_typeid='" . $typeid . "'");
            $last_seq = 1;
        }
        $this->runSQL("UPDATE set_z_systype SET typeno=typeno+1 WHERE sys_typeid='" . $typeid . "'");        
        return ($userid."".str_pad($last_seq,'4','0',STR_PAD_LEFT));
    }
    function nextTransTicketnumber($typeid, $type, $parkid)

    {
        //$transno=nextTransTicketnumber("24","ticketnumber",$parkid);
        date_default_timezone_set("Asia/Bangkok");
        $ci =& get_instance();        
        // $transno=nextTran("14","Time Table");
        $last_seq_park = $this->getValue("SELECT typeno FROM set_z_systype WHERE sys_typeid='" . $typeid . "'");
        if ($last_seq_park == 0) {
            $this->runSQL("UPDATE set_z_systype SET typeno = 1 WHERE typename = '" . $type . "' AND sys_typeid='" . $typeid . "'");
            $last_seq_park = 1;
        }else{
            $this->runSQL("UPDATE set_z_systype SET typeno = $last_seq_park + 1 WHERE sys_typeid = '" . $typeid . "'");

        }
        
        $prefix = "";
        $symbool = "";
        $sequence = "";
        $length = "";      
        $years = "";
        $userid = "";

        if($parkid !=""){
            $date = date("Y");
            $dates = date("y");
            $row_pre = $this->getOneRow("SELECT pre_typeno,
                                            sequence, 
                                            years, 
                                            sample, 
                                            simbool, 
                                            prefix,
                                            length,
                                            create_date,
                                            create_by,
                                            modify_by,
                                            modify_date
                                        FROM z_setup_prefix 
                                        WHERE package_typeno='".$parkid."' AND status=1");
            if(count($row_pre)>0){
                $last_seq = $row_pre["sequence"];

                if($row_pre["years"] != $date){
                    $pre_id = $this->nextTran(12, 'pre_type');                              
                    $data = $this->runSQL("INSERT INTO z_setup_prefix  SET 
                                        pre_typeno='".$pre_id."',
                                        pre_type ='12',
                                        package_typeno ='".$parkid."',           
                                        sequence='1', 
                                        sys_typeid='24',      
                                        years='".$date."', 
                                        sample='".$row_pre["prefix"].$dates.$row_pre["simbool"].str_pad('1',$row_pre["length"],'0',STR_PAD_LEFT)."', 
                                        simbool='".$row_pre["simbool"]."', 
                                        prefix='".$row_pre["prefix"]."',
                                        length='".$row_pre["length"]."',
                                        create_by ='".$row_pre["create_by"]."',
                                        create_date='".$row_pre["create_date"]."',
                                        modify_by='".$row_pre["modify_by"]."',
                                        modify_date='".$row_pre["modify_date"]."'");

                     $this->runSQL("UPDATE z_setup_prefix SET status = 0 WHERE pre_typeno = '" .$row_pre["pre_typeno"] . "'");       
                }else{
                    if($row_pre["sequence"] ==0){                
                         $this->runSQL("UPDATE z_setup_prefix SET sequence = 1 WHERE package_typeno = '" . $parkid . "' AND status=1");
                    }else{
                         $this->runSQL("UPDATE z_setup_prefix SET sequence = $last_seq + 1 WHERE package_typeno = '" . $parkid . "' AND status=1");               
                    } 
                }
           
            $row_tick = $this->getOneRow("SELECT
                                                z_setup_prefix.prefix,
                                                z_setup_prefix.length,
                                                z_setup_prefix.simbool,
                                                z_setup_prefix.sequence,
                                                z_setup_prefix.years
                                            FROM
                                                z_setup_prefix 
                                            WHERE z_setup_prefix.package_typeno ='".$parkid."'");
      
                $prefix = $row_tick["prefix"];
                $symbool = $row_tick["simbool"];
                $sequence = $row_tick["sequence"];
                $length = $row_tick["length"];      
                $years = date('y', strtotime($row_tick["years"]));
                $userid = $ci->session->userdata('userid');  
            }
        }
        return($prefix.$years.$symbool.str_pad($sequence,$length,'0',STR_PAD_LEFT));

    }
    function nextTransTicket($typeid, $type, $parkid)
    {
        //$transno= $this->green->nextTransTicket("1","ticket_type",$parkid);
        date_default_timezone_set("Asia/Bangkok");
        $ci =& get_instance();        
        // $transno=nextTran("14","Time Table");
        $last_seq_park = $this->getValue("SELECT typeno FROM set_z_systype WHERE sys_typeid='" . $typeid . "'");
        if ($last_seq_park == 0) {
            $this->runSQL("UPDATE set_z_systype SET typeno = 1 WHERE typename = '" . $type . "' AND sys_typeid='" . $typeid . "'");
            $last_seq_park = 1;
        }else{
            $this->runSQL("UPDATE set_z_systype SET typeno = $last_seq_park + 1 WHERE sys_typeid = '" . $typeid . "'");
        }       
        $userid = $ci->session->userdata('userid');
        $datetime = date('y').date('m').date('d').date('H').date('i').date('s');        
        return ($userid.$parkid.$datetime.($last_seq_park + 1));
        //return $this->getActiveUser()."".$parkid."".date("ymdhis")."".$last_seq;
    }
 function nextTransAppTicket($typeid, $type)

    {
        //$transno=nextTransAppTicket("3","app_type");
        date_default_timezone_set("Asia/Bangkok");
        $ci =& get_instance();
        
        $last_seq_park = $this->getValue("SELECT typeno FROM set_z_systype WHERE sys_typeid='" . $typeid . "'");
        if ($last_seq_park == 0) {
            $this->runSQL("UPDATE set_z_systype SET typeno = 1 WHERE typename = '" . $type . "' AND sys_typeid='" . $typeid . "'");
            $last_seq_park = 1;
        }else{
            $this->runSQL("UPDATE set_z_systype SET typeno = $last_seq_park + 1 WHERE sys_typeid = '" . $typeid . "'");
        }       
        $userid = $ci->session->userdata('userid');
        $datetime = date('y').date('m').date('d').date('H').date('i').date('s');        
        return ($userid.$datetime.($last_seq_park + 1));
        //return $this->getActiveUser()."".$parkid."".date("ymdhis")."".$last_seq;
    }
 function ajax_pagination($total_row, $url, $limit = 5)
    {
        //$limit=10; //********** Number for select from DB **********
        $start = 0; //********** Number for start select from DB **********
        $adjacents = 2;

        if (isset($_POST["page"])) {
            $page = $_POST["page"];
        } else {
            $page = 1;
        }

        if ($page != 0)
            $start = ($page - 1) * $limit;
        else
            $start = 0;

        $total_pages = $total_row;

        if ($page == 0) $page = 1;
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($total_pages / $limit);
        $lpm1 = $lastpage - 1;

        //=========================================================================
        $pagination = "";
        $pagination .= "<div class=\"pagination-links clear\"><ul class='pagination'><li>";
        if ($lastpage > 1) {
            if ($page > 1)
                $pagination .= "<a class=\"pagenav\" id='1' href='javascript:void(0)' id=1><span class='fa fa-fast-backward'></span></a>
									<a class=\"pagenav\" href='javascript:void(0)' id='$prev'><span class='fa fa-backward'></span></a>";
            else
                $pagination .= "<span class='fa fa-fast-backward'></span>
									<span class='fa fa-backward'></span>";
            if ($lastpage < 2 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span class=\"pagenav\">$counter</span>";
                    else
                        $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id='$counter'>$counter</a>";
                }
            } elseif ($lastpage >= ($adjacents * 2))    //enough pages to hide some
            {
                //close to beginning; only hide later pages

                if ($page <= 2 + ($adjacents) && $page >= $lastpage - $adjacents - 1) {

                    for ($counter = 1; $counter < $page - 1 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<span class=\"pagenav\">$counter</span>";
                        else
                            $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id='$counter'>$counter</a>";
                    }
                    $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id='$lastpage'>$lastpage</a>";
                } //in middle; hide some front and some back
                elseif ($page <= 2 + ($adjacents) && $page < $lastpage - $adjacents - 1) {
                    if ($page < 4) {
                        $page_ = 3;
                    } else {
                        $page_ = $page;
                    }
                    for ($counter = 1; $counter <= $page_ + ($adjacents); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<span class=\"pagenav\">$counter</span>";
                        else
                            $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id='$counter'>$counter</a>";
                    }
                    $pagination .= "<a href='javascript:void(0)'>...</a>";
                    $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id='$lastpage'>$lastpage</a>";
                } elseif ($page > 2 + ($adjacents) && $page >= $lastpage - $adjacents - 1) {
                    $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id=1>1</a>";
                    $pagination .= "<a href='javascript:void(0)'>...</a>";
                    if ($page > $lastpage - 3) {
                        $page_ = $lastpage - 4;
                    } else {
                        $page_ = $page - 2;
                    }
                    for ($counter = $page_; $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<span class=\"pagenav\">$counter</span>";
                        else
                            $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id='$counter'>$counter</a>";
                    }
                } elseif ($page > 2 + ($adjacents) && $page < $lastpage - $adjacents - 1) {
                    $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id=1>1</a>";
                    $pagination .= "<a href='javascript:void(0)'>...</a>";
                    for ($counter = $page - 2; $counter < $page - 1 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<span class=\"pagenav\">$counter</span>";
                        else
                            $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id='$counter'>$counter</a>";
                    }
                    $pagination .= "<a href='javascript:void(0)'>...</a>";
                    $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id='$lastpage'>$lastpage</a>";
                }
                //close to end; only hide early pages
            }
            if ($page < $counter - 1)
                $pagination .= "<a class=\"pagenav\" href='javascript:void(0)' id='$next'><span class='fa fa-forward'></span></a>
									<a class=\"pagenav\" href='javascript:void(0)' id='$lastpage'><span class='fa fa-fast-forward'></span></a>";
            else
                $pagination .= "<span class='fa fa-forward'></span>
									<span class='fa fa-fast-forward'></span>";

        } else
            $pagination .= "&nbsp;";
        $pagination .= "</li></ul></div>";
        $arr_pag = array();
        $arr_pag['start'] = $start;
        $arr_pag['limit'] = $limit;
        $arr_pag['pagination'] = $pagination;
        return $arr_pag;
    }

    // ------------------------------------ start long tha working---------------------------------------
    function set_montly_permission($y, $m, $n)
    {
        $this->num_perm = $this->getValue("SELECT
													COUNT(*)
												FROM
													(
														SELECT
															studentid,
															COUNT(*) AS num_perm
														FROM
															sch_student_permission att
														WHERE
															MONTH (att.to_date) = '" . $m . "'
														AND yearid = '" . $y . "'
														AND permis_status = 0
														GROUP BY
															studentid
														HAVING
															num_perm >= '" . $n . "'
													) AS tt;
											") - 0;
    }

    function get_montly_permission()
    {
        if ($this->num_perm > 1) {
            return $this->num_perm . " Students";
        } else {
            return $this->num_perm . " Student";
        }
    }

    function set_yearly_permission($y, $n)
    {
        $this->re_perm = $this->getValue("SELECT
													COUNT(*)
												FROM
													(
														SELECT
																COUNT(*) AS num_perm
															FROM
																sch_student_permission att
															WHERE
																yearid = '" . $y . "'
															AND permis_status = 0
															GROUP BY
																studentid
															HAVING
																num_perm >= '" . $n . "'
													) ssh
												") - 0;
    }

    function get_yearly_permission()
    {
        if ($this->re_perm > 1) {
            return $this->re_perm . " Students";
        } else {
            return $this->re_perm . " Student";
        }
    }

    function set_montly_permission_bigger_one($y, $m, $n)
    {
        $this->val_perm = $this->getValue("SELECT
													COUNT(*) as num_perm
												FROM
													(
														SELECT
															studentid,
															COUNT(studentid) AS num_per
														FROM
															sch_student_permission att
														WHERE
															yearid = '" . $y . "'
														AND MONTH (att.to_date) = '" . $m . "'
														AND DATEDIFF(to_date, from_date) + 1 >= '" . $n . "'
														GROUP BY
															studentid
													) scov
												") - 0;
    }

    function get_montly_permission_bigger_one()
    {
        if ($this->val_perm > 1) {
            return $this->val_perm . " Students";
        } else {
            return $this->val_perm . " Student";
        }
    }

    public function GetYear($setyear)
    {
        return $this->getValue("SELECT
									ssy.sch_year
								FROM
									sch_school_year ssy
								WHERE
									ssy.yearid = '" . $setyear . "'
							");
    }

    public function set_messages($userId = '')
    {       
        if ($userId != "admin") {

            $this->totaluser = $this->getValue("SELECT
														COUNT(schm.user_name) AS totaluser
													FROM
														sch_message schm
													WHERE 1=1
													AND schm.user_name = '" . $userId . "'
													OR	schm.sent_from = '" . $userId . "'
													OR schm.sent_to = '" . $userId . "'

												");
        } else {
            $this->totaluser = $this->getValue("SELECT
															COUNT(*) AS totaluser
														FROM
															sch_message schm
														WHERE 1=1");
													
        }
    }

    public function get_messages()
    {
        if ($this->totaluser > 0) {
            return $this->totaluser;
        }
    }

    public function user_access_park($is_cambo){ 
        // (1:0)//$is_cambo =1 for <select> and $is_cambo =0;
        ///////////////////////////  CALL  /////////////////////////////
        // echo $this->green->user_access_park(1);
        //    
        // foreach ($this->green->user_access_park(0) as $row_park) {
        //      echo  $row_park["par_typeno"].$row_park["park_name"];
        // } 
        ////////////////////////////////////////////////////////////////
        
        $ci =& get_instance();
        $userid = $ci->session->userdata('userid');
        $is_admin=$this->getValue("SELECT sch_user.is_admin FROM sch_user WHERE sch_user.userid ='".$userid."'");
        
        $userpark ="";
        if($userid !=""){
            $results=$this->getTable("SELECT sch_user_detail.par_typeno FROM sch_user_detail WHERE sch_user_detail.userid='".$userid."'");            
            if(count($results)>0){
                foreach ($results as $row) {
                    $userpark .= "'".$row["par_typeno"]."',";
                }
            }
        }
        $val_park = $userpark."''";

        //$where_user_park=$this->userSetPark($userid);
        
        if($is_admin !="1"){
            
            // $allpark=$this->getTable("SELECT * 
            //                         FROM set_park 
            //                         WHERE set_park.par_typeno in(".$val_park.") AND is_active=1
            //                         ORDER BY park_name ASC ");

            $allpark=$this->getTable("SELECT * 
                                    FROM set_park_package 
                                    WHERE set_park_package.package_typeno in(".$val_park.") AND is_active=1
                                    ORDER BY set_park_package.`order` ASC ");       
            
            $val_parks="";        
            if(count($allpark)>0){
                if($is_cambo==1){
                    foreach ($allpark as $row) {
                        $val_parks .='<option value="'.$row["package_typeno"].'">'.$row["package_name"].'</option>';               
                    }
                }
                if($is_cambo==0){
                    $val_parks = $allpark;
                }
            }           
           // return $val_parks;
        }else{
            $allpark=$this->getTable("SELECT * 
                                    FROM set_park_package
                                    WHERE is_active=1
                                    ORDER BY set_park_package.`order` ASC ");
                   
            $val_parks='<option value=""></option>'; 
            if(count($allpark)>0){
                if($is_cambo==1){
                    foreach ($allpark as $row) {
                        $val_parks .='<option value="'.$row["package_typeno"].'">'.$row["package_name"].'</option>';               
                    }
                }
                if($is_cambo==0){
                    $val_parks = $allpark;
                }
            }          
             
        }
        return $val_parks;   
    }
    public function user_access_gate($is_cambo){
         // (1:0)//$is_cambo =1 for <select> and $is_cambo =0;
        ///////////////////////////  CALL  /////////////////////////////
        // echo $this->green->user_access_gate(1);
        //    
        // foreach ($this->green->user_access_gate(0) as $row_park) {
        //      echo  $row_park["gat_typeno"].$row_park["gat_name"];
        // } 
        ////////////////////////////////////////////////////////////////
        $ci =& get_instance();
        $userid = $ci->session->userdata('userid');       
        $gate_row=$this->getOneRow("SELECT 
                                    sch_user.gat_typeno,
                                    sch_user.is_admin
                                FROM sch_user 
                                WHERE sch_user.userid ='".$userid."'");
      
        $is_admin = $gate_row["is_admin"];
        if ($is_admin != "1") { 
            
            $allgate=$this->getTable("SELECT 
                                        set_gate.gat_typeno,
                                        set_gate.gat_name
                                    FROM set_gate 
                                    WHERE set_gate.gat_typeno ='".$gate_row["gat_typeno"]."'");
           
            if(count($allgate)>0){
                if($is_cambo==1){
                    foreach ($allgate as $row_gate) {
                        $val_gate .='<option value="'.$row_gate["par_typeno"].'">'.$row_gate["park_name"].'</option>';               
                    }
                }
                if($is_cambo==0){
                    $val_gate = $allgate;
                }
            }
            return $val_parks;
        }else{
            $allgate=$this->getTable("SELECT 
                                        set_gate.gat_typeno,
                                        set_gate.gat_name
                                    FROM set_gate  ");
                                  
           
            if(count($allgate)>0){
                if($is_cambo==1){
                    foreach ($allgate as $row_gate) {
                        $val_gate .='<option value="'.$row_gate["par_typeno"].'">'.$row_gate["park_name"].'</option>';               
                    }
                }
                if($is_cambo==0){
                    $val_gate = $allgate;
                }
            }
            return $val_parks;
        }
        
    }
    public function user_login_gate($current_gate){
        $ci =& get_instance();
        $userid = $ci->session->userdata('userid');
        $is_admin = $ci->session->userdata('is_admin');
        $Login_gate=0;
        if ($is_admin != "1") {          
            $query=$this->db->query("SELECT 
                                        sch_user.gat_typeno
                                    FROM sch_user 
                                    WHERE sch_user.userid ='".$userid."'");
            $gate_row=$query->row();
            if($gate_row["gat_typeno"] != $current_gate){
                return $Login_gate=0; 
            }else{
                return $Login_gate=1; 
            }                                       
        }
    }

    function convertSQLDate($date){
     //echo $this->green->convertSQLDate($getdate); 
        $jdate =$this-> jdate_format(); 
        $disdate =$this-> gdate_format();
        $formatdate = "yyyy-mm-dd";

        if($date != ""){            
            if ($jdate != $formatdate) {           
                $datepart = explode("-", $date);               
                if($datepart[2] != ""){
                    return $datepart[2] . '-' . $datepart[1] . '-' . $datepart[0];
                }else{           
                    return  $disdate;
                }
            }else{          
                $datepart = explode("-", $date);               
                if($datepart[2] != ""){                     
                    return $date; 
                }else{                    
                     return $disdate; 
                }
            }
        }else{
            return  $disdate;
        }
    }
    public function gdate_format($d="",$t=""){
            ///////////////////////// CALL ////////////////////////////////////
            //$getdate = $this->green->getValue("SELECT set_park.create_date FROM set_park WHERE set_park.par_typeno='1'");
            //echo $this->green->gdate_format($getdate,0);   

            ///////////////////////////////////////////////////////////////////

            $date= date_create($d) ;
            $display_datetime = $this->getValue("SELECT sys_config.display_format FROM sys_config WHERE sys_config.dgroup='dt' AND status=1");            
            $display_date = $this->getValue("SELECT sys_config.display_format FROM sys_config WHERE sys_config.dgroup='d' AND status=1");            
            if($t==1){ /////1=Display date and time
                 $displaydate = date_format($date,$display_datetime);   
            }else{     /////0 = Display date only
                 $displaydate = date_format($date,$display_date); 
            }
                                
            return $displaydate; 
    }
    public function jdate_format(){
            ///////////////////////// CALL ////////////////////////////////////
            //$getdate = $this->green->getValue("SELECT set_park.create_date FROM set_park WHERE set_park.par_typeno='1'");
            //echo $this->green->jdate_format();           
            /////////////////////////////////////////////////////////////           
             $display_date = $this->getValue("SELECT sys_config.display_format FROM sys_config WHERE sys_config.dgroup='jd' AND status=1");                       
                                
            return $display_date; 
    }
    
}


?>