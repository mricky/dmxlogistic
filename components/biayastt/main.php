<?php require('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"JS-5");

$currentPage = $_SERVER["PHP_SELF"];




$maxRows_data = 20;

$pageNum_data = 0;

if (isset($_GET['pageNum_data'])) {

  $pageNum_data = $_GET['pageNum_data'];

}

$startRow_data = $pageNum_data * $maxRows_data;

$cr_txt = str_replace("+"," ",$_REQUEST[cr_txt]);

//Subcateogry Jewelry
mysql_select_db($database_con_gl, $con_gl);
$query_status = "SELECT ID, KODE FROM statusstt";
$item_status = mysql_query($query_status, $con_gl) or die(mysql_error());
$row_status = mysql_fetch_assoc($item_status);
$totalRows_status = mysql_num_rows($item_status);


mysql_select_db($database_con_gl, $con_gl);


$query_data = "SELECT * from v_detailstt";
$query_data .=" where TGLCONNOTE != ''";

if(isset($_GET[status]) AND $_GET[status]!='') { 
$query_data .=" AND IDSTATUS ='$_GET[status]'";
}
else
{
 // no filter 
}

if($_GET[mulai]<>'' AND $_GET[sampai]<>'') { 
$mulai = $_GET[mulai];
$sampai = $_GET[sampai];

$query_data .=" and TGLCONNOTE between '$_GET[mulai]' AND '$_GET[sampai]'";

}

if($_GET[cr_txt]<>'' AND $_GET[cr_txt]<>'+') { 

	$decode_cr = str_replace("+"," ",$_GET[cr_txt]);	
	$query_data .=" AND (NOCONNOTE LIKE '%%$decode_cr%%' OR NAMACUSTOMER LIKE '%%$decode_cr%%')";
}

//$query_data .=" order by item_type_name asc";
//printf($query_data);
$data = mysql_query($query_data, $con_gl) or die(mysql_error());

$totalRows_data = mysql_num_rows($data);

$totalPages_data = floor($totalRows_data / $maxRows_data);

$query_data .=" LIMIT $startRow_data, $maxRows_data";

$data = mysql_query($query_data, $con_gl) or die(mysql_error());

$totalRow_data = mysql_num_rows($data);

$row_data = mysql_fetch_assoc($data);



$queryString_data = "";

if (!empty($_SERVER['QUERY_STRING'])) {

  $params = explode("&", $_SERVER['QUERY_STRING']);

  $newParams = array();

  foreach ($params as $param) {

    if (stristr($param, "pageNum_data") == false && 

        stristr($param, "totalRows_data") == false) {

      array_push($newParams, $param);

    }

  }

  if (count($newParams) != 0) {

    $queryString_data = "&" . htmlentities(implode("&", $newParams));

  }

}

$queryString_data = sprintf("&totalRows_data=%d%s", $totalRows_data, $queryString_data);

//include('include/widget_export_daftar_stt.php');

?>

<link href="css/ui.datepicker.css" type="text/css" rel="stylesheet" />

<script language="javascript">

function download()

{

	window.location='report_penjualan.xls';

}

</script>

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

$(document).ready(function(){

$(".flipsearch").click(function(){

	$("form.tanggalsearch").hide() 

    $(".objsearch").slideToggle("fast");

  });

});



$(document).ready(function(){

$(".fliptanggal").click(function(){

	$("form.objsearch").hide();

    $(".tanggalsearch").slideToggle("fast");

  });

});

</script>

<h1>Daftar Biaya STT</h1>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 

  <tr valign="top" bgcolor="#FFFFFF" class="hide">

        <td>&nbsp;</td>

  <td colspan="16" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;"><form id="search" name="search" method="post" action="">
          <label> Status : 
              <select name="status" id="status" style="width:100px;">
               <option value="" <?php if($_GET['status']=='') echo "selected"; ?>>All</option>
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
              </select>
          Tanggal :
        <input name="mulai" type="text" id="mulai" value="<?php echo $_GET[mulai];?>" size="15" maxlength="15" class="calendar"/>
          </label>
          s/d
  <label>
  <input name="sampai" type="text" id="sampai" value="<?php echo $_GET[sampai];?>" size="15" maxlength="15" class="calendar"/>
  </label>
  <label> Kata Kunci :
  <input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: no connote,nama customer"; onclick="this.value='';"<?php echo $_REQUEST['cr_txt'];?>" size="40" maxlength="100"/>
  </label>
  <label>
  <input name="Search" type="submit" id="Search" value="Search" />
  </label>
        </form>
        <?php

	if(isset($_POST['Search'])) {

			echo "<script>window.location=\"index.php?component=biayastt&mulai=".$_POST[mulai]."&status=".$_POST[status]."&sampai=".$_POST[sampai]."&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";
            
   }

	?></td>
  </tr>

  <tr>
    <th width="100" rowspan="2"><strong>Customer</strong></th>
    <th width="100" rowspan="2">No Stt</th>
    <th width="100" rowspan="2">Layanan</th>
    <th width="100" rowspan="2">Armanda</th>
    <th colspan="12" align="center">Biaya</th>
    <th width="100" rowspan="2">Status</th>
    <th width="132" rowspan="2" align="center" class="hide"><strong>Action</strong></th>
  </tr>
  <tr>
	
    <th width="100"> Maskapai</th>
    <th width="100"> Shipping</th>
    <th width="100"> Trucking</th>
    <th width="100"> Delivery</th>
    <th width="100"> RA</th>
    <th width="100"> GRDH</th>
    <th width="100">Warehouse</th>
    <th width="100">Fee Marketing</th>
    <th width="100">Refund Customer</th>
    <th width="100">Total Sales</th>
    <th width="100">Total Cost</th>
    <th width="100">Total Profit</th>
  </tr>

  <?php if($totalRows_data > 0) { ?>

  <?php do { ?>

      <tr valign="top" bgcolor="#FFFFFF">
        <td><?php echo $row_data['NAMACUSTOMER']; ?></td>
        <td><?php echo $row_data['NOCONNOTE']; ?></td>
        <td><?php echo $row_data['NAMALAYANAN']; ?></td>
        <td><?php echo $row_data['NAMAJNSKIRIM']; ?></td>
        <td><?php $tsmu += $row_data['COST_SMU'];echo number_format($row_data['COST_SMU'],0,',','.').",-"; ?></td>
        <td><?php $tshipping += $row_data['COST_SHIPPING'];echo number_format($row_data['COST_SHIPPING'],0,',','.').",-"; ?></td>
        <td><?php $ttrucking += $row_data['COST_TRUCKING'];echo number_format($row_data['COST_TRUCKING'],0,',','.').",-"; ?></td>
        <td><?php $tdelivery += $row_data['COST_DELIVERY'];echo number_format($row_data['COST_DELIVERY'],0,',','.').",-"; ?></td>
        <td><?php $tra += $row_data['COST_RA'];echo number_format($row_data['COST_RA'],0,',','.').",-"; ?></td>
        <td><?php $tgrdh += $row_data['COST_GRDH'];echo number_format($row_data['COST_GRDH'],0,',','.').",-"; ?></td>
        <td><?php $twarehouse += $row_data['COST_WAREHOUSE'];echo number_format($row_data['COST_WAREHOUSE'],0,',','.').",-"; ?></td>
        <td><?php $tmarketing += $row_data['COST_FEEMARKETING'];echo number_format($row_data['COST_FEEMARKETING'],0,',','.').",-"; ?></td>
        <td><?php $trefund += $row_data['COST_REFUNDCUST'];echo number_format($row_data['COST_REFUNDCUST'],0,',','.').",-"; ?></td>
        <td><?php $tsales += $row_data['TOTALSALES'];echo number_format($row_data['TOTALSALES'],0,',','.').",-"; ?></td>
        <td><?php $tcost += $row_data['TOTALCOST'];echo number_format($row_data['TOTALCOST'],0,',','.').",-"; ?></td>
        <td><?php $tprofit += $row_data['TOTALPROFIT'];echo number_format($row_data['TOTALPROFIT'],0,',','.').",-"; ?></td>
        <td><?php echo $row_data['KODE']; ?></td>
        <td align="center" class="hide"><?php if(strstr($_SESSION['akses'],"JS-5-2")) { ?>
          <a href="index.php?component=biayastt&amp;task=biaya&amp;id=<?php echo $row_data['IDSTT']; ?>"><img src="images/edit_.png" alt="edit" border="0" /></a>
          <?php } ?>
          <?php if(strstr($_SESSION['akses'],"JS-5-3")) { ?>
          <!--<a href="index.php?component=merkkendaraan&amp;task=delete&amp;id=<?php echo $row_data['id']; ?>" class="ask"><img src="images/delete_.png" border="0" /></a>-->
          <?php } ?></td>
      </tr>
      <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
    <tr valign="top" bgcolor="#FFFFFF">

      <td>Total</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><strong><?php echo number_format($tsmu,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($tshipping,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($ttrucking,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($tdelivery,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($tra,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($tgrdh,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($twarehouse,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($tmarketing,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($trefund,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($tsales,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($tcost,0,',','.').",-";?></strong></td>
      <td><strong><?php echo number_format($tprofit,0,',','.').",-";?></strong></td>
      <td>&nbsp;</td>


      <td align="center" class="hide">&nbsp;</td>
  </tr>



	<?php if($totalRows_data > $maxRows_data) { ?>

    <tr class="hide">

      <td colspan="21"><table border="0" align="left" width="50%">

          <tr>
            <td align="center"><?php if ($pageNum_data > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, 0, $queryString_data); ?>"><img src="First.gif" border="0" /></a>
                <?php } // Show if not first page ?>            </td>
            <td align="center"><?php if ($pageNum_data > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, max(0, $pageNum_data - 1), $queryString_data); ?>"><img src="Previous.gif" border="0" /></a>
                <?php } // Show if not first page ?>            </td>
            <td align="center"><?php if ($pageNum_data < $totalPages_data) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, min($totalPages_data, $pageNum_data + 1), $queryString_data); ?>"><img src="Next.gif" border="0" /></a>
                <?php } // Show if not last page ?>            </td>
            <td align="center"><?php if ($pageNum_data < $totalPages_data) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, $totalPages_data, $queryString_data); ?>"><img src="Last.gif" border="0" /></a>
                <?php } // Show if not last page ?>            </td>
            <td>Halaman : <?php echo $pageNum_data+1; ?>, Ditampilkan <?php echo $totalRow_data; ?> dari <?php echo $totalRows_data; ?> total data</td>
          </tr>

      </table></td>
    </tr>

	<?php } ?>

   <?php }else{ ?>

  <tr bgcolor="#FFFFFF">

    <td colspan="5">Data tidak ada !!! </td>
  </tr>

  <?php } ?>

  <tr class="hide">

    <td colspan="5">&nbsp;</td>
  </tr>
</table>
