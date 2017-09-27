<?php require_once('../connections/con_gl.php'); ?>

<?php

$bar = $_GET['barang'];

$kid = $_GET['kid'];

// get kendaraan

mysql_select_db($database_con_gl, $con_gl);

$query_harga = "select a.akomod from gl_jenbar a, gl_tipekendaraan b, gl_masterkendaraan c where a.barang='$bar' AND c.nopolisi='$kid' AND b.id = c.tipekendaraan AND b.id = a.jenis";

$harga       = mysql_query($query_harga, $con_gl) or die(mysql_error());

$row_harga   = mysql_fetch_assoc($harga);

$total_harga = mysql_num_rows($harga);

?>
<input name="akomodasi" type="text" id="akomodasi" value="<?php echo $row_harga['akomod'];?>" size="20" maxlength="10" onkeyup="javascript:this.form.biaya.value = (2*this.form.supir.value) - this.form.supir.value + (2*this.form.bbm.value) - this.form.bbm.value + (2*this.form.tol.value) - this.form.tol.value + (2*this.form.parkir.value) - this.form.parkir.value + (2*this.form.akomodasi.value) - this.form.akomodasi.value + (2*this.form.other.value) - this.form.other.value; var total=parseInt(document.getElementById('bbm').value) + parseInt(document.getElementById('tol').value) + parseInt(document.getElementById('parkir').value) + parseInt(document.getElementById('supir').value) + parseInt(document.getElementById('akomodasi').value) + parseInt(document.getElementById('other').value); 
var grandtotal = parseInt(document.getElementById('hargasatuan').value) + parseInt(document.getElementById('hargaafterppn').value) + total - parseInt(document.getElementById('uangmuka').value)- parseInt(document.getElementById('hargaafterpph').value);;
document.getElementById('biaya').value=total; document.getElementById('ntotal').value=grandtotal;" style="text-align:right;"/>