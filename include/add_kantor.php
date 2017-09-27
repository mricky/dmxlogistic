<?php echo "<script>top.opener.location.reload();setTimeout(function(){ self.close();},2000);</script>";?>
<link type="text/css" rel="stylesheet" href="../css/jquery.wysiwyg.css" />
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery.wysiwyg.js"></script>
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
<h1>Tambah Lokasi Kantor/Cabang</h1>
<form action="proses/gudang.php?act=add" method="POST" name="add" id="add" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Kota/Area* : </td>
      <td bgcolor="#FFFFFF"><select name="area" id="area">
        
      </select></td>
    </tr>
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Lokasi Kantor/Cabang* : </td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <input name="gudang" type="text" id="gudang" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Alamat : </td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="keterangan" cols="85" rows="5" id="keterangan"></textarea>
        <input name="id" type="hidden" id="id" />
      </label></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><div align="right">No. Telp : </div></td>
      <td bgcolor="#FFFFFF"><input name="tlp" type="text" id="tlp" size="30" maxlength="100" /></td>
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
