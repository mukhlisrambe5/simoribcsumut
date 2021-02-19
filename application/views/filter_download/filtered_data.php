<section class="content-header">
  <h1>  Filter & download
    <small> </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
    <li class="active"></li>
  </ol>
</section>

<section class="content">

   <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data filtered</h3>
            
        </div>
        
		<!-- <div  class="box-body table-responsive" >	
			<h4>Filter Data</h4>
            <input type="date" name="tgl_awal" placeholder="Tanggal awal" >
            <input type="date" name="tgl_akhir" placeholder="Tanggal akhir">
            <input type="submit" class="btn btn-primary btn-flat-xs" name="filter" value="Submit" onclick="filter()">
            <!-- <button type="submit" name="filter" class="btn btn-success btn-flat-xs"><i class="fa fa-paper-plane"></i> Filter</button> -->


		</div> -->
        <div class="box-body table-responsive">
            
            
            <table class="table table-bordered table-striped" id="table1" style="width: 100%">
                <thead>
                
                    <tr>
                        <th>#</th>
                        <th class="text-center">No. PIB</th>
                        <th class="text-center">Tgl. PIB</th>
                        <th class="text-center">Importir</th>
                        <th class="text-center">Analis</th>
                        <th class="text-center">Analisis Mendalam</th>
                        <th class="text-center">Alasan</th>
                        <th class="text-center">Putusan STPI</th>
                        <th class="text-center">Alasan</th>
                        <th class="text-center">No_STPI</th>
                        <th class="text-center">Tgl STPI</th>
                        <th>Dokumen STPI</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1;
                    foreach($row->result() as $key =>$data) { ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$data->no_pib?></td>
                        <td><?=tgl_indo($data->tgl_pib)?></td>
                        <td><?=$data->importir?></td>
                        <td><?=$data->analis?></td>
                        <td><?=$data->putusan_analisis?></td>
                        <td><?=$data->alasan_analisis?></td>
                        <td><?=$data->putusan_stpi?></td>
                        <td><?=$data->alasan_stpi?></td>
                        <td><?=$data->no_stpi?></td>
                        <td><?=tgl_indo($data->tgl_stpi)
                        ?></td>
                        <td><?=$data->dokumen_stpi?></td>
                        <td><?=$data->keterangan_analis?></td>
                    </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
        </form>
    </div>
</section>


<!-- <script type="text/javascript">
		$(document).ready(function () {
			$('#table1').DataTable({
			"processing" : true,	
			buttons : [
				{
					extend :'pdf',
					orientation : 'landscape',
					pageSize : 'Legal',
					title : 'Data Analisis',
					download : 'open'
				},
				'excel', 'print','copy'
			],
			columnDefs: [
					{
						"searchable":false,
						"orderable": false,
						"targets" : [0,13],
					}
				],
				"order": [0,"asc"],
				dom : 'lBfrtip'
			});
			
			
		})
	
	</script> -->

    // <!-- <script>
//     $(document).ready(function(){
//         $('#table1').DataTable({
//             "processing" : true,
//             "serverSide" : true,
//             "ajax" : {
//                 "url" : "<?=site_url('filter_download/get_ajax')?>",
//                 "type" : "POST"
//             },
            
//         });
//     });
// </script> -->