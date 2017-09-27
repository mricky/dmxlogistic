<?php require_once('../connections/con_gl.php'); ?>
<?php
$tip = $_GET['tipe'];
$q  = $_GET['q'];
//-- get kontak
mysql_select_db($database_con_gl, $con_gl);
$query_kontak = "SELECT id, nama, tlp, type, tcustomer FROM gl_kontak where type='$tip' AND status='AKTIF' AND (nama LIKE '%$q%' OR tlp LIKE '%$q%') ORDER BY type, nama ASC";
$kontak = mysql_query($query_kontak, $con_gl) or die(mysql_error());
$row_kontak = mysql_fetch_assoc($kontak);
$totalRows_kontak = mysql_num_rows($kontak);
?>
<select name="dari" id="dari" onchange="setKeterangan(this.value);getDetailCustomer(this.value);" >
<option value="">Pilih Customer</option>
<?php do {  ?>
<option value="<?php echo $row_kontak['id']?>"><?php echo $row_kontak['nama']?></option>
<?php } while ($row_kontak = mysql_fetch_assoc($kontak)); ?>
</select>