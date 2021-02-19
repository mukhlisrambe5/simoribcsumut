<section class="content-header">
  <h1>  Filter & download
    <small> </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active"></li>
  </ol>
</section>

<section class="content">

    


   <div class="box">
        <!-- <div class="box-header">
            <h3 class="box-title">Data filter & download</h3>
        </div> -->
    
        <form method="post" name="proses" action="<?=site_url('filter_download/filter')?>" >
        
        <div class="box-body table-responsive" style="padding: 20px; background-color: white; width: 50%px; display: inline-block;" >	
			<!-- <h4>Filter Data</h4> -->
            <input type="date" name="tgl_awal" placeholder="Tanggal awal" >
            <input type="date" name="tgl_akhir" placeholder="Tanggal akhir">
            <input type="submit" class="btn btn-primary btn-flat-xs" name="filter" value="Filter">            
            <!-- <input type="submit" class="btn btn-success btn-flat-xs" name="excel" formaction="<?=site_url('filter_download/excel')?>" value="Download"> -->

		</div>
        <div  class="box-body table-responsive pull-right" style="padding: 20px; width: 50%px; background-color: white; display: inline-block;" >	
			<!-- <h4>Filter Data</h4> -->
            <input type="date" name="tgl_awal2" placeholder="Tanggal awal" >
            <input type="date" name="tgl_akhir2" placeholder="Tanggal akhir">
            <input type="submit" class="btn btn-success btn-flat-xs" name="excel" formaction="<?=site_url('filter_download/excel')?>" value="Download">
		</div>
       

        <div class="box-body table-responsive">
            
            <table class="table table-bordered table-striped analisis" id="table1"  style="width: 100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Rekomendasi</th>
                        <th class="text-center">Kegiatan</th>
                        <th class="text-center">Unit PIC</th>
                        <th class="text-center">Batas Waktu</th>
                        <th class="text-center">Tanggapan</th>
                        <th class="text-center">File</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tanggapan KI</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                <?php $no=1;
                    foreach($row->result() as $key =>$data) { ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$data->rekomendasi?></td>
                        <td><?=$this->fungsi->get_kegiatan($data->activities_id)?></td>
                        <td><?=$data->support?></td>
                        <td><?=$data->deadline?></td>
                        <td><?=$data->comment?></td>
                        <td><?=$data->file?></td>
                        <td><?=$this->fungsi->get_status($data->status_id)?></td>
                        <td><?=$data->komentar_ki?></td>
                    </tr>

                    <?php } ?>

                </tbody>
                </tbody>
            </table>
        </div>
        </form>
    </div>
</section>



