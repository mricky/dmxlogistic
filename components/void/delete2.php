<?php require_once('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"MS-8-3");
$colname_edit = "-1";
if (isset($_GET['id'])) {
  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_edit = sprintf("SELECT * FROM gl_kkeluar WHERE id = %s", $colname_edit);
$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
// get kendaraan
mysql_select_db($database_con_gl, $con_gl);
$query_kend = "SELECT a.nopolisi, a.tipekendaraan, a.tahun,  a.tersedia from gl_masterkendaraan a, gl_tipekendaraan b where a.tipekendaraan = b.id AND (a.tersedia='1' OR a.nopolisi='$row_edit[kendaraan]') order by b.tipekendaraan, a.nopolisi asc";
$kend = mysql_query($query_kend, $con_gl) or die(mysql_error());
$row_kend = mysql_fetch_assoc($kend);
$totalRows_kend = mysql_num_rows($kend);
// get driver
mysql_select_db($database_con_gl, $con_gl);
$query_drive = "select id, nama from gl_kontak where tkaryawan='Supir' order by nama";
$drive = mysql_query($query_drive, $con_gl) or die(mysql_error());
$row_drive = mysql_fetch_assoc($drive);
$totalRows_drive = mysql_num_rows($drive);
// get referensi order
mysql_select_db($database_con_gl, $con_gl);
$query_getref = "select a.no_ref from gl_rtrans a where a.tgl <='$row_edit[tgl]' AND a.jatuhtempo >='$row_edit[tgl]' AND a.jenis='7' order by a.no_ref";
$getref = mysql_query($query_getref, $con_gl) or die(mysql_error());
$row_getref = mysql_fetch_assoc($getref);
$totalRows_getref = mysql_num_rows($getref);
?>
<link href="ccss/ui.datepicker.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript">
<!--
$(function()
      {
        $('.calendar').datepicker({
            appendText : "",
            dateFormat : 'yy/mm/dd'
          });
      });
	  
</script>
<link type="text/css" rel="stylesheet" href="css/jquery.wysiwyg.css" />
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$().ajaxStart(function() {
		$('#loading').show();
		$('#result').hide();
	}).ajaxStop(function() {
		$('#loading').hide();
		$('#result').fadeIn('slow');
	});

	$('#delete').submit(function() {
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				$('#result').html(data);
			}
		})
		return false;
	});
  $('#result').click(function(){
  $(this).hide();
  });
})
$(function()
  {
	  $('#keterangan').wysiwyg();
  });
</script>
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<h1>Hapus Delivery Kendaraan</h1>
<form action="proses/checkout_kend.php?act=delete" method="POST" name="delete" id="delete" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Tanggal* :</td>
      <td bgcolor="#FFFFFF"><label>
        <input name="tanggal" type="text" class="calendar" id="tanggal" value="<?php echo $row_edit['tgl'];?>" size="20" maxlength="15"/>
      </label><label></label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">No. Order :</td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="noreferensi" id="noreferensi" value="<?php echo $row_edit['noref']; ?>" />
      <input type="text" name="txtnoreferensi" id="txtnoreferensi" size="28" value="<?php echo $row_edit['noref']; ?>" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=rtrans&amp;task=list&amp;open=window','name','825','450','yes');return false" placeholder="Klik untuk no. referensi" />
      </label></td>
    </tr>
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Kendaraan* : </td>
      <td width="80%" bgcolor="#FFFFFF"><input type="hidden" name="kendaraan" id="kendaraan" value="<?php echo $row_edit['kendaraan']; ?>" />
        <?php list($namakend, $tahun) = mysql_fetch_row(mysql_query("SELECT b.tipekendaraan, a.tahun from gl_masterkendaraan as a, gl_tipekendaraan b, gl_rtrans c where c.kendaraan=a.nopolisi AND a.tipekendaraan = b.id and a.nopolisi = '$row_edit[kendaraan]'")); ?>
        <input type="text" name="txtkendaraan" id="txtkendaraan" size="28" value="<?php echo $namakend." (".$tahun.")"; ?>" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=rtrans&amp;task=list_kendaraan&amp;noref='+document.getElementById('noreferensi').value+'&amp;open=window','name','825','450','yes');return false" placeholder="Klik untuk kendaraan" />
        </label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Pengemudi :</td>
      <td bgcolor="#FFFFFF"><label>
      <input type="hidden" name="driver" id="pengemudi" value="<?php echo $row_edit['driver']; ?>" />
      <?php list($namasupir) = mysql_fetch_row(mysql_query("select nama from gl_kontak where id = '$row_edit[driver]'")); ?>
      <input type="text" name="txtdriver" id="txtpengemudi" size="28" value="<?php echo $namasupir; ?>" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=kontak&amp;task=listsupir&amp;open=window','name','825','450','yes');return false" placeholder="Klik untuk Driver" />
      </label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Keterangan : </td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="keterangan" cols="85" rows="5" id="keterangan"><?php echo $row_edit['info'];?></textarea>
        <input name="id" type="hidden" id="id" value="<?php echo $row_edit['id'];?>" />
      </label></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi
        <input name="open" type="hidden" id="open" value="<?php echo $_GET['open'];?>" />
      </em></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="Save" type="submit" id="Save" value="Hapus" />
      </label>
        <label>
          <input type="button" name="Button" value="Batal" onclick="javascript:<?php if($_GET['open']=='window') { ?>window.close(2000);<?php }else{ ?>history.go(-1);<?php } ?>" />
        </label></td>
    </tr>
  </table>
</form>
