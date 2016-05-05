<?php

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->lang->load('general', 'english');
        $this->lang->load('login', 'english');

    }

    public function index()
    {
        if ($this->session->userdata('user_name') != "") {
            $data['page_header'] = "GreenICT";
            $this->load->view('header', $data);
            $this->load->view('index', $data);
            $this->load->view('footer');
        } else {
            $data['page_header'] = "Login";
            $this->load->view('login', $data);
        }
    }

    public function getLogin()
    {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');
        $schoolid = $this->input->post('schoolid');
        $year = $this->input->post('year');
        $lang = $this->input->post('lang');
        $sql_userinf = "SELECT
							userid,
							user_name,
							`password`,
							sch_user.roleid,
							sch_user.last_name,
							sch_user.first_name,
							sch_user.def_sch_level,
							sch_user.def_dashboard,
							sch_user.def_open_page,
                            sch_user.is_admin
						FROM
							sch_user
						WHERE
							user_name = ?
						AND `password` = ?
						AND is_active = ?";

        //$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";

        $userrow =$this->db->query($sql_userinf, array($user_name, md5($password), '1'));
        
        //$userinf = $this->green->getOneRow($sql_userinf);
        $userinf = $userrow->row();
        if (count($userinf) > 0 && $userinf->userid!= "") {
			$data = array('last_visit'=>date('Y-m-d H:i:s a',time()));
			$this->db->update("sch_user",$data,array('userid'=>$userinf->userid));
            $this->session->set_userdata($userinf);
            $this->session->set_userdata("roleid", $userinf->roleid);
            $this->green->getModule($userinf->roleid);

            $this->session->set_userdata("moduleids", $this->green->moduleids);
            $arrModules = $this->green->moduleids;

            $this->session->set_userdata('lang', $lang);

            $arrModInfos = array();
            $arrPageInfos = array();
            $arrPageAction = array();

            if (count($arrModules) > 0) {

                foreach ($arrModules as $moduleid) {
                    $this->green->getRolePage($moduleid['moduleid']);
                    $arrPages = $this->green->pageids;

                    if (count($arrPages) > 0) {
                        foreach ($arrPages as $page) {
                            $this->green->getPageInfo($page['pageid']);
                            $arrPageInfos[$moduleid['moduleid']][$page['pageid']] = $this->green->pageinfos;
                            $arrPageAction[$moduleid['moduleid']][$page['pageid']] = $page['is_read'];
                        }
                    }

                    $arrModInfos[$moduleid['moduleid']] = $this->green->getModuleInfo($moduleid['moduleid']);
                }
            }
            $this->session->set_userdata("roleid", $userinf->roleid);
            $this->session->set_userdata("ModuleInfors", $arrModInfos);
            $this->session->set_userdata("PageInfors", $arrPageInfos);
            $this->session->set_userdata("PageAction", $arrPageAction);

            $this->session->set_userdata("schoolid", $schoolid);
            $this->session->set_userdata("year", $year);
            $this->session->set_userdata("def_sch_level", $userinf->def_sch_level);

            if ($userinf->roleid== 1) {
                //$this->green->goToPage("home");
                $this->green->goToPage("dash");
            } else if ($userinf->def_open_page != '') {
                $this->green->goToPage($userinf->def_open_page);  
            } else {
                $this->green->goToPage("home");
            }

        } else {
            $this->green->goToPage(site_url('login'));
        }
    }
    public function logOut()
    {
        $this->session->sess_destroy();
        $this->green->goToPage(site_url('login'));
    }

}

?>