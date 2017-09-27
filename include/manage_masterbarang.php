<?php require_once('../connections/con_gl.php'); ?>

<?php

$act = $_GET['act'];

$bar = $_GET['brg'];

$rid = $_GET['rid'];

$jen = $_GET['jenis'];

$area = $_GET['area'];

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

		$query_cek = "select id from gl_jenbar where jenis='$jen' AND barang='$bar' and area='$area'";

		$cek       = mysql_query($query_cek, $con_gl) or die(mysql_error());

		$total_cek = mysql_num_rows($cek);

		if($total_cek > 0) {

			echo "<span style=\"color:red;font-size:12px;\">Paket Sewa sudah tersetting !!!</span>";

		}else{

			// add barang

			$query_save = "insert into gl_jenbar(id,jenis,area,barang,hargasewa,supir,bbm,tol,parkir,akomod,other) values  (NULL,'$jen','$area','$bar','$har','$sup','$bbm','$tol','$par','$ako','$oth')";

			$save       = mysql_query($query_save, $con_gl) or die(mysql_error());

		}

	}

}else if($act=='Hapus') {

	$query_save = "delete from gl_jenbar where id='$rid'";

	$save       = mysql_query($query_save, $con_gl) or die(mysql_error());

}else if($act=='Edit') {
	$query_save = "update gl_jenbar set barang='$bar', area = '$area', hargasewa='$har', supir='$sup', bbm='$bbm', tol='$tol', parkir='$par', akomod='$ako', other='$oth' where id='$rid'";
	$save       = mysql_query($query_save, $con_gl) or die(mysql_error());
}

// get master barang

$query_ldata = "select a.id, a.barang as barang_id, b.barang, a.area as idarea, c.area, a.hargasewa, a.supir, a.bbm, a.tol, a.parkir, a.akomod, a.other from gl_jenbar a, gl_barang b, gl_area c where a.jenis='$jen' AND a.barang = b.id AND a.area=c.id order by b.barang";

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
    <th colspan="2">Paket Sewa</th>
    <th width="9%">Harga Sewa</th>
    <th width="9%">Jasa Supir</th>
    <th width="9%">BBM</th>
    <th width="9%">Tol</th>
    <th width="9%">Parkir</th>
    <th width="9%">Akomodasi</th>
    <th width="9%">Other</th>
    <th width="8%">Atur</th>
  </tr>
  <?php if($total_ldata > 0) { do { ?>
  <?php if($act=='editform' AND $row_ldata['id']==$rid) { ?>
  <tr valign="top">
    <td width="14%"><label>
      <select name="barang" id="barang">
        <option value="">Pilih Paket Sewa</option>
        <?php if($totalRows_barang > 0) { do { ?>
        <option value="<?php echo $row_barang['id'];?>" <?php if($row_barang['id']==$row_ldata['barang_id']) { ?>selected="selected"<?php } ?>><?php echo $row_barang['barang'];?></option>
        <?php }while($row_barang = mysql_fetch_assoc($barang)); } ?>
      </select>
    </label>
  &nbsp;&nbsp;</td>
    <td width="15%"><input type="hidden" name="area" id="area" value="<?php echo $row_ldata['idarea']; ?>" />
        <?php list($namaarea) = mysql_fetch_row(mysql_query("select area from gl_area where id = '$row_ldata[idarea]'"));?>
        <input type="text" name="txtarea" id="txtarea" readonly="readonly" value="<?php echo $namaarea; ?>" size="20" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=area&amp;task=listarea&amp;open=window','name','825','450','yes');return false" placeholder="Pilih Area..." />
        <?php if(strstr($_SESSION['akses'],"PD-6-1")) { ?>
        <a href="index.php?component=area&amp;task=add&amp;open=window" onclick="NewWindow(this.href,'name','825','450','yes');return false"><img src="images/add_.png" hspace="2" border="0" style="position:absolute;" /></a>
        <?php } ?></td>
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
    <td align="center"><a href="javascript:void(0);" onclick="ajaxManageMasterBarang('Edit','<?php echo $row_ldata['id'];?>');"></a><a href="javascript:void(0);" onclick="javascrit: if(document.getElementById('area').value==''){ alert('Pilih Area dulu mas..'); document.getElementById('txtarea').click(); }else{ ajaxManageMasterBarang('Edit','<?php echo $row_ldata['id'];?>');}"><img src="images/save_.png" border="0" /></a></td>
  </tr>
  <?php }else{ ?>
  <tr valign="top">
    <td><?php echo $row_ldata['barang'];?><a href="javascript:void(0);" onclick="ajaxManageMasterBarang('editform','<?php echo $row_ldata['id'];?>');" title="Edit Data"><img src="images/edit_.png" border="0" /></a></td>
    <td><?php echo $row_ldata['area'];?></td>
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
