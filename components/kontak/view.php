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
<h1>Lihat Data Karyawan</h1>
<form action="proses/kontak.php?act=edit" method="POST" name="edit" id="edit">
<table width="92%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="datatable">
  <tr>
    <td align="right">Area* : </td>
    <td><input type="hidden" name="area" id="area" value="<?php echo $row_edit['area']; ?>" />
        <?php list($namaarea) = mysql_fetch_row(mysql_query("select area from gl_area where id = '$row_edit[area]'"));?>
        <?php echo $namaarea; ?>
</td>
  </tr>
  
  <tr>
    <td width="26%" align="right">Kantor/Cabang* : </td>
    <td width="74%"><label></label>
    <label>
      <input type="hidden" name="area" id="area" value="<?php echo $row_edit['cabang']; ?>" />
	  <?php list($namacabang) = mysql_fetch_row(mysql_query("select gudang from gl_gudang where id = '$row_edit[gudang]'"));?>
	  <?php echo $namacabang; ?></label>
      </label></td>
  </tr>
  <tr>
    <td align="right">Kelompok Karyawan* : </td>
    <td><?php echo $row_edit['tkaryawan']; ?></td>
  </tr>
  <tr>
    <td align="right">NPWP : </td>
    <td><label>
      <?php echo $row_edit['npwp']; ?></label></td>
  </tr>
  <tr>
    <td align="right">Nama*  : </td>
    <td><label>
      <?php echo $row_edit['nama']; ?></label></td>
  </tr>
  <tr>
    <td align="right">Unit Kerja* : </td>
    <td><?php list($unitkerja) = mysql_fetch_row(mysql_query("select untkerja from gl_unitkerja where id='$row_edit[unitkerja]'")); echo $unitkerja; ?></td>
  </tr>
  <tr valign="top">
    <td align="right">Alamat Rumah* : </td>
    <td><label>
      <?php echo $row_edit['alamat']; ?>    </label></td>
  </tr>
  <tr valign="top">
    <td align="right">No.Telepon : </td>
    <td><label>
      <?php echo $row_edit['tlp']; ?></label></td>
  </tr>
  <tr>
    <td align="right">Email : </td>
    <td><label>
      <?php echo $row_edit['email']; ?>
	  <input name="id" type="hidden" id="id" value="<?php echo $row_edit['id']; ?>" />
    Format : abcde@xxxx.com </label></td>
  </tr>
  <tr valign="top">
    <td align="right">Keterangan : </td>
    <td><label>
      <?php echo $row_edit['keterangan']; ?>
    </label></td>
  </tr>
  <tr>
    <td align="left"><label><em>*Harus diisi</em></label></td>
    <td><label>
        <input type="button" name="Button" value="Tutup" onclick="javascript:window.close();" />
        </label></td>
  </tr>
</table>
</form>