<?php include_once('../_header.php'); 
error_reporting(E_ALL & E_NOTICE & E_USER_NOTICE);
?>
<head>
  <title>Filter Data</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <!-- <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
  </style> -->
  

 </head>
<body style="background-color: whitesmoke; 
background-image:url(<?=base_url('/pict/bg2.png');?>);
height: 100%;
background-repeat: no-repeat;
background-size: cover;
 ">
	

 <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
 <div class="box" style="background-color: white; padding: 15px">
	<div class="box">
		<h1 align="center">Filter Data</h1>
		<div class="table-responsive" >

			<div class="row">
			     <div class="input-daterange">
				      <div class="col-md-4">
				       		<input type="text" name="start_date" id="start_date" class="form-control" placeholder="Tanggal awal" />
				      </div>
				      <div class="col-md-4">
				      		 <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Tanggal akhir" />
				      </div>      
				 </div>
				 
				 <div class="col-md-4">
				      <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
			     </div>
		    </div>

			<table id="order_data" class="table table-striped table-bordered table-hover" id="analisis" width="100%" s>
				<thead>
					<tr >
						<th>No. PIB</th>
						<th>Tanggal PIB</th>
						<th>Pemeriksa</th>
						<th>Hasil Pemeriksaan</th>
						<th>Poin Tidak Sesuai Impor</th>
						<th>Detail</th>
						<th>Hasil Pendampingan</th>
						<th>Poin Tidak Sesuai KI</th>
						<th>Detail</th>
						<th>Hasil Pengawasan</th>
						<th>Poin Tidak Sesuai P2</th>
						<th>Detail</th>
						<th>Tindak Lanjut PFPD</th>
						<th>Keterangan</th>
						
					</tr>
				</thead>
			</table>
		</div>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function(){
			 
			 $('.input-daterange').datepicker({
			  todayBtn:'linked',
			  format: "yyyy-mm-dd",
			  autoclose: true
			 });

			 fetch_data('no');

			 function fetch_data(is_date_search, start_date='', end_date='')
			 {
			  var dataTable = $('#order_data').DataTable({
			   "processing" : true,
			   "serverSide" : true,
			   "ajax" : {
			    url:"fetch.php",
			    type:"POST",
			    data:{
			     is_date_search:is_date_search, start_date:start_date, end_date:end_date
			    }
			   },
			   
			//    buttons : [
			//         {
			//           extend :'pdf',
			//           orientation : 'landscape',
			//           pageSize : 'Legal',
			//           title : 'Data Pemeriksaan',
			//           download : 'open'
			//         },
			//         'csv','excel', 'print','copy'
			//       ],
			    //   columnDefs : [
			    //       {
			    //         "searchable" : false,
			    //         "orderable" : false,
			    //         "targets" : [0,13],
			            
			    //       }
			    //     ],
			        // "order" : [1,"asc"],
			        // dom : 'lBfrtip'
			  });
			 }

			 $('#search').click(function(){
			  var start_date = $('#start_date').val();
			  var end_date = $('#end_date').val();
			  if(start_date != '' && end_date !='')
			  {
			   $('#order_data').DataTable().destroy();
			   fetch_data('yes', start_date, end_date);
			  }
			  else
			  {
			   alert("Both Date is Required");
			  }
			 }); 
			 
			});
		</script>
	</div>
</div>
</body>
<?php include_once('../_footer.php'); ?>