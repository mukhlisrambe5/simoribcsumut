<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Rekomendasi</title>
</head>
<body>
<section class="content">

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Print Data Rekomendasi</h3>
    </div>
    <div class="box-body table-responsive">
        
        <table class="table table-bordered table-striped" id="table1" style="width: 100%">
            <thead>
            
                <tr>
                    <th>No</th>
                    <th>Rekomendasi</th>
                    <th>Kegiatan</th>
                    <th>Unit PIC</th>
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
        "processing": false,
        "serverSide": true,
        "ajax": {
            "url" : "<?=site_url('rekoms/get_ajax')?>",
            "type" : "POST"
        }
      });
  });
</script>




</body>
</html>