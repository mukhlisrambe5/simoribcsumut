<section class="content-header">
  <h1>  Recommendations
    <small> </small>
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
            <h3 class="box-title">Data Semua Rekomendasi</h3>
            
        </div>
        <div class="box-body table-responsive">
            
            
            <table class="table table-bordered table-striped" id="table1" style="width: 100%">
                <thead>
                
                    <tr>
                        <th>#</th>
                        <th>Rekomendasi</th>
                        <th>Kegiatan</th>
                        <th>Unit Pendukung</th>
                        <th>Batas Waktu</th>
                        <th>Tanggapan</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>Tanggapan KI</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('#table1').DataTable({
            "processing" : true,
            "serverSide" : true,
            "ajax" : {
                "url" : "<?=site_url('rekoms_unit/get_ajax')?>",
                "type" : "POST"
            },
            // buttons : [
			// 	{
			// 		extend :'pdf',
			// 		orientation : 'landscape',
			// 		pageSize : 'Legal',
			// 		title : 'Data Pemeriksaan',
			// 		download : 'open'
			// 	},
			// 	'csv','excel', 'print','copy'
			// ],
            // columnDefs : [
			// 		{
			// 			"searchable" : false,
			// 			"orderable" : false,
			// 			"targets" : 9,
			// 		}
			// 	]
        });
    });
</script>


