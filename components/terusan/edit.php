<?php require_once('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"PD-5-1");




$colname_edit = "-1";

if (isset($_GET['id'])) {

  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);

  

}



mysql_select_db($database_con_gl, $con_gl);

$query_edit = sprintf("SELECT * FROM v_terusan WHERE IDTERUSAN = '$_GET[id]'", $colname_edit);

$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());

$row_edit = mysql_fetch_assoc($edit);

$totalRows_edit = mysql_num_rows($edit);

//print_r($query_edit);



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

<h1>Edit Kota Terusan</h1>

<form action="proses/terusan.php?act=edit" method="POST" name="edit" id="edit" >

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Kode * :</td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="idorigin" id="idorigin" value="<?php echo $row_edit['IDKOTA']; ?>"/>
        <input type="text" name="origin" id="origin" placeholder="Cari Kota Asal ..." size="28" readonly="readonly" value="<?php echo $row_edit['NAMAKOTA']; ?>" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listOrigin&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Kota Terusan * :</td>
      <td width="80%" bgcolor="#FFFFFF"><input name="nama" type="text" id="nama" size="30" maxlength="100"  value="<?php echo $row_edit['NAMATERUSAN']; ?>"/>
      <input name="id" type="hidden" id="id" value="<?php echo $row_edit['IDTERUSAN']; ?>" /></td>
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

