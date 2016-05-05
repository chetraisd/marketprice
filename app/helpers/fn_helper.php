<?php
function FgetPrefix($diseastypeid)
{
    $ci = &get_instance();
    $curr_year = date('Y');
    $counrow = $ci->db->query("SELECT COUNT(diseaseid) as counrow FROM z_setup_prefix WHERE 1=1 AND z_setup_prefix.diseaseid = '" . $diseastypeid . "' AND years='" . $curr_year . "'")->row();
    //return $counrow->counrow;die();
    if ($counrow->counrow == 0) {
        //$year = $ci->db->query("SELECT DATE_FORMAT(CURDATE(),'%y') AS inv_y")->row();
        $Updatepre = array("sequence" => 1,
            "diseaseid" => $diseastypeid,
            "prefix" => $diseastypeid,
            "leng" => 5,
            "simbool" => '-',
            "years" => date("Y"));
        $ci->db->insert("z_setup_prefix", $Updatepre);
    } else {
        $sequence_auto = $ci->db->query("SELECT sequence FROM z_setup_prefix WHERE 1=1 AND z_setup_prefix.diseaseid = '" . $diseastypeid . "' AND years='" . $curr_year . "'")->row();
        $Updatepre = array("sequence" => ($sequence_auto->sequence + 1));
        $where_seq = array("diseaseid" => $diseastypeid, "years" => $curr_year);
        $ci->db->where($where_seq);
        $ci->db->update("z_setup_prefix", $Updatepre);
    }
    //--------
    $sql_selecone = $ci->db->query("SELECT diseaseid,prefix,leng,simbool,sequence,sample,years FROM z_setup_prefix WHERE 1=1  AND z_setup_prefix.diseaseid  = '" . $diseastypeid . "'  AND years='" . $curr_year . "'")->row();
    $prefix = $sql_selecone->prefix;
    $pre_sep_sym = $sql_selecone->simbool;
    //$sequence    = $sql_selecone->sequence;

    $sequence = $sql_selecone->sequence;
    $len = $sql_selecone->leng;

    $years = date('y', strtotime($sql_selecone->years));
    $sample = $prefix . $pre_sep_sym . str_pad($sequence, $len, '0', STR_PAD_LEFT) . "/" . $years;

    $Upsam = array("sample" => $sample);
    $where_ar = array("diseaseid" => $diseastypeid, "years" => $curr_year);
    $ci->db->where($where_ar);
    $ci->db->update("z_setup_prefix", $Upsam);
    $Select = $ci->db->query("SELECT sample FROM z_setup_prefix WHERE 1=1 AND z_setup_prefix.diseaseid  = '" . $diseastypeid . "' AND years='" . $curr_year . "'")->row();
    return $Select->sample;

}

?>