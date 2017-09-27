  <?php require_once('connections/con_gl.php'); ?>
  <?php
cekAkses($_SESSION[akses],"PJ-7-2");
// -- info order
mysql_select_db($database_con_gl, $con_gl);
$query = "SELECT * from v_tagihan where ID = '$_GET[noreferensi]'";
$order = mysql_query($query, $con_gl) or die(mysql_error());
$row_order = mysql_fetch_assoc($order);
$totalRows_order = mysql_num_rows($order);

$query_listbayar = "SELECT * from v_list_bayar_tagihan where IDTAGIHAN = '$_GET[noreferensi]'";
$order_listbayar  = mysql_query($query_listbayar, $con_gl) or die(mysql_error());
$row_order_listbayar = mysql_fetch_assoc($order_listbayar);
$totalRows_order_listbayar = mysql_num_rows($order_listbayar);

// combo debit

?>
<link href="ccss/ui.datepicker.css" type="text/css" rel="stylesheet" />
<style>
#cusinfo tr td {
	font-size:10px;	
}
</style>
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript">
<!--
$(function()
      {
        $('.calendar').datepicker({
            appendText : "",
            dateFormat : ''
          });
      });
	  
</script>
<script type="text/javascript" src="js/ajax_data.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //alert( "ready!" );
	 var jnspembayaran = $('#cr_jenisbayar option:selected').text();
	 if(jnspembayaran == 'UANG MUKA')
	 {
	   // alert('SET POST KREDIT UANG MUKA');
		

		$("#cr_kredit").val("UANG MUKA PENJUALAN");


	 }
	 else
	 {
		 // PIUTANG USAHA RENTAL KENDARAAN RETAIL
		 $("#cr_kredit").val("PIUTANG USAHA RENTAL KENDARAAN RETAIL");
	 }
	 
    // alert($('#cr_jenisbayar option:selected').val());
	$().ajaxStart(function() {
		$('#loading').show();
		$('#result').hide();
	}).ajaxStop(function() {
		$('#loading').hide();
		$('#result').fadeIn('slow');
	});

	$('#bayar').submit(function() {
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
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading...."/></div>
<div id="result" style="display:none;"></div>
<div id="divDetail">
  <table width="100%" border="0" cellspacing="0" cellpadding="4" class="datatable" id="cusinfo">
    <tr>
      <th colspan="4" align="left"  style="background:#ed1c24" ><h1 style="color:#FFFFFF; text-shadow:none">PENGELUARAN BIAYA</h1></th>
    </tr>
    <tr>
      <th colspan="4" align="center"  style="background:#FFFFFF">&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" align="center">INFORMASI TAGIHAN</th>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;"><div align="left">TRANSAKSI</div></td>
      <td width="33%" valign="top" style="background:#FFF;">&nbsp;</td>
      <td valign="top" style="background:#FFF;">INFO ACCOUNT</td>
      <td width="31%" valign="top" style="background:#FFF;">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;">No Invoice :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_order['NOINV']; ?></td>
      <td width="16%" align="right" valign="top" style="background:#FFF;">BANK :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_order['BANK']; ?></td>
    </tr>
    <tr>
      <td width="20%" align="right" valign="top" style="background:#FFF;">Agent :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_order['NAMAAGENT']; ?></td>
      <td align="right" valign="top" style="background:#FFF;">No Akun :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_order['ACCOUNTNUMBER']; ?></td>
    </tr>
    <tr>
      <td align="right" valign="top" style="background:#FFF;">Keterangan :</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_order['KETERANGAN']; ?></td>
      <td align="right" valign="top" style="background:#FFF;">Atas Nama</td>
      <td valign="top" style="background:#FFF;"><?php echo $row_order['ATASNAMA']; ?></td>
    </tr>
  </table>
</div>
<h3>Daftar Detail Pembayaran</h3>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 
<tr>
    <th width="78"><strong>Tanggal </strong><?PHP echo $row_order['idgudang'];?></th>
    <th width="78"><strong>No Order</strong></th>
	<th width="78">Jenis Bayar </th>
   	<th width="78">Metode Bayar </th>
    <th width="78">Kasir</th> 
    <th width="78" align="center"><strong>Nominal</strong></th>

  </tr>
  	  <?php if($totalRows_order_listbayar > 0) { ?>
  <?php do { ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td><?php echo $row_order_listbayar['TGLBAYAR']; ?></td>
      <td><?php echo $row_order_listbayar['NOTRANSAKSI']; ?></td>
      <td><?php echo $row_order_listbayar['METODEBAYAR']; ?></td>
      <td><?php echo $row_order_listbayar['NAMAJENISBAYAR']; ?></td>            
      <td><?php echo $row_order_listbayar['CREATED_BY']; ?></td>
     <td><?php echo number_format($row_order_listbayar['TOTALBAYAR'],0,',','.').",-"; ?></td>
     
    </tr>
    <?php } while ($row_order_listbayar = mysql_fetch_assoc($order_listbayar)); ?>

   <?php }else{ ?>
  <tr bgcolor="#FFFFFF">
    <td colspan="5">Data tidak ada !!! </td>
  </tr>
  <?php } ?>
</table>
<br>
<?php

mysql_select_db($database_con_gl, $con_gl);

$query_cr_tipebayar = "SELECT IDMETODEBAYAR, METODEBAYAR FROM metodebayar";

$cr_tipebayar = mysql_query($query_cr_tipebayar, $con_gl) or die(mysql_error());

$row_cr_tipebayar = mysql_fetch_assoc($cr_tipebayar);

$totalRows_cr_gud = mysql_num_rows($cr_tipebayar);


$query_cr_jenisbayar = "select * from jenisbayar where IDJENISBAYAR not in(4)";

$cr_jenisbayar = mysql_query($query_cr_jenisbayar, $con_gl) or die(mysql_error());

$row_cr_jenisbayar = mysql_fetch_assoc($cr_jenisbayar);

$totalRows_cr_jenisbayar = mysql_num_rows($cr_jenisbayar);

?>

<form action="proses/pengeluaranbiaya.php?act=bayar&IDINVOICE=<?php echo $row_order['ID']?>" method="POST" name="bayar" id="bayar" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr>
      <th colspan="4">Pembayaran</th>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Metode Pembayaran :</td>
      <td width="15%" valign="top" bgcolor="#FFFFFF"><select name="cr_tipebayar">
        <?php

do {  

?>
        <option value="<?php echo $row_cr_tipebayar['IDMETODEBAYAR']?>"><?php echo $row_cr_tipebayar['METODEBAYAR']?></option>
        <?php

} while ($row_cr_tipebayar = mysql_fetch_assoc($cr_tipebayar));

  $rows = mysql_num_rows($cr_tipebayar);

  if($rows > 0) {

      mysql_data_seek($cr_tipebayar, 0);

	  $row_cr_tipebayar = mysql_fetch_assoc($cr_tipebayar);

  }

?>
      </select>
      <input name="no_ref" type="hidden" id="no_ref" value="<?php echo $_GET[noreferensi];?>" size="20" maxlength="10" style="text-align:right;" /></td>
      <td width="29%" valign="top" bgcolor="#FFFFFF">Jenis  Pembayaran 
        <select name="cr_jenisbayar" id="cr_jenisbayar">
          <?php

do {  

?>
          <option value="<?php echo $row_cr_jenisbayar['IDJENISBAYAR']?>"><?php echo $row_cr_jenisbayar['KODEJENISBAYAR']?></option>
          <?php

} while ($row_cr_jenisbayar = mysql_fetch_assoc($cr_jenisbayar));

  $rows = mysql_num_rows($cr_jenisbayar);

  if($rows > 0) {


      mysql_data_seek($cr_jenisbayar, 0);

	  $row_cr_jenisbayar = mysql_fetch_assoc($cr_jenisbayar);

  }

?>
        </select></td>
      <td valign="top" bgcolor="#FFFFFF">Total Sewa   Rp :
        <label></label>
        <input name="totalsewa" type="text" id="totalsewa"  value="<?php echo $row_order['JUMLAHTAGIHAN']; ?>" size="20" maxlength="10" style="text-align:right;" /></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Tgl Bayar</td>
      <td colspan="2" valign="top" bgcolor="#FFFFFF"><input name="tanggalbayar" type="text" class="calendar" id="tanggalbayar" value="<?php echo date("Y/m/d");?>" size="12" maxlength="12"/></td>
      <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">No Transfer</td>
      <td colspan="2" valign="top" bgcolor="#FFFFFF"><input name="notransfer" type="text" id="notransfer" size="20" maxlength="10";" style="text-align:right;" /></td>
      <td valign="top" bgcolor="#FFFFFF">Kekurangan Rp :
        <?php
		  $kekurangan = ($row_order['SISA'] == "" ? $row_order['JUMLAHTAGIHAN'] : $row_order['SISA']);
		  ?>
        <input name="kekurangan" type="text" id="kekurangan" readonly="readonly" value="<?php echo  $kekurangan; ?>" size="20" maxlength="10" style="text-align:right;" /></td>
    </tr>
    <tr>
      <td width="12%" align="right" valign="top" bgcolor="#FFFFFF">Pembayaran Rp </td>
      <td colspan="2" valign="top" bgcolor="#FFFFFF"><input name="nominalbayar" type="text" id="nominalbayar" value="0" size="20" maxlength="10";" style="text-align:right;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';"/></td>
      <td width="44%" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF">Keterangan Transaksi</td>
      <td colspan="2" valign="top" bgcolor="#FFFFFF"><textarea name="keterangan" cols="35" rows="2" id="keterangan"></textarea></td>
      <td valign="top" bgcolor="#FFFFFF"><label></label></td>
    </tr>
    <tr valign="top">
      <td align="right" valign="top" bgcolor="#FFFFFF"><input name="Save" type="submit" id="Save" value="Bayar" />
      :</td>
      <td colspan="2" valign="top" class="datatable"><input name="Cancel" type="button" id="Cancel" value="Batal" onclick="window.close();"/></td>
      <td valign="top" class="datatable"><!-- Added by suwondo -->&nbsp;&nbsp;
          <!-- Added by suwondo -->      </td>
    </tr>
    <tr valign="top">
      <td width="12%" align="right" bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="44%" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
       <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
  </table>
</form>

