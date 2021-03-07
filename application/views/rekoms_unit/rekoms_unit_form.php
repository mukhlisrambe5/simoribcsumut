<?php 
    use Ramsey\Uuid\Uuid;
?>

<section class="content-header">
  <h1>  Recommendations
    <small>Rekomendasi </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Recommendations</li>
  </ol>
</section>

<section class="content">
    <?php $this->view('messages') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Recommendations</h3>
            <div class="pull-right">
                <a href="<?=site_url('rekoms_unit')?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Back</a>
            </div>
        </div>
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-4 col-md-offset-4"> 
                
                
                <?php echo form_open_multipart('rekoms_unit/process') ?>

                        <div class="form-group">
                            <label for="">Rekomendasi</label>
                            <input type="hidden" name="rekom_id" value="<?=$row->rekom_id ?? Uuid::uuid4()->toString(); ?>" class="form-control" readonly>
                            <textarea name="rekomendasi" id="" cols="30" rows="10" value="<?=$row->rekomendasi?>" class="form-control" readonly><?=$row->rekomendasi?></textarea>                            
                        </div>  

                        <div class="form-group">
                            <label for="">Kegiatan</label>
                            <input type="text" name="" value="<?=$row->activities_name ?>" class="form-control" readonly>                            
                        </div>  

                        <div class="form-group">
                            <label for="">Unit Pendukung</label>
                            <input type="text" name="" value="<?=$row->support ?>" class="form-control" readonly>                            
                        </div> 

                        <div class="form-group">
                            <label for="">Dateline</label>
                            <input type="data" name="" value="<?=$row->deadline ?>" class="form-control" readonly>                            
                        </div> 

                        <div class="form-group">
                            <label for="">Tanggapan</label>
                            <input type="text" name="comment" value="<?=$row->comment ?>" class="form-control" >                            
                        </div> 
                       
                        <div class="form-group">
                            <label for="">File</label>

                                <?php if($row->file != null) { ?>
                                    <a href="<?=base_url('uploads/'.$row->file)?>"> <?=$row->file?> </a>
                                    
                                <?php } ?>

                            <input type="file" name="file" class="form-control"> 
                            <small>Biarkan kosong jika tidak ingin diganti!</small>                           
                        </div> 

                        <div class="form-group">
                            <label for="">Status Tindaklanjut</label>
                            <input type="text" name="status" value="<?=$row->status_name ?>" class="form-control" readonly>                            
                        </div> 

                        <div class="form-group">
                            <label for="">Komentar KI</label>
                            <input type="text" name="komentar_ki" value="<?=$row->komentar_ki ?>" class="form-control" readonly>                            
                        </div> 
                        

                        <div class="form-group">
                            <button type="submit" name= "<?=$page?>" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i>
                            Save</button>
                            <button type="reset" class="btn  btn-flat">Reset</button>
                        </div>
                <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
