<?php require_once('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"PD-5-1");

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

<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<h1>New Polish</h1>
<form action="proses/polish.php?act=add" method="POST" name="add" id="add" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Polish Name* : </td>
      <td bgcolor="#FFFFFF"><input name="name" type="text" id="name" size="30" maxlength="100" /></td>
    </tr>
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Description* :</td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <input name="description" type="text" id="description" size="30" maxlength="100" />
      </label></td>
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
