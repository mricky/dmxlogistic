<?php require_once('connections/con_gl.php'); ?>
<?php

cekAkses($_SESSION[akses],"KR-1-1");



mysql_select_db($database_con_gl, $con_gl);

$query_edit = sprintf("SELECT * FROM v_detailstt WHERE IDSTT = '$_GET[id]'", $colname_edit);

$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());

$row_edit = mysql_fetch_assoc($edit);

$totalRows_edit = mysql_num_rows($edit);

//print_r($query_edit);
/*
unset($_SESSION['stt']);
unset($_SESSION['trackingdate']);
unset($_SESSION['city']);
unset($_SESSION['idcity']);
unset($_SESSION['idstatus']);  
unset($_SESSION['status']);  
unset($_SESSION['desc']);
*/

?>

<link rel="stylesheet" type="text/css" href="css/ui.datepicker.css"/>
<style>
#cusinfo tr td {
	font-size:10px;	
}
.style1 {background-color: #FFF}
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
<h1>Tracking History</h1>
<form action="proses/tracking.php?act=add" method="post" name="add" id="add">

  <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">

    <tr valign="top">
      <th colspan="6" align="center">INFORMASI STT [ No STT :<?php echo $row_edit['NOCONNOTE']; ?> ]
      <input name="idstt" type="hidden" id="idstt" value=<?php echo $row_edit['IDSTT']; ?> size="30" maxlength="100" /></th>
    </tr>
    <tr valign="top">
      <td width="40%" align="right"><div align="center">INFO PEMESAN </div></td>
      <td width="60%">&nbsp;</td>
      <td width="60%"><div align="left">INFO PENERIMA </div></td>
      <td width="60%">&nbsp;</td>
      <td width="60%"><div align="left">INFO KIRIMAN </div></td>
      <td width="60%"><label id="divKontak"></label></td>
    </tr>
    

    <tr >
      <td  align="right" valign="top"><span style="background:#FFF;">Nama :</span></td>
      <td valign="top"><?php echo $row_edit['NAMACUSTOMER']; ?></td>
      <td valign="top"><span style="background:#FFF;">Nama :</span></td>
      <td valign="top"><?php echo $row_edit['NAMAPENERIMA']; ?></td>
      <td valign="top"><span class="style1" style="background:#FFF;">Kota Asal :</span></td>
      <td valign="top"><?php echo $row_edit['KOTAASAL']; ?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><span style="background:#FFF;">Alamat </span></td>
      <td valign="top"><?php echo $row_edit['ALAMAT']; ?></td>
      <td valign="top"><span style="background:#FFF;">Alamat :</span></td>
      <td valign="top"><?php echo $row_edit['ALAMATPENERIMA']; ?></td>
      <td valign="top"><span class="style1" style="background:#FFF;">Kota Kota Tujuan:</span></td>
      <td valign="top"><?php echo $row_edit['kotatujuan']; ?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><span style="background:#FFF;">No. Tlp :</span></td>
      <td valign="top"><?php echo $row_edit['TELEPON']; ?></td>
      <td valign="top"><span style="background:#FFF;">No. Tlp </span></td>
      <td valign="top"><?php echo $row_edit['TELEPONPENERIMA']; ?></td>
      <td valign="top">Terusan :</td>
      <td valign="top"><?php echo $row_edit['NAMATERUSAN']; ?></td>
    </tr>

    <tr>
      <td align="right" valign="top"><span style="background:#FFF;">Email :</span></td>
      <td valign="top"><?php echo $row_edit['EMAIL']; ?></td>
      <td valign="top"><span style="background:#FFF;">Email :</span></td>
      <td valign="top"><?php echo $row_edit['EMAILPENERIMA']; ?></td>
      <td valign="top">Layanan :</td>
      <td valign="top"><?php echo $row_edit['NAMALAYANAN']; ?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><span style="background:#FFF;">Marketing :</span></td>
      <td valign="top"><?php echo $row_edit['MARKETING']; ?></td>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td valign="top">Armada</td>
      <td valign="top"><?php echo $row_edit['NAMAJNSKIRIM']; ?></td>
    </tr>
    <tr>
      <td colspan="6" align="right" valign="top"><?php
	 
	  	  	
			
				unset($_SESSION['stt']);
				unset($_SESSION['trackingdate']);
				unset($_SESSION['city']);
				unset($_SESSION['idcity']);
				unset($_SESSION['idstatus']);  
				unset($_SESSION['status']);  
				unset($_SESSION['desc']);																												         	
			
			// ini untuk edit jika diperlukan

			mysql_select_db($database_con_gl, $con_gl);
			$query = mysql_query("SELECT IDSTT,tracking_date,tracking_city,NAMAKOTA,tracking_status_id,tracking_status_name,tracking_desc from v_tracking where IDSTT = '$_GET[id]'") or die (mysql_error());
			$i=0;		
			
			
			while(list($IDSTT,$tracking_date, $tracking_city,$NAMAKOTA,$tracking_status_id,$tracking_status_name,$tracking_desc) = mysql_fetch_row($query)){
			
				$_SESSION['stt'][$i] = $IDSTT;		
				$_SESSION['trackingdate'][$i] = $tracking_date;
				$_SESSION['city'][$i] = $NAMAKOTA;
				$_SESSION['idcity'][$i] = $tracking_city;
				$_SESSION['idstatus'][$i] = $tracking_status_id;				
				$_SESSION['status'][$i] = $tracking_status_name;				
				$_SESSION['desc'][$i] = $tracking_desc;									
																																			           		
				$i++;
			}
											
			
			?>			</td>
    </tr>
    

    <tr>

      <td colspan="6" align="right">
		<div id="ajaxDiv"><?php include "detailTracking.php"; ?></div>	</td>
    </tr>

    <tr>

      <td colspan="6" align="right"><input name="page" type="hidden" id="page" value="jual" />
        <label>

          <input name="Save" type="submit" id="Save" value="Save" />
      </label></td>
    </tr>
  </table>

  <input type="hidden" name="MM_update" value="add" />

  <input type="hidden" name="MM_insert" value="add" />

</form>

