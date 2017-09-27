<?php require_once('../connections/con_gl.php'); ?>
<?php
$kon = $_GET['kontrak'];
//echo $kon."<br>";
// get list kendaraan
mysql_select_db($database_con_gl, $con_gl);
$query_kkontrak = "select b.id as jenisid, b.tipekendaraan, c.nopolisi, harga, diskon, total, transaksi from gl_dkontrak a, gl_tipekendaraan b, gl_masterkendaraan c where a.kendaraan = c.nopolisi AND b.id = c.tipekendaraan AND a.kontrak = '$kon' order by a.id";
$kkontrak = mysql_query($query_kkontrak, $con_gl) or die(mysql_error());
$row_kkontrak = mysql_fetch_assoc($kkontrak);
// --
mysql_select_db($database_con_gl, $con_gl);
$query_satuan = "SELECT id, satuan FROM gl_satuan ORDER BY satuan ASC";
$satuan = mysql_query($query_satuan, $con_gl) or die(mysql_error());
$row_satuan = mysql_fetch_assoc($satuan);
$totalRows_satuan = mysql_num_rows($satuan);
// --- get biaya
$query_getbiaya = "select biaya,pajak,total from gl_kontrak where no='$kon'";
$getbiaya = mysql_query($query_getbiaya, $con_gl) or die(mysql_error());
$row_getbiaya = mysql_fetch_assoc($getbiaya);
// -- get akun
mysql_select_db($database_con_gl, $con_gl);
$query_klasbeban = "SELECT * FROM gl_klas WHERE gl_klas.tipe=10";
$klasbeban = mysql_query($query_klasbeban, $con_gl) or die(mysql_error());
$row_klasbeban = mysql_fetch_assoc($klasbeban);
$totalRows_klasbeban = mysql_num_rows($klasbeban);

mysql_select_db($database_con_gl, $con_gl);
$query_klasbeban2 = "SELECT * FROM gl_klas WHERE gl_klas.tipe=9";
$klasbeban2 = mysql_query($query_klasbeban2, $con_gl) or die(mysql_error());
$row_klasbeban2 = mysql_fetch_assoc($klasbeban2);
$totalRows_klasbeban2 = mysql_num_rows($klasbeban2);
// --- default akun
mysql_select_db($database_con_gl, $con_gl);
$query_getbpajak = "SELECT a_beb, a_paj from gl_company";
$getbpajak = mysql_query($query_getbpajak, $con_gl) or die(mysql_error());
$row_getbpajak = mysql_fetch_assoc($getbpajak);
$totalRows_getbpajak = mysql_num_rows($getbpajak);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">

          <tr>

            <th  width="8%"><strong>Daftar Kendaraan</strong></th>

            <!-- <th width="5%" align="center"><strong>Satuan</strong></th>

            <th width="5%" align="center"><strong>Jumlah</strong></th> -->

            <th width="8%" align="center"><strong>Harga hhSatuan </strong></th>

            <th width="5%" align="center"><strong>Diskon</strong></th>

            <th width="6%" align="center"><strong>Total</strong></th>

            <th align="center"><strong>Transaksi</strong></th>
          </tr>
		  <?php do { ?>
          <?php
		  // get akun otomatis

		  $query_akunbarang = "select distinct c.ak_jual, b.id from gl_jenbar a, gl_barang b, gl_kelompok c where a.jenis='$row_kkontrak[jenisid]' AND a.barang = b.id AND b.kelompok = c.id AND b.barang LIKE '%Kontrak%'"; 
//		  $query_akunbarang = "select distinct b.ak_jual, a.id from gl_barang a, gl_kelompok b where a.kelompok = b.id AND a.barang LIKE '%Kontrak%'"; echo $query_akunbarang2."<br>";
		  $akunbarang = mysql_query($query_akunbarang, $con_gl) or die(mysql_error());
		  $row_akunbarang = mysql_fetch_assoc($akunbarang);
		  ?>
          <tr valign="top" bgcolor="#FFFFFF">

            <td align="left" style="background:none;border:none;"><label id="divListKendaraan">

              <select name="kendaraan[]" id="kendaraan[]" style="width:100%;">

                  <option value="">Pilih Kendaraan</option>.
                  <option value="<?php echo $row_kkontrak['nopolisi'];?>" selected="selected"><?php echo $row_kkontrak['tipekendaraan'];?>-( <?php echo $row_kkontrak['nopolisi'];?> )</option>
              </select>

            </label>
			<input type="hidden" name="satuan[]" value="5" />
			<input type="hidden" name="jumlah[]" value="1" />			</td>

            <!-- <td align="center" style="background:none;border:none;"><label>

              <select name="satuan[]" id="satuan[]">

                <?php

do {  

?>

                <option value="<?php echo $row_satuan['id']?>"><?php echo $row_satuan['satuan']?></option>

                <?php

} while ($row_satuan = mysql_fetch_assoc($satuan));

  $rows = mysql_num_rows($satuan);

  if($rows > 0) {

      mysql_data_seek($satuan, 0);

	  $row_satuan = mysql_fetch_assoc($satuan);

  }

?>

              </select>

            </label></td>

            <td align="center" style="background:none;border:none;"><label>

              <input name="jumlah[]" type="text" id="jumlah[]" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);" value="1" size="5" maxlength="5" readonly="readonly"/>

            </label></td> -->

            <td align="center" style="background:none;border:none;"><label id="divHargaKendaraan">

              <input name="hargasatuan[]" type="text" id="hargasatuan[]" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);" value="<?php echo $row_kkontrak['harga'];?>" size="10" maxlength="10" readonly="readonly"/>

            </label></td>

            <td align="center" style="background:none;border:none;"><label>

              <input name="diskon[]" type="text" id="diskon[]" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);" value="<?php echo $row_kkontrak['diskon'];?>" size="2" maxlength="3" readonly="readonly"/>

              </label>

              %</td>

            <td align="center" style="background:none;border:none;"><label>

              <input name="total[]" type="text" id="total[]" value="<?php echo $row_kkontrak['total'];?>" size="10" maxlength="15" readonly="readonly"/>

            </label></td>

            <td align="center" style="background:none;border:none;"><label>

              <textarea name="transaksi[]" cols="30" rows="2" readonly="readonly" id="transaksi[]"><?php echo $row_kkontrak['transaksi'];?></textarea>

              <input name="akun_jual[]" type="hidden" id="akun_jual[]" value="<?php echo $row_akunbarang['ak_jual'];?>">
              <input name="barang[]" type="hidden" id="barang[]" value="<?php echo $row_akunbarang['id'];?>">
            </label></td>
          </tr>
		 <?php }while($row_kkontrak = mysql_fetch_assoc($kkontrak)); ?>
         <tr valign="top" bgcolor="#FFFFFF">
           <td align="left" style="background:none;border:none;">&nbsp;</td>
           <!--<td align="center" style="background:none;border:none;">&nbsp;</td>
           <td align="center" style="background:none;border:none;">&nbsp;</td>-->
           <td align="right" style="background:none;border:none;">&nbsp;</td>
           <td align="right" style="background:none;border:none;">Biaya Done:</td>
           <td align="center" style="background:none;border:none;"><label>
             <input name="biaya" type="text" id="biaya" value="<?php echo intval($row_getbiaya['biaya']);?>" size="10" maxlength="15" readonly="readonly"/>
           </label></td>
           <td align="left" style="background:none;border:none;"><label></label></td>
         </tr>
         <tr align="left" valign="top" bgcolor="#FFFFFF">
           <td style="background:none;border:none;">&nbsp;</td>
          <!-- <td style="background:none;border:none;">&nbsp;</td>
           <td style="background:none;border:none;">&nbsp;</td> -->
           <td style="background:none;border:none;">&nbsp;</td>
           <td align="right" style="background:none;border:none;">PPN :</td>
           <td style="background:none;border:none;"><label>
             <input name="pajak" type="text" id="pajak" value="<?php echo intval($row_getbiaya['pajak']);?>" size="10" maxlength="15" readonly="readonly"/>
           </label></td>
           <td style="background:none;border:none;"><label></label></td>
         </tr>
         <tr valign="top" bgcolor="#FFFFFF">
            <td align="left" style="background:none;border:none;">&nbsp;</td>
           <!-- <td align="center" style="background:none;border:none;">&nbsp;</td>
            <td align="center" style="background:none;border:none;">&nbsp;</td> -->
            <td align="right" style="background:none;border:none;">&nbsp;</td>
            <td align="right" style="background:none;border:none;">Total :</td>
            <td align="center" style="background:none;border:none;"><label>
              <input name="ntotal" type="text" id="ntotal" value="<?php echo intval($row_getbiaya['total']);?>" size="10" maxlength="15" readonly="readonly"/>
            </label></td>
            <td align="center" style="background:none;border:none;">&nbsp;</td>
          </tr>
        </table>
