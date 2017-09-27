<?php require_once('connections/con_gl.php'); ?>
<?php

cekAkses($_SESSION[akses],"KR-1-1");
include('include/widget_export_daftar_pricelistagent.php');
//print_r($query_edit);

unset($_SESSION['idagent']);
unset($_SESSION['agent']);
unset($_SESSION['idservice']);
unset($_SESSION['service']);  //  Door To Door
unset($_SESSION['idorigin']);
unset($_SESSION['origin']);
unset($_SESSION['iddestination']);
unset($_SESSION['destination']);
unset($_SESSION['idnextdest']);
unset($_SESSION['nextdest']);
unset($_SESSION['idhandling']);
unset($_SESSION['handling']); // Shipping, Delivery
unset($_SESSION['modatransport']);  // Darat Laut Udara
unset($_SESSION['idmodatransport']); 
unset($_SESSION['rate']);
unset($_SESSION['minpackage']);



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
<h1>Pricelist Agent Maskapai</h1>
<form action="proses/pricelistAgent.php?act=addPriceAgent" method="post" name="addPriceAgent" id="addPriceAgent">

  <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">

    <tr valign="top">
      <td align="right">Handling :</td>
      <td><input name="idhandling" type="hidden" id="idhandling" value="5" size="30" maxlength="100" />
        <input name="handling" type="text" id="handling" size="30" value="MASKAPAI" readonly="readonly" maxlength="100"  /></td>
    </tr>
    <tr valign="top">
      <td width="21%" align="right">Nama * :</td>
      <td width="72%"><label>
      <input name="nama" type="text" id="nama" size="30" maxlength="100"  />
      </label></td>
    </tr>

    <tr>
      <td align="right" valign="top">Alamat *:</td>
      <td valign="top"><textarea name="alamat" cols="85" rows="5" id="alamat"></textarea></td>
    </tr>

    <tr>
      <td align="right" valign="top">Telepon :</td>
      <td valign="top"><input name="telepon" type="text" id="telepon" size="30" maxlength="100"  /></td>
    </tr>
    <tr>
      <td align="right" valign="top">Fax :</td>
      <td valign="top"><input name="fax" type="text" id="fax" size="30" maxlength="100"/></td>
    </tr>
    <tr>

      <td align="right" valign="top">Hp :</td>
      <td valign="top">
	  <!-- Added by suwondo -->
	  <input name="hp" type="text" id="hp" size="30" maxlength="100" /></td>
    </tr>

    <tr>
      <td align="right" valign="top">NPWP :</td>
      <td valign="top"><input name="npwp" type="text" id="npwp" size="30" maxlength="100"/></td>
    </tr>
    <tr>
      <td align="right" valign="top">REKENING BANK :</td>
      <td valign="top"><input name="rekening" type="text" id="rekening" size="30" maxlength="100" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">ATAS NAMA :</td>
      <td valign="top"><input name="atas_nama" type="text" id="atas_nama" size="30" maxlength="100" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="right" valign="top"></td>
    </tr>
    

    <tr>

      <td colspan="2" align="right">
		<div id="ajaxDiv"><?php include "detailPricelistAgent.php"; ?></div>	</td>
    </tr>

    <tr>

      <td colspan="2" align="right"><input name="page" type="hidden" id="page" value="jual" />
        <label>

          <input name="Save" type="submit" id="Save" value="Save" />
      </label></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="add" />
  <input type="hidden" name="MM_insert" value="add" />
</form>

