<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_listbayar = "SELECT gl_trans.transaksi, gl_trans.total, gl_trans.x_ref, gl_trans.id FROM gl_trans WHERE gl_trans.no_ref='$_GET[noreferensi]' AND gl_trans.pos='D'";
$listbayar = mysql_query($query_listbayar, $con_gl) or die(mysql_error());
$row_listbayar = mysql_fetch_assoc($listbayar);
$totalRows_listbayar = mysql_num_rows($listbayar);

mysql_select_db($database_con_gl, $con_gl);
$query_invoi = "SELECT no_ref FROM gl_rtrans WHERE jenis = 6 AND gl_rtrans.no_ref LIKE '%PJ%' AND gl_rtrans.kontak ='$_GET[kontak]' AND gl_rtrans.jatuhtempo <>'' ORDER BY gl_rtrans.no_ref";
$invoi = mysql_query($query_invoi, $con_gl) or die(mysql_error());
$row_invoi = mysql_fetch_assoc($invoi);
$totalRows_invoi = mysql_num_rows($invoi);

mysql_select_db($database_con_gl, $con_gl);
$query_getxref = "SELECT gl_trans.x_ref FROM gl_trans WHERE gl_trans.id='$_GET[refid]'";
$getxref = mysql_query($query_getxref, $con_gl) or die(mysql_error());
$row_getxref = mysql_fetch_assoc($getxref);
$totalRows_getxref = mysql_num_rows($getxref);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
  <tr>
    <th width="31%" align="center"><strong>Invoice</strong><strong></strong></th>
    <th width="10%" align="center"><strong>Nilai (D) </strong></th>
    <th width="29%" align="center"><strong>Transaksi</strong></th>
    <th width="14%" align="center"><strong>Aksi</strong></th>
  </tr>
  <?php do { ?>
  <?php if($_GET[refid] <> $row_listbayar['id']) { ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td width="31%" align="center"><?php echo $row_listbayar['x_ref']; ?></td>
      <td width="10%" align="right"><?php echo $row_listbayar['total']; ?></td>
      <td width="29%" align="center"><?php echo $row_listbayar['transaksi']; ?></td>
      <td width="14%" align="center">
			     <label>
        <button value="<?php echo $row_list_tr['id']; ?>" onclick="ajaxEditFormPembayaranHutang(this.value);" type="button" class="editbutton" title="Edit Transaksi">&nbsp;</button></label><label>
        <input name="hapus" type="button" id="hapus" value="&nbsp;" onclick="ajaxManagePembayaranHutang('Hapus',<?php echo $row_list_tr['id']; ?>);" title="Hapus Transaksi" class="deletebutton"/>
</label>       </td>
    </tr>
	<?php }else{ ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td align="center"><div id="divInvoice"><label>
      <select name="invoice" id="invoice" style="width:400px;" onChange="hitungHutang(this.value);setTransaksi(this.value)">
        <option value="" style="background:#EEEEEE;font-weight:bold;" <?php if (!(strcmp("", $row_listbayar['x_ref']))) {echo "selected=\"selected\"";} ?>>Pilih Invoice</option>
        <?php if($totalRows_invoi > 0) { ?>
        <?php
do {  
?>
        <option value="<?php echo $row_invoi['no_ref']?>"<?php if (!(strcmp($row_invoi['no_ref'], $row_getxref['x_ref']))) {echo "selected=\"selected\"";} ?>><?php echo $row_invoi['no_ref']?></option>
        <?php
} while ($row_invoi = mysql_fetch_assoc($invoi));
  $rows = mysql_num_rows($invoi);
  if($rows > 0) {
      mysql_data_seek($invoi, 0);
	  $row_invoi = mysql_fetch_assoc($invoi);
  }
?>
        <?php } ?>
      </select>
      </label></div></td>
      <td align="center"><div id="divTotal"><label>
      <input name="nilai" type="text" id="nilai" onchange="javascript:if(this.value > 0) { this.form.debet.value='';}else{ alert('Value invalid !!!');this.value='';}" value="<?php echo $row_listbayar['total']; ?>" size="10"/>
      </label></div></td>
      <td align="center"><label>
      <textarea name="transaksi" cols="50" rows="2" id="transaksi"><?php echo $row_listbayar['transaksi']; ?></textarea>
      </label></td>
      <td align="center">        <label>
        <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxManagePembayaranHutang('Simpan',<?php echo $row_listbayar['id']; ?>);" class="checkbutton" title="Simpan Transaksi"/>
        </label>      </td>
    </tr>
	<?php } ?>
  <?php } while ($row_listbayar = mysql_fetch_assoc($listbayar)); ?>
</table>
<?php
mysql_free_result($getxref);
?>
