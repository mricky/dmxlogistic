<?php require_once('../connections/con_gl.php'); ?>
<?php
$kon = $_GET['kontrak'];
$tmonth = date("Y/m");
// get tgl
mysql_select_db($database_con_gl, $con_gl);
$query_gtgl = "select tgl, pbayar from gl_kontrak where no='$kon'";
$gtgl = mysql_query($query_gtgl, $con_gl) or die(mysql_error());
$row_gtgl = mysql_fetch_assoc($gtgl);
// --
$ptgl = explode("/",$row_gtgl['tgl']);
$awal = $tmonth."/".$ptgl[2];
$akhr = date("Y/m/d", strtotime("$awal +$row_gtgl[pbayar] month-1 day"));
?>
<input name="tanggal" type="text" id="tanggal" size="12" maxlength="12" readonly="readonly" value="<?php echo $awal;?>"/> s.d <input name="jatuhtempo" type="text" id="jatuhtempo" size="12" maxlength="12" readonly="readonly" value="<?php echo $akhr;?>"/>