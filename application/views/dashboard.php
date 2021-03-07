    <section class="content-header">
      <h1>
        Dashboard
        <small>Menu Utama</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
        <li class="active"> </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- Menampilkan jumlah rekomendasi yang sudah ditindaklanjuti dan menunggu respon admin-->
    <div class="row" 
     style=" color:white; 
     font-size:20px;
     text-shadow: 2px 2px green;
     margin-left: 5px">
      <span style="font-weight:bold; font-size:24px; text-shadow: 2px 2px red "><?=$this->fungsi->count_wait()?></span> rekomendasi telah ditanggapi/ditindaklanjuti dan menunggu respon Admin.
    </div>
    <hr>

    <?php if($this->fungsi->user_login()->level == 1) { ?>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$this->fungsi->count_semua()?></h3>

              <p>Total Rekomendasi</p>
            </div>
            <div class="icon">
              <i class="ion-pie-graph"></i>
            </div>
            <a href="<?=site_url('rekoms')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?=$this->fungsi->count_belum()?><sup style="font-size: 20px"></sup></h3>

              <p>Belum ditindaklanjuti</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert"></i>
            </div>
            <a href="<?=site_url('belum')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$this->fungsi->count_proses()?></h3>

              <p>Proses ditindaklanjuti</p>
            </div>
            <div class="icon">
              <i class="ion ion-battery-low"></i>
            </div>
            <a href="<?=site_url('proses')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$this->fungsi->count_selesai()?></h3>

              <p>Selesai ditindaklanjuti</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark"></i>
            </div>
            <a href="<?=site_url('selesai')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div style="width: 50%;
      margin: auto;
      margin-top: 30px">
        <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$this->fungsi->count_hampir()?></h3>

              <p>Akan Jatuh Tempo</p>
            </div>
            <div class="icon">
              <i class="ion-sad-outline"></i>
            </div>
            <a href="<?=site_url('hampir')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$this->fungsi->count_lewat()?><sup style="font-size: 20px"></sup></h3>
  
              <p>Telah Jatuh Tempo</p>
            </div>
            <div class="icon">
              <i class="ion ion-close"></i>
            </div>
            <a href="<?=site_url('lewat')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
        
        
    <?php } ?>


    <!-- main content untuk unit -->
    <?php if($this->fungsi->user_login()->level == 2) { ?>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$this->fungsi->count_unit_semua()?></h3>

              <p>Total Rekomendasi</p>
            </div>
            <div class="icon">
              <i class="ion-pie-graph"></i>
            </div>
            <a href="<?=site_url('rekoms_unit')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$this->fungsi->count_unit_belum()?><sup style="font-size: 20px"></sup></h3>

              <p>Belum ditindaklanjuti</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert"></i>
            </div>
            <a href="<?=site_url('belum_unit')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$this->fungsi->count_unit_proses()?></h3>

              <p>Proses ditindaklanjuti</p>
            </div>
            <div class="icon">
              <i class="ion ion-battery-low"></i>
            </div>
            <a href="<?=site_url('proses_unit')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$this->fungsi->count_unit_selesai()?></h3>

              <p>Selesai ditindaklanjuti</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark"></i>
            </div>
            <a href="<?=site_url('selesai_unit')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    <?php } ?>
      

    </section>


  