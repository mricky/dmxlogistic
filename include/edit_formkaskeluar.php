<?php require_once('../connections/con_gl.php'); ?>
<?php
$nref = $_GET['noreferensi'];
$tr = $_GET['transaksi'];
$nilai = intval($_GET['nilai']);
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
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
			<tr>
			  <th width="10%" align="center"><strong>Kode</strong></th>
              <th width="36%" align="center"><strong>Akun</strong></th>
              <th width="10%" align="center"><strong>Nilai (D) </strong></th>
              <th align="center"><strong>Transaksi</strong></th>
              <th width="10%" align="center"><strong>Aksi</strong></th>
  </tr>
			<?php
			mysql_select_db($database_con_gl, $con_gl);
$query_list_tr = "SELECT gl_trans.transaksi, gl_trans.total, gl_trans.id, gl_akun.id as akun_id, gl_akun.akun FROM gl_trans, gl_akun WHERE gl_akun.id = gl_trans.akun AND gl_trans.no_ref='$nref' AND gl_trans.pos='D' ORDER BY gl_trans.id desc";
$list_tr = mysql_query($query_list_tr, $con_gl) or die(mysql_error());
$row_list_tr = mysql_fetch_assoc($list_tr);
$totalRows_list_tr = mysql_num_rows($list_tr);
			?>
			<?php do { ?>
			<?php if($row_list_tr['id'] <> $_GET[refid] AND $totalRows_list_tr > 1) {  ?>
			  <tr bgcolor="#FFFFFF">
			    <td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $row_list_tr['akun_id']; ?></td>
			    <td width="36%" align="center" bgcolor="#FFFFFF"><?php echo $row_list_tr['akun']; ?></td>
			    <td width="10%" align="right"><?php echo number_format($row_list_tr['total'],0,',','.').",-"; ?></td>
			    <td align="center"><?php echo $row_list_tr['transaksi']; ?></td>
			    <td align="center">
			      <label>
        <button value="<?php echo $row_list_tr['id']; ?>" onclick="ajaxEditFormKaskeluar(<?php echo $row_list_tr['id']; ?>);" type="button" class="editbutton" title="Edit Transaksi">&nbsp;</button></label><label>
        <input name="hapus" type="button" id="hapus" value="&nbsp;" onclick="ajaxManageKaskeluar('Hapus',<?php echo $row_list_tr['id']; ?>);" title="Hapus Transaksi" class="deletebutton"/>
</label>       </td>
		    </tr>
				<?php }else{ ?>
				<tr valign="top" bgcolor="#FFFFFF">
				  <td width="10%" align="center" ><div id="kodeDiv"><label>
                  <input name="akunkd" type="text" id="akunkd" onchange="cekAkun(this.value);" value="<?php echo $row_list_tr['akun_id']; ?>" size="10" maxlength="10"/>
                  </label></div></td>
              <td width="36%" align="center"><div id="akunDiv"><label>
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
                <option value="" style="background:#EEEEEE; font-weight:bold;"><?php echo $row_klas['kd']." - ";echo $row_klas['klasifikasi'];?></option>
				<?php do { ?>
				<option value="<?php echo $row_akun['id']?>" <?php if($row_akun['id'] == $row_list_tr['akun_id']) { ?>selected="selected"<?php } ?>>-<?php echo $row_akun['akun']?></option>
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
              </label></div></td>
              <td width="10%" align="center"><label>
                <input name="nilai" type="text" id="nilai" value="<?php echo $row_list_tr['total']; ?>" size="10"/>
              </label></td>
              <td align="center"><label>
              <textarea name="transaksi" cols="45" rows="3" id="transaksi"><?php echo $row_list_tr['transaksi']; ?></textarea>
              </label></td>
              <td align="center"><label></label>
                  <label>
                  <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxManageKaskeluar('Simpan',<?php echo $row_list_tr['id']; ?>);" class="checkbutton" title="Simpan Transaksi"/>
              </label></td>
            </tr>
			<?php } ?>
			  <?php } while ($row_list_tr = mysql_fetch_assoc($list_tr)); ?>
</table>
<?php
mysql_free_result($list_tr);
?>
