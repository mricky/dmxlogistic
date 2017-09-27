<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT id, kelompok FROM gl_kelompok ORDER BY kelompok ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);
?>
<select name="kelompok" id="kelompok" onKeyPress="return">
<?php do { ?>
<option value="<?php echo $row_klas['id']?>"><?php echo $row_klas['kelompok']?></option>
<?php } while ($row_klas = mysql_fetch_assoc($klas));
$rows = mysql_num_rows($klas);
if($rows > 0) {
mysql_data_seek($klas, 0);
$row_klas = mysql_fetch_assoc($klas);
}
?>
</select>