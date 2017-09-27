<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_gethutang = "SELECT sum(gl_trans.total) FROM gl_trans WHERE gl_trans.no_ref='$_GET[invoice]' AND gl_trans.pos='D' AND gl_trans.transaksi LIKE '%%Piutang%%'";
$gethutang = mysql_query($query_gethutang, $con_gl) or die(mysql_error());
$row_gethutang = mysql_fetch_assoc($gethutang);
$totalRows_gethutang = mysql_num_rows($gethutang);


mysql_select_db($database_con_gl, $con_gl);
$query_getretur = "select sum(gl_trans.total), gl_rtrans.no_ref from gl_rtrans, gl_trans where gl_rtrans.no_ref LIKE '%%SR%%' AND gl_rtrans.x_ref ='$_GET[invoice]' AND gl_rtrans.no_ref = gl_trans.no_ref AND gl_trans.pos='K' group by gl_rtrans.no_ref";
$getretur = mysql_query($query_getretur, $con_gl) or die(mysql_error());
$row_getretur = mysql_fetch_assoc($getretur);
$totalRows_getretur = mysql_num_rows($getretur);

mysql_select_db($database_con_gl, $con_gl);
$query_bayar = "SELECT sum(gl_trans.total) FROM gl_trans WHERE gl_trans.x_ref='$_GET[invoice]' AND gl_trans.pos='K'";
$bayar = mysql_query($query_bayar, $con_gl) or die(mysql_error());
$row_bayar = mysql_fetch_assoc($bayar);
$totalRows_bayar = mysql_num_rows($bayar);

//echo $query_gethutang."<br/>".$query_getretur."<br/>".$query_bayar;
?><label>
<input name="nilai" type="text" id="nilai" onchange="javascript:if(this.value > 0) { this.form.debet.value='';}else{ alert('Value invalid !!!');this.value='';}" value="<?php echo $row_gethutang['sum(gl_trans.total)']-($row_getretur['sum(gl_trans.total)']+$row_bayar['sum(gl_trans.total)']); ?>" size="10"/>
</label>
<?php
mysql_free_result($gethutang);

mysql_free_result($getretur);
?>
