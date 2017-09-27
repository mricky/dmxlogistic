<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_gol = "SELECT id, golongan FROM gl_gol ORDER BY golongan ASC";
$gol = mysql_query($query_gol, $con_gl) or die(mysql_error());
$row_gol = mysql_fetch_assoc($gol);
$totalRows_gol = mysql_num_rows($gol);
?>
<select name="golongan" id="golongan">
<option value="">Pilih Golongan Aset</option>
<?php do { ?>
	<option value="<?php echo $row_gol['id']?>"><?php echo $row_gol['golongan']?></option>
<?php } while ($row_gol = mysql_fetch_assoc($gol)); ?>
</select>