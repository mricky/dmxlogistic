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

<h1>Penerima Baru</h1>

<form action="proses/consignee.php?act=add" method="POST" name="add" id="add" >

  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

    <tr valign="top">

      <td align="right" bgcolor="#FFFFFF">Nama * : </td>

      <td bgcolor="#FFFFFF"><input name="nama" type="text" id="nama" size="30" maxlength="100" /></td>
    </tr>

    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Alamat *:</td>
      <td bgcolor="#FFFFFF"><textarea name="alamat" cols="85" rows="5" id="alamat"></textarea></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Telepon</td>
      <td bgcolor="#FFFFFF"><input name="telepon" type="text" id="telepon" size="30" maxlength="100" /></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Fax</td>
      <td bgcolor="#FFFFFF"><input name="fax" type="text" id="fax" size="30" maxlength="100" /></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Hp :</td>
      <td bgcolor="#FFFFFF"><input name="hp" type="text" id="hp" size="30" maxlength="100" /></td>
    </tr>
    <tr valign="top">

      <td width="20%" align="right" bgcolor="#FFFFFF">Email :</td>

      <td width="80%" bgcolor="#FFFFFF"><label>
        <input name="hp2" type="email" id="text" size="30" maxlength="100" />
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

