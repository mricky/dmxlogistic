
<?php require_once('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"D-2-2");
// ---
mysql_select_db($database_con_gl, $con_gl);
$query_edit = "SELECT * FROM gl_kontak WHERE id = '$_GET[id]'";
$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
// get lokasi kantor ( gudang )
mysql_select_db($database_con_gl, $con_gl);
$query_lokasi = "select * from gl_gudang order by gudang";
$lokasi       = mysql_query($query_lokasi,$con_gl) or die(mysql_error());
$row_lokasi   = mysql_fetch_assoc($lokasi);
$total_lokasi = mysql_num_rows($lokasi);
// get unit kerja
mysql_select_db($database_con_gl, $con_gl);
$query_unitkerja = "select * from gl_unitkerja order by unitkerja";
$unitkerja       = mysql_query($query_unitkerja,$con_gl) or die(mysql_error());
$row_unitkerja   = mysql_fetch_assoc($unitkerja);
$total_unitkerja = mysql_num_rows($unitkerja);

?>
<link type="text/css" rel="stylesheet" href="css/jquery.wysiwyg.css" />
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript">
// --- cek karyawan
function checkKaryawan(val) {
	if(val=='Karyawan') {
		document.getElementById('lkantor').disabled='';	
	}else{
		document.getElementById('lkantor').value='';
		document.getElementById('lkantor').disabled='disabled';		
	}
}
// ---
$(document).ready(function() {

	$().ajaxStart(function() {
		$('#loading').show();
		$('#result').hide();
	}).ajaxStop(function() {
		$('#loading').hide();
		$('#result').fadeIn('slow');
	});

	$('#edit').submit(function() {
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
      $('#alamat').wysiwyg();
	  $('#keterangan').wysiwyg();
  });
</script>
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<h1>Edit Data Karyawan</h1>
<form action="proses/kontak.php?act=edit" method="POST" name="edit" id="edit">
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="datatable">
  <tr>
    <td width="21%" align="right">Kelompok Karyawan* : </td>
    <td width="79%"><select name="statkaryawan" id="statkaryawan" style="width:230px;" >
      <option value="Staff" selected="selected" <?php if (!(strcmp("Staff", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Staff</option>
      <option value="Sales" <?php if (!(strcmp("Driver", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Sales</option>
      <option value="Driver" <?php if (!(strcmp("Driver", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Driver</option>
      </select></td>
  </tr>
  <tr>
    <td align="right">NPWP / KTP: </td>
    <td><label>
      <input name="npwp" type="text" id="npwp" value="<?php echo $row_edit['npwp']; ?>" size="30" maxlength="100"/>
    </label></td>
  </tr>
  <tr>
    <td align="right">Nama*  : </td>
    <td><label>
      <input name="nama" type="text" id="nama" value="<?php echo $row_edit['nama']; ?>" size="30" maxlength="100"/>
    </label></td>
  </tr>
  <tr>
    <td align="right">Unit Kerja* : </td>
    <td><select name="unitkerja" id="unitkerja" style="width:230px;">
        <option value="">Pilih Unit Kerja</option>
        <?php if($total_unitkerja > 0) { do { ?>
        <option value="<?php echo $row_unitkerja['id'];?>" <?php if($row_unitkerja['id']==$row_edit['unitkerja']) { ?>selected="selected"<?php } ?>><?php echo $row_unitkerja['unitkerja'];?></option>
        <?php }while($row_unitkerja = mysql_fetch_assoc($unitkerja)); } ?>
    </select></td>
  </tr>
  <tr valign="top">
    <td align="right">Alamat Rumah* : </td>
    <td><label>
      <textarea name="alamat" cols="85" rows="5" id="alamat"><?php echo $row_edit['alamat']; ?></textarea>
    </label></td>
  </tr>
  <tr valign="top">
    <td align="right">No.Telepon : </td>
    <td><label>
      <input name="tlp" type="text" id="tlp" value="<?php echo $row_edit['tlp']; ?>" size="30" maxlength="20" />
    </label></td>
  </tr>
  <tr>
    <td align="right">Email : </td>
    <td><label>
      <input name="email" type="text" id="email" value="<?php echo $row_edit['email']; ?>" size="30" maxlength="100" />
      <input name="id" type="hidden" id="id" value="<?php echo $row_edit['id']; ?>" />
    Format : abcde@xxxx.com </label></td>
  </tr>
  <tr valign="top">
    <td align="right">Keterangan : </td>
    <td><label>
      <textarea name="keterangan" cols="85" rows="5" id="keterangan"><?php echo $row_edit['keterangan']; ?></textarea>
    </label></td>
  </tr>
  <tr>
    <td align="left"><label><em>*Harus diisi</em></label></td>
    <td><label>
      <input name="Save" type="submit" id="Save" value="Simpan" />
      </label>
        <label>
        <input type="button" name="Button" value="Batal" onClick="javascript:history.go(-1);">
      </label></td>
  </tr>
</table>
</form>