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

mysql_select_db($database_con_gl, $con_gl);
$query_tr = "SELECT gl_trans.id, gl_trans.total, gl_trans.jumlah, gl_trans.hargasatuan, gl_trans.transaksi, gl_akun.akun, gl_akun.id as akun_id, gl_barang.id as brg_id, gl_barang.barang, gl_satuan.satuan FROM gl_trans, gl_akun, gl_barang, gl_satuan WHERE gl_akun.id = gl_trans.akun AND gl_barang.id = gl_trans.barang AND gl_satuan.id = gl_trans.satuan AND gl_trans.no_ref='$nref' AND gl_trans.retur='1' ORDER BY gl_trans.id desc";
$tr = mysql_query($query_tr, $con_gl) or die(mysql_error());
$row_tr = mysql_fetch_assoc($tr);
$totalRows_tr = mysql_num_rows($tr);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">

  <tr>
    <th width="28%" align="center"><strong>Barang</strong></th>
    <th width="9%" align="center"><strong>Satuan</strong></th>
    <th width="8%" align="center"><strong>Jumlah</strong></th>
    <th width="10%" align="center"><strong>Harga Satuan </strong></th>
    <th width="7%" align="center"><strong>Diskon</strong></th>
    <th width="7%" align="center"><strong>Total</strong></th>
    <th width="23%" align="center"><strong>Transaksi</strong></th>
    <th width="15%" align="center"><strong>Aksi</strong></th>
  </tr>
  <?php if($totalRows_tr > 0) { ?>
  <?php do { ?>
  <?php if($id_x == $row_tr['id']) { ?>
      <tr valign="top" bgcolor="#FFFFFF">
        <td width="28%" align="center" ><label>
          <select name="barang" id="barang" style="width:400px;" onChange="cekReturPembelianAvailable();" disabled="disabled">
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
            <option value="<?php echo $row_getpro['id']; ?>" title="<?php echo $row_getpro['keterangan']; ?>" <?php if($row_getpro['id'] == $row_getvalue['barang']) { ?>selected="selected"<?php } ?>>-<?php echo $row_getpro['barang']; ?></option>
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
        <td width="9%" align="center" ><label>
          <select name="satuan" id="satuan" onChange="cekReturPembelianAvailable();" disabled="disabled">
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
        <td width="8%" align="center" ><label>
          <input name="jumlah" type="text" id="jumlah" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);" value="<?php echo $row_getvalue['jumlah']; ?>" size="5" maxlength="5"/>
        </label></td>
        <td width="10%" align="center" ><label>
          <input name="hargasatuan" type="text" id="hargasatuan" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);" value="<?php echo $row_getvalue['hargasatuan']; ?>" size="10" maxlength="10"/>
        </label></td>
        <td width="7%" align="center" ><label>
        <input name="diskon" type="text" id="diskon" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);" value="<?php echo $row_getvalue['diskon']; ?>" size="5" maxlength="5"/>
        </label></td>
        <td width="7%" align="center" ><label>
          <input name="total" type="text" id="total" onchange="javascript:if(this.value &gt; 0) { this.form.debet.value='';}else{ alert('Value invalid !!!');this.value='';}" value="<?php echo $row_getvalue['total']; ?>" size="10" maxlength="15"/>
        </label></td>
        <td width="23%" align="center" ><label>
          <textarea name="transaksi" cols="40" rows="2" id="transaksi"><?php echo $row_getvalue['transaksi']; ?></textarea>
        </label></td>
        <td width="15%" align="center" ><label></label>
          <div id="boxRetur">
            <label></label>
            <label>
            <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxManageReturPembelian('Simpan',<?php echo $id_x; ?>);" class="checkbutton" title="Simpan Transaksi"/>
            <input name="xx_ref" type="hidden" id="xx_ref" value="<?php echo $row_getvalue['r_ref']; ?>" />
            </label>
          </div></td>
      </tr>
	  <?php }else{ ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td width="28%" align="center" ><?php echo $row_tr['brg_id']; ?> - <?php echo $row_tr['barang']; ?></td>
      <td width="9%" align="center" ><?php echo $row_tr['satuan']; ?></td>
      <td width="8%" align="center" ><?php echo $row_tr['jumlah']; ?></td>
      <td width="10%" align="right" ><?php echo number_format($row_tr['hargasatuan'],0,',','.').",-"; ?></td>
      <td width="7%" align="center" ><?php echo $row_tr['diskon']; ?>%</td>
      <td width="7%" align="right" ><?php echo number_format($row_tr['total'],0,',','.').",-"; ?></td>
      <td width="23%" align="center" ><?php echo $row_tr['transaksi']; ?></td>
      <td align="center" ><label>
        <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxEditFormReturPembelian(<?php echo $row_cek_retur['id']; ?>);" class="editbutton" title="Edit Transaksi"/>
        </label>
          <label>
          <input name="delete" type="button" id="delete" value="&nbsp;" title="Hapus Retur" onclick="ajaxManageReturPembelian('Hapus',<?php echo $row_cek_retur['id']; ?>,'');" class="deletebutton"/>
          <input name="xx_ref" type="hidden" id="xx_ref" value="0" />
        </label></td>
    </tr>
	<?php } ?>
    <?php } while ($row_tr = mysql_fetch_assoc($tr)); ?>
	<?php } ?>
</table>
<?php
mysql_free_result($getvalue);
?>
