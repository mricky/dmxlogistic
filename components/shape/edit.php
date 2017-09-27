<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"JS-5-2");
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

	$('#edit').submit(function() {
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: new FormData(this),
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
<h1>Edit Shape</h1>
<form action="proses/shape.php?act=edit" enctype="multipart/form-data" method="POST" name="edit" id="edit" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Shape Name* : </td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <input name="shape_name" type="text" id="shape_name" value="<?php echo $row_edit['shape_name']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr valign="top">
    <td align="right">Upload File :</td>
    <td width="80%" bgcolor="#FFFFFF"><label>
        <input type="file" name="imagefile" id="imagefile" accept="image/*" />
      (* hanya gambar)</label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Keterangan : </td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="description" cols="85" rows="5" id="description"><?php echo $row_edit['description']; ?></textarea>
        <input name="id" type="hidden" id="hidden" value="<?php echo $row_edit['shape_code']; ?>" />
        <input name="image_edit" type="text" id="image_edit" value="<?php echo $row_edit['shape_image']; ?>" />
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
