<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"JS-5-3");
$colname_edit = "-1";
if (isset($_GET['id'])) {
  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_con_gl, $con_gl);
$query_edit = sprintf("SELECT * FROM ref_dm_shape WHERE shape_code = %s", $colname_edit);
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
<h1>Delete Shape </h1>
<form action="proses/shape.php?act=delete" method="POST" name="delete" id="delete" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Shape Name * : </td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <input name="shape_name" type="text" id="shape_name" value="<?php echo $row_edit['shape_name']; ?>" size="30" maxlength="100" onFocus="this.blur();"/>
      </label></td>
    </tr>
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Image Name * : </td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <input name="image_delete" type="text" id="image_delete" value="<?php echo $row_edit['shape_image']; ?>" size="30" maxlength="100" onFocus="this.blur();"/>
      </label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Desciption : </td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="description" cols="85" rows="5" id="description" onFocus="this.blur();"><?php echo $row_edit['description']; ?></textarea>
        <input name="id" type="hidden" id="id" value="<?php echo $row_edit['shape_code']; ?>" />
      </label></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi</em></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="Save" type="submit" id="Save" value="Hapus" />
        </label>
          <label>
          <input type="button" name="Button" value="Batal" onClick="javascript:history.go(-1);">
        </label></td>
    </tr>
  </table>
</form>