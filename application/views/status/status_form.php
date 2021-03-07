<section class="content-header">
  <h1>  Status
    <small>Progress</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">Status</li>
  </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Progress</h3>
            <div class="pull-right">
                <a href="<?=site_url('status')?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"></i> Back</a>
            </div>
        </div>
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-4 col-md-offset-4"> 
                
                    <form action="<?=site_url('status/process')?>" method="post">
                        <div class="form-group ">
                            <label for="">Status *</label>
                            <input type="hidden" name="status_id" value="<?=$row->status_id?>">
                            <input type="text" name="status_name" value="<?=$row->status_name?>" class="form-control" required>
                        </div>
                        
                        <div class="form-group ">
                            <label for="">Informasi *</label>
                            <textarea name="info" class="form-control" ><?=$row->info?></textarea>
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
