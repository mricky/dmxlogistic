<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_gol = "SELECT id, jeniskendaraan FROM gl_jeniskendaraan ORDER BY jeniskendaraan ASC";
$gol = mysql_query($query_gol, $con_gl) or die(mysql_error());
$row_gol = mysql_fetch_assoc($gol);
$totalRows_gol = mysql_num_rows($gol);
?>
<select name="jeniskendaraan" id="jeniskendaraan" style="width:180px;">
<option value="">Pilih Jenis Kendaraan</option>
<?php do { ?>
	<option value="<?php echo $row_gol['id']?>"><?php echo $row_gol['jeniskendaraan']?></option>
<?php } while ($row_gol = mysql_fetch_assoc($gol)); ?>
</select>