<?php 
    use Ramsey\Uuid\Uuid;
?>
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
            <h3 class="box-title">Tambah User</h3>
            <div class="pull-right">
                <a href="<?=site_url('user')?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Back</a>
            </div>
        </div>
        
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-4 col-md-offset-4"> 
                
                    <form action="" method="post">
                        <div class="form-group <?=form_error('user_name') ? 'has-error' : null?>">
                        <label for="">Nama Unit *</label>
                            <input type="hidden" name="user_id" value="<?=Uuid::uuid4()->toString();?>">
                            <input type="text" name="user_name" value="<?=set_value('user_name')?>" class="form-control">
                            <?=form_error('user_name')?>
                        </div>
                        <div class="form-group <?=form_error('username') ? 'has-error' : null ?>">
                        <label for="">Username *</label>
                            <input type="text" name="username" value="<?=set_value('username')?>" class="form-control">
                            <?= form_error('username')?>
                        </div>
                        <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
                        <label for="">Password *</label>
                            <input type="password" name="password" value="<?=set_value('password')?>" class="form-control">
                            <?=form_error('password')?>
                        </div>
                        <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                        <label for="">Konfirmasi Password *</label>
                        <input type="password" name="passconf" value="<?=set_value('passconf')?>" class="form-control">
                        <?=form_error('passconf')?>
                        </div>
                        <div class="form-group <?=form_error('level') ? 'has-error' : null?>">
                        <label for="">Level *</label>
                            <select name="level" value="<?=set_value('level')?>" class="form-control">
                            <option value="">-Pilih-</option>
                            <option value="1" <?=set_value('level')== '1' ? 'selected' : null?>>Admin</option>
                            <option value="2" <?=set_value('level')== '2' ? 'selected' : null?>>Unit/Seksi</option>
                            </select>
                            <?=form_error('level')?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i>
                            Simpan</button>
                            <button type="reset" class="btn  btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






