<?php require_once('connections/con_gl.php'); ?>

<?php
$s_rep = intval($_GET['replace']);
cekAkses($_SESSION[akses],"MS-8");

$currentPage = $_SERVER["PHP_SELF"];



$maxRows_data = 10;

$pageNum_data = 0;

if (isset($_GET['pageNum_data'])) {

  $pageNum_data = $_GET['pageNum_data'];

}

$startRow_data = $pageNum_data * $maxRows_data;

$cr_txt = str_replace("+"," ",$_REQUEST[cr_txt]);

mysql_select_db($database_con_gl, $con_gl);

$query_data = "SELECT a.id, a.tgl, a.info, a.noref, b.nopolisi, d.tipekendaraan, c.nama, a.tipecustomer from gl_kkeluar as a inner join gl_masterkendaraan as b on (a.kendaraan = b.nopolisi) inner join gl_kontak as c on (a.driver = c.id) inner join gl_tipekendaraan as d on (b.tipekendaraan = d.id) left join gl_rtrans as e on ( a.noref = e.no_ref) where true ";
if(!strstr($_SESSION[akses],'A-1-4')) {

	$query_data .= " AND e.gudang='$_SESSION[lokasi]'";

}
if($_GET[cr_txt]<>'' AND $_GET[cr_txt]<>'+') { 

$decode_cr = str_replace("+"," ",$_GET[cr_txt]);

$query_data .=" AND (a.info LIKE '%%$decode_cr%%' OR b.nopolisi LIKE '%%$decode_cr%%' OR d.tipekendaraan LIKE '%%$decode_cr%%' OR c.nama LIKE '%%$decode_cr%%' OR a.noref LIKE '%%$decode_cr%%')";

}

$query_data .=" order by a.tgl desc";

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

include('include/widget_exportdata.php');

?>

<h1>Daftar Delivery Order Kendaraan<?php if($s_rep=='1') {?> ( Replacement )<?php } ?></h1>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 

  <tr valign="top" bgcolor="#FFFFFF" class="hide">

        <td width="10%"><?php if(strstr($_SESSION[akses],"MS-8-1")) { ?><a href="index.php?component=delivery&amp;task=add"><img src="images/add_new.png" border="0" /></a><?php } ?></td>

        <td colspan="5" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;"><form id="search" name="search" method="post" action="">

          <label>

      <input name="cr_txt" type="text" id="cr_txt" value="<?php echo $_REQUEST['cr_txt'];?>" size="30" maxlength="100" />

      </label>

      <label>

      <input name="Search" type="submit" id="Search" value="Cari" />

      </label>

    </form>

	<?php

	if(isset($_POST['Search'])) {

		echo "<script>window.location=\"index.php?component=delivery&replace=".$s_rep."&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";

	}

	?></td>

  </tr>

  <tr>

    <th>Tanggal</th>
    <th width="12%">No. Referensi/Kontrak</th>
    <th width="18%">Kendaraan</th>
    <th width="18%"><strong>Driver</strong></th>

    <th><strong>Keterangan</strong></th>

    <th width="15%" align="center"><strong>Aksi</strong></th>

  </tr>

  <?php if($totalRows_data > 0) { ?>

  <?php do { ?>

    <tr valign="top" bgcolor="#FFFFFF">

      <td align="center"><?php tanggal($row_data['tgl'],"tampilkan"); ?></td>
      <td align="center"><a href="include/invoice.php?referensi=<?php echo $row_data['noref'];?>" onclick="NewWindow(this.href,'name','735','450','yes');return false" title="View Invoice"><?php echo $row_data['noref']; ?></a></td>
      <td><?php echo $row_data['tipekendaraan']; ?> ( <?php echo $row_data['nopolisi']; ?> )</td>
      <td><?php echo $row_data['nama']; ?></td>

      <td><?php echo $row_data['info']; ?></td>

      <td align="center"><a href="include/print_do.php?id=<?php echo $row_data['id']; ?>&tipecust=<?php echo $row_data['tipecustomer'];?>" onclick="NewWindow(this.href,'name','765','500','yes');return false" title="Print Delivery Order"><img src="images/_print.png" width="22" height="22" hspace="4" border="0" /></a>
      <?php if(strstr($_SESSION[akses],"MS-8-2")) { ?><a href="index.php?component=delivery&amp;task=edit&amp;id=<?php echo $row_data['id']; ?>"><img src="images/edit_.png" border="0" /></a><?php } ?> <?php if(strstr($_SESSION[akses],"MS-8-3")) { ?><a href="index.php?component=delivery&amp;task=delete&amp;id=<?php echo $row_data['id']; ?>" class="ask"><img src="images/delete_.png" border="0" /></a><?php } ?></td>

    </tr>

    <?php } while ($row_data = mysql_fetch_assoc($data)); ?>

	<?php if($totalRows_data > $maxRows_data) { ?>

    <tr class="hide">

      <td colspan="6"><table border="0" align="left">

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

    <td colspan="6">Data tidak ada !!! </td>

  </tr>

  <?php } ?>

  <tr class="hide">

    <td colspan="6"><?php if(strstr($_SESSION[akses],"MS-8-1")) { ?><a href="index.php?component=develivery&amp;task=add"><img src="images/add_new.png" border="0" /></a><?php } ?></td>

  </tr>

</table>