<?php
date_default_timezone_set('Asia/Phnom_Penh');
$user_name = $this->session->userdata('user_name');
if ($user_name == "") {
    $this->green->goToPage(site_url('login'));
}
#====== get menu ============
//print_r($this->session->userdata('moduleids'));
$menu = "";
$roleid = $this->session->userdata('roleid');
$modules = $this->session->userdata('ModuleInfors');

$pages = $this->session->userdata('PageInfors');

$year = $this->session->userdata('year');
$schoolid = $this->session->userdata('schoolid');

if (isset($_REQUEST['yearid']) && $_REQUEST['yearid'] != "") {
    $year = $_REQUEST['yearid'];
} elseif (isset($_REQUEST['y']) && $_REQUEST['y'] != "") {
    $year = $_REQUEST['y'];
} elseif (isset($_REQUEST['year']) && $_REQUEST['year'] != "") {
    $year = $_REQUEST['year'];
}
$this->green->setActiveUser($this->session->userdata('userid'));
$this->green->setActiveRole($roleid);

if (isset($_GET['m'])) {
    $this->green->setActiveModule($this->gencrypt->decode($_GET['m']));
    $this->session->set_userdata("m", $this->gencrypt->decode($_GET['m']));
}
if (isset($_GET['p'])) {
    $this->green->setActivePage($this->gencrypt->decode($_GET['p']));
    $this->session->set_userdata("p", $this->gencrypt->decode($_GET['p']));
}

if (count($modules) > 0) {

    foreach ($modules as $row) {
        if(isset($row['mod_position'])){
            if ($row['mod_position'] == '2') {

                $mod_icon=isset($row['icon'])?$row['icon']:" fa-bars ";
                $menu .= '<li>
                                <a href="#"><i class="fa '.$mod_icon.'"></i> <b>' . $this->lang->line($row['module_name']) . '</b><span class="fa arrow"></span></a>';
                if (count($pages) > 0) {

                    if (isset($pages[$row['moduleid']])) {
                        $page_mod = $pages[$row['moduleid']];

                        if (count($page_mod) > 0 && isset($pages[$row['moduleid']])) {

                            $menu .= '<ul class="nav nav-second-level">';
                            foreach ($page_mod as $page) {
                                $page_link =$page['route_url']."?m=".$this->gencrypt->encode($row['moduleid'])."&p=".$this->gencrypt->encode($page['pageid']);

                                $menu .= '<li>
                                                <a href="' . site_url($page_link) . '?"><i class="fa ' . $page['icon'] . ' fa-fw"></i> ' .$page['page_name'].'</a>
                                          </li>';
                            }
                            $menu .= '</ul>';
                        }
                    }

                }

                $menu .= '</li>';
            }
        }
        

    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GreenICT-System</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.css') ?>" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="<?php echo base_url('assets/dist/css/timeline.css') ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/dist/css/sb-admin-2.css') ?>" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('assets/bower_components/morrisjs/morris.css') ?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>"
          rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
    <!-- Jquery ui -->
    <link href="<?php echo base_url('assets/css/jquery/jquery-ui.css') ?>" rel="stylesheet">
    <!-- datepicker -->
    <link href="<?php echo base_url('assets/css/datepicker3.css') ?>" rel="stylesheet">
    <!-- Ck editor-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/editor/summernote.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/editor/codemirror/codemirror.min.css') ?>"/>
    <!-- Green CSS -->
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
    <!-- Favicon -->
    <link rel="apple-touch-icon" href="../../apple-touch-icon.html">
    <link rel="icon" href="../../favicon.html">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery/jquery-ui.js') ?>"></script>

    <!-- js for print -->
    <!-- end js for print -->

    <!-- Parsley Form Validation -->
    <script src="<?php echo base_url('assets/js/parsley.min.js') ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js') ?>"></script>
    <!-- Morris Charts JavaScript
	<script src="<?php echo base_url('asset/bower_components/raphael/raphael-min.js') ?>"></script>
	<script src="<?php echo base_url('assets/bower_components/morrisjs/morris.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/morris-data.js') ?>"></script>	-->

    <!-- Ck editor-->
    <script src="<?php echo base_url('assets/js/editor/summernote.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/editor/codemirror/codemirror.min.js') ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/dist/js/sb-admin-2.js') ?>"></script>
    <!-- Date pictker -->
    <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
    <!-- jqprint -->
    <script src="<?php echo base_url('assets/js/jquery/jquery.PrintArea.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/gScript.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.form.js') ?>"></script>    
    <script src="<?php echo base_url('assets/js/bootbox.min.js') ?>"></script>
    <!-- webcame -->
    <script src="<?php echo base_url('assets/j_webcam/webcam.js') ?>"></script>

    <style type="text/css">
        #loading_header {
            display: none;
            position: fixed;
            z-index: 2000;
            top: 20%;
            left: 40%;
            height: 10%;
            width: 20%;
            /* background: rgba( 255, 255, 255, .8 ) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat; */
            background: rgba( 0, 0, 0, .0 ) url(<?= base_url('assets/images/icons/images/20.gif') ?>) 50% 40% no-repeat;
            cursor: progress !important;
        }
        
        #success{
            display: none;
            position: fixed;
            z-index: 20000;
            top: 20%;
            left: 50%;
            height: 10%;
            width: 20%;
            background: rgba( 0, 0, 0, .0 ) url(<?= base_url('assets/images/icons/success.png') ?>) 50% 50% no-repeat;
            cursor: progress !important;
        }
        /* When the body has the loading class, we turn the scrollbar off with overflow:hidden */
        /*body.loading {
            overflow: hidden;
        }*/
        /* Anytime the body has the loading class, our modal element will be visible */
        /*body.loading {
            display: inline;
            cursor: progress !important;
        }*/
    </style>

    <script type="text/javascript">
      $(function(){
        // decimal =======
         $('body').delegate('[decimal]', 'keydown', function(e) {
           var key = e.charCode || e.keyCode || 0;
           // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
           // home, end, period, and numpad decimal
           if (key == 110 || key == 190) {
               var text = $(this).val();
               if (text.toString().indexOf(".") != -1) {
                   return false;
               }
           }
           return (
                   key == 8 ||
                   key == 9 ||
                   key == 46 ||
                   key == 110 ||
                   key == 190 ||
                   (key >= 35 && key <= 40) ||
                   (key >= 48 && key <= 57) ||
                   (key >= 96 && key <= 105));
         });

         // number =======
         $('body').delegate('[number]', 'keydown', function(e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                   key == 8 ||
                   key == 9 ||
                   key == 46 ||
                   // key == 110 ||
                   // key == 190 ||
                   (key >= 35 && key <= 40) ||
                   (key >= 48 && key <= 57) ||
                   (key >= 96 && key <= 105));
         });

        // date =======
        $('body').delegate('[date_]', 'keydown', function(e) {
        var key = e.charCode || e.keyCode || 0;
        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
        // home, end, period, and numpad decimal
        return (
               key == 8 ||
               key == 9 ||
               key == 46 ||
               (key == 191 || key == 111) ||
               (key == 109 || key == 189) ||
               (key >= 35 && key <= 40) ||
               (key >= 48 && key <= 57) ||
               (key >= 96 && key <= 105));
        });

      });// ready =====
      

      // clear a element =======
      function clear_a_element(){      
        $("[clear_a_element]").each(function(i){
           $(this).val('');
        });
      }

        function modal_delete(hidden_typeno){ 
            $("#myModal_delete").modal();            
            $('#title_msg').html('Are you sure to delete ?');
            $('#title_msg').css({'color':' red' , 'font-size' : '16px'});
            $('.modal_msg').css({'top' : '30%','width' : '280px' });
            $('#btn_delete').attr('attr',hidden_typeno);
        }

    </script>

</head>
<body>

<!-- modal_msg -->
<div class="modal" id="myModal_delete">
    <div class="modal-dialog modal_msg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title" align="center"><span id="title_msg"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_delete" data-dismiss="modal" attr="" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-primary" id="close_msg" data-dismiss="modal">Cancel</button>
                
            </div>
        </div>
    </div>
</div>

<!--end modal_msg -->


<!-- <div class="modal" > -->

<div id="wrapper">
    <!-- success -->
    <div id="success"></div>

    <!-- loading -->
    <div id="loading_header"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span style="color:green; font-size:20px; padding-left:25px;"><?php echo $this->lang->line('company')?></span>
            <!-- <a class="navbar-brand" href="index.html">
                	<img src="<?php echo base_url('assets/images/logo/logo.png') ?>"  />
                </a> -->
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <li class="dropdown">
                <a class="dropdown-toggle hide" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    <span class="badge"><span
                            style="color:#f00;"> <?php echo $this->green->get_messages(); ?></span></span>
                </a>
                <style type="text/css">
                    .span.badge {
                        margin-bottom: 4490px !important;
                    }

                    a.text-center:hover {
                        text-decoration: none !important;
                        background: none !important;
                        cursor: inherit;
                    }
                </style>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="<?php echo site_url('message/message'); ?>">

                            <div>
                                <strong>Message</strong>
                                    <span class="pull-right text-muted">
                                        <em>New</em>

                                    </span>
                            </div>
                            <div>
                                Just coming new messages

                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center">
                            <strong>&nbsp;</strong>

                            <!-- <i class="fa fa-angle-right"></i> -->
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown hide">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-tasks">
                    <li>
                        <a href="<?php echo site_url('message/message'); ?>">
                            <div>
                                <p>
                                    <strong>Message</strong>
                                    <span class="pull-right text-muted"></span>
                                </p>
                                <!-- <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div> -->
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                </ul>
                <!-- /.dropdown-tasks -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown hide">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>

                <!--  start long tha working - -->
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="">
                            <div>
                                <i class="fa fa-user fa-fw"></i>
                                <span class="pull-right text-muted small"></span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="">
                            <div>
                                <i class="fa fa-user fa-fw"></i>
                                <span class="pull-right text-muted small"></span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="">
                            <div>
                                <i class="fa fa-user fa-fw"></i>
                                <span class="pull-right text-muted small"></span>
                            </div>
                        </a>
                    </li>
                </ul>
                <!--  end long tha working - -->
                <!-- /.dropdown-alerts -->
            </li>

            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <?php //if ($roleid == '1') {
                        $getPage = $this->db->query("SELECT pageid, moduleid FROM sch_z_page WHERE link='setting/userprofile'")->row();                       
                         $page_link = "setting/userprofile?m=".$getPage->moduleid."&p=".$getPage->pageid;
                     ?>
                        <li><a href="<?php echo site_url($page_link);?>"><i class="fa fa-user fa-fw"></i> User
                                Profile</a>
                        </li>
                        <!-- <li><a href="<?php echo site_url("setting/setting") ?>"><i class="fa fa-gear fa-fw"></i>
                                Settings</a>
                        </li> -->
                    <?php //} ?>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url("login/logOut") ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->

        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search" style="display:none;">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li style="">
                        <a href="<?php echo site_url("dash") ?>"><i class="fa fa-dashboard fa-fw"></i> <b>Dashboard</b></a>
                    </li>
                    <!--
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts Report<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="flot.html">Student by class</a>
                            </li>
                            <li>
                                <a href="morris.html">Families visit by month</a>
                            </li>
                        </ul>
                    </li>
                    -->
                    <?php echo $menu;?>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <!-- content - -->
        	
        	
        	