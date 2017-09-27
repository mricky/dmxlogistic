<?php require_once('../connections/con_gl.php'); ?>
<?php
$nref = $_GET['noreferensi'];
$tr = $_GET['transaksi'];
$deb = $_GET['debet'];
$kred = $_GET['kredit'];
if(is_numeric($deb)) {
	$pos = "D";
	$tot = $deb;
}else{
	$pos = "K";
	$tot = $kred;
}
$ak = $_GET['akun'];
$rul = $_GET['rules'];
$id_x = $_GET['refid'];
$totdeb = 0;
$totkre = 0;

mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT kd, klasifikasi, keterangan, neraca, ruglab tipe FROM gl_klas ORDER BY kd, klasifikasi ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
  <?php 
  if($rul =='Tambah' AND $nref<>'' AND $tr <>'' AND (is_numeric($deb) XOR is_numeric($kred)) AND $ak <>'') {
	mysql_select_db($database_con_gl, $con_gl);
	$query = "INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$nref', '$tr', '$tot', '$pos', '$ak')";
	$run_query = mysql_query($query, $con_gl);
  }else if($rul =='Simpan' AND $nref<>'' AND $tr <>'' AND $tot > 0 AND $ak <>'') { 
    mysql_select_db($database_con_gl, $con_gl);
	$query = "UPDATE gl_trans SET transaksi= '$tr', total= $tot, pos= '$pos', akun= '$ak' WHERE id='$_GET[value]'";
	$run_query = mysql_query($query, $con_gl);
  }else if($rul =='Hapus' AND $_GET[value] <>'') {
    mysql_select_db($database_con_gl, $con_gl);
	$query = "DELETE FROM gl_trans WHERE id='$_GET[value]'";
	$run_query = mysql_query($query, $con_gl);
  }else{ ?>
  <tr>
    <th width="10%" align="center"><strong>Kode</strong></th>
    <th width="30%" align="center"><strong>Akun</strong></th>
    <th width="10%" align="center"><strong>Debet</strong></th>
    <th width="10%" align="center"><strong>Kredit</strong></th>
    <th width="30%" align="center"><strong>Transaksi</strong></th>
    <th width="10%" align="center">&nbsp;</th>
  </tr>
  <tr valign="top" bgcolors="#FEAA8D">
    <td align="center" style="color:#FF0000;"><?php if($ak=='') { ?>
      <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Diisi
    <?php }else{ ?><img src="images/ok.png" width="24" height="24" /><?php } ?></td>
    <td align="center" style="color:#FF0000;"><?php if($ak=='') { ?>
      <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Pilih Akun -
      <?php }else{ ?>
      <img src="images/ok.png" width="24" height="24" />
      <?php } ?></td>
    <td align="center" style="color:#FF0000;"><?php if(!is_numeric($tot)) { ?>      <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Angka
      <?php }else{ ?>
      <img src="images/ok.png" width="24" height="24" />
      <?php } ?></td>
    <td align="center" style="color:#FF0000;"><?php if(!is_numeric($tot)) { ?>      <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" />Angka
      <?php }else{ ?>
      <img src="images/ok.png" width="24" height="24" />
      <?php } ?></td>
    <td align="center" style="color:#FF0000;"><?php if($tr=='') { ?>      <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Diisi
      <?php }else{ ?>
      <img src="images/ok.png" width="24" height="24" />
      <?php } ?></td>
    <td>&nbsp;</td>
  </tr>
  <?php } ?>
  <?php
  $colname_get_t = "-1";
if (isset($_GET['noreferensi'])) {
  $colname_get_t = (get_magic_quotes_gpc()) ? $_GET['noreferensi'] : addslashes($_GET['noreferensi']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_get_t = "SELECT gl_trans.id, gl_trans.transaksi, gl_trans.total, gl_trans.pos, gl_akun.id as akunid, gl_akun.akun FROM gl_trans, gl_akun WHERE gl_trans.no_ref= '$colname_get_t' AND gl_akun.id = gl_trans.akun ORDER BY gl_trans.id desc";
$get_t = mysql_query($query_get_t, $con_gl) or die(mysql_error());
$row_get_t = mysql_fetch_assoc($get_t);
$totalRows_get_t = mysql_num_rows($get_t);
  ?>
  <?php if($totalRows_get_t > 0) { ?>
  <tr>
    <th width="10%" align="center"><strong>Kode</strong></th>
    <th width="30%" align="center"><strong>Akun</strong></th>
    <th width="10%" align="center"><strong>Debet</strong></th>
    <th width="10%" align="center"><strong>Kredit</strong></th>
    <th width="30%" align="center"><strong>Transaksi</strong></th>
    <th width="10%" align="center"><strong>Aksi</strong></th>
  </tr>
  <?php do { ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td width="10%" align="center"><?php echo $row_get_t['akunid']; ?></td>
      <td align="center"><?php echo $row_get_t['akun']; ?></td>
      <td align="right"><?php if($row_get_t['pos']=='D') { echo number_format($row_get_t['total'],0,',','.').",-";$totdeb += $row_get_t['total'];}else{ echo "0,00";} ?></td>
      <td align="right"><?php if($row_get_t['pos']=='K') { echo number_format($row_get_t['total'],0,',','.').",-";$totkre += $row_get_t['total'];}else{ echo "0,00";} ?></td>
      <td align="center"><?php echo $row_get_t['transaksi']; ?> <?php echo $row_get_t['keterangan']; ?></td>
      <td width="10%" align="center"><label>
        <button value="<?php echo $row_get_t['id']; ?>" onclick="ajaxEditForm(<?php echo $row_get_t['id']; ?>);" type="button" class="editbutton" title="Edit Transaksi">&nbsp;</button>
      </label>
        <label>
        <button value="<?php echo $row_get_t['id']; ?>" onclick="ajaxManageTransaksi('Hapus',<?php echo $row_get_t['id']; ?>);" type="button" class="deletebutton" title="Hapus Transaksi">&nbsp;</button>
      </label></td>
    </tr>
  <?php } while ($row_get_t = mysql_fetch_assoc($get_t)); ?>
    <tr bgcolor="#EEEEEE">
      <td width="10%" align="right" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" bgcolor="#FFFFFF">Total : </td>
      <td align="right" bgcolor="#FFFFCC"><?php echo number_format($totdeb,0,',','.').",-";?></td>
      <td align="right" bgcolor="#FFFFCC"><?php echo number_format($totkre,0,',','.').",-";?></td>
      <td colspan="2" align="right" bgcolor="<?php if(($totdeb > 0 OR $totkre > 0) AND ($totdeb == $totkre)) { ?>#FFFFCC<?php }else{ ?>#FEAA8D<?php } ?>"><?php if(($totdeb > 0 OR $totkre > 0) AND ($totdeb == $totkre)) { ?>Jurnal Benar, 
        <input name="Save" type="submit" id="Save" value="Simpan Jurnal"/><?php }else{ ?>Jurnal salah / tidak sama, periksa kembali transaksi anda !!!<?php } ?></td>
    </tr>
	<?php } ?>
    <tr>
      <th width="10%" align="center"><strong>Kode</strong></th>
      <th align="center"><strong>Akun</strong></th>
      <th align="center"><strong>Debet</strong></th>
      <th align="center"><strong>Kredit</strong></th>
      <th align="center"><strong>Transaksi</strong></th>
      <th align="center"><strong>Aksi
      <input name="idtrans" type="hidden" id="idtrans" value="<?php echo $row_get_t['id']; ?>" />
      </strong></th>
  </tr>
  <tr valign="top" bgcolor="#FFFFFF">
    <td width="10%" align="center">      <div id="kodeDiv"><label>
        <input name="akunkd" type="text" id="akunkd" size="10" maxlength="10" onchange="cekAkun(this.value);" value="<?php if(!$run_query) { echo $ak; }?>"/>
        </label>
    </div></td>
    <td align="center"><div id="akunDiv">
      <label>
      <select name="akun" id="akun" onchange="cekKode(this.value);">
        <?php
do {  
?>
        <?php
mysql_select_db($database_con_gl, $con_gl);
$query_akun = "SELECT id, akun, klasifikasi, keterangan FROM gl_akun where klasifikasi = '$row_klas[kd]' ORDER BY id,akun ASC";
$akun = mysql_query($query_akun, $con_gl) or die(mysql_error());
$row_akun = mysql_fetch_assoc($akun);
$totalRows_akun = mysql_num_rows($akun);
?>
        <option value="" style="background:#EEEEEE; font-weight:bold;"><?php echo $row_klas['klasifikasi'];?></option>
        <?php do { ?>
        <option value="<?php echo $row_akun['id'];?>" <?php if($row_akun['id'] == $ak AND !$run_query) { ?>selected="selected"<?php } ?>>-<?php echo $row_akun['akun']?></option>
        <?php } while ($row_akun = mysql_fetch_assoc($akun));?>
        <?php
} while ($row_klas = mysql_fetch_assoc($klas));
  $rows = mysql_num_rows($klas);
  if($rows > 0) {
      mysql_data_seek($klas, 0);
	  $row_klas = mysql_fetch_assoc($klas);
  }
?>
      </select>
      </label>
    </div></td>
    <td align="center"><label>
      <input name="debet" type="text" id="debet" size="10" onchange="javascript:if(this.value > 0) { this.form.kredit.value='';}else{ alert('Value invalid !!!');this.value='';}" value="<?php if(!$run_query AND $pos=='D') { echo $tot; } ?>"/>
    </label></td>
    <td align="center"><label>
      <input name="kredit" type="text" id="kredit" size="10" onchange="javascript:if(this.value > 0) { this.form.debet.value='';}else{ alert('Value invalid !!!');this.value='';}" value="<?php if(!$run_query AND $pos=='K') { echo $tot; } ?>"/>
    </label></td>
    <td align="center"><label>
      <textarea name="transaksi" cols="35" rows="2" id="transaksi"><?php if(!$run_query) { echo $tr; } ?></textarea>
    </label></td>
    <td align="center"><label></label>
        <label>
        <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxManageTransaksi('Tambah');" class="checkbutton" title="Tambah Transaksi"/>
    </label></td>
  </tr>
</table>
<?php
mysql_free_result($get_t);
?>
