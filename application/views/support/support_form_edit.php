<?php 
    use Ramsey\Uuid\Uuid;
?>
<section class="content-header">
    <h1>Supports
        <small>Dukungan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Supports</li>
    </ol>
</section>


<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Update data</h3>
            <div class="pull-right">
                <a href="<?=site_url('support')?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Back</a>
            </div>
        </div>
        
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-4 col-md-offset-4"> 
                
                    <form action="" method="post">
                        <div class="form-group <?=form_error('support_name') ? 'has-error' : null?>">
                        <label for="">Nama Unit Pendukung *</label>
                            <input type="hidden" name="support_id" value="<?=$row->support_id?>">
                            <input type="text" name="support_name" value="<?=$this->input->post('support_name') ?? $row->support_name?>" class="form-control">
                            <?=form_error('support_name')?>
                        </div>
                        <div class="form-group <?=form_error('info') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="info" value="<?=$this->input->post('info') ?? $row->info?>" class="form-control">
                            <?= form_error('info')?>
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






