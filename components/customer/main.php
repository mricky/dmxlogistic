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

$query_data = "SELECT
				a.IDCUSTOMER,
				a.KODECUSTOMER,
				a.NAMACUSTOMER,
				a.ALAMAT,
				a.TELEPON,
				a.FAX,
				a.CONTACTPERSON,
				a.HP,
				a.EMAIL,
				a.MARKETING,
				Count(b.IDCUSTOMER) AS pricelist
				FROM
				customer AS a
				LEFT JOIN pricelist AS b ON a.IDCUSTOMER = b.IDCUSTOMER
				
				";

if($_GET[cr_txt]<>'' AND $_GET[cr_txt]<>'+') { 

$decode_cr = str_replace("+"," ",$_GET[cr_txt]);

$query_data .=" where a.NAMACUSTOMER LIKE '%%$decode_cr%%' OR a.TELEPON LIKE '%%$decode_cr%%'";

}
$query_data .=" GROUP BY
				a.IDCUSTOMER,
				a.KODECUSTOMER,
				a.NAMACUSTOMER,
				a.ALAMAT,
				a.TELEPON,
				a.FAX,
				a.HP,
				a.EMAIL,
				a.MARKETING";
$query_data .=" ORDER BY NAMACUSTOMER asc";
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

//include('../Copy of customer/include/widget_exportdata.php');

?>

<h1>Daftar Customer</h1>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 

  <tr valign="top" bgcolor="#FFFFFF" class="hide">

        <td><?php if(strstr($_SESSION['akses'],"JS-5-1")) { ?>
          <a href="index.php?component=customer&amp;task=addPricelistCustomer"><img src="images/add_new.png" border="0" /></a>
        <?php } ?></td>

  <td colspan="6" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;"><form id="search" name="search" method="post" action="">

          <label>

      <input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: name, phone"; onclick="this.value='';"<?php echo $_REQUEST['cr_txt'];?>" size="30" maxlength="100" />
      </label>

      <label>

      <input name="Search" type="submit" id="Search" value="Search" />
      </label>

    </form>

	<?php

	if(isset($_POST['Search'])) {

		echo "<script>window.location=\"index.php?component=customer&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";

	}

	?></td>
  </tr>

  <tr>
	
    <th width="100"><strong>Kode</strong></th>
    <th width="220">Nama</th>
	<th width="220">Alamat</th>
    <th width="100">Contact Person</th>
    <th width="100">HP</th>
    <th width="100">Email</th>
    <th width="100">Marketing</th>
    <th width="100">Pricelist</th>
   

    <th width="220" align="center" class="hide"><strong>Action</strong></th>
  </tr>

  <?php if($totalRows_data > 0) { ?>

  <?php do { ?>

    <tr valign="top" bgcolor="#FFFFFF">

      <td><?php echo $row_data['KODECUSTOMER']; ?></td>

      <td><?php echo $row_data['NAMACUSTOMER']; ?></td>

      <td><?php echo $row_data['ALAMAT']; ?></td>
      <td><?php echo $row_data['CONTACTPERSON']; ?></td>
      <td><?php echo $row_data['HP']; ?></td>
      <td><?php echo $row_data['EMAIL']; ?></td>
      <td><?php echo $row_data['MARKETING']; ?></td>
      <td><?php echo $row_data['pricelist']; ?></td>

      <td align="center" class="hide"><?php if(strstr($_SESSION['akses'],"JS-5-2")) { ?><a href="index.php?component=customer&amp;task=pricelistCustomer&amp;id=<?php echo $row_data['IDCUSTOMER']; ?>">Pricelist </a><?php } ?><?php if(strstr($_SESSION['akses'],"JS-5-2")) { ?><a href="index.php?component=customer&amp;task=edit&amp;id=<?php echo $row_data['IDCUSTOMER']; ?>"><img src="images/edit_.png" border="0" /></a><?php } ?> <?php if(strstr($_SESSION['akses'],"JS-5-3")) { ?><a href="index.php?component=customer&amp;task=delete&amp;id=<?php echo $row_data['IDCUSTOMER']; ?>" class="ask"><img src="images/delete_.png" border="0" /></a><?php } ?></td>
    </tr>

<?php } while ($row_data = mysql_fetch_assoc($data)); ?>

	<?php if($totalRows_data > $maxRows_data) { ?>

    <tr class="hide">

      <td colspan="11"><table border="0" align="left" width="50%">

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
