<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$id= $this->session->userdata('user_login');
$this->db->where('id',$id);
$arr = $this->db->get('admin')->row_array();
$view_data['arr'] = $arr;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CDMI | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jqvmap/jqvmap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/summernote/summernote-bs4.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  

  
     <link rel="shortcut icon" type="image/x-icon" href="assets/images/cdmi-favicon.png">
     <!-- Animation CSS -->
     <!-- <link rel="stylesheet" href="assets/css/animate.css" /> -->
     <!-- Latest Bootstrap min CSS -->
     <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" /> -->
     <!-- Google Font -->
     <!-- <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet" /> -->
     <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
          rel="stylesheet" /> -->
     <!-- Icon Font CSS -->
     <!-- <link rel="stylesheet" href="assets/css/ionicons.min.css" /> -->
     <!-- <link rel="stylesheet" href="assets/css/themify-icons.css" /> -->
     <!-- FontAwesome CSS -->
     <!-- <link rel="stylesheet" href="assets/css/all.min.css" /> -->
     <!-- Style CSS -->
     <!-- <link rel="stylesheet" href="assets/css/style.css" /> -->
     <!-- <link rel="stylesheet" href="assets/css/responsive.css" /> -->
     <!-- <link rel="stylesheet" id="layoutstyle" href="assets/color/theme.css" /> -->
     <!-- <link rel="stylesheet" href="assets/css/select2.min.css" /> -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="loader process-loader">
  <img width="100" src="<?php echo base_url('assets/loader.gif');?>">
</div>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
     
      <?php 
      if($arr['role'] == 1){
      ?>
      <!-- <li class="nav-item">
        <a class="nav-link" title="Download Database"  href="<?php echo site_url('download-backup')?>">
          <i class="fas fa-database"></i>
        </a>
      </li> -->
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link"   href="<?php echo site_url('logout')?>">
          <i class="fas fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <?php
  
  $this->load->view('sidebar_admin',$view_data);
  
  ?>