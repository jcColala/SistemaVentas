<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema Bar</title> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script src="<?php echo base_url();?>/public/js/jquery.js"></script>
  <script src="<?php echo base_url();?>/public/js/scri.js"></script>
  <script src="<?php echo base_url();?>/public/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url()?>/public/icomoon/style.css">

  <script src="<?php echo base_url();?>/public/myjs/main.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>/public/mycss/main.css">

  <script src="<?php echo base_url();?>/public/myjs/usuario.js"></script>
  <script src="<?php echo base_url();?>/public/myjs/almacen.js"></script>
  <script src="<?php echo base_url();?>/public/myjs/compras.js"></script>

  <link rel="stylesheet" href="<?php echo base_url()?>/public/alertifyJS/css/themes/semantic.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/public/alertifyJS/css/alertify.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <script  src="<?php echo base_url()?>/public/alertifyJS/alertify.min.js"></script>

  <link rel="stylesheet" href="<?php echo base_url();?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.css">


 
</head>
<body class="hold-transition sidebar-mini layout-fixed" id="body">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-teal" style="padding: .8rem .1rem;border-bottom: 1px solid #d9dce3;box-shadow: 0 3px 14px -7px #343a4061; background:#009688;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
		<!-- Right navbar links -->
	     <ul class="navbar-nav ml-auto">
	       <!-- Notifications Dropdown Menu -->
	       <li class="nav-item dropdown dropdown user user-menu">
					 <a id="a_heder_usuiario" class="a_heder_usuiario" data-toggle="dropdown">
						 	<span class="info"><?php echo $_SESSION['nombre'];?> &nbsp;</span>
 							<img  src="<?php echo base_url();?>/public/img/usuario/inicio.jpg" class="user-image img-circle elevation-2" alt="User Image">
 					</a>
	         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
	           <span class="dropdown-item dropdown-header">Opciones</span>
	           <div class="dropdown-divider"></div>
	           <a href="#" class="dropdown-item">
	             <i class="fas fa-user mr-2"></i> Perfil
	             <span class="float-right text-muted text-sm">Información</span>
	           </a>

	           <div class="dropdown-divider"></div>
	           <a href="<?php echo base_url();?>/Login/salir" id="salir" class="dropdown-item small-box-footer">
	             <i class="fas fa-sign-out-alt mr-2"></i>Salir
	           </a>
	           <div class="dropdown-divider"></div>

	         </div>
	       </li>
	     </ul>
	   </nav>
	   <!-- /.navbar -->
	<!-- jQuery -->
	<script src="<?php echo base_url();?>/public/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url();?>/public/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url();?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
