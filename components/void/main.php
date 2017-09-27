<?php require_once('connections/con_gl.php');require_once("excel/excelwriter.class.php"); ?>

<?php
$s_rep = intval($_GET['replace']);
cekAkses($_SESSION[akses],"MS-8");

$currentPage = $_SERVER["PHP_SELF"];



$maxRows_data = 20;

$pageNum_data = 0;

if (isset($_GET['pageNum_data'])) {

  $pageNum_data = $_GET['pageNum_data'];

}

$startRow_data = $pageNum_data * $maxRows_data;

$cr_txt = str_replace("+"," ",$_REQUEST[cr_txt]);

mysql_select_db($database_con_gl, $con_gl);

/*$query_data = "SELECT a.id, a.tgl, a.info, a.noref, b.nopolisi, d.tipekendaraan, c.nama, a.tipecustomer from gl_kkeluar as a inner join gl_masterkendaraan as b on (a.kendaraan = b.nopolisi) inner join gl_kontak as c on (a.driver = c.id) inner join gl_tipekendaraan as d on (b.tipekendaraan = d.id) left join gl_rtrans as e on ( a.noref = e.no_ref) where true ";*/


if($_GET[cr_order]<>'' AND $_GET[cr_order]<>'+'){
	if($_GET[cr_order] == "INVOICE")
	{
	 $query_data = "SELECT * FROM v_history_pmb where IDINVOICE !=''";
	}
	else if($_GET[cr_order] == "STT")
	{
		 $query_data = "SELECT * FROM v_history_pmb where IDSTT !=''";
	}
	
	
	
}
else
{
	$query_data = "SELECT * FROM v_history_pmb WHERE IDPEMBAYARAN != ''";
}

if($_GET[cr_txt]<>'' AND $_GET[cr_txt]<>'+') { 

$decode_cr = str_replace("+"," ",$_GET[cr_txt]);
$query_data .=" AND (NOTRANSAKSI LIKE '%%$decode_cr%%')";


}

if($_GET[mulai]<>'' AND $_GET[sampai]<>'') { 

$query_data .=" AND TGLBAYAR BETWEEN '$_GET[mulai]' AND '$_GET[sampai]'";

}
$query_data .=" GROUP BY NOTRANSAKSI";
//printf($query_data);
//$query_data .=" order by a.tgl desc"; //echo $query_data;

$query_limit_data = sprintf("%s LIMIT %d, %d", $query_data, $startRow_data, $maxRows_data);

$data = mysql_query($query_limit_data, $con_gl) or die(mysql_error());

$row_data = mysql_fetch_assoc($data);



if (isset($_GET['totalRows_data'])) {

  $totalRows_data = $_GET['totalRows_data'];

} else {

  $all_data = mysql_query($query_data);

  $totalRows_data = mysql_num_rows($all_data);

}

$totalPages_data = ceil($totalRows_data/$maxRows_data)-1;



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

//include('include/widget_exportdata.php');
// Export Excel

$excel=new ExcelWriter("report_penjualan.xls");

if($excel==false)	

echo $excel->error;



$myArr=array("Tanggal","No Referensi","Gudang","Total","Keterangan");

$excel->writeLine($myArr);



$qry=mysql_query($query_data, $con_gl);

if($qry!=false)

{

	$i=1;

	while($res=mysql_fetch_array($qry))

	{

		$total = mysql_query("SELECT sum(gl_trans.total) as total FROM gl_trans WHERE gl_trans.no_ref='$row_data[no_ref]' AND pos='K'",$con_gl);

		$row_total = mysql_fetch_assoc($total);

		$myArr=array($res['tgl'],$res['no_ref'],$res['gudang'],$row_total['total'],$res['keterangan']);

		$excel->writeLine($myArr);

		$i++;

	}

}

// End Export

include('include/widget_export_trans.php');

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

$(".fliptanggal").click(function(){

	$("form.objsearch").hide();

    $(".tanggalsearch").slideToggle("fast");

  });

});

</script>



<h1>Daftar Pembayaran </h1>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 

  <tr valign="top" bgcolor="#FFFFFF" class="hide">

        <td width="10%"></td>

        <td colspan="7" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;"><form id="search" name="search" method="post" action="">

          
			<label>Tipe Penagihan : 
			  <select name="cr_order" onchange="javascript: window.location.href='index.php?component=void&cr_order='+this.value;">>
              
               <option value="INVOICE" <?php if($_GET['cr_order']=='INVOICE') echo "selected"; ?>>INVOICE</option>
                <option value="STT" <?php if($_GET['cr_order']=='STT') echo "selected"; ?>>STT</option>
      </select>
      Tanggal :
<input name="mulai" type="text" id="mulai" value="<?php echo $_GET[mulai];?>" size="15" maxlength="15" class="calendar"/></label> s/d <label><input name="sampai" type="text" id="sampai" value="<?php echo $_GET[sampai];?>" size="15" maxlength="15" class="calendar"/>

        </label>
      <input name="cr_txt" type="text" id="cr_txt" value="<?php echo $_REQUEST['cr_txt'];?>" size="30" maxlength="100" />
      </label>

      <label>

      <input name="Search" type="submit" id="Search" value="Cari" />
      </label>

    </form>

	<?php

	if(isset($_POST['Search'])) {

		echo "<script>window.location=\"index.php?component=void&cr_order=".$_POST[cr_order]."&mulai=".$_POST[mulai]."&sampai=".$_POST[sampai]."&replace=".$s_rep."&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";

	}

	?></td>
  </tr>

  <tr>

    <th>Tgl Bayar</th>
    <th width="10%">No. STT</th>
    <th width="10%">No. Invoice</th>
    <th width="10%">No Transaksi</th>
    <th width="19%">Metode</th>
    <th width="10%">Jenis </th>
    <th width="15%"><strong>Nominal</strong></th>
    <th width="25%"><strong>Aksi</strong></th>
  </tr>

  <?php if($totalRows_data > 0) { ?>

  <?php do { ?>

    <tr valign="top" bgcolor="#FFFFFF">

      <td align="left"><?php echo $row_data['TGLBAYAR']; ?></td>
      <td align="left"><?php echo $row_data['NOCONNOTE'];?></td>
      <td><?php echo $row_data['KODEINVOICE']; ?></td>
      <td><?php echo $row_data['NOTRANSAKSI']; ?></td>
            <td><?php echo $row_data['METODEBAYAR']; ?></td>
      <td><?php echo $row_data['NAMAJENISBAYAR']; ?>
      <td><?php $ttotal += $row_data['TOTALBAYAR'];echo number_format($row_data['TOTALBAYAR'],0,',','.').",-"; ?></td>
      <td><?php if($row_data['tipecustomer']=='R'){ ?>
        <a href="include/print_do2.php?id=<?php echo $row_data['id']; ?>&amp;noreferensi=<?php echo $row_data['noref'];?>&amp;tipecust=<?php echo $row_data['tipecustomer'];?>" onclick="NewWindow(this.href,'name','765','500','yes');return false" title="Print SPJ-Surat Perintah Jalan"><img src="images/invoices.png" width="22" height="22" hspace="4" border="0" /></a><a href="include/print_do.php?id=<?php echo $row_data['id']; ?>&amp;tipecust=<?php echo $row_data['tipecustomer'];?>" onclick="NewWindow(this.href,'name','765','500','yes');return false" title="Print BASTK-Berinta Acara Serah Terima Kendaraan"><img src="images/invoices.png" width="22" height="22" hspace="4" border="0" /></a>
        <?php } ?>
        <?php if(strstr($_SESSION[akses],"MS-8-2")) { ?>
        <a href="index.php?component=void&amp;task=edit&amp;id=<?php echo $row_data['IDPEMBAYARAN']; ?>"><img src="images/edit_.png" border="0" /></a>
        <?php } ?>
        <?php if(strstr($_SESSION[akses],"MS-8-3")) { ?>
        <a href="index.php?component=void&amp;task=delete&amp;id=<?php echo $row_data['IDPEMBAYARAN']; ?>" class="ask"><img src="images/delete_.png" border="0" /></a>
      <?php } ?></td>
    </tr>

    <?php } while ($row_data = mysql_fetch_assoc($data)); ?>

	<?php if($totalRows_data > $maxRows_data) { ?>

    <tr class="hide">

      <td colspan="8"><table border="0" align="left">

          <tr>

            <td width="23%" align="center"><?php if ($pageNum_data > 0) { // Show if not first page ?>

                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, 0, $queryString_data); ?>"><img src="First.gif" border=0></a>

            <?php } // Show if not first page ?>            </td>

            <td width="31%" align="center"><?php if ($pageNum_data > 0) { // Show if not first page ?>

                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, max(0, $pageNum_data - 1), $queryString_data); ?>"><img src="Previous.gif" border=0></a>

            <?php } // Show if not first page ?>            </td>

            <td width="23%" align="center"><?php if ($pageNum_data < $totalPages_data) { // Show if not last page ?>

                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, min($totalPages_data, $pageNum_data + 1), $queryString_data); ?>"><img src="Next.gif" border=0></a>

            <?php } // Show if not last page ?>            </td>

            <td width="23%" align="center"><?php if ($pageNum_data < $totalPages_data) { // Show if not last page ?>

                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, $totalPages_data, $queryString_data); ?>"><img src="Last.gif" border=0></a>

            <?php } // Show if not last page ?>            </td>
          </tr>

        </table></td>
    </tr>

	<?php } ?>

   <?php }else{ ?>

  <tr bgcolor="#FFFFFF">

    <td colspan="8">Data tidak ada !!! </td>
  </tr>

  <?php } ?>

  <tr class="hide">

    <td colspan="8"></td>
  </tr>
</table>
