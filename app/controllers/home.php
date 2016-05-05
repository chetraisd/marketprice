<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->lang->load('general', $this->session->userdata('lang'));
        $this->lang->load('login', 'khmer');

    }

    public function index()
    {
        $data['page_header'] = "Here is Index Page";
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
        //echo $this->green->nextTrans(1,"Create User");
    }
}

