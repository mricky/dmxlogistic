<?php require('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"UK-1-1");

mysql_select_db($database_con_gl, $con_gl);

$query_klas = "SELECT id, unitkerja FROM gl_unitkerja ORDER BY unitkerja ASC";

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



<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>

<div id="result" style="display:none;"></div>

<h1>Tambah Layanan </h1>

<form action="proses/tarif_layanan.php?act=add" method="POST" name="add" id="add" >

  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">


    <tr valign="top">

      <td width="20%" align="right" bgcolor="#FFFFFF">Nama Satuan : </td>

      <td width="80%" bgcolor="#FFFFFF"><label>
      <input name="nama" type="text" id="nama" size="30" maxlength="100" />
      <input name="id" type="hidden" id="id" />

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

