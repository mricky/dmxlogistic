<?php require_once('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"PD-5-1");


$query_area = "SELECT IDAREA, KODEAREA,NAMAAREA FROM area";

$item_area = mysql_query($query_area, $con_gl) or die(mysql_error());

$row_area = mysql_fetch_assoc($item_area);

$totalRows_area = mysql_num_rows($item_area);

$colname_edit = "-1";

if (isset($_GET['id'])) {

  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);

  

}



mysql_select_db($database_con_gl, $con_gl);

$query_edit = sprintf("SELECT * FROM v_kota WHERE IDKOTA = '$_GET[id]'", $colname_edit);

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

<h1>Edit Kota</h1>

<form action="proses/kota.php?act=edit" method="POST" name="edit" id="edit" >

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Area *:</td>
      <td bgcolor="#FFFFFF"><select name="area" id="area" style="width:210px;">
        <?php

do {  

?>
      
        
         <option value="<?php echo $row_area['IDAREA']?>"<?php if (!(strcmp($row_area['IDAREA'], $row_edit['IDAREA']))) {echo "selected=\"selected\"";} ?>><?php echo $row_area['NAMAAREA'];?></option>

       
        <?php

} while ($row_area = mysql_fetch_assoc($item_area));

  $row_area = mysql_num_rows($item_area);

  if($row_area > 0) {

      mysql_data_seek($row_area, 0);

	  $row_gem = mysql_fetch_assoc($row_area);

  }

?>
      </select></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Kode * :</td>
      <td bgcolor="#FFFFFF"><input name="kode" type="text" id="kode" size="30" maxlength="100"  value="<?php echo $row_edit['KODEKOTA']; ?>"/></td>
    </tr>
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Nama * :</td>
      <td width="80%" bgcolor="#FFFFFF"><input name="nama" type="text" id="nama" size="30" maxlength="100"  value="<?php echo $row_edit['NAMAKOTA']; ?>"/>
      <input name="id" type="hidden" id="id" value="<?php echo $row_edit['IDKOTA']; ?>" /></td>
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

