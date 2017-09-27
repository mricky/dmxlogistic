<?php require_once('../connections/con_gl.php'); ?>
<?php
$colname_cekpk = "-1";
if (isset($_GET['ref'])) {
  $colname_cekpk = (get_magic_quotes_gpc()) ? $_GET['ref'] : addslashes($_GET['ref']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_cekpk = sprintf("SELECT no_ref FROM gl_retailtrans WHERE no_ref = '%s'", $colname_cekpk);
$cekpk = mysql_query($query_cekpk, $con_gl) or die(mysql_error());
$row_cekpk = mysql_fetch_assoc($cekpk);
$totalRows_cekpk = mysql_num_rows($cekpk);
?><label>
<input name="noreferensi" type="text" id="noreferensi" value="<?php echo $_GET[ref];?>" size="20" maxlength="20" onchange="cekReferensi(this.value);"/>
</label><?php if($totalRows_cekpk > 0) { ?><span style="color:#FF0000">No Referensi sudah digunakan !!!</span><?php } ?>
