<?php
  require "assets/vendor/autoload.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIMORI V-2.0</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
  <!-- <header class="main-header" style="position: fixed; width:100%"> -->
    <!-- Logo -->
    <a href="<?=site_url('dashboard')?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SMR </b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIMORI </b><small>V-2.0</small></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url()?>image/bg_sumut1.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= ucfirst($this->fungsi->user_login()->username)?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url()?>image/bg_sumut1.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= ucfirst($this->fungsi->user_login()->username)?> - Kanwil DJBC Sumut
                  <small><?=date('Y')?></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="pull-right">
                  <a href="<?=site_url('auth/logout')?>" class="btn btn-danger btn-flat" >Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url()?>image/bg_sumut1.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
          <?=ucfirst($this->fungsi->user_login()->username) ?> 
          <!-- <br> -->
         <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
          </p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU UTAMA</li>
		  <li <?=$this->uri->segment(1) == 'dashboard' || $this->uri->segment(1)==""  ? 'class="active"' : '' ?>>
        <a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> 
		    Dashboard</a>
		  </li>

      <!-- <li <?=$this->uri->segment(1) == 'tes' || $this->uri->segment(1)==""  ? 'class="active"' : '' ?>>
        <a href="<?=site_url('tes')?>"><i class="fa fa-truck"></i> 
		    Tes</a>
		  </li> -->


        <?php if($this->fungsi->user_login()->level == 1) { ?>
        <li class="treeview <?=$this->uri->segment(1) == 'rekoms' ||
          $this->uri->segment(1) == 'rekom' ||
          $this->uri->segment(1) == 'belum' ||
          $this->uri->segment(1) == 'proses' ||
          $this->uri->segment(1) == 'selesai' 
        ? "active" : '' ?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Data Rekomendasi</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu" >
          <!-- <li <?=$this->uri->segment(1) == 'rekom' ?  'class="active"' : ''?>><a href="<?=site_url('rekom')?>"><i class="fa fa-circle-o"></i> All-Rekom</a></li> -->
            <li <?=$this->uri->segment(1) == 'rekoms' ?  'class="active"' : ''?>><a href="<?=site_url('rekoms')?>"><i class="fa fa-circle-o"></i> Semua 
              <span class="pull-right-container">
                <span class="label bg-aqua pull-right"> <?=$this->fungsi->count_semua()?></span>
              </span> </a></li>
            <li <?=$this->uri->segment(1) == 'belum' ?  'class="active"' : ''?>><a href="<?=site_url('belum')?>"><i class="fa fa-circle-o"></i> Belum 
              <span class="pull-right-container">
                <span class="label label-primary pull-right"> <?=$this->fungsi->count_belum()?></span>
              </span> </a></li>
            <li <?=$this->uri->segment(1) == 'proses' ?  'class="active"' : ''?>><a href="<?=site_url('proses')?>"><i class="fa fa-circle-o"></i> Proses
              <span class="pull-right-container">
                <span class="label label-warning pull-right"> <?=$this->fungsi->count_proses()?></span>
              </span> </a></li>
            <li <?=$this->uri->segment(1) == 'selesai' ?  'class="active"' : ''?>><a href="<?=site_url('selesai')?>"><i class="fa fa-circle-o"></i> Selesai
              <span class="pull-right-container">
                <span class="label label-success pull-right"> <?=$this->fungsi->count_selesai()?></span>
              </span> </a></li>
            <li <?=$this->uri->segment(1) == 'hampir' ?  'class="active"' : ''?>><a href="<?=site_url('hampir')?>"><i class="fa fa-circle-o"></i> Hampir
            <span class="pull-right-container">
              <span class="label label-danger pull-right"> <?=$this->fungsi->count_hampir()?></span>
            </span> </a></li>
            <li <?=$this->uri->segment(1) == 'lewat' ?  'class="active"' : ''?>><a href="<?=site_url('lewat')?>"><i class="fa fa-circle-o"></i> Lewat
            <span class="pull-right-container">
              <span class="label label-danger pull-right"> <?=$this->fungsi->count_lewat()?></span>
            </span> </a></li>
            
          </ul>
        </li>
        <li><a href="<?=site_url('filter_download')?>"><i class="fa fa-filter"></i> <span>Filter & Download</span></a></li>     
        <?php }?>


        


        
        <?php if($this->fungsi->user_login()->level == 2) { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Data Rekomendasi <?= $this->fungsi->user_login()->username?></span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li <?=$this->uri->segment(1) == 'rekoms_unit' ?  'class="active"' : ''?>><a href="<?=site_url('rekoms_unit')?>"><i class="fa fa-circle-o"></i> Semua
              <span class="pull-right-container">
                <span class="label label-primary pull-right"> <?=$this->fungsi->count_unit_semua()?></span>
              </span> </a></li>
            <li <?=$this->uri->segment(1) == 'belum_unit' ?  'class="active"' : ''?>><a href="<?=site_url('belum_unit')?>"><i class="fa fa-circle-o"></i> Belum 
              <span class="pull-right-container">
                <span class="label label-danger pull-right"> <?=$this->fungsi->count_unit_belum()?></span>
              </span> </a></li>
            <li <?=$this->uri->segment(1) == 'proses_unit' ?  'class="active"' : ''?>><a href="<?=site_url('proses_unit')?>"><i class="fa fa-circle-o"></i> Proses
              <span class="pull-right-container">
                <span class="label label-warning pull-right"> <?=$this->fungsi->count_unit_proses()?></span>
              </span> </a></li>
            <li <?=$this->uri->segment(1) == 'selesai_unit' ?  'class="active"' : ''?>><a href="<?=site_url('selesai_unit')?>"><i class="fa fa-circle-o"></i> Selesai
            <span class="pull-right-container">
                <span class="label label-success pull-right"> <?=$this->fungsi->count_unit_selesai()?></span>
              </span> </a></li>
            
          </ul>
        </li>
        <?php }?>
      

        <br>
        <br>
        <br>
        <li class="header">SETTING</li>
        <?php if($this->fungsi->user_login()->level == 1) { ?>

        <li <?=$this->uri->segment(1) == 'user' || $this->uri->segment(1)==""  ? 'class="active"' : '' ?>><a href="<?=site_url('user')?>"><i class="fa fa-user"></i> <span>Users</span></a></li>
        <li <?=$this->uri->segment(1) == 'activities' || $this->uri->segment(1)==""  ? 'class="active"' : '' ?>><a href="<?=site_url('activities')?>"><i class="fa fa-tasks"></i> <span>Kegiatan</span></a></li>
        <!-- <li <?=$this->uri->segment(1) == 'status' || $this->uri->segment(1)==""  ? 'class="active"' : '' ?>><a href="<?=site_url('status')?>"><i class="fa fa-battery-half"></i> <span>Status</span></a></li> -->
        <!-- <li <?=$this->uri->segment(1) == 'support' || $this->uri->segment(1)==""  ? 'class="active"' : '' ?>><a href="<?=site_url('support')?>"><i class="fa fa-address-book"></i> <span>Unit Pendukung</span></a></li> -->
    
        <?php } ?>

        <!-- <li <?=$this->uri->segment(1) == 'suggest' || $this->uri->segment(1)==""  ? 'class="active"' : '' ?>><a href="<?=site_url('suggest')?>"><i class="fa fa-lightbulb-o"></i> <span>Saran/Masukan u/ Aplikasi</span></a></li> -->
        <li><a href="<?=site_url('change')?>"><i class="fa fa-key"></i> <span>Ganti Password</span></a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
  <!-- jQuery 3 -->
  <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo $contents ?>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2019- <?=date('Y')?> <span style="color:deepskyblue">Seksi KI- M.Rambe</span> </a>.</strong> <a href="https://adminlte.io">All rights
    reserved.
  </footer>


</div>
<!-- ./wrapper -->


<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>

<script src="<?=base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $(document).ready(function(){
      $('#table1').DataTable()
  })
</script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
