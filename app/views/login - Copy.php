<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>GreenICT</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>"
          rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>"
          rel="stylesheet" type="text/css">
    <!-- Jquery ui -->
    <link href="<?php echo base_url('assets/css/jquery/jquery-ui.css') ?>" rel="stylesheet">

    <!-- Green CSS --->
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
    <script src="<?php echo base_url('assets/js/parsley.min.js') ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

    <script type="text/javascript">
        $(function () {
            $('#loginform').parsley();
        })
    </script>

</head>
<body>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="loginform text-center">
            <div class="dv_login">
                <div class="dv_login_icon">
                    <img src="<?php echo base_url('assets/images/icons/login.png') ?>"/>
                </div>
                <div class="dv_login_form">
                    <form action="<?php echo site_url('login/getLogin') ?>" method="post" id="loginform">
                        <table class="">
                            <tr>

                                <td colspan="3" align="left" class="login_title">
                                    <span class="" style="font-family: 'Khmer OS Muol light' "><?php echo $this->lang->line('angduon_hospital'); ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td><?php echo $this->lang->line('user_name') ?></td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="user_name" id="user_name" class="form-control col-sm-4"
                                           required data-parsley-required-message="Enter User Name"/>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('password') ?></td>
                                <td>:</td>
                                <td>
                                    <input type="password" name="password" id="password" class="form-control col-sm-4"
                                           required data-parsley-required-message="Enter Password"/>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('langs') ?></td>
                                <td>:</td>
                                <td>
                                    <select name="lang" id="lang">
                                        <option value="khmer"><?php echo $this->lang->line('khmer_lang') ?></option>
                                        <option value="english"><?php echo $this->lang->line('english_lang') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: center!import">
                                    <input type="submit" name="login" id="login" class="form-control btn-primary"
                                           value="<?php echo $this->lang->line('login') ?>"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0
    }

    body {
        /*		    background: url(*/
    <?php //echo base_url("assets/images/background.png")?> /*);*/
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0.5px;
        background-attachment: fixed;
        background-position: center;
    }

    .login_title {
        font-size: 18px;
        color: #276B08;
        font-weight: bold;
        padding-bottom: 20px;
        border-bottom: 1px solid #E9EDE8;
    }

    table {
        padding: 5px;
    }

    table td {
        padding: 3px;
        text-align: left;
    }

    .container-fluid {
        height: 100%;
        display: table;
        width: 100%;
        padding: 0;
    }

    .row-fluid {
        height: 100%;
        display: table-cell;
        vertical-align: middle;
    }

    .dv_login {
        position: relative;
        width: 570px;
        height: 270px;
        margin: 0 auto;
        background: none repeat scroll 0 0 #f8f8f8;
        border: 1px solid #b0adad;
        box-shadow: 1px 4px 4px 2px #E2DEDE;
        border-radius: 4px;
        padding-top: 15px;
        /*opacity: 0.7;*/

    }

    .dv_login_icon {
        width: 200px;
        float: left;
    }

    .dv_login_form {
        width: 290px;
        float: left;
    }

    #login {
        width: 100px;
    }
</style>
</html>
