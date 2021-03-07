<?php 
    use Ramsey\Uuid\Uuid;
?>
<section class="content-header">
    <h1>Recommendations
        <small>Rekomendasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Recommendations</li>
    </ol>
</section>


<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah data</h3>
            <div class="pull-right">
                <a href="<?=site_url('rekom')?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Back</a>
            </div>
        </div>
        
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-4 col-md-offset-4"> 
                
                    <form action="" method="post">
                        <div class="form-group <?=form_error('rekomendasi') ? 'has-error' : null?>">
                        <label for="">Rekomendasi *</label>
                            <input type="hidden" name="rekom_id" value="<?=Uuid::uuid4()->toString();?>">
                            <input type="text" name="rekomendasi" value="<?=set_value('rekomendasi')?>" class="form-control">
                            <?=form_error('rekomendasi')?>
                        </div>

                        <div class="form-group <?=form_error('activities_name') ? 'has-error' : null?>">
                            <label for="activities_name">Kegiatan *</label>
                            <?php echo form_dropdown('activities_name', $activities, $selected, 
                            ['class'=>'form-control', 'required'=>'required']) ?>
                            <?=form_error('activities_name')?>
                        </div> 

                        <div class="form-group <?=form_error('activities_id') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="activities_id" value="<?=set_value('activities_id')?>" class="form-control">
                            <?= form_error('activities_id')?>
                        </div>

                        <div class="form-group <?=form_error('activities_id') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="activities_id" value="<?=set_value('activities_id')?>" class="form-control">
                            <?= form_error('activities_id')?>
                        </div>

                        <div class="form-group <?=form_error('activities_id') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="activities_id" value="<?=set_value('activities_id')?>" class="form-control">
                            <?= form_error('activities_id')?>
                        </div>

                        <div class="form-group <?=form_error('activities_id') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="activities_id" value="<?=set_value('activities_id')?>" class="form-control">
                            <?= form_error('activities_id')?>
                        </div>

                        <div class="form-group <?=form_error('activities_id') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="activities_id" value="<?=set_value('activities_id')?>" class="form-control">
                            <?= form_error('activities_id')?>
                        </div>

                        <div class="form-group <?=form_error('activities_id') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="activities_id" value="<?=set_value('activities_id')?>" class="form-control">
                            <?= form_error('activities_id')?>
                        </div>

                        <div class="form-group <?=form_error('activities_id') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="activities_id" value="<?=set_value('activities_id')?>" class="form-control">
                            <?= form_error('activities_id')?>
                        </div>

                        <div class="form-group <?=form_error('activities_id') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="activities_id" value="<?=set_value('activities_id')?>" class="form-control">
                            <?= form_error('activities_id')?>
                        </div>

                        <div class="form-group <?=form_error('activities_id') ? 'has-error' : null ?>">
                        <label for="">Informasi </label>
                            <input type="text" name="activities_id" value="<?=set_value('activities_id')?>" class="form-control">
                            <?= form_error('activities_id')?>
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






