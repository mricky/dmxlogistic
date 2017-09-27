<?php require_once('../connections/con_gl.php'); ?>
<?php
$nref = $_GET['noreferensi'];
$gud = $_GET['gudang'];
$tr = $_GET['transaksi'];
$nilai = doubleval($_GET['nilai']);
$total = doubleval($_GET['total']);
$inv = $_GET['invoice'];
$ak = $_GET['akun'];
$rul = $_GET['rules'];
$id_x = $_GET['refid'];
$ak = $_GET['akun'];
$tnilai = 0;

//echo $nref."<br/>".$nilai."<br/>".$inv."<br/>".$ak."<br/>".$tr."<br/>".$rul;

mysql_select_db($database_con_gl, $con_gl);
$query_getakhut = "SELECT gl_trans.akun FROM gl_trans WHERE gl_trans.no_ref='$inv' AND gl_trans.transaksi LIKE '%Piutang Penjualan%'";
$getakhut = mysql_query($query_getakhut, $con_gl) or die(mysql_error());
$row_getakhut = mysql_fetch_assoc($getakhut);
$totalRows_getakhut = mysql_num_rows($getakhut);

mysql_select_db($database_con_gl, $con_gl);
$query_invoi = "SELECT no_ref FROM gl_rtrans WHERE jenis = 7  AND gl_rtrans.no_ref LIKE '%SJ%' AND gl_rtrans.kontak ='$_GET[kontak]' AND gl_rtrans.jatuhtempo <>'' ORDER BY gl_rtrans.no_ref";
$invoi = mysql_query($query_invoi, $con_gl) or die(mysql_error());
$row_invoi = mysql_fetch_assoc($invoi);
$totalRows_invoi = mysql_num_rows($invoi);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
			<?php if($rul =='Hapus') {
			mysql_select_db($database_con_gl, $con_gl);
			$query = "DELETE FROM gl_trans WHERE id='$_GET[value]'";
			$run_query = mysql_query($query, $con_gl);
			?>
			<?php }else if(($nref=='' OR $inv=='' OR $nilai <=0 OR $tr =='' OR $ak =='') AND $rul <>'Hapus') { ?>
            <tr>
			  <th align="center"><strong>Invoice</strong><strong></strong></th>
              <th align="center"><strong>Nilai (D) </strong></th>
              <th align="center"><strong>Transaksi</strong></th>
              <th width="15%" align="center"><strong>Aksi</strong></th>
			</tr>
			<tr valign="top" bgcolor="#FFFFFF">
			<td align="center" style="color:#FF0000;font-size:10px;"><?php if($inv=='') { ?>
			<img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Pilih Invoice <?php }else{ ?>
			<img src="images/ok.png" width="24" height="24" />
			<?php } ?></td>
			    <td align="center" style="color:#FF0000;font-size:10px;"><?php if($nilai=='') { ?>
                    <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Angka<?php }else{ ?>
                    <img src="images/ok.png" width="24" height="24" />
                    <?php } ?></td>
			    <td align="center" style="color:#FF0000;font-size:10px;"><?php if($tr=='') { ?>
                    <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Diisi
			      <?php }else{ ?>
                    <img src="images/ok.png" width="24" height="24" />
                    <?php } ?></td>
			    <td align="center">&nbsp;</td>
			</tr>
			<?php }else{ ?>
			<?php if($rul =='Tambah' AND $nref<>'' AND $tr <>'' AND $nilai > 0 AND $ak <>'') {
				mysql_select_db($database_con_gl, $con_gl);
				/*$query = "INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun, x_ref) VALUES (NULL, '$nref', '$tr', '$nilai', 'K', '$ak', '$inv')";
				$run_query = mysql_query($query, $con_gl);*/
				$query2 = "INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun, x_ref) VALUES (NULL, '$nref', '$tr', '$nilai', 'K', '$row_getakhut[akun]', '$inv')";
				$run_query2 = mysql_query($query2, $con_gl) or die(mysql_error());
				}else if($rul =='Simpan' AND $nref<>'' AND $tr <>'' AND $nilai > 0 AND $ak <>'') { 
				mysql_select_db($database_con_gl, $con_gl);
				$query = "UPDATE gl_trans SET transaksi= '$tr', total= $nilai, pos= 'K', akun= '$row_getakhut[akun]', x_ref='$inv' WHERE id='$_GET[value]'";
				$run_query = mysql_query($query, $con_gl);
				}?>		
				<?php } ?>
				<?php mysql_select_db($database_con_gl, $con_gl);
				$query_list_tr = "SELECT gl_trans.x_ref, gl_trans.transaksi, gl_trans.total, gl_trans.id, gl_akun.id as akun_id, gl_akun.akun FROM gl_trans, gl_akun WHERE gl_akun.id = gl_trans.akun AND gl_trans.no_ref='$nref' AND gl_trans.pos='K' ORDER BY gl_trans.id desc";
				$list_tr = mysql_query($query_list_tr, $con_gl) or die(mysql_error());
				$row_list_tr = mysql_fetch_assoc($list_tr);
				$totalRows_list_tr = mysql_num_rows($list_tr);
	
//echo $query_list_tr;
			?>
			<?php if($totalRows_list_tr > 0) { ?>
			<tr>
			  <th align="center"><strong>Invoice</strong><strong></strong></th>
              <th align="center"><strong>Nilai (D) </strong></th>
              <th align="center"><strong>Transaksi</strong></th>
              <th width="15%" align="center"><strong>Aksi</strong></th>
			</tr>
			<?php do { ?>
		      <tr valign="top" bgcolor="#FFFFFF">
			    <td align="center" bgcolor="#FFFFFF"><?php echo $row_list_tr['x_ref']; ?></td>
			    <td align="right"><?php echo number_format($row_list_tr['total'],0,',','.').",-"; $tnilai += $row_list_tr['total'];?></td>
			    <td align="center"><?php echo $row_list_tr['transaksi']; ?></td>
			    <td align="center">
			     <label>
                 <button value="&nbsp;" onclick="ajaxEditFormPembayaranPiutang(<?php echo $row_list_tr['id']; ?>);" type="button" class="editbutton" title="Edit Transaksi">&nbsp;</button></label><label>
        <input name="hapus" type="button" id="hapus" value="&nbsp;" onclick="ajaxManagePembayaranPiutang('Hapus',<?php echo $row_list_tr['id']; ?>);" title="Hapus Transaksi" class="deletebutton"/>
</label>       </td>
		    </tr>
			  <?php } while ($row_list_tr = mysql_fetch_assoc($list_tr)); ?>
			  <?php
			  mysql_select_db($database_con_gl, $con_gl);
$query_sumtot = "SELECT sum(gl_trans.total) FROM gl_trans WHERE gl_trans.no_ref='$nref'  AND gl_trans.pos='K'";
$sumtot = mysql_query($query_sumtot, $con_gl) or die(mysql_error());
$row_sumtot = mysql_fetch_assoc($sumtot);
$totalRows_sumtot = mysql_num_rows($sumtot);
			  ?>
			  <tr valign="top" bgcolor="#FFFFFF">
			      <td align="right" bgcolor="#FFFFFF">Total : </td>
			      <td align="right"><label>
                  <?php echo number_format($row_sumtot['sum(gl_trans.total)'],0,',','.').",-"; ?>
                  <input name="total" type="hidden" id="total" value="<?php echo $row_sumtot['sum(gl_trans.total)']; ?>" size="10" maxlength="15" />
                </label></td>
			      <td align="center" >&nbsp;</td>
			      <td align="center" >&nbsp;</td>
	        </tr>
			  <?php } ?>
              <tr>
                <th align="center"><strong>Invoice</strong><strong></strong></th>
                <th align="center"><strong>Nilai (D) </strong></th>
                <th align="center"><strong>Transaksi</strong></th>
                <th align="center"><strong>Aksi</strong></th>
              </tr>
            <tr valign="top" bgcolor="#FFFFFF">
              <td align="center" ><div id="divInvoice">
                  <label>
                  <select name="invoice" id="invoice" style="width:400px;" onchange="hitungPiutang(this.value);setTransaksi(this.value)">
                    <option style="background:#EEEEEE;font-weight:bold;" value="">Pilih Invoice</option>
                    <?php if($totalRows_invoi > 0) { ?>
                    <?php
do {  
mysql_select_db($database_con_gl, $con_gl);
$query_totalbyr = "SELECT sum(gl_trans.total) FROM gl_trans where x_ref='$row_invoi[no_ref]'";
$totalbyr = mysql_query($query_totalbyr, $con_gl) or die(mysql_error());
$row_totalbyr = mysql_fetch_assoc($totalbyr);
$totalRows_totalbyr = mysql_num_rows($totalbyr);

mysql_select_db($database_con_gl, $con_gl);
$query_totalhut = "SELECT gl_trans.total FROM gl_trans WHERE gl_trans.no_ref='$row_invoi[no_ref]' AND gl_trans.pos='D' AND gl_trans.transaksi LIKE '%Piutang%'";
$totalhut = mysql_query($query_totalhut, $con_gl) or die(mysql_error());
$row_totalhut = mysql_fetch_assoc($totalhut);
$totalRows_totalhut = mysql_num_rows($totalhut);

mysql_select_db($database_con_gl, $con_gl);
$query_bayar = "SELECT sum(gl_trans.total) FROM gl_trans WHERE gl_trans.x_ref='$row_invoi[no_ref]' AND gl_trans.pos='K'";
$bayar = mysql_query($query_bayar, $con_gl) or die(mysql_error());
$row_bayar = mysql_fetch_assoc($bayar);
$totalRows_bayar = mysql_num_rows($bayar);

mysql_select_db($database_con_gl, $con_gl);
$query_getbrg = "SELECT gl_trans.id, gl_barang.barang FROM gl_trans, gl_barang WHERE gl_trans.no_ref='$row_invoi[no_ref]' AND gl_barang.id=gl_trans.barang ORDER BY gl_trans.id";
$getbrg = mysql_query($query_getbrg, $con_gl) or die(mysql_error());
$row_getbrg = mysql_fetch_assoc($getbrg);
$totalRows_getbrg = mysql_num_rows($getbrg);

$hutbal = $row_totalhut['total'] - $row_totalbyr['sum(gl_trans.total)'];

$listbrg ="";
	do {
		$listbrg .= $row_getbrg['barang'].",";
	} while ($row_getbrg = mysql_fetch_assoc($getbrg));
?>
<?php if($hutbal > 0) { ?>
<option value="<?php echo $row_invoi['no_ref']?>"><?php echo $row_invoi['no_ref']; echo " - ".$listbrg."&nbsp;Sisa Piutang : ".$hutbal;?></option><?php } ?>
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
                  </label>
              </div></td>
              <td align="center" ><div id="divTotal">
                <label>
                  <input name="nilai" type="text" id="nilai" size="10" onchange="javascript:if(this.value > 0) { this.form.debet.value='';}else{ alert('Value invalid !!!');this.value='';}"/>
                </label>
              </div></td>
              <td align="center" ><div id="divTransaksi">
                <label>
                  <textarea name="transaksi" cols="40" rows="2" id="transaksi"></textarea>
                </label>
              </div></td>
              <td align="center" ><label></label>
              <label>
                <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxManagePembayaranPiutang('Tambah');" class="checkbutton" title="Tambah Transaksi"/>
              </label></td>
            </tr>
			<?php //if($tnilai == $total) { ?>
			<?php //} ?>
</table>
