<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT kd, klasifikasi, keterangan, neraca, ruglab, tipe FROM gl_klas ORDER BY kd,klasifikasi ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);
?>
<div id="akunDiv">
  <label>
              <select name="akun" id="akun" onchange="cekKode(this.value);">
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
				<option value="<?php echo $row_akun['id']?>" <?php if($_GET[refid] == $row_akun['id']) { ?>selected="selected"<?php } ?>>-<?php echo $row_akun['akun']?></option>
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
</div>
