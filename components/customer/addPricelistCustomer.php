<?php require_once('connections/con_gl.php'); ?>
<?php

cekAkses($_SESSION[akses],"KR-1-1");



mysql_select_db($database_con_gl, $con_gl);



include('include/widget_export_daftar_pricelistcustomer.php');


//print_r($query_edit);
unset($_SESSION['idpricelist']);
unset($_SESSION['idcustomer']);
unset($_SESSION['idservice']);
unset($_SESSION['service']);
unset($_SESSION['idorigin']);
unset($_SESSION['origin']);
unset($_SESSION['iddestination']);
unset($_SESSION['destination']);
unset($_SESSION['idnextdest']);
unset($_SESSION['nextdest']);
unset($_SESSION['idhandling']);
unset($_SESSION['handling']);
unset($_SESSION['charge']);
unset($_SESSION['weight']);
unset($_SESSION['duration']);
unset($_SESSION['description']);


// salesman / marketing

?>

<link rel="stylesheet" type="text/css" href="css/ui.datepicker.css"/>
<style>
#cusinfo tr td {
	font-size:10px;	
}
</style>
<script type="text/javascript" src="js/ajax_data.js"></script>
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript">
<!--
$(function(){
	$('.calendar').datepicker({
		appendText : "",
		dateFormat : 'yy/mm/dd'
	});
});
</script>

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
</script>


</script>
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<h1>Pricelist Customer</h1>
<form action="proses/pricelistCustomer.php?act=addPriceCustomer" method="post" name="addPriceCustomer" id="addPriceCustomer">

  <table width="98%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">

    <tr valign="top">
      <td align="right">Nama * :</td>
      <td><label>
      <input name="nama" type="text" id="nama" size="30" maxlength="100"/>
      <input name="id" type="hidden" id="id" size="30" maxlength="100" />
      </label></td>

      <td width="12%" align="right">&nbsp;</td>

      <td colspan="4">&nbsp;</td>
      </td>
    </tr>

    <tr>
      <td align="right" valign="top">Alamat *:</td>
      <td valign="top"><textarea name="alamat" cols="85" rows="5" id="alamat"></textarea></td>
      <td align="right" valign="top">&nbsp;</td>
      <td colspan="4" valign="top">&nbsp;</td>
    </tr>

    <tr>
      <td align="right" valign="top">Telepon :</td>
      <td valign="top"><input name="telepon" type="text" id="telepon" size="30" maxlength="100" /></td>
      <td align="right" valign="top">&nbsp;</td>
      <td colspan="4" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top">Fax :</td>
      <td valign="top"><input name="fax" type="text" id="fax" size="30" maxlength="100" /></td>
      <td align="right" valign="top">&nbsp;</td>
      <td colspan="4" valign="top">&nbsp;</td>
    </tr>
    <tr>

      <td align="right" valign="top">Hp :</td>
      <td valign="top">
	  <!-- Added by suwondo -->
	  <input name="hp" type="text" id="hp" size="30" maxlength="100"/></td>

      <td align="right" valign="top">&nbsp;</td>
      <td colspan="4" valign="top">&nbsp;</td>
    </tr>

    <tr>
      <td align="right" valign="top">Marketing :</td>
      <td valign="top"><input name="marketing" type="text" id="marketing" size="30" maxlength="100"/></td>
      <td align="right" valign="top">&nbsp;</td>
      <td colspan="4" valign="top"><div id="divKeterangan">
        <input name="cid" type="hidden" id="cid" value=""/>
      </div></td>
    </tr>
    <tr>
      <td colspan="7" align="right" valign="top"></td>
    </tr>
    

    <tr>

      <td colspan="7" align="right">
		<div id="ajaxDiv"><?php include "detailAddPricelistCustomer.php"; ?></div>	</td>
    </tr>

    <tr>

      <td align="right">&nbsp;</td>

      <td colspan="6" align="right"><input name="page" type="hidden" id="page" value="jual" />
        <label>

          <input name="Save" type="submit" id="Save" value="Save" />
        </label></td>
    </tr>
  </table>

  <input type="hidden" name="MM_update" value="add" />

  <input type="hidden" name="MM_insert" value="add" />

</form>

