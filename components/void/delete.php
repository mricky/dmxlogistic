<?php require_once('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"MS-8-2");

mysql_select_db($database_con_gl, $con_gl);
$query_edit = "SELECT * FROM transaksipembayaran WHERE IDPEMBAYARAN = '$_GET[id]'";
$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);

//printf($query_edit);
// get referensi order

?>
<link href="ccss/ui.datepicker.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript">
<!--
$(function()
      {
        $('.calendar').datepicker({
            appendText : "",
            dateFormat : 'yy/mm/dd'
          });
      });
	  
</script>
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
<h1>Delete Pembayaran</h1>
<form action="proses/void.php?act=delete" method="POST" name="edit" id="edit" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Tanggal* :</td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <input name="tgl_bayar" type="text" class="calendar" id="tgl_bayar" value="<?php echo $row_edit['TGLBAYAR'];?>" size="20" maxlength="15"/>
      </label><label></label></td>
    </tr>
    
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">No Transaksi</td>
      <td bgcolor="#FFFFFF"><input type="text" name="no_transaksi" id="no_transaksi" readonly="readonly" size="28" value="<?php echo $row_edit['NOTRANSAKSI'];?>" /></td>
    </tr>
    
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Nominal</td>
      <td bgcolor="#FFFFFF"><input type="text" name="pmb_nominal" id="pmb_nominal" size="28" value="<?php echo $row_edit['TOTALBAYAR'];?>" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" /></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Keterangan : </td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="keterangan" cols="85" rows="5" id="keterangan"><?php echo $row_edit['keterangan'];?></textarea>
        <input name="id" type="hidden" id="id" value="<?php echo $row_edit['IDPEMBAYARAN'];?>" />
      </label></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi
        <input name="open" type="hidden" id="open" value="<?php echo $_GET['open'];?>" />
      </em></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="Save" type="submit" id="Save" value="Simpan" />
      </label>
        <label>
          <input type="button" name="Button" value="Batal" onclick="javascript:<?php if($_GET['open']=='window') { ?>window.close(2000);<?php }else{ ?>history.go(-1);<?php } ?>" />
        </label></td>
    </tr>
  </table>
</form>
