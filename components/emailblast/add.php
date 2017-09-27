<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"PD-7-1");
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT id, area FROM gl_area ORDER BY area ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);
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
<h1>Informasi Customer</h1>
<form action="proses/emailblast.php?act=add" method="POST" name="add" id="add" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Kota/Area* : </td>
      <td bgcolor="#FFFFFF"><label id='divJenis'>	  <input type="hidden" name="area" id="area" />
	  <input type="text" name="txtarea" id="txtarea" size="28" readonly style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=area&amp;task=listarea&amp;open=window','name','825','450','yes');return false" /></label>
        <?php if(strstr($_SESSION['akses'],"PD-6-1")) { ?>
        <a href="index.php?component=area&amp;task=add&amp;open=window" onclick="NewWindow(this.href,'name','825','450','yes');return false"><img src="images/add_.png" hspace="2" border="0" /></a>
      <?php } ?></td>
    </tr>
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Nama* : </td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <input name="nama" type="text" id="nama" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Email* : </td>
      <td bgcolor="#FFFFFF"><input name="email" type="text" id="email" size="30" maxlength="100" /></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Alamat : </td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="alamat" cols="85" rows="5" id="alamat"></textarea>
        <input name="id" type="hidden" id="id" />
      </label></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><div align="right">No. Telp : </div></td>
      <td bgcolor="#FFFFFF"><input name="nohp" type="text" id="nohp" size="30" maxlength="100" /></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi
        <input name="open" type="hidden" id="open" value="<?php echo $_GET['open'];?>" />
      </em></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="Save" type="submit" id="Save" value="Simpan" />
        </label>
          <label>
          <input type="button" name="Button" value="Batal" onClick="javascript:<?php if($_GET['open']=='window') { ?>window.close(2000);<?php }else{ ?>history.go(-1);<?php } ?>">
        </label></td>
    </tr>
  </table>
</form>
