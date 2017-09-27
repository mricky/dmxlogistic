<?php require_once('../connections/con_gl.php'); ?>

<?php

$bid = $_GET['bid'];
// get kendaraan
mysql_select_db($database_con_gl, $con_gl);

$query_kend = "select a.area, b.gudang from gl_area a, gl_gudang b where a.id = b.area  AND b.area='$bid'  order by a.area, b.gudang";

$kend       = mysql_query($query_kend, $con_gl) or die(mysql_error());

$row_kend   = mysql_fetch_assoc($kend);

$total_kend = mysql_num_rows($kend);

?>

<select name="cabang" id="cabang" style="width:180px;">

  <option value="">Pilih Kantor Cabang</option>

  <?php if($total_kend > 0) { do { ?>

  <option value="<?php echo $row_kend['id'];?>"><?php echo $row_kend['gudang'];?></option>

  <?php }while($row_kend = mysql_fetch_assoc($kend)); } ?>

</select>