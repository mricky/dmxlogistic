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
$query_data = "SELECT * from v_detailstt";
$query_data .=" where TGLCONNOTE != ''";

if(isset($_GET[decode_cr]) AND $_GET[decode_cr]<>'' AND $_GET[decode_cr]<>'+') { 
$decode_cr = $_GET[decode_cr];
$query_data .=" AND (NOCONNOTE LIKE '%%$decode_cr%%' OR NAMACUSTOMER LIKE '%%$decode_cr%%')";
}

if($_GET[mulai]<>'' AND $_GET[sampai]<>'') { 
$mulai = $_GET[mulai];
$sampai = $_GET[sampai];
$query_data .=" and TGLCONNOTE between '$_GET[mulai]' AND '$_GET[sampai]'";


}
if(isset($_GET[status]) AND $_GET[status]=='') { 

//$query_data .=" AND IDSTATUS ='$_GET[status]'";
}
else
{
$query_data .=" AND IDSTATUS ='$_GET[status]'";
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
<P align="center" class="style2"><strong>LAPORAN BIAYA STT</strong></P>
<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <th colspan="7" align="left">PERIODE : <?php echo $_GET[mulai]; ?> s/d <?php echo $_GET[sampai];?> </th>
</table>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
    <tr bgcolor="#CCCCCC">
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th colspan="7">Nama Agent</th>
      <th colspan="7">Biaya </th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr bgcolor="#CCCCCC">
      <th width="5">No.</th>
      <th width="30">No STT </th>
      <th width="30">No Resi Vendor</th>
      <th width="30">Tgl. STT</th>
      <th width="106">Tgl. Resi Vendor</th>
      <th width="106">Customer</th>
      <th width="50">Penerima</th>
      <th width="50">Berat</th>
      <th width="50">Colly (Kg)</th>
      <th width="50">Kota Asal</th>
      <th width="50">Kota Tujuan</th>
      <th width="50">Kota Terusan</th>
      <th width="50">Layanan</th>
      <th width="50">Armada</th>
      <th width="50">Maskapai</th>
      <th width="50">Shipping</th>
      <th width="50">Trucking</th>
      <th width="50">Delivery</th>
      <th width="50">RA</th>
      <th width="50">GRDH</th>
      <th width="50">Warehouse</th>
      <th width="50">Maskapai</th>
      <th width="50">Shipping</th>
      <th width="50">Trucking</th>
      <th width="50">Delivery</th>
      <th width="50">RA</th>
      <th width="50">GRDH</th>
      <th width="50">Warehouse</th>
      <th width="50">Fee Marketing</th>
      <th width="50">Refund Customer</th>
      <th width="50">Total Cost</th>
  </tr>
  <?php 	
  		$t_nominal = 0;
		
		$t_total = 0;?>
       
    <?php $i = 1;do { ?>
    	
        <tr valign="top">
          <td align="left"><?php echo $i;?></td>
          <td align="left"><?php echo $row_data['NOCONNOTE'];?></td>
          <td align="left"><?php echo $row_data['AIRWAYBILL'];?></td>
          <td align="left"><?php echo $row_data['TGLCONNOTE'];?></td>
          <td align="left"><?php echo $row_data['TGLMANIFEST']; ?></td>
          <td align="left"><?php echo $row_data['NAMACUSTOMER']; ?></td>
          <td align="left"><?php echo $row_data['NAMAPENERIMA']; ?></td>
          <td align="left"><?php $t_weight += $row_data['WEIGHT'];echo number_format($row_data['WEIGHT'],0,',','.').",-"; ?></td>
          <td align="left"><?php $t_colly += $row_data['COLLY'];echo number_format($row_data['COLLY'],0,',','.').",-"; ?></td>
          <td align="left"><?php echo $row_data['KOTAASAL']; ?></td>
          <td align="left"><?php echo $row_data['kotatujuan']; ?></td>
          <td align="left"><?php echo $row_data['NAMATERUSAN']; ?></td>
          <td align="left"><?php echo $row_data['NAMALAYANAN']; ?></td>
          <td align="left"><?php echo $row_data['NAMAJNSKIRIM']; ?></td>
          <td align="left"><?php echo $row_data['FRIGHT']; ?></td>
          <td align="left"><?php echo $row_data['SHIPPING']; ?></td>
          <td align="left"><?php echo $row_data['TRUCKING']; ?></td>
          <td align="left"><?php echo $row_data['DELIVERY']; ?></td>
          <td align="left"><?php echo $row_data['RA']; ?></td>
          <td align="left"><?php echo $row_data['GRDH']; ?></td>
          <td align="left"><?php echo $row_data['WAREHOUSE']; ?></td>
          <td align="left"><?php $tsmu += $row_data['COST_SMU'];echo number_format($row_data['COST_SMU'],0,',','.').",-"; ?></td>
          <td align="left"><?php $tshipping += $row_data['COST_SHIPPING'];echo number_format($row_data['COST_SHIPPING'],0,',','.').",-"; ?></td>
          <td align="left"><?php $ttrucking += $row_data['COST_TRUCKING'];echo number_format($row_data['COST_TRUCKING'],0,',','.').",-"; ?></td>
          <td align="left"><?php $tdelivery += $row_data['COST_DELIVERY'];echo number_format($row_data['COST_DELIVERY'],0,',','.').",-"; ?></td>
          <td align="left"><?php $tra += $row_data['COST_RA'];echo number_format($row_data['COST_RA'],0,',','.').",-"; ?></td>
          <td align="left"><?php $tgrdh += $row_data['COST_GRDH'];echo number_format($row_data['COST_GRDH'],0,',','.').",-"; ?></td>
          <td align="left"><?php $twarehouse += $row_data['COST_WAREHOUSE'];echo number_format($row_data['COST_WAREHOUSE'],0,',','.').",-"; ?></td>
          <td align="left"><?php $tmarketing += $row_data['COST_FEEMARKETING'];echo number_format($row_data['COST_FEEMARKETING'],0,',','.').",-"; ?></td>
          <td align="left"><?php $trefund += $row_data['COST_REFUNDCUST'];echo number_format($row_data['COST_REFUNDCUST'],0,',','.').",-"; ?></td>
          <td align="left"><?php $tcost += $row_data['TOTALCOST'];echo number_format($row_data['TOTALCOST'],0,',','.').",-"; ?></td>
        </tr>
        <?php 
		$nomor ++;
			$i++;
        } while ($row_data = mysql_fetch_assoc($data)); ?>
          <tr valign="top">
        <td align="left">Total</td>
          
        <td colspan="20" align="left">&nbsp;</td>
        <td align="left"><strong><?php echo number_format($tsmu,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($tshipping,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($ttrucking,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($tdelivery,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($tra,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($tgrdh,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($twarehouse,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($tmarketing,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($trefund,0,',','.').",-";?></strong></td>
        <td align="left"><strong><?php echo number_format($tcost,0,',','.').",-";?></strong></td>
    </tr> 
</table>
  
  
