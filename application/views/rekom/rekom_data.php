

<section class="content-header">
  <h1>  Recommendations
    <small>Rekomendasi</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Recommendations</li>
  </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Rekomendasi</h3>
            <div class="pull-right">
                <a href="<?=site_url('rekom/add')?>" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Tambah data</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                
                    <tr>
                        <th>#</th>
                        <th>Rekomendasi</th>
                        <th>Kegiatan</th>
                        <th>Unit PIC</th>
                        <th>Unit Pendukung</th>
                        <th>Batas Waktu</th>
                        <th>Tanggapan</th>
                        <th>File</th>
                        <th>Tanggal upload</th>
                        <th>Status</th>
                        <th>Tanggapan KI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1;
                    foreach($row->result() as $key =>$data) { ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$data->rekomendasi?></td>
                        <td><?=$data->activities_name?></td>
                        <td><?=$data->user_name ?></td>
                        <td><?=$data->support_name ?></td>
                        <td><?=$data->deadline?></td>
                        <td><?=$data->comment?></td>
                        <td><?=$data->file?></td>
                        <td><?=$data->upload_date?></td>
                        <td><?=$data->status_name?></td>
                        <td><?=$data->komentar_ki ?></td>
                        <td class="text-center" width="160px">
                            <a href="<?=site_url('rekom/edit/' .$data->rekom_id)?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Update</a>
                            <a href="<?=site_url('rekom/del/' .$data->rekom_id)?>" onclick= "return confirm('Apakah Anda yakin akan megahpus data?')" class="btn btn-danger btn-xs"><i class="fa fa-pencil"></i> Delete</a>         
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
