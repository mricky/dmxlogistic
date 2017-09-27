<?php require_once('../connections/con_gl.php'); ?>
<?php
$nref = $_GET['noreferensi'];
$tr = $_GET['transaksi'];
$nilai = $_GET['nilai'];
$total = $_GET['total'];
$ak = $_GET['akun'];
$rul = $_GET['rules'];
$id_x = $_GET['refid'];
$tnilai = 0;

mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT kd, klasifikasi, keterangan, neraca, ruglab tipe FROM gl_klas  where `tipe` <>'6' and `tipe` <>'7' ORDER BY kd,klasifikasi ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
			<?php if($rul =='Hapus') {
			mysql_select_db($database_con_gl, $con_gl);
	$query = "DELETE FROM gl_trans WHERE id='$_GET[value]'";
	$run_query = mysql_query($query, $con_gl);
			?>
			<?php }else if(($nref=='' OR $ak=='' OR !is_numeric($nilai) OR $tr =='') AND $rul <>'Hapus') { ?>
            <tr>
			  <th width="10%" align="center"><strong>Kode</strong></th>
              <th width="36%" align="center"><strong>Akun</strong></th>
              <th width="10%" align="center"><strong>Nilai (D) </strong></th>
              <th align="center"><strong>Transaksi</strong></th>
              <th width="10%" align="center"><strong>Aksi</strong></th>
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
    <td align="center" style="color:#FF0000;"><?php if(!is_numeric($nilai)) { ?>      <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Angka
      <?php }else{ ?>
     <img src="images/ok.png" width="24" height="24" />
      <?php } ?></td>
    <td align="center" style="color:#FF0000;"><?php if($tr=='') { ?>      <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Diisi
      <?php }else{ ?>
      <img src="images/ok.png" width="24" height="24" />
      <?php } ?></td>
    <td>&nbsp;</td>
  </tr>
			<?php }else{ ?>
			<?php
			if($rul =='Tambah' AND $nref<>'' AND $tr <>'' AND $nilai > 0 AND $ak <>'') {
	mysql_select_db($database_con_gl, $con_gl);
	$query = "INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$nref', '$tr', '$nilai', 'D', '$ak')";
	$run_query = mysql_query($query, $con_gl);
  }else if($rul =='Simpan' AND $nref<>'' AND $tr <>'' AND $nilai > 0 AND $ak <>'') { 
    mysql_select_db($database_con_gl, $con_gl);
	$query = "UPDATE gl_trans SET transaksi= '$tr', total= $nilai, pos= 'D', akun= '$ak' WHERE id='$_GET[value]'";
	$run_query = mysql_query($query, $con_gl);
  }
  ?>		
			<?php } ?>
			<?php
			mysql_select_db($database_con_gl, $con_gl);
$query_list_tr = "SELECT gl_trans.transaksi, gl_trans.total, gl_trans.id, gl_akun.id as akun_id, gl_akun.akun FROM gl_trans, gl_akun WHERE gl_akun.id = gl_trans.akun AND gl_trans.no_ref='$nref' AND gl_trans.pos='D' ORDER BY gl_trans.id desc";
$list_tr = mysql_query($query_list_tr, $con_gl) or die(mysql_error());
$row_list_tr = mysql_fetch_assoc($list_tr);
$totalRows_list_tr = mysql_num_rows($list_tr);
			?>
			<?php if($totalRows_list_tr > 0) { ?>
			<tr>
			  <th width="10%" align="center"><strong>Kode</strong></th>
              <th width="36%" align="center"><strong>Akun</strong></th>
              <th width="10%" align="center"><strong>Nilai (D) </strong></th>
              <th align="center"><strong>Transaksi</strong></th>
              <th width="10%" align="center"><strong>Aksi</strong></th>
  </tr>
			<?php $tottrans = 0; do { ?>
		      <tr valign="top" bgcolor="#FFFFFF">
		        <td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $row_list_tr['akun_id']; ?></td>
			    <td width="36%" align="center" bgcolor="#FFFFFF"><?php echo $row_list_tr['akun']; ?></td>
			    <td width="10%" align="right"><?php echo number_format($row_list_tr['total'],0,',','.').",-"; $tnilai += $row_list_tr['total'];?></td>
			    <td align="center"><?php echo $row_list_tr['transaksi']; ?></td>
			    <td width="10%" align="center">
			      <label>
        <button value="<?php echo $row_list_tr['id']; ?>" onclick="ajaxEditFormKaskeluar(<?php echo $row_list_tr['id']; ?>);" type="button" class="editbutton" title="Edit Transaksi">&nbsp;</button>
      </label>
			      <label>
                  <input name="hapus" type="button" id="hapus" value="&nbsp;" onclick="ajaxManageKaskeluar('Hapus',<?php echo $row_list_tr['id']; ?>);" title="Hapus Transaksi" class="deletebutton"/>
                </label></td>
		    </tr>
			  <?php } while ($row_list_tr = mysql_fetch_assoc($list_tr)); ?>
			  <?php
			  mysql_select_db($database_con_gl, $con_gl);
$query_sumtot = "SELECT sum(gl_trans.total) FROM gl_trans WHERE gl_trans.no_ref='$nref'  AND gl_trans.pos='D'";
$sumtot = mysql_query($query_sumtot, $con_gl) or die(mysql_error());
$row_sumtot = mysql_fetch_assoc($sumtot);
$totalRows_sumtot = mysql_num_rows($sumtot);
			  ?>
			  <tr bgcolor="#FFFFFF">
			    <td width="10%" align="right" bgcolor="#FFFFFF">&nbsp;</td>
			      <td width="36%" align="right" bgcolor="#FFFFFF">Total : </td>
			      <td width="10%" align="right"><label><?php echo number_format($row_sumtot['sum(gl_trans.total)'],0,',','.').",-"; ?>
			        <input name="total" type="hidden" id="total" value="<?php echo $row_sumtot['sum(gl_trans.total)']; ?>" size="10" maxlength="15" />
			      </label></td>
			      <td align="center">&nbsp;</td>
			      <td width="10%" align="center">&nbsp;</td>
	        </tr>
			  <?php } ?>
            <tr>
              <th width="10%" align="center"><strong>Kode</strong></th>
              <th width="36%" align="center"><strong>Akun </strong></th>
              <th width="10%" align="center"><strong>Nilai (D) </strong></th>
              <th align="center"><strong>Transaksi</strong></th>
              <th width="10%" align="center"><strong>Aksi</strong></th>
  </tr>
            <tr valign="top" bgcolor="#FFFFFF">
              <td width="10%" align="center"><div id="kodeDiv">
                  <label>
                  <input name="akunkd" type="text" id="akunkd" onchange="cekAkun(this.value);" size="10" maxlength="10"/>
                  </label>
              </div></td>
              <td width="36%" align="center"><div id="akunDiv">
                  <label>
                  <select name="akun" id="akun" onchange="cekKode(this.value);">
                    <?php do {  ?>
                    <?php
mysql_select_db($database_con_gl, $con_gl);
$query_akun = "SELECT id, akun, klasifikasi, keterangan FROM gl_akun where klasifikasi = '$row_klas[kd]' ORDER BY id,akun ASC";
$akun = mysql_query($query_akun, $con_gl) or die(mysql_error());
$row_akun = mysql_fetch_assoc($akun);
$totalRows_akun = mysql_num_rows($akun);
?>
                    <option value="" style="background:#EEEEEE; font-weight:bold;"><?php echo $row_klas['kd']." - ";echo $row_klas['klasifikasi'];?></option>
                    <?php do { ?>
                    <option value="<?php echo $row_akun['id']?>">-<?php echo $row_akun['akun']?></option>
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
              <td width="10%" align="center"><label>
                <input name="nilai" type="text" id="nilai" size="10"/>
              </label></td>
              <td align="center"><label>
                <textarea name="transaksi" cols="45" rows="3" id="transaksi"></textarea>
              </label></td>
              <td width="10%" align="center"><label>
                <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxManageKaskeluar('Tambah');" class="checkbutton" title="Tambah Transaksi"/>
              </label></td>
            </tr>
			<?php //if($tnilai == $total) { ?>
			<tr>
			  <td width="10%" align="left">&nbsp;</td>
              <td width="36%" align="left">&nbsp;</td>
              <td width="10%" align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td width="10%" align="center">&nbsp;</td>
            </tr>
			<?php //} ?>
</table>
<?php
mysql_free_result($list_tr);
?>
