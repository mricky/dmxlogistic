<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"PD-7-2");
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT id, area FROM gl_area ORDER BY area ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);

$colname_edit = "-1";
if (isset($_GET['id'])) {
  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_edit = sprintf("SELECT * FROM gl_gudang WHERE id = %s", $colname_edit);
$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
?>
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
	  $('#keterangan').wysiwyg();
  });
</script>
<script>
function sendRespondArea() {
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('divJenis');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
		if (ajaxRequest.readyState == 3) {
			var ajaxDisplay = document.getElementById('divJenis');
			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";
		}
	}
	ajaxRequest.open("GET", "include/send_respondarea.php", true);
	ajaxRequest.send(null);	
}
</script>

<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<h1>Edit Lokasi Kantor Cabang</h1>
<form action="proses/gudang.php?act=edit" method="POST" name="edit" id="edit" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Kota/Area* :</td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="area" id="area" value="<?php echo $row_edit['area']; ?>" />
        <?php list($namaarea) = mysql_fetch_row(mysql_query("select area from gl_area where id = '$row_edit[area]'"));?>
        <input type="text" name="txtarea" id="txtarea" readonly="readonly" value="<?php echo $namaarea; ?>" size="28" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=area&amp;task=listarea&amp;open=window','name','825','450','yes');return false" />
        <?php if(strstr($_SESSION['akses'],"PD-6-1")) { ?>
        <a href="index.php?component=area&amp;task=add&amp;open=window" onclick="NewWindow(this.href,'name','825','450','yes');return false"><img src="images/add_.png" hspace="2" border="0" /></a>
        <?php } ?></td>
    </tr>
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Lokasi Cabang* : </td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <input name="gudang" type="text" id="gudang" value="<?php echo $row_edit['gudang']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Kode Cabang* : </td>
      <td bgcolor="#FFFFFF"><input name="kodecabang" type="text" id="kodecabang" value="<?php echo $row_edit['kodecabang']; ?>" size="3" maxlength="3" /></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Alamat : </td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="keterangan" cols="85" rows="5" id="keterangan"><?php echo $row_edit['keterangan']; ?></textarea>
        <input name="id" type="hidden" id="id" value="<?php echo $row_edit['id']; ?>" />
      </label></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><div align="right">No. Telp : </div></td>
      <td bgcolor="#FFFFFF"><input name="tlp" type="text" id="tlp" value="<?php echo $row_edit['tlp']; ?>" size="30" maxlength="100" /></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi</em></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="Save" type="submit" id="Save" value="Simpan" />
        </label>
          <label>
          <input type="button" name="Button" value="Batal" onClick="javascript:history.go(-1);">
        </label></td>
    </tr>
  </table>
</form>
