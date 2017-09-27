<?php require_once('../connections/con_gl.php'); ?>

<?php

//session_start();

$day = $_GET['tgl'];

// get referensi order

mysql_select_db($database_con_gl, $con_gl);

$query_getref = "select a.no_ref from gl_retailtrans a where a.tgl <='$day' AND a.jatuhtempo >='$day' AND a.jenis='7'";

if(!strstr($_SESSION[akses],'A-1-4')) {



	$query_getref .= " AND a.gudang='$_SESSION[lokasi]'";



}

$query_getref .=" order by a.no_ref";

$getref = mysql_query($query_getref, $con_gl) or die(mysql_error());

$row_getref = mysql_fetch_assoc($getref);

$totalRows_getref = mysql_num_rows($getref);

?>

<select name="noreferensi" id="noreferensi">

    <option value="">Pilih No. Referensi</option>

    <?php if($totalRows_getref > 0) { do { ?>

    <option value="<?php echo $row_getref['no_ref'];?>"><?php echo $row_getref['no_ref'];?></option>

    <?php }while($row_getref = mysql_fetch_assoc($getref)); } ?>

</select>