<?php require_once('../connections/con_gl.php'); ?>
<?php
$kon = $_GET['kontrak'];
$tmonth = date("Y/m");
// get tgl
mysql_select_db($database_con_gl, $con_gl);
$query_gket = "select info from gl_kontrak where no='$kon'";
$gket = mysql_query($query_gket, $con_gl) or die(mysql_error());
$row_gket = mysql_fetch_assoc($gket);
?>
<textarea name="keterangan" cols="40" rows="2" id="keterangan" readonly="readonly"><?php echo $row_gket['info'];?></textarea>

        <input name="cid" type="hidden" id="cid" value=""/>