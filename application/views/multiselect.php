<div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <?php 
            $id= @$_GET['id'];
            $sql_analisis=mysqli_query($con, "SELECT * FROM tb_analisis WHERE id_analisis='$id' ") or die (mysqli_error($con));
           $data = mysqli_fetch_array ($sql_analisis);
           $newdata= explode(", ", $data[6]);
            ?>

             <?php 
            if(in_array("Jumlah",  $newdata)) {
                $checkedValue ="checked='checked'";
            }
            if(in_array("Jenis",  $newdata)) {
                $checkedValue1 ="checked='checked'";
            }
            if(in_array("Merek",  $newdata)) {
                $checkedValue2 ="checked='checked'";
            }
            if(in_array("Tipe",  $newdata)) {
                $checkedValue3 ="checked='checked'";
            }
            if(in_array("Negara Asal",  $newdata)) {
                $checkedValue4 ="checked='checked'";
            }
            if(in_array("Tidak diberitahukan",  $newdata)) {
                $checkedValue5 ="checked='checked'";
            }
            if(in_array("Lainnya",  $newdata)) {
                $checkedValue6 ="checked='checked'";
            }
             ?>


            <form action="proses.php" method="post" style="background-color: white;
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 0px;
             ">
                <div class="form-group">
                    <label for="no_pib">Nomor PIB</label>
                    <input type="hidden" name="id" value="<?=$data['id_analisis']?>">
                    <input readonly="readonly" type="number" name="no_pib" id="no_pib" class="form-control" value="<?=$data['no_pib']?>" required autofocus>
                </div>
                <div class="form-group">
                    <label for="tgl_pib">Tanggal_PIB</label>
                    <input readonly="readonly" type="text" name="tgl_pib" class="form-control" value="<?=$data['tgl_pib']?>" required >
                </div> 
                <div class="form-group">
                    <input  type="hidden" name="pemeriksa" id="pemeriksa" class="form-control" value="<?=$data['pemeriksa']?>" required >
                </div>
                <div class="form-group">
                    <label for="simpulan_impor">Hasil Pemeriksaan</label>

                    <select name="simpulan_impor" id="simpulan_impor" class="form-control"> 
                        
                    <option value=" "
                    <?php 
                        if($data["simpulan_impor"] ==  ''){
                            echo "selected";
                        }
                     ?>
                    >  </option>
                    <option value="Sesuai"
                    <?php 
                        if($data["simpulan_impor"] ==  'Sesuai'){
                            echo "selected";
                        }
                     ?>
                    >Sesuai </option>
                    <option value="Tidak Sesuai"
                    <?php 
                        if($data["simpulan_impor"] ==  'Tidak Sesuai'){
                            echo "selected";
                        }
                     ?>
                    >Tidak Sesuai </option> 
                    </select>
                </div>
 
                <div id="checkboxes" class="form-group">
                    <label for="tidak_sesuai_impor">Komponen Tidak Sesuai</label>
                    <br>
                    <input type="checkbox" id="tidak_sesuai_impor" name="tidak_sesuai_impor[]" <?php echo $checkedValue; ?> value="Jumlah"> Jumlah <br>
                    <input type="checkbox" id="tidak_sesuai_impor" name="tidak_sesuai_impor[]" <?php echo $checkedValue1; ?> value="Jenis"> Jenis <br>
                    <input type="checkbox" id="tidak_sesuai_impor" name="tidak_sesuai_impor[]" <?php echo $checkedValue2; ?> value="Merek"> Merek <br>
                    <input type="checkbox" id="tidak_sesuai_impor" name="tidak_sesuai_impor[]" <?php echo $checkedValue3; ?> value="Tipe"> Tipe <br>
                    <input type="checkbox" id="tidak_sesuai_impor" name="tidak_sesuai_impor[]" <?php echo $checkedValue4; ?> value="Negara Asal"> Negara Asal <br>
                    <input type="checkbox" id="tidak_sesuai_impor" name="tidak_sesuai_impor[]" <?php echo $checkedValue5; ?> value="Tidak diberitahukan"> Tidak diberitahukan <br>
                    <input type="checkbox" id="tidak_sesuai_impor" name="tidak_sesuai_impor[]" <?php echo $checkedValue6; ?> value="Lainnya"> Lainnya <br>
                </div>