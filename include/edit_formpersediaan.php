<?php require_once('../connections/con_gl.php'); ?>
<?php
$sat = $_GET[satuan];
$brg = $_GET[barang];
$gud = $_GET[gudang];
$jum = intval($_GET[jumlah]);
$hrgsat = $_GET[hargasatuan];
$nref = $_GET['noreferensi'];
$trans = $_GET['transaksi'];
//$nilai = intval($_GET['nilai']);
$total = intval($_GET['total']);
$ak = $_GET['akun'];
$rul = $_GET['rules'];
$id_x = $_GET['refid'];
$tnilai = 0;

mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT kd, klasifikasi, keterangan, neraca, ruglab tipe FROM gl_klas ORDER BY kd,klasifikasi ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);

mysql_select_db($database_con_gl, $con_gl);
$query_satuan = "SELECT id, satuan FROM gl_satuan ORDER BY satuan ASC";
$satuan = mysql_query($query_satuan, $con_gl) or die(mysql_error());
$row_satuan = mysql_fetch_assoc($satuan);
$totalRows_satuan = mysql_num_rows($satuan);

mysql_select_db($database_con_gl, $con_gl);
$query_kelom = "SELECT id, kelompok FROM gl_kelompok ORDER BY kelompok ASC";
$kelom = mysql_query($query_kelom, $con_gl) or die(mysql_error());
$row_kelom = mysql_fetch_assoc($kelom);
$totalRows_kelom = mysql_num_rows($kelom);

mysql_select_db($database_con_gl, $con_gl);
$query_getvalue = "SELECT * FROM gl_trans WHERE gl_trans.id='$id_x'";
$getvalue = mysql_query($query_getvalue, $con_gl) or die(mysql_error());
$row_getvalue = mysql_fetch_assoc($getvalue);
$totalRows_getvalue = mysql_num_rows($getvalue);

if($nref <>'' AND $ak <>'' AND $brg<>'' AND $sat<>'' AND $gud<>'' AND $jum<>0 AND $total<>0 OR $hrgsat<>0 OR $trans<>'')
  if($rul=='Tambah') {
  mysql_select_db($database_con_gl, $con_gl);
$query_get_ak_sedia = "SELECT gl_kelompok.ak_sedia, gl_barang.kelompok FROM gl_kelompok, gl_barang WHERE gl_barang.id='$brg'  AND gl_barang.kelompok = gl_kelompok.id";
$get_ak_sedia = mysql_query($query_get_ak_sedia, $con_gl) or die(mysql_error());
$row_get_ak_sedia = mysql_fetch_assoc($get_ak_sedia);
$totalRows_get_ak_sedia = mysql_num_rows($get_ak_sedia);
  mysql_select_db($database_con_gl, $con_gl);
  $addquery = "INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun, barang, jumlah, satuan, hargasatuan) VALUES (NULL, '$nref', '$trans', '$total', 'D', '$row_get_ak_sedia[ak_sedia]', '$brg', '$jum', '$sat', '$hrgsat'),\n(NULL, '$nref', '$trans', '$total', 'K', '$ak', '$brg', '$jum', '$sat', '$hrgsat');";
  mysql_query($addquery, $con_gl);
  
  mysql_select_db($database_con_gl, $con_gl);
$query_stockcek = "SELECT gl_stok.id, gl_stok.stok FROM gl_stok WHERE gl_stok.gudang='$gud' AND gl_stok.barang='$brg'  AND gl_stok.satuan='$sat'";
$stockcek = mysql_query($query_stockcek, $con_gl) or die(mysql_error());
$row_stockcek = mysql_fetch_assoc($stockcek);
$totalRows_stockcek = mysql_num_rows($stockcek);
if($totalRows_stockcek > 0) {
$stoknow = $jum + $row_stockcek['stok'];
$stokquery = "update gl_stock set stok='$stoknow' where id='$row_stockcek[id]'";
}else{
$stokquery = "INSERT INTO gl_stok (id, gudang, barang, satuan, stok) VALUES (NULL, '$gud', '$brg', '$sat', '$jum')";
}
mysql_select_db($database_con_gl, $con_gl);
mysql_query($stokquery, $con_gl);
}

 mysql_select_db($database_con_gl, $con_gl);
$query_tr = "SELECT gl_trans.id, gl_trans.total, gl_trans.jumlah, gl_trans.hargasatuan, gl_trans.transaksi, gl_akun.akun, gl_akun.id as akun_id, gl_barang.id as brg_id, gl_barang.barang, gl_satuan.satuan FROM gl_trans, gl_akun, gl_barang, gl_satuan WHERE gl_akun.id = gl_trans.akun AND gl_barang.id = gl_trans.barang AND gl_satuan.id = gl_trans.satuan AND gl_trans.no_ref='$nref' AND gl_trans.pos='K' ORDER BY gl_trans.id desc";
$tr = mysql_query($query_tr, $con_gl) or die(mysql_error());
$row_tr = mysql_fetch_assoc($tr);
$totalRows_tr = mysql_num_rows($tr);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">

  <tr>
    <th width="28%" align="center"><strong>Barang</strong></th>
    <th width="10%" align="center"><strong>Satuan</strong></th>
    <th width="10%" align="center"><strong>Jumlah</strong></th>
    <th width="10%" align="center"><strong>Harga Satuan</strong></th>
    <th width="10%" align="center"><strong>Total</strong></th>
    <th align="center"><strong>Transaksi</strong></th>
    <th width="10%" align="center"><strong>Aksi</strong></th>
  </tr>
  <?php if($totalRows_tr > 0) { ?>
  <?php do { ?>
  <?php if($id_x == $row_tr['id']) { ?>
      <tr valign="top" bgcolor="#FFFFFF">
        <td width="28%" align="center"><label>
          <select name="barang" id="barang" style="width:400px;">
            <?php
do {  
mysql_select_db($database_con_gl, $con_gl);
$query_getpro = "SELECT id, barang, keterangan FROM gl_barang where kelompok='$row_kelom[id]' order by barang";
$getpro = mysql_query($query_getpro, $con_gl) or die(mysql_error());
$row_getpro = mysql_fetch_assoc($getpro);
$totalRows_getpro = mysql_num_rows($getpro);
?>
            <?php
 if($totalRows_getpro  > 0) { ?>
            <option value="" style="background:#DDDDDD;font-weight:bold;"><?php echo $row_kelom['kelompok']?></option>
            <?php do { ?>
            <option value="<?php echo $row_getpro['id']; ?>" title="<?php echo $row_getpro['keterangan']; ?>" <?php if($row_getpro['id'] == $row_getvalue['barang']) { ?>selected="selected"<?php } ?>>----- <?php echo $row_getpro['id']; ?> - <?php echo $row_getpro['barang']; ?></option>
            <?php }  while ($row_getpro = mysql_fetch_assoc($getpro)); ?>
            <?php } ?>
            <?php
} while ($row_kelom = mysql_fetch_assoc($kelom));
  $rows = mysql_num_rows($kelom);
  if($rows > 0) {
      mysql_data_seek($kelom, 0);
	  $row_kelom = mysql_fetch_assoc($kelom);
  }
?>
          </select>
        </label></td>
        <td width="10%" align="center"><label>
          <select name="satuan" id="satuan">
            <?php
do {  
?><option value="<?php echo $row_satuan['id']?>"<?php if (!(strcmp($row_satuan['id'], $row_getvalue['satuan']))) {echo "selected=\"selected\"";} ?>><?php echo $row_satuan['satuan']?></option>
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
        <td width="10%" align="center"><label>
          <input name="jumlah" type="text" id="jumlah" onchange="javascript:this.form.total.value=this.form.jumlah.value * this.form.hargasatuan.value;" value="<?php echo $row_getvalue['jumlah']; ?>" size="5" maxlength="5"/>
        </label></td>
        <td width="10%" align="center"><label>
          <input name="hargasatuan" type="text" id="hargasatuan" onchange="javascript:this.form.total.value=this.form.jumlah.value * this.form.hargasatuan.value;" value="<?php echo $row_getvalue['hargasatuan']; ?>" size="10" maxlength="10"/>
        </label></td>
        <td width="10%" align="center"><label>
          <input name="total" type="text" id="total" onchange="javascript:if(this.value &gt; 0) { this.form.debet.value='';}else{ alert('Value invalid !!!');this.value='';}" value="<?php echo $row_getvalue['total']; ?>" size="10" maxlength="15"/>
        </label></td>
        <td align="center"><label>
          <textarea name="transaksi" cols="40" rows="3" id="transaksi"><?php echo $row_getvalue['transaksi']; ?></textarea>
        </label></td>
        <td width="10%" align="center"><label></label>
            <label>
            <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxManagePenyesuaian('Simpan',<?php echo $row_getvalue['id']; ?>);" class="checkbutton" title="Simpan Transaksi"/>
        </label></td>
      </tr>
	  <?php }else{ ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td width="28%" align="center"><?php echo $row_tr['brg_id']; ?> - <?php echo $row_tr['barang']; ?></td>
      <td width="10%" align="center"><?php echo $row_tr['satuan']; ?></td>
      <td width="10%" align="center"><?php echo $row_tr['jumlah']; ?></td>
      <td width="10%" align="right"><?php echo number_format($row_tr['hargasatuan'],0,',','.').",-"; ?><strong> </strong></td>
      <td width="10%" align="right"><?php echo number_format($row_tr['total'],0,',','.').",-"; ?></td>
      <td align="center"><?php echo $row_tr['transaksi']; ?></td>
      <td width="10%" align="center"><label>
        <button value="<?php echo $row_get_t['id']; ?>" onclick="ajaxEditFormPenyesuaian(<?php echo $row_tr['id']; ?>);" type="button" class="editbutton" title="Edit Transaksi">&nbsp;</button>
      </label><label>
        <input name="hapus" type="button" id="hapus" value="&nbsp;" onclick="ajaxManagePenyesuaian('Hapus',<?php echo $row_tr['id']; ?>);" title="Hapus Transaksi" class="deletebutton"/></label></td>
    </tr>
	<?php } ?>
    <?php } while ($row_tr = mysql_fetch_assoc($tr)); ?>
	<?php } ?>
</table>
<?php
mysql_free_result($getvalue);
?>
