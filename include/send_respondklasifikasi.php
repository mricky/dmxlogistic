<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT kd, klasifikasi FROM gl_klas ORDER BY kd,klasifikasi ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);
?>
<select name="klasifikasi" id="klasifikasi">
<?php do { ?>
	<option value="<?php echo $row_klas['kd']?>"><?php echo $row_klas['kd']?> - <?php echo $row_klas['klasifikasi']?></option>
<?php } while ($row_klas = mysql_fetch_assoc($klas)); ?>
</select>