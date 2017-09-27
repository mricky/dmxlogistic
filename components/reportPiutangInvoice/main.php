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

mysql_select_db($database_con_gl, $con_gl);

$query_data = "SELECT * from v_invoice WHERE KODEINVOICE !=''";

if($_GET[mulai]<>'' AND $_GET[sampai]<>'') { 
$mulai = $_GET[mulai];
$sampai = $_GET[sampai];

$query_data .=" and TGLINVOICE between '$_GET[mulai]' AND '$_GET[sampai]'";

}
if($_GET[cr_txt]<>'' AND $_GET[cr_txt]<>'+') { 

$decode_cr = str_replace("+"," ",$_GET[cr_txt]);

$query_data .=" where KODEINVOICE LIKE '%%$decode_cr%%'";

}

//$query_data .=" order by item_type_name asc";

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

include('include/widget_export_daftar_tagihan.php');

?>
<script type="text/javascript" src="js/ui.datepicker.js"></script>
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
<h1>Laporan Piutang Invoice</h1>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 

  <tr valign="top" bgcolor="#FFFFFF" class="hide">

        <td>&nbsp;</td>

<td colspan="12" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;"><form id="search" name="search" method="post" action="">

          <label>

      Tanggal :
        <input name="mulai" type="text" id="mulai" value="<?php echo $_GET[mulai];?>" size="15" maxlength="15" class="calendar"/>
</label>
s/d
<label>
<input name="sampai" type="text" id="sampai" value="<?php echo $_GET[sampai];?>" size="15" maxlength="15" class="calendar"/>
</label>
<label>
<input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: cod,name, description"; onclick="this.value='';"<?php echo $_REQUEST['cr_txt'];?>" size="30" maxlength="100" />
      </label>

      <label>

      <input name="Search" type="submit" id="Search" value="Search" />
      </label>

    </form>

	<?php

	if(isset($_POST['Search'])) {

		echo "<script>window.location=\"index.php?component=reportPiutangInvoice&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";

	}

	?></td>
  </tr>

  <tr>
	
    <th width="100"><strong>Tgl Invoice</strong></th>
    <th width="220">Invoice</th>
	
  

    <th width="100" align="center" class="hide">Customer</th>
    <th width="50" align="center" class="hide">PPN</th>
    <th width="50" align="center" class="hide">Asuransi</th>
    <th width="50" align="center" class="hide">Packing</th>
    <th width="50" align="center" class="hide">Total</th>
    <th width="132" align="center" class="hide">Bayar</th>
    <th width="132" align="center" class="hide">Sisa</th>
  </tr>

  <?php if($totalRows_data > 0) { ?>

  <?php do { ?>

    <tr valign="top" bgcolor="#FFFFFF">

      <td><?php echo $row_data['TGLINVOICE']; ?></td>
      <td><?php echo $row_data['KODEINVOICE']; ?></td>
      <td align="center" class="hide"><?php echo $row_data['NAMACUSTOMER']; ?></td>
      <td align="center"><?php $tppn += $row_data['PPN'];echo number_format($row_data['PPN'],0,',','.').",-"; ?></td>
      <td align="center"><?php $tinsurance += $row_data['NBARANGINSURANCE'];echo number_format($row_data['NBARANGINSURANCE'],0,',','.').",-"; ?></td>
      <td align="center"><?php $tpacking += $row_data['PACKING'];echo number_format($row_data['PACKING'],0,',','.').",-"; ?></td>
	  <td align="center"><?php $tcharge += $row_data['TOTAL_CHARGE'];echo number_format($row_data['TOTAL_CHARGE'],0,',','.').",-"; ?></td>
	  <td align="center"><?php $tbayar += $row_data['BAYAR'];echo number_format($row_data['BAYAR'],0,',','.').",-"; ?></td>
      <td align="center"><?php $tsisa += $row_data['SISA'];echo number_format($row_data['SISA'],0,',','.').",-"; ?></td>
    </tr>

<?php } while ($row_data = mysql_fetch_assoc($data)); ?>

	<?php if($totalRows_data > $maxRows_data) { ?>

    <tr class="hide">

      <td colspan="17"><table border="0" align="left" width="50%">

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

    <td colspan="11">Data tidak ada !!! </td>
  </tr>

  <?php } ?>

  <tr class="hide">

    <td colspan="11">&nbsp;</td>
  </tr>
</table>
