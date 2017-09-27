<?php 
//session_start(); 
require_once('../connections/con_gl.php'); ?>



<?php



$bar = $_GET['barang'];



$kid = $_GET['kid'];



// get kendaraan



mysql_select_db($database_con_gl, $con_gl);



$query_harga = "select a.tol from gl_jenbar a where a.barang = '$bar' and a.area = '$_SESSION[area]' and a.jenis = (select tipekendaraan from gl_masterkendaraan where nopolisi ='$kid')";



$harga       = mysql_query($query_harga, $con_gl) or die(mysql_error());



$row_harga   = mysql_fetch_assoc($harga);



$total_harga = mysql_num_rows($harga);



?>

<input name="tol" type="text" id="tol" value="<?php echo $row_harga['tol'];?>" size="20" maxlength="10" onkeyup="javascript:this.form.biaya.value = (2*this.form.supir.value) - this.form.supir.value + (2*this.form.bbm.value) - this.form.bbm.value + (2*this.form.tol.value) - this.form.tol.value + (2*this.form.parkir.value) - this.form.parkir.value + (2*this.form.akomodasi.value) - this.form.akomodasi.value + (2*this.form.other.value) - this.form.other.value; var total=parseInt(document.getElementById('bbm').value) + parseInt(document.getElementById('tol').value) + parseInt(document.getElementById('parkir').value) + parseInt(document.getElementById('supir').value) + parseInt(document.getElementById('akomodasi').value) + parseInt(document.getElementById('other').value); 

var grandtotal = parseInt(document.getElementById('hargasatuan').value) + parseInt(document.getElementById('hargaafterppn').value) + total - parseInt(document.getElementById('uangmuka').value)- parseInt(document.getElementById('hargaafterpph').value);;

document.getElementById('biaya').value=total; document.getElementById('ntotal').value=grandtotal;" style="text-align:right;"/>