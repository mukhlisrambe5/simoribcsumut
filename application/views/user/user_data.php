<section class="content-header">
    <h1>Users
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Users</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Users</h3>
            <div class="pull-right">
                <a href="<?=site_url('user/add')?>" class="btn btn-primary btn-flat">
                <i class="fa fa-user-plus"> Tambah Data</i></a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Unit</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    $no= 1;
                    foreach($row->result() as $key =>$data){ ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$data->user_name?></td>
                        <td><?=$data->username?></td>
                        <td><?=$data->password?></td>
                        <td><?=$data->level =="1" ? "Admin" : "Unit/Seksi"?></td>
                        <td class="text-center" width="160px">

                            <form action="<?=site_url('user/del')?>" method="post"> 
                            
                                <a href="<?=site_url('user/edit/' .$data->user_id)?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Update</a>
                            
                                <input type="hidden" name="user_id" value="<?=$data->user_id?>">
                                <button onclick="return confirm('Apakah Anda yakin akan menghapus data?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"> </i> Delete
                                </button>
                            </form>

                            
                        </td>
                    </tr>
                    <?php }    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>