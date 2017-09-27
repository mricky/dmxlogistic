<?php require_once('../connections/con_gl.php'); ?>

<?php

$act = $_GET['act'];

$area = $_GET['area'];

$bar = $_GET['brg'];

$rid = $_GET['rid'];

$jen = $_GET['jenis'];

$har = intval($_GET['hargasewa']);
$sup = intval($_GET['supir']);
$bbm = intval($_GET['bbm']);
$tol = intval($_GET['tol']);
$par = intval($_GET['parkir']);
$ako = intval($_GET['akomodasi']);
$oth = intval($_GET['other']);
// ---

mysql_select_db($database_con_gl, $con_gl);

// ---

if($act=='Tambah') {

	if($bar=='') {

		echo "<span style=\"color:red;font-size:12px;\">Pilih Paket Sewa !!!</span>";

	}else{

		$query_cek = "select id from gl_jenbar where area='$area' AND jenis='$jen' AND barang='$bar'";

		$cek       = mysql_query($query_cek, $con_gl) or die(mysql_error());

		$total_cek = mysql_num_rows($cek);

		if($total_cek > 0) {

			echo "<span style=\"color:red;font-size:12px;\">Paket Sewa sudah tersetting !!!</span>";

		}else{

			// add barang

			$query_save = "insert into gl_jenbar(id,area,jenis,barang,hargasewa,supir,bbm,tol,parkir,akomod,other) values  (NULL,'$area', '$jen','$bar','$har','$sup','$bbm','$tol','$par','$ako','$oth')";

			$save       = mysql_query($query_save, $con_gl) or die(mysql_error());

		}

	}

}else if($act=='Hapus') {

	$query_save = "delete from gl_jenbar where id='$rid'";

	$save       = mysql_query($query_save, $con_gl) or die(mysql_error());

}else if($act=='Edit') {
	$query_save = "update gl_jenbar set area='$area', barang='$bar', hargasewa='$har', supir='$sup', bbm='$bbm', tol='$tol', parkir='$par', akomod='$ako', other='$oth' where id='$rid'";
	$save       = mysql_query($query_save, $con_gl) or die(mysql_error());
}

// --- get area

mysql_select_db($database_con_gl, $con_gl);

$query_area = "select id, area from gl_area order by area";

$area       = mysql_query($query_area, $con_gl) or die(mysql_error());

$row_area   = mysql_fetch_assoc($area);

$totalRows_area = mysql_num_rows($area);

// get master barang

$query_ldata = "select a.id, a.barang as barang_id, b.barang, a.hargasewa, a.supir, a.bbm, a.tol, a.parkir, a.akomod, a.other from gl_jenbar a, gl_barang b where a.jenis='$jen' AND a.barang = b.id order by b.barang";

$ldata       = mysql_query($query_ldata, $con_gl) or die(mysql_error());

$row_ldata   = mysql_fetch_assoc($ldata);

$total_ldata = mysql_num_rows($ldata);

// --- get barang

mysql_select_db($database_con_gl, $con_gl);

$query_barang = "select a.id, a.barang from gl_barang a, gl_kelompok b where a.kelompok = b.id AND b.jenis='2' order by a.barang";

$barang       = mysql_query($query_barang, $con_gl) or die(mysql_error());

$row_barang   = mysql_fetch_assoc($barang);

$totalRows_barang = mysql_num_rows($barang);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="datatable">
  <tr>
    <th width="10%">Area Ops </th>
    <th width="30%">Paket Sewa</th>
    <th width="9%">Harga Sewa</th>
    <th width="7%">Jasa Supir</th>
    <th width="7%">BBM</th>
    <th width="7%">Tol</th>
    <th width="7%">Parkir</th>
    <th width="8%">Akomodasi</th>
    <th width="7%">Other</th>
    <th width="8%">Atur</th>
  </tr>
  <?php if($total_ldata > 0) { do { ?>
  <?php if($act=='editform' AND $row_ldata['id']==$rid) { ?>
  <tr valign="top">
    <td><select name="area" id="area">
      <option value="">Pilih Area Ops</option>
      <?php if($totalRows_area > 0) { do { ?>
      <option value="<?php echo $row_area['id'];?>" <?php if($row_area['id']==$row_ldata['area']) { ?>selected="selected"<?php } ?>><?php echo $row_area['area'];?></option>
      <?php }while($row_area = mysql_fetch_assoc($area)); } ?>
    </select></td>
    <td><label>
      <select name="barang" id="barang">
        <option value="">Pilih Paket Sewa</option>
        <?php if($totalRows_barang > 0) { do { ?>
        <option value="<?php echo $row_barang['id'];?>" <?php if($row_barang['id']==$row_ldata['barang_id']) { ?>selected="selected"<?php } ?>><?php echo $row_barang['barang'];?></option>
        <?php }while($row_barang = mysql_fetch_assoc($barang)); } ?>
      </select>
    </label>
  &nbsp;&nbsp;</td>
    <td align="center"><label>
      <input name="harga" type="text" id="harga" value="<?php echo $row_ldata['hargasewa'];?>" size="8" maxlength="10" />
    </label></td>
    <td align="center"><label>
      <input name="supir" type="text" id="supir" value="<?php echo $row_ldata['supir'];?>" size="8" maxlength="10" />
    </label></td>
    <td align="center"><label>
      <input name="bbm" type="text" id="bbm" value="<?php echo $row_ldata['bbm'];?>" size="8" maxlength="10" />
    </label></td>
    <td align="center"><label>
      <input name="tol" type="text" id="tol" value="<?php echo $row_ldata['tol'];?>" size="8" maxlength="10" />
    </label></td>
    <td align="center"><label>
      <input name="parkir" type="text" id="parkir" value="<?php echo $row_ldata['parkir'];?>" size="8" maxlength="10" />
    </label></td>
    <td align="center"><label>
      <input name="akomodasi" type="text" id="akomodasi" value="<?php echo $row_ldata['akomod'];?>" size="8" maxlength="10" />
    </label></td>
    <td align="center"><label>
      <input name="other" type="text" id="other" value="<?php echo $row_ldata['other'];?>" size="8" maxlength="10" />
    </label></td>
    <td align="center"><a href="javascript:void(0);" onclick="ajaxManageMasterBarang('Edit','<?php echo $row_ldata['id'];?>');"></a><a href="javascript:void(0);" onclick="ajaxManageMasterBarang('Edit','<?php echo $row_ldata['id'];?>');"><img src="images/save_.png" border="0" /></a></td>
  </tr>
  <?php }else{ ?>
  <tr valign="top">
    <td><?php echo $row_ldata['area'];?></td>
    <td><?php echo $row_ldata['barang'];?><a href="javascript:void(0);" onclick="ajaxManageMasterBarang('editform','<?php echo $row_ldata['id'];?>');" title="Edit Data"><img src="images/edit_.png" border="0" /></a></td>
    <td align="center"><?php echo number_format($row_ldata['hargasewa'],0,',','.');?></td>
    <td align="center"><?php echo number_format($row_ldata['supir'],0,',','.');?></td>
    <td align="center"><?php echo number_format($row_ldata['bbm'],0,',','.');?></td>
    <td align="center"><?php echo number_format($row_ldata['tol'],0,',','.');?></td>
    <td align="center"><?php echo number_format($row_ldata['parkir'],0,',','.');?></td>
    <td align="center"><?php echo number_format($row_ldata['akomod'],0,',','.');?></td>
    <td align="center"><?php echo number_format($row_ldata['other'],0,',','.');?></td>
    <td align="center"><a href="javascript:void(0);" onclick="ajaxManageMasterBarang('Hapus','<?php echo $row_ldata['id'];?>');"><img src="images/delete_.png" border="0" /></a></td>
  </tr>
  <?php } ?>
  <?php }while($row_ldata = mysql_fetch_assoc($ldata)); } ?>
</table>
