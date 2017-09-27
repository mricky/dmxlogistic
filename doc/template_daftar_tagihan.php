<?php require_once('../connections/con_gl.php'); ?>
<?php
$year = date('Y');
$month =  date('m');
//printf($query_dataremainderstnk);
mysql_select_db($database_con_gl, $con_gl);
$query_getcompany = "SELECT * FROM gl_gudang WHERE id = '$_GET[cabang]';";
$getcompany = mysql_query($query_getcompany, $con_gl) or die(mysql_error());
$row_getcompany = mysql_fetch_assoc($getcompany);
$totalRows_getcompany = mysql_num_rows($getcompany);
$query_data = "SELECT * from v_invoice";
$query_data .=" where TGLINVOICE != ''";

if(isset($_GET[decode_cr]) AND $_GET[decode_cr]<>'' AND $_GET[decode_cr]<>'+') { 
$decode_cr = $_GET[decode_cr];
$query_data .=" AND (KODEINVOICE LIKE '%%$decode_cr%%' OR NAMACUSTOMER LIKE '%%$decode_cr%%')";
}

if($_GET[mulai]<>'' AND $_GET[sampai]<>'') { 
$mulai = $_GET[mulai];
$sampai = $_GET[sampai];
$query_data .=" and TGLINVOICE between '$_GET[mulai]' AND '$_GET[sampai]'";


}

$data = mysql_query($query_data, $con_gl) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
//printf($query_data);
$mulai = $_GET['mulai'];
$akhir = $_GET['akhir'];    
	


?>
<style type="text/css">
<!--
.style2 {font-size: 18px}
-->
</style>

<P align="center"><span class="style2"><strong>PT. Dhiwantara Muda</strong></span></P>
<P align="center" class="style2"><strong>DAFTAR PIUTANG INVOICE</strong></P>
<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <th>PERIODE : <?php echo $_GET[mulai]; ?> s/d <?php echo $_GET[sampai];?> </th>
</table>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
    <tr bgcolor="#CCCCCC">
      <th width="5">No.</th>
      <th width="30"><strong>Tgl Invoice</strong></th>
      <th width="106">No Invoice</th>
      <th width="106"><span class="hide">Customer</span></th>
      <th width="50"><span class="hide">PPN</span></th>
      <th width="50"><span class="hide">Asuransi</span></th>
      <th width="50"><span class="hide">Packing</span></th>
      <th width="50"><span class="hide">Total Tagihan</span></th>
      <th width="50"><span class="hide">Bayar</span></th>
      <th width="50"><span class="hide">Sisa</span></th>
  </tr>
  <?php 	
  		$t_nominal = 0;
		
		$t_total = 0;?>
       
    <?php $i = 1;do { ?>
    	
        <tr valign="top">
          <td align="left"><?php echo $i;?></td>
          <td align="left"><?php echo $row_data['TGLINVOICE'];?></td>
          <td align="left"><?php echo $row_data['KODEINVOICE']; ?></td>
          <td align="left"><?php echo $row_data['NAMACUSTOMER']; ?></td>
          <td align="left"><?php $t_ppn += $row_data['PPN'];echo number_format($row_data['PPN'],0,',','.').",-"; ?></td>
          <td align="left"><?php $t_asuransi += $row_data['NBARNGINSURANCE'];echo number_format($row_data['NBARNGINSURANCE'],0,',','.').",-"; ?></td>
          <td align="left"><?php $t_packing += $row_data['PACKING'];echo number_format($row_data['PACKING'],0,',','.').",-"; ?></td>
          <td align="left"><?php $t_charge += $row_data['TOTAL_CHARGE'];echo number_format($row_data['TOTAL_CHARGE'],0,',','.').",-"; ?></td>
          <td align="left"><?php $t_bayar += $row_data['BAYAR'];echo number_format($row_data['BAYAR'],0,',','.').",-"; ?></td>
          <td align="left"><?php $t_sisa += $row_data['SISA'];echo number_format($row_data['SISA'],0,',','.').",-"; ?></td>
        </tr>
        <?php 
		$nomor ++;
			$i++;
        } while ($row_data = mysql_fetch_assoc($data)); ?>
    <tr valign="top">
      <td align="left">Total</td>
          
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="left"><strong><?php echo number_format($t_ppn,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($t_asuransi,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($t_packing,0,',','.').",-";?></strong></td>
      <td align="left"><strong><?php echo number_format($t_charge,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($t_bayar,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($t_sisa,0,',','.').",-";?></strong></td>
    </tr> 
</table>
  
  
