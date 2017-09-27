<?php require_once('connections/con_gl.php'); ?>
<?php

cekAkses($_SESSION[akses],"KR-1-1");

echo 'MODE MAINTENANCE';

mysql_select_db($database_con_gl, $con_gl);

$query_edit = sprintf("SELECT * FROM agent WHERE ID_AGENT = '$_GET[id]'", $colname_edit);

$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());

$row_edit = mysql_fetch_assoc($edit);

$totalRows_edit = mysql_num_rows($edit);

//print_r($query_edit);

unset($_SESSION['stt']);
unset($_SESSION['idservice']);
unset($_SESSION['service']);
unset($_SESSION['idorigin']);  //  Door To Door
unset($_SESSION['origin']);
unset($_SESSION['iddestination']);
unset($_SESSION['destination']);
unset($_SESSION['idnextdest']);
unset($_SESSION['nextdest']);
unset($_SESSION['modatransport']);  // Darat Laut Udara
unset($_SESSION['idmodatransport']); 
unset($_SESSION['weight']);
unset($_SESSION['tcharge']);



// salesman / marketing

$res = mysql_query("SELECT getNOINVOICE('2017-01-01','2017-01-30','C01') AS result");
	
	
printf($res['result']);
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
<h1>Pembuatan Invoice</h1>
<form action="proses/invoice.php?act=addInvoice" method="post" name="editPriceAgent" id="editPriceAgent">

  <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">

    <tr valign="top">
      <td width="21%" align="right">Customer *:</td>
      <td width="72%"><input type="text" name="customer" id="customer" placeholder="Cari Customer ..." size="28" readonly style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=invoice&amp;task=listCustomer&amp;open=window','name','925','450','yes');return false" />
        <?php 
		  
		  if(strstr($_SESSION['akses'],"DD-2-1")) { ?>
        <?php } ?>
        <label id="divKontak">
        <input type="hidden" name="idcustomer" id="idcustomer" />
      </label></td>
    </tr>
    

    <tr>
      <td align="right" valign="top">Tanggal </td>
      <td valign="top"><input name="tanggalstt" type="text" class="calendar" id="tanggalstt" value="<?php echo date("Y/m/d");?>" size="12" maxlength="12"/></td>
    </tr>
    <tr>
      <td align="right" valign="top">No Invoice *:</td>
      <td valign="top"><input name="noinvoice" readonly="readonly" type="text" id="noinvoice" size="30" maxlength="100" value="INV<?php echo time();?>"  /> 
      (*auto generate by system)</td>
    </tr>
    <tr>
      <td align="right" valign="top">Keterangan *:</td>
      <td valign="top"><textarea name="alamat" cols="85" rows="5" id="alamat"><?php echo $row_edit['ALAMAT']; ?></textarea></td>
    </tr>

    <tr>
      <td align="right" valign="top">&nbsp;</td>
      <td valign="top"><span style="font-size:14px; border:#E2E73E">* Daftar STT yang mucul adalah sesuai dengan nama customer dan status stt invoce</span></td>
    </tr>
    <tr>
      <td colspan="2" align="right" valign="top"><?php
	 
		  	  	
				unset($_SESSION['stt']);
				unset($_SESSION['idservice']);				
				unset($_SESSION['service']);
				unset($_SESSION['idorigin']);
				unset($_SESSION['origin']);
				unset($_SESSION['iddestination']);
				unset($_SESSION['destination']);
				unset($_SESSION['idnextdest']);
				unset($_SESSION['nextdest']);
				unset($_SESSION['modatransport']);
				unset($_SESSION['idmodatransport']); 
				unset($_SESSION['weight']);
				unset($_SESSION['tcharge']);																													         	
			
			// ini untuk edit jika diperlukan
			/*
			mysql_select_db($database_con_gl, $con_gl);
			$query = mysql_query("SELECT IDSTT,NOCONNOTE, NAMAPENERIMA,IDSERVICE,NAMALAYANAN,IDHANDLING,NAMAJNSKIRIM,IDORIGIN,KOTAASAL,IDDESC,KOTATUJUAN,WEIGHT,TOTAL_CHARGE  from v_invoice_detail ORDER BY NOCONNOTE") or die (mysql_error());
			$i=0;
			
			
			
			while(list($IDSTT,$NOCONNOTE, $NAMAPENERIMA,$IDSERVICE,$NAMALAYANAN,$IDHANDLING,$NAMAJNSKIRIM,$IDORIGIN,$KOTAASAL,$IDDESC,$KOTATUJUAN,$WEIGHT,$TOTAL_CHARGE) = mysql_fetch_row($query)){
			
				$_SESSION['stt'][$i] = $IDSTT;		
				$_SESSION['idservice'][$i] = $IDLAYANAN;
				$_SESSION['service'][$i] = $NAMALAYANAN;
				$_SESSION['idorigin'][$i] = $IDORIGIN;
				$_SESSION['origin'][$i] = $KOTAASAL;				
				$_SESSION['iddestination'][$i] = $IDDESC;				
				$_SESSION['destination'][$i] = $KOTATUJUAN;									
				$_SESSION['modatransport'][$i] = $NAMAJNSKIRIM;	
				$_SESSION['idmodatransport'][$i] = $IDHANDLING;				
				$_SESSION['weight'][$i] = $WEIGHT;																	
				$_SESSION['tcharge'][$i] = $TOTAL_CHARGE;																																	           		
				$i++;
			}
											
			*/
			?>
			</td>
    </tr>
    

    <tr>

      <td colspan="2" align="right">
		<div id="ajaxDiv"><?php include "detailSTT.php"; ?></div>	</td>
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

