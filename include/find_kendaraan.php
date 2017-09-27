<?php require_once('../connections/con_gl.php'); ?>
<?php
$q = $_GET['q'];
// ---
mysql_select_db($database_con_gl, $con_gl);
$query_kelom = "select a.jenis, b.nopol, b.tipe from gl_jkendaraan a, gl_kendaraan b where a.id = b.jenis AND b.tersedia='1' AND (a.jenis LIKE '%$q%' OR b.nopol LIKE '%$q%' OR b.tipe LIKE '%$q%') order by a.jenis, b.nopol";
$kelom = mysql_query($query_kelom, $con_gl) or die(mysql_error());
$row_kelom = mysql_fetch_assoc($kelom);
$totalRows_kelom = mysql_num_rows($kelom);
?>
<select name="kendaraan" id="kendaraan" style="width:385px;">
    <option value="">Pilih Kendaraan</option>
    <?php if($totalRows_kelom > 0) { do { ?>
    <option value="<?php echo $row_kelom['nopol'];?>"><?php echo $row_kelom['jenis'];?> <?php echo $row_kelom['tipe'];?> - <?php echo $row_kelom['nopol'];?></option>
    <?php }while($row_kelom = mysql_fetch_assoc($kelom)); } ?>
</select>