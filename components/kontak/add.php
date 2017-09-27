<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"D-2-1");
// get unit kerja
mysql_select_db($database_con_gl, $con_gl);
$query_unitkerja = "select * from gl_unitkerja order by unitkerja";
$unitkerja       = mysql_query($query_unitkerja,$con_gl) or die(mysql_error());
$row_unitkerja   = mysql_fetch_assoc($unitkerja);
$total_unitkerja = mysql_num_rows($unitkerja);
// get lokasi kantor ( gudang )
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

	$('#add').submit(function() {
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
<h1>Tambah Data Karyawan</h1>
<form action="proses/kontak.php?act=add" method="POST" name="add" class="niceform" id="add">
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="datatable">
  <tr>
    <td width="21%" align="right">Kelompok Pegawai* : </td>
    <td width="79%"><select name="statkaryawan" id="statkaryawan" style="width:230px;">
      <option value="">Pilih Kelompok Pegawai</option>
      <option value="Staff">Staff</option>
      <option value="Sales">Sales</option>
      <option value="Driver">Driver</option>
      </select></td>
  </tr>
  <tr>
    <td align="right">NPWP / KTP: </td>
    <td><label>
      <input name="npwp" type="text" id="npwp" size="30" maxlength="100"/>
    </label></td>
  </tr>
  <tr>
    <td align="right">Nama*  : </td>
    <td><label>
      <input name="nama" type="text" id="nama" size="30" maxlength="100"/>
    </label></td>
  </tr>
  <tr>
    <td align="right">Unit Kerja* : </td>
    <td><select name="unitkerja" id="unitkerja" style="width:230px;">
        <option value="">Pilih Unit Kerja </option>
        <?php if($total_unitkerja > 0) { do { ?>
        <option value="<?php echo $row_unitkerja['id'];?>"><?php echo $row_unitkerja['unitkerja'];?></option>
        <?php }while($row_unitkerja = mysql_fetch_assoc($unitkerja)); } ?>
    </select></td>
  </tr>
  <tr valign="top">
    <td align="right">Alamat Rumah* : </td>
    <td><label>
      <textarea name="alamat" cols="85" rows="5" id="alamat"></textarea>
    </label></td>
  </tr>
  <tr valign="top">
    <td align="right">No.Telepon : </td>
    <td><label>
      <input name="tlp" type="text" id="tlp" size="30" maxlength="30" />
    </label></td>
  </tr>
  <tr>
    <td align="right">Email : </td>
    <td><label>
      <input name="email" type="text" id="email" size="30" maxlength="100" />
      <input name="id" type="hidden" id="id" />
    Format : abcde@xxxx.com </label></td>
  </tr>
  <tr valign="top">
    <td align="right">Keterangan : </td>
    <td><label>
      <textarea name="keterangan" cols="85" rows="5" id="keterangan"></textarea>
    </label></td>
  </tr>
  <tr>
    <td align="left"><label><em>*Harus diisi
          <input name="open" type="hidden" id="open" value="<?php echo $_GET['open'];?>" />
    </em></label></td>
    <td><label>
      <input name="Save" type="submit" id="Save" value="Simpan" />
      </label>
        <label>
          <input type="button" name="Button" value="Batal" onclick="javascript:<?php if($_GET['open']=='window') { ?>window.close(2000);<?php }else{ ?>history.go(-1);<?php } ?>" />
      </label></td>
  </tr>
</table>
</form>
