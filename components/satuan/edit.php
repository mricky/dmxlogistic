<?php require('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"UK-1-2");

$colname_edit = "-1";

if (isset($_GET['id'])) {

  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);

}

mysql_select_db($database_con_gl, $con_gl);

$query_edit = sprintf("SELECT * FROM satuan WHERE SATUAN_ID = %s", $colname_edit);

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

<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>

<div id="result" style="display:none;"></div>

<h1>Edit Nama Satuan</h1>

<form action="proses/satuan.php?act=edit" method="POST" name="edit" id="edit" >

  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

    <tr valign="top">

      <td width="20%" align="right" bgcolor="#FFFFFF">Kode* : </td>

      <td width="80%" bgcolor="#FFFFFF"><label>

        <input name="kode" type="text" id="unitkerja" value="<?php echo $row_edit['KODESATUAN']; ?>" size="30" maxlength="100" />

      </label></td>

    </tr>

    <tr valign="top">

      <td align="right" bgcolor="#FFFFFF">Nama : </td>

      <td bgcolor="#FFFFFF"><label>
      <input name="nama" type="text" id="nama" value="<?php echo $row_edit['NAMASATUAN']; ?>" size="30" maxlength="100" />
      <input name="id" type="hidden" id="id" value="<?php echo $row_edit['SATUAN_ID']; ?>" />

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

