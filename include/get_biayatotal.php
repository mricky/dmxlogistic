<?php require_once('../connections/con_gl.php'); ?>

<?php

$bar = $_GET['barang'];

$kid = $_GET['kid'];

// get kendaraan

mysql_select_db($database_con_gl, $con_gl);

$query_harga = "select sum(a.akomod+a.bbm+a.other+a.parkir+a.supir+a.tol) as tbiaya from gl_jenbar a, gl_jkendaraan b, gl_kendaraan c where a.barang='$bar' AND c.nopol='$kid' AND b.id = c.jenis AND b.id = a.jenis";

$harga       = mysql_query($query_harga, $con_gl) or die(mysql_error());

$row_harga   = mysql_fetch_assoc($harga);

$total_harga = mysql_num_rows($harga);

?>
<input name="biaya" type="text" id="biaya" value="<?php echo $row_harga['tbiaya'];?>" size="10" maxlength="10" onchange="javascript:this.form.ntotal.value = (2*this.form.xntotal.value) - this.form.xntotal.value + (2*this.form.biaya.value) - this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;this.form.saldohutang.value=this.form.ntotal.value-this.form.bayar.value;" onfocus="this.blur();"/>
