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
$query_data = "SELECT * from v_tagihan a";
$query_data .=" where TGLDATANGINV != ''";

if(isset($_GET[decode_cr]) AND $_GET[decode_cr]<>'' AND $_GET[decode_cr]<>'+') { 
$decode_cr = $_GET[decode_cr];
$query_data .=" AND (a.NOINV LIKE '%%$decode_cr%%')";
}

if($_GET[mulai]<>'' AND $_GET[sampai]<>'') { 
$mulai = $_GET[mulai];
$sampai = $_GET[sampai];
$query_data .=" and TGLDATANGINV between '$_GET[mulai]' AND '$_GET[sampai]'";


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
<P align="center" class="style2"><strong>DAFTAR TAGIHAN AGENT</strong></P>
<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <th>PERIODE : <?php echo $_GET[mulai]; ?> s/d <?php echo $_GET[sampai];?> </th>
</table>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
    <tr bgcolor="#CCCCCC">
      <th width="5">No.</th>
            <th width="30">Tgl. Invoice</th>
            <th width="106">No Invoice</th>
            <th width="106">Agent</th>
            <th width="50">Bank</th>
            <th width="50">Account No</th>
            <th width="50">Account Name</th>
            <th width="97"><strong>Nominal</strong></th>
  </tr>
  <?php 	
  		$t_nominal = 0;
		
		$t_total = 0;?>
       
    <?php $i = 1;do { ?>
    	
        <tr valign="top">
          <td align="left"><?php echo $i;?></td>
          <td align="left"><?php echo $row_data['TGLDATANGINV'];?></td>
          <td align="left"><?php echo $row_data['NOINV']; ?></td>
          <td align="left"><?php echo $row_data['NAMAAGENT']; ?></td>
          <td align="left"><?php echo $row_data['BANK']; ?></td>
          <td align="left"><?php echo $row_data['ACCOUNTNUMBER']; ?></td>
          <td align="left"><?php echo $row_data['ATASNAMA']; ?></td>
          <td align="left"><?php $t_nominal += $row_data['JUMLAHTAGIHAN'];echo number_format($row_data['JUMLAHTAGIHAN'],0,',','.').",-"; ?></td>
        </tr>
        <?php 
		$nomor ++;
			$i++;
        } while ($row_data = mysql_fetch_assoc($data)); ?>
    <tr valign="top">
      <td colspan="7" align="left">Total</td>
          
        <td align="left"><strong><?php echo number_format($t_nominal,0,',','.').",-";?></strong></td>
    </tr> 
 
		
</table>
  
  
