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
  <title><?= $title?></title>
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
	 <script src="<?= base_url('assets')?>/js/jquery.min.js"></script>
	
</head>
<body>
