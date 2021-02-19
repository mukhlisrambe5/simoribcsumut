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
                <a href="<?=site_url('proses')?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Back</a>
            </div>
        </div>
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-4 col-md-offset-4"> 
                
                <form action="<?=site_url('proses/process')?>" method="post">

                        <div class="form-group">
                            <label for="">Rekomendasi *</label>
                            <input type="hidden" name="rekom_id" value="<?=$row->rekom_id ?? Uuid::uuid4()->toString(); ?>" class="form-control" readonly>
                            <textarea name="rekomendasi" id="" cols="30" rows="10" value="<?=$row->rekomendasi?>" class="form-control" required><?=$row->rekomendasi?></textarea>
                            
                        </div>  
                       
                        <div class="form-group ">
                            <label for="name">Kegiatan *</label>
                            <select name="activities" class="form-control">
                                <!-- <option value="">-Pilih-</option> -->
                                <?php foreach($activities->result() as $key =>$data) { ?>
                                    <option value="<?=$data->activities_id;?>" <?=$data->activities_id == $row->activities_id ? "selected" : null ?>><?=$data->activities_name;?></option>
                                <?php    } ?>
                            </select>
                        </div> 
                                                

                        <div class="form-group ">
                            <label for="user">Unit In Charge *</label>
                            <?php echo form_dropdown('user', $user,$selecteduser, 
                            ['class'=>'form-control', 'required'=>'required']) ?>
                        </div> 

                        <div class="form-group">
                            <label for="">Unit Pendukung <small>(kosongkan jika tidak ada) </small></label>
                            <input type="text" name="support" value="<?=$row->support?>" class="form-control">
                        </div>
                                                
                        <div class="form-group">
                            <label for="">deadline *</label>
                            <input type="date" name="deadline" value="<?=$row->deadline?>" class="form-control" required>
                        </div>  

                        <div class="form-group ">
                            <label for="status_id">Status *</label>
                            <?php echo form_dropdown('status', $status,$selectedstatus, 
                            ['class'=>'form-control', 'required'=>'required']) ?>
                        </div> 
                        
                        <div class="form-group">
                            <label for="">Komentar KI <small>(kosongkan jika tidak ada) </small></label>
                            <input type="text" name="komentar_ki" value="<?=$row->komentar_ki?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" name= "<?=$page?>" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i>
                            Save</button>
                            <button type="reset" class="btn  btn-flat">Reset</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
