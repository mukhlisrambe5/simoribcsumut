<?php 
    use Ramsey\Uuid\Uuid;
?>
<section class="content-header">
    <h1>Change Password
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Change Password</li>
    </ol>
</section>


<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Ubah Password</h3>
           
        </div>
        
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-4 col-md-offset-4"> 
                
                    <form action="<?=site_url('change/edit')?>" method="post">
                        
                        <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
                        <label for="">Password Baru*</label>
                            <input type="password" name="password" value="<?=$this->input->post('password') ?>" class="form-control">
                            <?=form_error('password')?>
                        </div>
                        <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                        <label for="">Konfirmasi Password *</label>
                        <input type="password" name="passconf" value="<?=$this->input->post('password') ?>" class="form-control">
                        <?=form_error('passconf')?>
                        </div>
                        
                        <div class="form-group">
                            <input type="hidden" name="user_id" value="<?=$this->fungsi->user_login()->user_id?>" readonly>
                            <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i>
                            Simpan</button>
                            <button type="reset" class="btn  btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






