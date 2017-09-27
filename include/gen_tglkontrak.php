<?php require_once('../connections/con_gl.php'); ?>
<?php
$kon = $_GET['kontrak'];
$tmonth = date("Y/m");
// get tgl
mysql_select_db($database_con_gl, $con_gl);
$query_gtgl = "select mulai, sampai from gl_kontrak where no='$kon'";
$gtgl = mysql_query($query_gtgl, $con_gl) or die(mysql_error());
$row_gtgl = mysql_fetch_assoc($gtgl);
// --
$tglawal = $row_gtgl['mulai']; 
$tglakhir = $row_gtgl['sampai']; 
?>
<input name="tglawal" type="text" id="tglawal" size="12" maxlength="12" readonly="readonly" value="<?php echo $tglawal;?>"/> s.d <input name="tglakhir" type="text" id="tglakhir" size="12" maxlength="12" readonly="readonly" value="<?php echo $tglakhir;?>"/>