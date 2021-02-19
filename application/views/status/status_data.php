<section class="content-header">
  <h1>  Status
    <small>tindak lanjut</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Status</li>
  </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data status</h3>
            <div class="pull-right">
                <a href="<?=site_url('status/add')?>" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Tambah data</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Status</th>
                        <th>Informasi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                    
                <tbody>
                    <?php $no=1;
                    foreach($row->result() as $key =>$data) { ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$data->status_name?></td>
                        <td><?=$data->info?></td>
                        <td class="text-center" width="160px">
                            <a href="<?=site_url('status/edit/' .$data->status_id)?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Update</a>
                            <a href="<?=site_url('status/del/' .$data->status_id)?>" onclick= "return confirm('Apakah Anda yakin akan megahpus data?')" class="btn btn-danger btn-xs"><i class="fa fa-pencil"></i> Delete</a>         
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
