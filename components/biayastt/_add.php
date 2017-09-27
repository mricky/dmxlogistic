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
    	var tinggi = parseInt(document.getElementById('lebar').value);
		
		var weightdim = (panjang*lebar*tinggi)/4000;
	
		document.getElementById('weight').value = weightdim;
		document.getElementById('charge').value = weightdim * rate;
		grandTotal()
	
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



//Subcateogry Jewelry

mysql_select_db($database_con_gl, $con_gl);

$query_status = "SELECT ID, KODE FROM statusstt WHERE ID != 2 ORDER BY KODE ASC";

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
      <input type="text" name="customer" id="customer" placeholder="Cari Customer ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listCustomer&amp;open=window','name','925','450','yes');return false" />
          <?php 
		  
		  if(strstr($_SESSION['akses'],"DD-2-1")) { ?>
        <?php } ?>
      <label id="divKontak"></label></td>
      <td  valign="top" style="background:#FFF;">Nama :</td>
      <td valign="top" style="background:#FFF;"><input type="text" name="penerima" id="penerima" placeholder="Cari Penerima ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listPenerima&amp;open=window','name','925','450','yes');return false" />
        <?php 
		  
		  if(strstr($_SESSION['akses'],"DD-2-1")) { ?>
        <?php } ?>
        <label id="divKontak"></label></td>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;">Alamat :</td>
      <td valign="top" style="background:#FFF;"><div id="custaddress"></div></td>
      <td  valign="top" style="background:#FFF;">Alamat :</td>
      <td valign="top" style="background:#FFF;"><div id="penerimaaddress"></div></td>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;">No. Tlp :</td>
      <td valign="right" style="background:#FFF;"><div id="custtelpon"></div></td>
      <td valign="top" style="background:#FFF;">No. Tlp :</td>
      <td valign="top" style="background:#FFF;"><div id="penerimatelpon"></div></td>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;">Email :</td>
      <td valign="right" style="background:#FFF;"><div id="custemail"></div></td>
      <td valign="right" style="background:#FFF;">Email :</td>
      <td valign="top" style="background:#FFF;"><div id="penerimaemail"></div></td>
    </tr>
    <tr>
      <td align="right" style="background:#FFF;">Marketing :</td>
      <td valign="top" style="background:#FFF;"><div id="custmarketing"></div></td>
      <td valign="top" style="background:#FFF;">Keterangan :</td>
      <td valign="top" style="background:#FFF;">&nbsp;</td>
    </tr>
  </table>
</div>
<form action="proses/stt.php?act=add" method="post" name="add" id="add" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr>
      <th colspan="5">Informasi Surat Tanda Terima Barang </th>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <th colspan="3">Informasi Kota Pengiriman</th>
    </tr>
    <tr>
      <td width="8%" align="right" valign="top" bgcolor="#FFFFFF">No STT *: </td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="nostt" type="text" id="nostt" size="30" maxlength="100" />
      <input type="hidden" name="idcustomer" id="idcustomer" />
      <span style="background:#FFF;">
      <input type="hidden" name="idpenerima" id="idpenerima" />
      </span></td>
      <td width="1%" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">Asal * :</td>
      <td align="right" valign="top"><input type="hidden" name="idorigin" id="idorigin" />
        <input type="text" name="origin" id="origin" placeholder="Cari Kota Asal ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listOrigin&amp;open=window','name','925','450','yes');return false" /></td>
      <td width="23%" valign="top" bgcolor="#FFFFFF"><label></label></td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Tanggal STT * :</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="tanggalstt" type="text" class="calendar" id="tanggalstt" value="<?php echo date("Y/m/d");?>" size="12" maxlength="12"/></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="10%" align="right">Tujuan* : </td>
      <td width="17%" bgcolor="#FFFFFF"><input type="hidden" name="iddestination" id="iddestination" />
        <input type="text" name="destination" id="destination" placeholder="Cari Kota Tujuan ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listDestination&amp;open=window','name','925','450','yes');return false" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Tanggal Kirim :</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="tanggalkirim" type="text" class="calendar" id="tanggalkirim" value="<?php echo date("Y/m/d");?>" size="12" maxlength="12"/></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">Terusan *:</td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="idnextdest" id="idnextdest" />
        <input type="text" name="nextdest" id="nextdest" placeholder="Cari Kota Terusan ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listTerusan&amp;open=window','name','925','450','yes');return false" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Dimensi</td>
      <td width="3%" valign="top" bgcolor="#FFFFFF"><input type="checkbox" name="isdimensi" readonly="readonly" id='isdimensi' onclick="calcDimesi();" /></td>
      <td width="8%" valign="top" bgcolor="#FFFFFF">P :
      <input name="panjang" type="text" id="panjang" value="0" size="5" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="calcDimesi();"/></td>
      <td width="7%" valign="top" bgcolor="#FFFFFF">L :
      <input name="lebar" type="text" id="lebar" value="0" size="5" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="calcDimesi();"/></td>
      <td width="23%" valign="top" bgcolor="#FFFFFF">T:
      <input name="tinggi" type="text" id="tinggi" value="0" size="5" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="calcDimesi();"/></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">Layanan *:</td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="idservice" id="idservice" />
        <input type="text" name="service" id="service" placeholder="Cari Layanan ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listService&amp;open=window','name','925','450','yes');return false" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Berat</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="weight" type="text" id="weight" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungCharge();"/>
/ kg</td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">Armada *:</td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="idhandling" id="idhandling" />
        <input type="text" name="handling" id="handling" placeholder="Cari Armada ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listHandling&amp;open=window','name','925','450','yes');return false" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Collie</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="colly" type="text" id="colly"  value="0" size="20" maxlength="10" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA()";"/>
/ colly</td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">No SMU </td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="nosmu" type="text" id="nosmu" size="20" maxlength="10";" style="text-align:right;" /></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Status :</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><label></label>
      &nbsp;<label></label>
      <select name="statusstt" id="statusstt" style="width:210px;">
        <?php

do {  

?>
        <option value="<?php echo $row_status['ID']?>"><?php echo $row_status['KODE']?></option>
        <?php

} while ($row_status = mysql_fetch_assoc($item_status));

  $row_status = mysql_num_rows($item_status);

  if($row_status > 0) {

      mysql_data_seek($row_status, 0);

	  $row_gem = mysql_fetch_assoc($row_status);

  }

?>
      </select></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    

    <tr>
      <th colspan="5" align="center" valign="center" bgcolor="#FFFFFF"><label>Informasi Harga Pengiriman</label></th>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <th colspan="3" align="center" valign="top">Rincian Biaya Pengiriman</th>
    </tr>
    <tr valign="top">
      <td colspan="5" align="right" bgcolor="#FFFFFF"><span style="color:blue; background-color: #9999ff;">
        <input name="check_rate" type="button" id="check_rate" value="Check Rate"  onclick="var err=''; 
   				 if(document.getElementById('customer').value=='') err+='Customer harus dipilih\n'; 
if(err!='') alert(err);
else {                 NewWindow('index.php?component=stt&amp;task=listPricelist&amp;customer='+document.getElementById('idcustomer').value+'&amp;open=window','name','925','450','yes');return false }"/>
      </span></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Rate Kirim </td>
      <td colspan="4" bgcolor="#FFFFFF">        <input name="rate" type="text" id="rate" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/>
      / KG</td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right">Shipping</td>
      <td bgcolor="#FFFFFF"><input name="costshipping" type="text" id="costshipping" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td bgcolor="#FFFFFF"><input type="text" name="agentshipping" id="agentshipping" placeholder="Cari Pricelist Agent Shipping ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onchange="hitungBIAYA();" onclick="NewWindow('index.php?component=stt&amp;task=listShipping&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Charge Rp.:</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><!--
	  <label id="divListKendaraan">
        <select name="kendaraan" id="kendaraan" style="width:180px;">
          <option value="">Pilih Kendaraan</option>
        </select>
      </label>
	  -->
      <!-- Added by suwondo -->
      <input name="charge" type="text" id="charge" onchange="grandTotal();" value="0" size="20" maxlength="10" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" /></td>
      <td valign="top">&nbsp;</td>
      <td align="right">Delivery</td>
      <td valign="top"><input name="costdelivery" type="text" id="costdelivery" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td valign="top" bgcolor="#FFFFFF"><input type="text" name="agentdelivery" id="agentdelivery" placeholder="Cari Pricelist Agent Delivery ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listDelivery&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Charge Packing :</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="chargepacking" type="text" id="chargepacking" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="grandTotal();"/></td>
      <td valign="top">&nbsp;</td>
      <td align="right" valign="top">Warehouse</td>
      <td valign="top"><input name="costwarehouse" type="text" id="costwarehouse" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td valign="top" bgcolor="#FFFFFF"><input type="text" name="agentwarehouse" id="agentwarehouse" placeholder="Cari Pricelist Agent Warehouse ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listWarehouse&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Other Charge :</td>
      <td colspan="4" bgcolor="#FFFFFF"><input name="othercharge" type="text" id="othercharge" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="grandTotal();"/></td>
      <td align="right">&nbsp;</td>
      <td align="right">RA</td>
      <td><input name="costra" type="text" id="costra" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td bgcolor="#FFFFFF"><input type="text" name="agentra" id="agentra" placeholder="Cari Pricelist Agent Regulated ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listRegulated&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">&nbsp;Asuransi</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><select id="insurance" name="insurance" onchange="calcInsurance();" >
        <option value="0">0</option>
        <option value="0.35">0.35</option>
        <option value="0.20">0.20</option>
        <option value="10">10</option>
      </select>
        <input name="chargeinsurace" type="text" id="chargeinsurace"  value="0" size="10" maxlength="10" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA()";"/></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">Trucking</td>
      <td valign="top"><input name="costrucking" type="text" id="costrucking" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td valign="top" bgcolor="#FFFFFF"><input type="text" name="agenttrucking" id="agenttrucking" placeholder="Cari Pricelist Agent Trucking ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listTrucking&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Sub Total</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><label></label>
      <input name="subtotal" type="text" id="subtotal" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">GRDH</td>
      <td valign="top"><input name="costgrdh" type="text" id="costgrdh" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td valign="top" bgcolor="#FFFFFF"><input type="text" name="agentgrdh" id="agentgrdh" placeholder="Cari Pricelist Agent GRDH ..." size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=stt&amp;task=listGRDH&amp;open=window','name','925','450','yes');return false" /></td>
    </tr>
    
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">PPN</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input type="checkbox" name="isppn" readonly="readonly" id='isppn' onclick="calcPPN();" />
        <input name="ppn" type="text" id="ppn"  value="0" size="5" maxlength="10" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" />
%
<input name="nominalppn" type="text" id="nominalppn"  value="0" size="10" maxlength="10" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">Freight</td>
      <td valign="top"><input name="costfreight" type="text" id="costfreight" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Total Sales</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><input name="totalsales" type="text" id="totalsales" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" /></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">Fee Marketing</td>
      <td valign="top"><input name="feemarketing" type="text" id="feemarketing" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td align="right" valign="top">Refund Cust</td>
      <td valign="top"><input name="refundcust" type="text" id="refundcust" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="4" valign="top" bgcolor="#FFFFFF"><label></label></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <th align="right" valign="top">Total Cost</th>
      <td valign="top"><input name="totalcost" type="text" id="totalcost" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th align="right" bgcolor="#FFFFFF">&nbsp;</th>
      <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <th align="center" bgcolor="#FFFFFF">&nbsp;</th>
      <td align="left" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="4" bgcolor="#FFFFFF"><input name="Save" type="submit" id="Save" value="Simpan Order" />
        <input name="Cancel" type="button" id="Cancel" value="Batal" onclick="javascript:history.go(-1);"/></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="3" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
  </table>
  <input name="totalprofit" type="hidden" id="totalprofit" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';" onchange="hitungBIAYA();"/>
</form>
</body>
</html>
