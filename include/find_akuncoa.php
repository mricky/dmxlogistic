<?php

//session_start();

require_once('../connections/con_gl.php');

// get akun

mysql_select_db($database_con_gl, $con_gl);

$query_noakun = "select a.id, a.akun, b.klasifikasi from gl_akun a, gl_klas b where a.klasifikasi = b.kd AND a.gudang <>'$_SESSION[lokasi]' AND (a.akun LIKE '%$_GET[q]%' OR b.klasifikasi LIKE '%$_GET[q]%') order by b.klasifikasi, a.akun";

$noakun = mysql_query($query_noakun, $con_gl) or die(mysql_error());

$row_noakun = mysql_fetch_assoc($noakun);

$totalRows_noakun = mysql_num_rows($noakun);

?>

<table width="100%" border="0" cellspacing="0" cellpadding="4">

  <?php $no = 0; if($totalRows_noakun > 0) { do { ?>

  <tr valign="top">

    <td width="4%" align="right"><?php echo $no+1;?>.</td>

    <td width="4%" align="center"><input name="data[]" type="checkbox" id="data<?php echo $no;?>" value="<?php echo $row_noakun['id'];?>" /></td>

    <td width="35%"><?php echo $row_noakun['klasifikasi'];?></td>

    <td><?php echo $row_noakun['akun'];?></td>

  </tr>

  <?php $no++; }while($row_noakun = mysql_fetch_assoc($noakun)); } ?>

</table>

