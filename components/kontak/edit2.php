<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"D-2-2");
// ---
mysql_select_db($database_con_gl, $con_gl);
$query_edit = "SELECT * FROM gl_kontak WHERE id = '$_GET[id]'";
$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
?>
<link type="text/css" rel="stylesheet" href="css/jquery.wysiwyg.css" />
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript">
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
    <td align="right">Area* : </td>
    <td>
	<input type="hidden" name="area" id="area" value="<?php echo $row_edit['area']; ?>" />
	  <?php list($namaarea) = mysql_fetch_row(mysql_query("select area from gl_area where id = '$row_edit[area]'"));?>
	  <input type="text" name="txtarea" id="txtarea" readonly value="<?php echo $namaarea; ?>" size="28" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=area&amp;task=list&amp;open=window','name','825','450','yes');return false" />
       <?php if(strstr($_SESSION['akses'],"PD-6-1")) { ?>
		<a href="index.php?component=area&amp;task=add&amp;open=window" onclick="NewWindow(this.href,'name','825','450','yes');return false"><img src="images/add_.png" hspace="2" border="0" style="position:absolute;" /></td>
  </tr>
  <tr>
    <td width="21%" align="right">Kantor/Cabang* : </td>
    <td width="79%"><label></label>
	<input type="hidden" name="cabang" id="cabang" value="<?php echo $row_edit['cabang']; ?>" />
	  <?php list($namacabang) = mysql_fetch_row(mysql_query("select gudang from gl_gudang where id = '$row_edit[cabang]'"));?>
	  <input type="text" name="txtcabang" id="txtcabang" value="<?php echo $namacabang; ?>" size="28" readonly style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=gudang&amp;task=list&amp;area='+document.getElementById('area').value+'&amp;open=window','name','825','450','yes');return false" />
	  <?php if(strstr($_SESSION['akses'],"PD-7-1")) { ?>
        <a href="index.php?component=gudang&amp;task=add&amp;area='+document.getElementById('area').value+'&amp;open=window" onclick="NewWindow(this.href,'name','825','450','yes');return false"><img src="images/add_.png" hspace="2" border="0" style="position:absolute;" /></a>
    </td>
  </tr>
  <tr>
    <td align="right">Level Pegawai* : </td>
    <td><select name="statkaryawan" id="statkaryawan" style="width:180px;">
      <option value="Staff" selected="selected" <?php if (!(strcmp("Staff", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Staff</option>
      <option value="Sales" <?php if (!(strcmp("Sales", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Sales</option>
      <option value="Supir" <?php if (!(strcmp("Driver", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Supir</option>
    </select></td>
  </tr>
  <tr>
    <td align="right">NPWP : </td>
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
    <td><select name="unitkerja" id="unitkerja" style="width:180px;">
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
      <input name="tlp" type="text" id="tlp" value="<?php echo $row_edit['tlp']; ?>" size="10" maxlength="20" />
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