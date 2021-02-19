
<section class="content-header">
    <h1>Suggestion
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Suggestion</li>
    </ol>
</section>


<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Saran/Masukan</h3>
            
        </div>
        
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-4 "> 
                
                    <form action="<?=site_url('suggest/add')?>" method="post">
                        <div class="form-group">
                            <label for=""></label><br>
                           
                            <textarea name="suggest_name" cols="100" rows="10" class="form-control" required></textarea>                            
                        </div>  
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"></i>
                            Kirim</button>
                            <button type="reset" class="btn  btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






