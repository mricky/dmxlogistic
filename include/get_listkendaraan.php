<?php require_once('../connections/con_gl.php'); ?>

<?php

$bid = $_GET['bid'];

// get kendaraan
mysql_select_db($database_con_gl, $con_gl);

$query_kend = "select a.tipekendaraan, b.nopolisi from gl_tipekendaraan a, gl_masterkendaraan b, gl_jenbar c where a.id = b.tipekendaraan AND a.id = c.jenis AND c.barang='$bid' AND b.tersedia='1' order by a.tipekendaraan, b.nopolisi"; //echo $query_kend;

$kend       = mysql_query($query_kend, $con_gl) or die(mysql_error());

$row_kend   = mysql_fetch_assoc($kend);

$total_kend = mysql_num_rows($kend);

?>

<select name="kendaraan" id="kendaraan" style="width:240px;" onChange="getHargaKendaraan();getBiayaBBM();getBiayaTol();getBiayaParkir();getBiayaSupir();getBiayaAkomodasi();getBiayaOther();">

  <option value="">Pilih Kendaraan</option>

  <?php if($total_kend > 0) { do { ?>

  <option value="<?php echo $row_kend['nopolisi'];?>"><?php echo $row_kend['tipekendaraan'];?>( <?php echo $row_kend['nopolisi'];?> )</option>

  <?php }while($row_kend = mysql_fetch_assoc($kend)); } ?>

</select>