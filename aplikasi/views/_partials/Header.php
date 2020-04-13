<!DOCTYPE html>
<html>
<head>
<?php 
     //header("Cache-Control: private, max-age=10800, pre-check=10800");
     //header("Pragma: private");
     //header("Expires: " . date(DATE_RFC822,strtotime("+2 day")));
?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title.' - '.$txttitle?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name='csrf' id="<?=$this->security->get_csrf_token_name();?>" content="<?=$this->security->get_csrf_hash();?>" url_public='<?= base_url()?>' >

	<link rel="icon" href="<?= base_url('assets')?>/img/BUDIv3.png">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="<?= base_url('assets')?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')?>/css/nifty.min.css" rel="stylesheet">

    <link href="<?= base_url('assets')?>/css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')?>/plugins/pace/pace.min.css" rel="stylesheet">
    <script src="<?= base_url('assets')?>/plugins/pace/pace.min.js"></script>
    <link href="<?= base_url('assets')?>/css/demo/nifty-demo.min.css" rel="stylesheet">
	<link href="<?= base_url('assets')?>/plugins/toastr-master/build/toastr.min.css" rel="stylesheet">
	<link href="<?= base_url('assets')?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url('assets')?>/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?= base_url('assets')?>/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')?>/plugins/chosen/chosen.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')?>/plugins/noUiSlider/nouislider.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')?>/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')?>/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?= base_url('assets')?>/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')?>/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
	<script src="<?= base_url('assets')?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets')?>/js/jquery.toast.js"></script>
	<script type="text/javascript" src="<?= base_url('assets')?>/js/panel.js"></script>
	<script type="text/javascript" src="<?= base_url('assets')?>/js/page.js"></script>
	
	<script type="text/javascript" src="<?= base_url('assets')?>/js/moment.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets')?>/plugins/daterangepicker/daterangepicker.js"></script>
	  <style>
	input[type="search"]::-webkit-search-cancel-button {
    -webkit-appearance: searchfield-cancel-button;
	cursor: pointer;
	}
	.drop-shadow {
	  -webkit-box-shadow: 2px 2px 5px 0 rgba(0, 0, 0, 0.4);
			  box-shadow: 2px 2px 5px 0 rgba(0, 0, 0, 0.4);
	}
	.drop-shadow-2 {
    -webkit-box-shadow: 0 8px 17px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .19) !important;
    box-shadow: 0 8px 17px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .19) !important
	}

	.drop-shadow-3 {
		-webkit-box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19) !important;
		box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19) !important
	}

	.drop-shadow-4 {
		-webkit-box-shadow: 0 16px 28px 0 rgba(0, 0, 0, .22), 0 25px 55px 0 rgba(0, 0, 0, .21) !important;
		box-shadow: 0 16px 28px 0 rgba(0, 0, 0, .22), 0 25px 55px 0 rgba(0, 0, 0, .21) !important
	}

	.drop-shadow-5 {
		-webkit-box-shadow: 0 27px 24px 0 rgba(0, 0, 0, .2), 0 40px 77px 0 rgba(0, 0, 0, .22) !important;
		box-shadow: 0 27px 24px 0 rgba(0, 0, 0, .2), 0 40px 77px 0 rgba(0, 0, 0, .22) !important
	}
  </style>
  
</head>
<body>
 <div id="container" class="effect aside-float aside-bright mainnav-lg navbar-fixed">
<header id="navbar">
            <div id="navbar-container" class="boxed">
                <div class="navbar-header">
                    <a href="<?= base_url('Dashboard')?>" class="navbar-brand">
                        <img src="<?= base_url('assets')?>/img/logo.png" alt="Nifty Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text"><?= $about['SESSION']?></span>
                        </div>
                    </a>
                </div>

                <div class="navbar-content">
                    <ul class="nav navbar-top-links">
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="demo-pli-list-view"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-top-links">
                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="ic-user pull-right">
                                    <i class="demo-pli-male"></i>
                                </span>
                            </a>


                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                                <ul class="head-list">
                                    <li>
                                        <a href="#"><i class="demo-pli-male icon-lg icon-fw"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Auth/Logout')?>"><i class="demo-pli-unlock icon-lg icon-fw"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
						
                    </ul>
                </div>
            </div>
        </header>
		 <div class="boxed">
		            
			
			
		 
