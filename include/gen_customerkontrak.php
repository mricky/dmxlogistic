<?php require_once('../connections/con_gl.php'); ?>
<?php
$kon = $_GET['kontrak'];
$tmonth = date("Y/m");
// get tgl
mysql_select_db($database_con_gl, $con_gl);
$query_gcus = "select kontak from gl_kontrak where no='$kon'";
$gcus = mysql_query($query_gcus, $con_gl) or die(mysql_error());
$row_gcus = mysql_fetch_assoc($gcus);
// ---
mysql_select_db($database_con_gl, $con_gl);
$query_kontak = "SELECT id, nama, type, tcustomer FROM gl_kontak where gl_kontak.type='Customer' ORDER BY type, nama ASC";
$kontak = mysql_query($query_kontak, $con_gl) or die(mysql_error());
$row_kontak = mysql_fetch_assoc($kontak);
$totalRows_kontak = mysql_num_rows($kontak);
?>
<select name="dari" id="dari" style="width:310px; onchange="setKeterangan(this.value);" >
            <option value="">Pilih Customer</option>
            <?php

do {  

?>
            <option value="<?php echo $row_kontak['id']?>" <?php if($row_kontak['id']==$row_gcus['kontak']) { ?>selected="selected"<?php } ?>><?php echo $row_kontak['nama']?></option>
            <?php

} while ($row_kontak = mysql_fetch_assoc($kontak));

  $rows = mysql_num_rows($kontak);

  if($rows > 0) {

      mysql_data_seek($kontak, 0);

	  $row_kontak = mysql_fetch_assoc($kontak);

  }

?>
          </select>