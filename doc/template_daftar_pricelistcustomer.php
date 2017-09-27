<?php require_once('../connections/con_gl.php'); ?>
<?php
$year = date('Y');
$month =  date('m');
//printf($query_dataremainderstnk);
mysql_select_db($database_con_gl, $con_gl);
$customerid = $_GET['customerid'];  
$query_getcustomer = "SELECT * FROM customer WHERE IDCUSTOMER = '$_GET[customerid]';";
$getcustomer = mysql_query($query_getcustomer, $con_gl) or die(mysql_error());
$row_getcustomer = mysql_fetch_assoc($getcustomer);
$totalRows_getcustomer = mysql_num_rows($getcustomer);


$query_data = "SELECT * from v_pricelist_customer";

$data = mysql_query($query_data, $con_gl) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
//printf($query_data);



?>
<style type="text/css">
<!--
.style2 {font-size: 18px}
-->
</style>

<P align="center"><span class="style2"><strong>PT. Dhiwantara Muda</strong></span></P>
<P align="center" class="style2"><strong>PRICELIST CUSTOMER : <?php echo $row_data['NAMACUSTOMER']; ?></strong></P>
<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <th>&nbsp;</th>
</table>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
    <tr bgcolor="#CCCCCC">
      <th width="5">No.</th>
      <th width="30">Service</th>
      <th width="106">Agent</th>
      <th width="106">Moda Transport</th>
      <th width="50">Asal</th>
      <th width="50">Tujuan</th>
      <th width="50">Terusan</th>
      <th width="50">Charge (Kg)</th>
      <th width="50">Durasi</th>
      <th width="50">Keterangan</th>
  </tr>
  <?php 	
  		$t_nominal = 0;
		
		$t_total = 0;?>
       
    <?php $i = 1;do { ?>
    	
        <tr valign="top">
          <td align="left"><?php echo $i;?></td>
          <td align="left"><?php echo $row_data['NAMALAYANAN']; ?></td>
          <td align="left"><?php echo $row_data['NAMAAGENT']; ?></td>
          <td align="left"><?php echo $row_data['NAMAJNSKIRIM']; ?></td>
          <td align="left"><?php echo $row_data['KOTAASAL']; ?></td>
          <td align="left"><?php echo $row_data['KOTATUJUAN']; ?></td>
          <td align="left"><?php echo $row_data['NAMATERUSAN']; ?></td>
          <td align="left"><?php $t_charge += $row_data['CHARGE'];echo number_format($row_data['CHARGE'],0,',','.').",-"; ?></td>
          <td align="left"><?php echo $row_data['DURASIWAKTU']; ?></td>
          <td align="left"><?php echo $row_data['KETERANGAN']; ?></td>
        </tr>
        <?php 
		$nomor ++;
			$i++;
        } while ($row_data = mysql_fetch_assoc($data)); ?>
</table>
  
  
