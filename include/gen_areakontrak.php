<?php require_once('../connections/con_gl.php'); ?>
<?php
$kon = $_GET['kontrak'];
// --- area operasional
mysql_select_db($database_con_gl, $con_gl);
$query_area = "select a.id, a.area from gl_area a, gl_kontrak b where a.id = b.area AND b.no ='$kon' order by a.area";
$area = mysql_query($query_area, $con_gl) or die(mysql_error());
$row_area = mysql_fetch_assoc($area);
$totalRows_area = mysql_num_rows($area);
?>
<select name="area" id="area" style="width:150px;" disabled="disabled">
  <option value="">Area Operasional</option>
  <?php if($totalRows_area > 0) { do { ?>
  <option value="<?php echo $row_area['id'];?>" selected="selected"><?php echo $row_area['area'];?></option>
  <?php }while($row_area = mysql_fetch_assoc($area)); } ?>
</select>
