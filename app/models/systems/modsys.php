<?php

class ModSys extends CI_Model
{
    function deletedata(){
        $arrJson=array();
        $arrJson['del']=0;
        $ch_clear=$_POST['ch_clear'];

        if(isset($ch_clear) && count($ch_clear)>0){
            foreach($ch_clear as $chd){
                if($chd=="alltrans"){
                    $this->db->query("TRUNCATE TABLE tran_agency_approval");
                    $this->db->query("TRUNCATE TABLE tran_agency_approval_detail");
                    $this->db->query("TRUNCATE TABLE tran_agency_visit");
                    $this->db->query("TRUNCATE TABLE tran_application");
                    $this->db->query("TRUNCATE TABLE tran_comparison");
                    $this->db->query("TRUNCATE TABLE tran_reciept_payment");
                    $this->db->query("TRUNCATE TABLE tran_reciept_payment_detail");
                    $this->db->query("TRUNCATE TABLE tran_ticket");
                    $this->db->query("TRUNCATE TABLE tran_ticket_check_park");
                }
            }
            $arrJson['del']=1;
        }
        $arrJson['del']=1;
        header("Content-type:text/x-json");
        echo json_encode($arrJson);
    }
}