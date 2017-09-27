<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
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
<script type="text/javascript">
function callPricelistGRDH()
{
  var idfright = parseInt(document.getElementById('idfright').value);
 
  NewWindow('index.php?component=biayastt&amp;task=listPricelist&amp;open=window','name','925','450','yes');return false
  
}
function calcPPN()
{
  if (document.getElementById('isppn').checked) 
  {
  	 // fix charge + other charge + packing * 10 %
 	 // pastikan untuk ppn
	  subTotal();
	  var totalcharge  = parseInt(document.getElementById('subtotal').value);
	  
	  var nominalppn = totalcharge * 10/100;
      
	  document.getElementById('ppn').value = 10;
	  document.getElementById('nominalppn').value = nominalppn;
	  grandTotal();
	  

  } else {
      //calculate();
	  document.getElementById('ppn').value = 0;
	  document.getElementById('nominalppn').value = 0;
	 // grandTOTAL();
  }
}
function subTotal()
{
	 var charge = parseInt(document.getElementById('charge').value);	
	 var othercharge = parseInt(document.getElementById('othercharge').value);	
	 var chargepacking = parseInt(document.getElementById('chargepacking').value);	
	 var totalcharge  = charge + othercharge + chargepacking;	 
     document.getElementById('subtotal').value = totalcharge;	

}
function grandTotal()
{
   // sub total + ppn + asuransi
   subTotal();
   var totalcharge  = parseInt(document.getElementById('subtotal').value);
   var nominalppn = parseInt(document.getElementById('nominalppn').value);
   var chargeinsurace = parseInt(document.getElementById('chargeinsurace').value);
   var totalsales =  totalcharge + nominalppn + chargeinsurace;
   
   document.getElementById('totalsales').value = totalsales;
}

function calcInsurance()
{
	 
 	 // pastikan untuk ppn
	  var charge = parseFloat(document.getElementById('charge').value);	
	  var insurance = parseFloat(document.getElementById('insurance').value);	
	  var nominalinsurance = charge * insurance / 100;
      
	  alert(insurance);
	  document.getElementById('chargeinsurace').value = nominalinsurance;
	  
	 grandTotal()
  
}
function calcDimesi()
{
  if (document.getElementById('isdimensi').checked) 
  {
  		document.getElementById('weight').value = 0;
    	document.getElementById('charge').value = 0;
		
		var rate = parseInt(document.getElementById('rate').value);
		var panjang = parseInt(document.getElementById('panjang').value);
		var lebar = parseInt(document.getElementById('lebar').value);
    	var tinggi = parseInt(document.getElementById('tinggi').value);
		
		var handling = document.getElementById('idhandling');
		if (typeof handling !== "undefined" && handling.value == '') {
				alert("Handling belum terpilih");
				document.getElementById('panjang').value = 0;
				document.getElementById('lebar').value = 0;
    			document.getElementById('tinggi').value = 0;
	
		}
		else
		{
			if(handling.value == 2 || handling.value == 3)
			{
				//alert("Dara / Laut (:4000)");
				var weightdim = (panjang*lebar*tinggi)/4000;
			}
			else
			{
				//alert("Dara / Laut (:6000)");
				var weightdim = (panjang*lebar*tinggi)/6000;
			}
			document.getElementById('weight').value = weightdim;
			document.getElementById('charge').value = weightdim * rate;
			grandTotal()
		}
		
	
  } else {
      //calculate();
	    document.getElementById('panjang').value = 0;
        document.getElementById('lebar').value = 0;
        document.getElementById('tinggi').value = 0;
		document.getElementById('weight').value = 0;
    	document.getElementById('charge').value = 0;
     	document.getElementById('subtotal').value = 0;
     	document.getElementById('totalsales').value = 0;
  }
}

function hitungCharge()
{
	var rate = parseInt(document.getElementById('rate').value);
	var weight = parseInt(document.getElementById('weight').value);
	
	document.getElementById('charge').value =	rate * weight;
	grandTotal()
}
function hitungBIAYA()
{
	
	//document.getElementById('biaya').value = 0;
	var costshipping = parseInt(document.getElementById('costshipping').value);
	var costdelivery = parseInt(document.getElementById('costdelivery').value);
	var costwarehouse = parseInt(document.getElementById('costwarehouse').value);
	var costra = parseInt(document.getElementById('costra').value);
	var costrucking = parseInt(document.getElementById('costrucking').value);
	var costgrdh = parseInt(document.getElementById('costgrdh').value);
	
    var costfreight = parseInt(document.getElementById('costfreight').value);
	var feemarketing = parseInt(document.getElementById('feemarketing').value);
	var refundcust = parseInt(document.getElementById('refundcust').value);
	
	
	
	document.getElementById('totalcost').value = costshipping+costdelivery+costwarehouse+costra+costrucking+costgrdh+costfreight+feemarketing+refundcust;
	
		

}
	
</script>
<?php require_once('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"MS-8-1");

$colname_edit = "-1";
if (isset($_GET['id'])) {
  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
  
}

mysql_select_db($database_con_gl, $con_gl);
$query_edit = sprintf("SELECT * FROM v_detailstt WHERE IDSTT = '$_GET[id]'", $colname_edit);
$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
print_r($query_edit);

//Subcateogry Jewelry

mysql_select_db($database_con_gl, $con_gl);

$query_status = "SELECT * FROM statusstt ORDER BY KODE ASC";

$item_status = mysql_query($query_status, $con_gl) or die(mysql_error());

$row_status = mysql_fetch_assoc($item_status);

$totalRows_status = mysql_num_rows($item_status);

?>
<script type="text/javascript" src="js/ajax_data.js"></script>
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
});

</script>
<h1>Tambah Transaksi Terima Barang</h1>
<div id="divDetail">
  <table width="100%" border="0" cellspacing="0" cellpadding="4" class="datatable" id="cusinfo">
    <tr>
      <th colspan="4" align="center">INFORMASI PELANGGAN</th>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;"><div align="left">INFO PEMESAN </div></td>
      <td width="37%" valign="top" style="background:#FFF;">&nbsp;</td>
      <td width="16%" valign="top" style="background:#FFF;">INFO PENERIMA </td>
      <td width="31%" valign="top" style="background:#FFF;">&nbsp;</td>
    </tr>
    
    <tr>
      <td width="16%" align="right" valign="top" style="background:#FFF;">Nama :</td>
      <td width="38%" valign="top" bgcolor="#FFFFFF"><label></label>
      <!-- Added by suwondo -->
      <input type="text" name="customer" id="customer" placeholder="Cari Customer ..." size="28" readonly="readonly" value="<?php echo $row_edit['NAMACUSTOMER']; ?>" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listCustomer&amp;open=window','name','925','450','yes');return false" />
          <?php 
		  
		  if(strstr($_SESSION['akses'],"DD-2-1")) { ?>
        <?php } ?>
      <label id="divKontak"></label></td>
      <td  valign="top" style="background:#FFF;">Nama :</td>
      <td valign="top" style="background:#FFF;"><input type="text" name="penerima" id="penerima" placeholder="Cari Penerima ..." size="28" readonly="readonly" value="<?php echo $row_edit['NAMAPENERIMA']; ?>" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listPenerima&amp;open=window','name','925','450','yes');return false" />
        <?php 
		  
		  if(strstr($_SESSION['akses'],"DD-2-1")) { ?>
        <?php } ?>
        <label id="divKontak"></label></td>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;">Alamat :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_edit['ALAMAT']; ?></td>
      <td  valign="top" style="background:#FFF;">Alamat :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_edit['ALAMATPENERIMA']; ?></td>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;">No. Tlp :</td>
      <td valign="right" style="background:#FFF;"><?php echo $row_edit['TELEPON']; ?></td>
      <td valign="top" style="background:#FFF;">No. Tlp :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_edit['TELEPONPENERIMA']; ?></td>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;">Email :</td>
      <td valign="right" style="background:#FFF;"><?php echo $row_edit['EMAIL']; ?></td>
      <td valign="right" style="background:#FFF;">Email :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_edit['EMAILPENERIMA']; ?></td>
    </tr>
    <tr>
      <td align="right" style="background:#FFF;">Marketing :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_edit['MARKETING']; ?></td>
      <td valign="top" style="background:#FFF;">Keterangan :</td>
      <td valign="top" style="background:#FFF;">&nbsp;</td>
    </tr>
  </table>
  </div>
<form action="proses/biayastt.php?act=edit" method="post" name="edit" id="edit" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr>
      <th colspan="5">Informasi Surat Tanda Terima Barang </th>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <th colspan="5">Informasi Kota Pengiriman</th>
    </tr>
    <tr>
      <td width="7%" align="right" valign="top" bgcolor="#FFFFFF">No STT *: </td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="nostt" type="text" id="nostt" size="30" maxlength="100" value="<?php echo $row_edit['NOCONNOTE']; ?>" />
      <input type="hidden" name="idcustomer" id="idcustomer" value="<?php echo $row_edit['IDCUSTOMER']; ?>" />
      <span style="background:#FFF;">
      <input type="hidden" name="idpenerima" id="idpenerima" value="<?php echo $row_edit['IDPENERIMA']; ?>" />
      <input type="hidden" name="idstt" id="idstt" value="<?php echo $colname_edit; ?>" />
      </span></td>
      <td width="1%" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">&nbsp;</td>
      <td align="right" valign="top">Kota Asal * :</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><input type="hidden" name="idorigin" id="idorigin" value="<?php echo $row_edit['IDORIGIN']; ?>"/>
        <input type="text" name="origin" id="origin" placeholder="Cari Kota Asal ..." size="28" readonly="readonly" value="<?php echo $row_edit['KOTAASAL']; ?>" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listOrigin&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Tanggal STT * :</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><span style="background:#FFF;">
        <input name="tanggalstt" type="text" class="calendar" id="tanggalstt" value="<?php echo $row_edit['TGLCONNOTE']; ?>" size="12" maxlength="12"/>
      </span></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="12%" align="right">&nbsp;</td>
      <td width="12%" align="right">Kota Tujuan * : </td>
      <td width="21%" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="21%" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="21%" bgcolor="#FFFFFF"><input type="hidden" name="iddestination" id="iddestination"  value="<?php echo $row_edit['IDDESC']; ?>"/>
        <input type="text" name="destination" id="destination" placeholder="Cari Kota Tujuan ..." size="28" readonly="readonly" value="<?php echo $row_edit['kotatujuan']; ?>" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listDestination&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Tanggal Kirim :</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="tanggalkirim" type="text" class="calendar" id="tanggalkirim" value="<?php echo $row_edit['TGLMANIFEST']; ?>" size="12" maxlength="12"/></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">Kota Terusan *:</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="idnextdest" id="idnextdest" value="<?php echo $row_edit['IDTERUSAN']; ?>" />
        <input type="text" name="nextdest" id="nextdest" placeholder="Cari Kota Terusan ..." size="28" readonly="readonly"value="<?php echo $row_edit['NAMATERUSAN']; ?>" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listTerusan&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Dimensi :</td>
      <td width="3%" valign="top" bgcolor="#FFFFFF"><input type="checkbox" name="isdimensi" readonly="readonly" id='isdimensi' value="yes"<?php echo ($row_edit['DIM_P']>0 ? 'checked' : '');?> onclick="calcDimesi();" /></td>
      <td width="9%" valign="top" bgcolor="#FFFFFF">P :
      <input name="panjang" type="text" id="panjang" value="<?php echo $row_edit['DIM_P']; ?>" size="5" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="calcDimesi();"/></td>
      <td width="10%" valign="top" bgcolor="#FFFFFF">L :
      <input name="lebar" type="text" id="lebar" value="<?php echo $row_edit['DIM_L']; ?>" size="5" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="calcDimesi();"/></td>
      <td width="31%" valign="top" bgcolor="#FFFFFF">T:
      <input name="tinggi" type="text" id="tinggi" value="<?php echo $row_edit['DIM_T']; ?>" size="5" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="calcDimesi();"/></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">Layanan *:</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="idservice" id="idservice" value="<?php echo $row_edit['IDLAYANAN']; ?>" />
        <input type="text" name="service" id="service" placeholder="Cari Layanan ..." size="28" readonly="readonly" value="<?php echo $row_edit['NAMALAYANAN']; ?>" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listService&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Berat</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="weight" type="text" id="weight" value="<?php echo $row_edit['WEIGHT']; ?>"  size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungCharge();"/>
/ kg</td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">Armada *:</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="idhandling" id="idhandling" value="<?php echo $row_edit['IDHANDLING']; ?>" />
        <input type="text" name="handling" id="handling" placeholder="Cari Armada ..." size="28" readonly="readonly" value="<?php echo $row_edit['NAMAJNSKIRIM']; ?>" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listHandling&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Collie</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="colly" type="text" id="colly" value="<?php echo $row_edit['COLLY']; ?>" size="20" maxlength="10" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA()";"/>
/ colly</td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">No SMU</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="nosmu" type="text" id="nosmu" size="20"  value="<?php echo $row_edit['NOSMU']; ?>" maxlength="10";" style="text-align:right;" /></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Status :</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><label></label>
        &nbsp;<label>
        <select name="statusstt" id="statusstt" style="width:210px;">
          <?php

do {  

?>
          <option value="<?php echo $row_status['ID']?>"<?php if (!(strcmp($row_status['ID'], $row_edit['IDSTATUS']))) {echo "selected=\"selected\"";} ?>><?php echo $row_status['KODE'];?></option>
          <?php

} while ($row_status = mysql_fetch_assoc($item_status));

  $row_status = mysql_num_rows($item_status);

  if($row_status > 0) {

      mysql_data_seek($row_status, 0);

	  $row_gem = mysql_fetch_assoc($row_status);

  }

?>
        </select>
      </label></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    
    
    
    <tr>
      <th colspan="5" align="center" valign="center" bgcolor="#FFFFFF"><label>Informasi Harga Pengiriman</label></th>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <th colspan="5" align="center" valign="top">Rincian Biaya Pengiriman</th>
    </tr>
    <tr valign="top">
      <td colspan="4" align="left" bgcolor="#FFFFFF"><span style="color:blue; background-color: #9999ff;">
        <input name="check_rate" type="button" id="check_rate" value="Check Rate"  onclick="NewWindow('index.php?component=stt&amp;task=listPricelist&amp;customer=1&amp;open=window','name','925','450','yes');return false"/>
      </span></td>
      <td align="right" bgcolor="#FFFFFF">Rate Kirim
        <input name="rate" type="text" id="rate" value="<?php echo $row_edit['RATE_KIRIM']; ?>" size="10" maxlength="20";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/>
/ KG</td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">Freight :</td>
      <td align="left"><span style="color:blue; background-color: #9999ff;">
        <input name="fregiht" type="button" id="fregiht" value="..." onclick="NewWindow('index.php?component=biayastt&amp;task=listAgent&amp;agent=5&amp;open=window','name','925','450','yes');return false"/>
        <input name="idfright" type="hidden" id="idfright" size="5" maxlength="5" />
      </span></td>
      <td bgcolor="#FFFFFF"><input type="text" name="agentfright" id="agentfright" value="<?php echo $row_edit['FRIGHT']; ?>" placeholder="Cari Pricelist Agent Maskapai ..." size="28" readonly="readonly" style="border:1px solid #ff0000;"  /></td>
      <td bgcolor="#FFFFFF"><span style="color:blue; background-color: #9999ff;">
        <input name="check_rate3" type="button" id="check_rate3" value="..."  onclick="NewWindow('index.php?component=biayastt&amp;task=listPricelistAgent&amp;id='+parseInt(document.getElementById('idfright').value)+'&amp;weight='+parseInt(document.getElementById('weight').value)+'&amp;open=window','name','925','450','yes');return false"/>
      </span></td>
      <td bgcolor="#FFFFFF"><input name="costfreight" type="text" id="costfreight" value="<?php echo $row_edit['COST_SMU']; ?>" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
    </tr>
    
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Charge Rp.:</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="charge" type="text" id="charge" readonly="readonly" onchange="grandTotal();" value="<?php echo $row_edit['CHARGE_KIRIM']; ?>" size="20" maxlength="10" style="border:1px solid #ff0000;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">GRDH :</td>
      <td align="left" valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="grdh" type="button" id="grdh" value="..." onclick="NewWindow('index.php?component=biayastt&amp;task=listAgent&amp;agent=6&amp;open=window','name','925','450','yes');return false"/>
        <input name="idgrdh" type="hidden" id="idgrdh" size="5" maxlength="5" />
      </span></td>
      <td valign="top"><input type="text" name="agentgrdh" id="agentgrdh" value="<?php echo $row_edit['GRDH']; ?>" placeholder="Cari Pricelist Agent GRDH ..." size="28" readonly="readonly" style="border:1px solid #ff0000;" onclick="NewWindow('index.php?component=stt&amp;task=listGRDH&amp;open=window','name','925','450','yes');return false" /></td>
      <td valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="check_rate2" type="button" id="check_rate2" value="..."  onclick="NewWindow('index.php?component=biayastt&amp;task=listPricelistAgent&amp;id='+parseInt(document.getElementById('idgrdh').value)+'&amp;weight='+parseInt(document.getElementById('weight').value)+'&amp;open=window','name','925','450','yes');return false"/>
      </span></td>
      <td valign="top"><input name="costgrdh" type="text" id="costgrdh"  value="<?php echo $row_edit['COST_GRDH']; ?>" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Charge Packing :</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><label>
      <input name="chargepacking" type="text" id="chargepacking" value="<?php echo $row_edit['PACKING']; ?>" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="grandTotal();"/>
      </label></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">RA :</td>
      <td align="left" valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="ra" type="button" id="ra" value="..." onclick="NewWindow('index.php?component=biayastt&amp;task=listAgent&amp;agent=4&amp;open=window','name','925','450','yes');return false"/>
        <input name="idra" type="hidden" id="idra" size="5" maxlength="5" />
      </span></td>
      <td valign="top"><input type="text" name="agentra" id="agentra" value="<?php echo $row_edit['RA']; ?>" placeholder="Cari Pricelist Agent Regulated ..." size="28" readonly="readonly" style="border:1px solid #ff0000;" onclick="NewWindow('index.php?component=stt&amp;task=listRegulated&amp;open=window','name','925','450','yes');return false" /></td>
      <td valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="check_rate4" type="button" id="check_rate4" value="..."  onclick="NewWindow('index.php?component=biayastt&amp;task=listPricelistAgent&amp;id='+parseInt(document.getElementById('idra').value)+'&amp;weight='+parseInt(document.getElementById('weight').value)+'&amp;open=window','name','925','450','yes');return false"/>
      </span></td>
      <td valign="top"><input name="costra" type="text" id="costra"  size="20" maxlength="10";" value="<?php echo $row_edit['COST_RA']; ?>" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
    </tr>
    
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Other Charge :</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="othercharge" type="text" id="othercharge" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="grandTotal();"/></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">Warehouse :</td>
      <td align="left" valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="warehouse" type="button" id="warehouse" value="..." onclick="NewWindow('index.php?component=biayastt&amp;task=listAgent&amp;agent=3&amp;open=window','name','925','450','yes');return false"/>
        <input name="idwarehouse" type="hidden" id="idwarehouse" size="5" maxlength="5" />
      </span></td>
      <td valign="top"><input type="text" name="agentwarehouse" id="agentwarehouse" value="<?php echo $row_edit['WAREHOUSE']; ?>" placeholder="Cari Pricelist Agent Warehouse ..." size="28" readonly="readonly" style="border:1px solid #ff0000;" onclick="NewWindow('index.php?component=stt&amp;task=listWarehouse&amp;open=window','name','925','450','yes');return false" /></td>
      <td valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="check_rate5" type="button" id="check_rate5" value="..."  onclick="NewWindow('index.php?component=biayastt&amp;task=listPricelistAgent&amp;id='+parseInt(document.getElementById('idwarehouse').value)+'&amp;weight='+parseInt(document.getElementById('weight').value)+'&amp;open=window','name','925','450','yes');return false"/>
      </span></td>
      <td valign="top"><input name="costwarehouse" type="text" id="costwarehouse" value="<?php echo $row_edit['COST_WAREHOUSE']; ?>" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">&nbsp;Asuransi</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><select id="insurance" name="insurance" onchange="calcInsurance();" >
       	
        <option value="0"<?php echo $row_edit['INCURANCEPERCENT'] == "0.35" ? ' selected="selected"' : ""; ?>>0</option>
        <option value="0.35"<?php echo $row_edit['INCURANCEPERCENT'] == "0.35" ? ' selected="selected"' : ""; ?>>0.35</option>
        <option value="0.20"<?php echo $row_edit['INCURANCEPERCENT'] == "0.20" ? ' selected="selected"' : ""; ?>>0.20</option>
        <option value="10"<?php echo $row_edit['INCURANCEPERCENT'] == "10" ? ' selected="selected"' : ""; ?>>10</option>
      </select>
      <input name="chargeinsurace" type="text" id="chargeinsurace"  value="<?php echo $row_edit['NBARANGINSURANCE']; ?>" size="10" maxlength="10" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA()";"/></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">Trucking :</td>
      <td align="left" valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="trucking" type="button" id="trucking" value="..." onclick="NewWindow('index.php?component=biayastt&amp;task=listAgent&amp;agent=7&amp;open=window','name','925','450','yes');return false"/>
        <input name="idtrucking" type="hidden" id="idtrucking" size="5" maxlength="5" />
      </span></td>
      <td valign="top"><input type="text" name="agenttrucking" id="agenttrucking" value="<?php echo $row_edit['TRUCKING']; ?>" placeholder="Cari Pricelist Agent Trucking ..." size="28" readonly="readonly" style="border:1px solid #ff0000;" onclick="NewWindow('index.php?component=stt&amp;task=listTrucking&amp;open=window','name','925','450','yes');return false" /></td>
      <td valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="check_rate6" type="button" id="check_rate6" value="..."  onclick="NewWindow('index.php?component=biayastt&amp;task=listPricelistAgent&amp;id='+parseInt(document.getElementById('idtrucking').value)+'&amp;weight='+parseInt(document.getElementById('weight').value)+'&amp;open=window','name','925','450','yes');return false"/>
      </span></td>
      <td valign="top"><input name="costrucking" type="text" id="costrucking" value="<?php echo $row_edit['COST_TRUCKING']; ?>" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Sub Total</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="subtotal" type="text" id="subtotal" readonly="readonly" value="0" size="20" maxlength="10";" style="border:1px solid #ff0000;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">Shipping :</td>
      <td align="left" valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="shipping" type="button" id="shipping" value="..." onclick="NewWindow('index.php?component=biayastt&amp;task=listAgent&amp;agent=1&amp;open=window','name','925','450','yes');return false"/>
        <input name="idshipping" type="hidden" id="idshipping" size="5" maxlength="5" />
      </span></td>
      <td valign="top"><input type="text" name="agentshipping" id="agentshipping" value="<?php echo $row_edit['SHIPPING']; ?>"  placeholder="Cari Pricelist Agent Shipping ..." size="28" readonly="readonly" style="border:1px solid #ff0000;" onchange="hitungBIAYA();" onclick="NewWindow('index.php?component=stt&amp;task=listShipping&amp;open=window','name','925','450','yes');return false" /></td>
      <td valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="check_rate7" type="button" id="check_rate7" value="..."  onclick="NewWindow('index.php?component=biayastt&amp;task=listPricelistAgent&amp;id='+parseInt(document.getElementById('idshipping').value)+'&amp;weight='+parseInt(document.getElementById('weight').value)+'&amp;open=window','name','925','450','yes');return false"/>
      </span></td>
      <td valign="top"><input name="costshipping" type="text" id="costshipping" value="<?php echo $row_edit['COST_SHIPPING']; ?>" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">PPN</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><label>
        <input type="checkbox" name="isppn" readonly="readonly" id='isppn' value="yes"<?php echo ($row_edit['PPNPERCENT']>0 ? 'checked' : '');?> onclick="calcPPN();" />
          <input name="ppn" type="text" id="ppn"  value="<?php echo $row_edit['PPNPERCENT']; ?>" size="5" maxlength="10" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" />
%
<input name="nominalppn" type="text" id="nominalppn"  value="<?php echo $row_edit['PPN']; ?>"  size="10" maxlength="10" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" />
      </label></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">Delivery      
      :<td align="left">&nbsp;</th></span>
        <span style="color:blue; background-color: #9999ff;">
        <input name="delivery" type="button" id="delivery" value="..." onclick="NewWindow('index.php?component=biayastt&amp;task=listAgent&amp;agent=2&amp;open=window','name','925','450','yes');return false"/>
        <input name="iddelivery" type="hidden" id="iddelivery" size="5" maxlength="5" />
        </span>
      <td valign="top"><input type="text" name="agentdelivery" id="agentdelivery" value="<?php echo $row_edit['DELIVERY']; ?>" placeholder="Cari Pricelist Agent Delivery ..." size="28" readonly="readonly" style="border:1px solid #ff0000;" onclick="NewWindow('index.php?component=stt&amp;task=listDelivery&amp;open=window','name','925','450','yes');return false" /></td>
      <td valign="top"><span style="color:blue; background-color: #9999ff;">
        <input name="check_rate8" type="button" id="check_rate8" value="..."  onclick="NewWindow('index.php?component=biayastt&amp;task=listPricelistAgent&amp;id='+parseInt(document.getElementById('iddelivery').value)+'&amp;weight='+parseInt(document.getElementById('weight').value)+'&amp;open=window','name','925','450','yes');return false"/>
      </span></td>
      <td valign="top"><input name="costdelivery" type="text" id="costdelivery" value="<?php echo $row_edit['COST_DELIVERY']; ?>" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
    </tr>
    <tr>
      <th align="right" bgcolor="#FFFFFF">Total Sales</th>
      <td colspan="4" bgcolor="#FFFFFF"><input name="totalsales" type="text" id="totalsales" value="<?php echo $row_edit['TOTALSALES']; ?>" size="20" maxlength="10";" readonly="readonly" style="border:1px solid #ff0000;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="left" bgcolor="#FFFFFF">Fee Marketing
      <td align="left" bgcolor="#FFFFFF">
      
      <td align="left" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="left" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="left" bgcolor="#FFFFFF"><input name="feemarketing" type="text" id="feemarketing" value="<?php echo $row_edit['COST_FEEMARKETING']; ?>" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="left" bgcolor="#FFFFFF">&nbsp;
        </th>
        Refund Customer      
      <td align="left" bgcolor="#FFFFFF">
      
      <td align="left" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="left" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="left" bgcolor="#FFFFFF"><input name="refundcust" type="text" id="refundcust" value="<?php echo $row_edit['COST_REFUNDCUST']; ?>" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="4" bgcolor="#FFFFFF"><input name="Save" type="submit" id="Save" value="Simpan Order" />
        <input name="Cancel" type="button" id="Cancel" value="Batal" onclick="javascript:history.go(-1);"/></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="5" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
