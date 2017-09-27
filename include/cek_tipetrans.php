<?php require_once('../connections/con_gl.php'); ?>
<?php

mysql_select_db($database_con_gl, $con_gl);
$query_def_ak = "SELECT gl_company.a_hut, gl_company.a_piu FROM gl_company";
$def_ak = mysql_query($query_def_ak, $con_gl) or die(mysql_error());
$row_def_ak = mysql_fetch_assoc($def_ak);
$totalRows_def_ak = mysql_num_rows($def_ak);
if($_GET[page]=='jual') {
	$tx="6";
	$def_a = $row_def_ak[a_piu];
}else{
	$tx="7";
	$def_a = $row_def_ak[a_hut];
}
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT kd, klasifikasi, keterangan, neraca, ruglab, tipe FROM gl_klas where tipe = '$tx' ORDER BY kd,klasifikasi ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);
?>
<?php if($_GET[tipe]=='Kredit') { ?>
<label>
        <select name="akunkredit" id="akunkredit">
          <?php
do {  
?>
          <?php
mysql_select_db($database_con_gl, $con_gl);
$query_akun = "SELECT id, akun, klasifikasi, keterangan FROM gl_akun where klasifikasi = '$row_klas[kd]' ORDER BY id,akun ASC";
$akun = mysql_query($query_akun, $con_gl) or die(mysql_error());
$row_akun = mysql_fetch_assoc($akun);
$totalRows_akun = mysql_num_rows($akun);
?>
          <option value="" style="background:#EEEEEE; font-weight:bold;"><?php echo $row_klas['klasifikasi'];?></option>
          <?php do { ?>
          <option value="<?php echo $row_akun['id']?>" <?php if($def_a==$row_akun['id']) { ?>selected="selected"<?php } ?>>-<?php echo $row_akun['akun']?></option>
          <?php } while ($row_akun = mysql_fetch_assoc($akun));?>
          <?php
} while ($row_klas = mysql_fetch_assoc($klas));
  $rows = mysql_num_rows($klas);
  if($rows > 0) {
      mysql_data_seek($klas, 0);
	  $row_klas = mysql_fetch_assoc($klas);
  }
?>
</select>
</label>
<?php }else{ ?>
		<input name="akunkredit" type="hidden" id="akunkredit">
		<?php } ?>
		<label>
        <input name="tipetrans" type="radio" value="Tunai" <?php if($_GET[tipe]=='Tunai') { ?>checked="checked"<?php } ?> onchange="if(this.checked) { this.form.jatuhtempo.value='';this.form.jatuhtempo.disabled='disabled';cektipetrans(this.value);}"/>
        Tunai</label>
        <label>
        <input type="radio" name="tipetrans" value="Kredit" <?php if($_GET[tipe]=='Kredit') { ?>checked="checked"<?php } ?> onchange="if(this.checked) { this.form.jatuhtempo.disabled='';cektipetrans(this.value);}"/>
        Kredit</label>