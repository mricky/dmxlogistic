<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"JS-5");
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_data = 20;
$pageNum_data = 0;

//Subcateogry Jewelry
mysql_select_db($database_con_gl, $con_gl);
$query_layanan = "SELECT layanan_paket_id, layanan_paket_nama FROM layanan_paket";
$item_layanan = mysql_query($query_layanan, $con_gl) or die(mysql_error());
$row_layanan = mysql_fetch_assoc($item_layanan);
$totalRows_layanan = mysql_num_rows($item_layanan);
// Shape
mysql_select_db($database_con_gl, $con_gl);
$query_jenis = "SELECT jenis_paket_id, jenis_paket_name FROM jenis_paket";
$item_jenis = mysql_query($query_jenis, $con_gl) or die(mysql_error());
$row_jenis = mysql_fetch_assoc($item_jenis);
$totalRows_jenis = mysql_num_rows($item_jenis);


if (isset($_GET['pageNum_data'])) {
  $pageNum_data = $_GET['pageNum_data'];
}
$startRow_data = $pageNum_data * $maxRows_data;
$cr_txt = str_replace("+"," ",$_REQUEST[cr_txt]);
mysql_select_db($database_con_gl, $con_gl);
$query_data = "SELECT * from v_tarif a";       
$query_data .=" where a.kotaasal_name != ''";

              
if($_GET[cr_txt]<>'' AND $_GET[cr_txt]<>'+') { 
$decode_cr = str_replace("+"," ",$_GET[cr_txt]);
$query_data .=" AND a.kotaasal_name LIKE '%%$decode_cr%%'";
}

if(isset($_GET[layanan]) AND $_GET[layanan]<>0) { 
$query_data .=" AND a.layanan_paket_id ='$_GET[layanan]'";
}

if(isset($_GET[jenis]) AND $_GET[jenis]<>0) { 
$query_data .=" AND a.jenis_paket_id ='$_GET[jenis]'";
}
//printf($query_data);

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
//include('include/widget_exportdata.php');
?>
<h1>List Tarif</h1>
<table width="100%" border="0" align="left" cellpadding="5" cellspacing="0" class="datatable"> 
  <tr valign="top" bgcolor="#FFFFFF" class="hide">
        <td><?php if(strstr($_SESSION['akses'],"JS-5-1")) { ?><a href="index.php?component=tarif&amp;task=add"><img src="images/add_new.png" border="0" /></a><?php } ?></td>
        <td colspan="6" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;"><form id="search" name="search" method="post" action="">
          Layanan Paket: 
              <select name="layananpaket" id="layananpaket" style="width:100px;">
                <?php
do {  
?>
                <option value="<?php echo $row_layanan['layanan_paket_id']?>"><?php echo $row_layanan['layanan_paket_nama']?></option>
                <?php
} while ($row_layanan = mysql_fetch_assoc($item_layanan));
  $row_layanan = mysql_num_rows($item_layanan);
  if($row_layanan > 0) {
      mysql_data_seek($row_layanan, 0);
	  $row_gem = mysql_fetch_assoc($row_layanan);
  }
?>
              </select>
          Jenis Paket:
          <select name="jenispaket" id="jenispaket" style="width:100px;">
                <?php
do {  
?>
        <option value="<?php echo $row_jenis['jenis_paket_id']?>"><?php echo $row_jenis['jenis_paket_name']?></option>
                <?php
} while ($row_jenis = mysql_fetch_assoc($item_jenis));
  $rows_jenis = mysql_num_rows($item_jenis);
  if($rows_jenis > 0) {
      mysql_data_seek($item_jenis, 0);
	  $row_jenis = mysql_fetch_assoc($item_jenis);
  }
?>
              </select>
          <input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: kota asal"; onclick="this.value='';"<?php echo $_REQUEST['cr_txt'];?>" size="40" maxlength="100"/>
          <label></label>
  <label>
  <input name="Search" type="submit" id="Search" value="Search" />
  </label>
        </form>
        <?php
	if(isset($_POST['Search'])) {
		echo "<script>window.location=\"index.php?component=tarif&layanan=".$_POST[layananpaket]."&jenis=".$_POST[jenispaket]."&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";
	}
	?></td>
  </tr>
  <tr>
    <th width="70"><strong>Layanan</strong></th>
    <th width="100">Jenis</th>
    <th width="100">Asal</th>
    <th width="100">Tujuan</th>
    <th width="50">Tarif</th>
    <th width="50">Waktu</th>
    <th width="132" align="center" class="hide"><strong>Action</strong></th>
  </tr>
  <?php if($totalRows_data > 0) { ?>
  <?php do { ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td><?php echo $row_data['layanan_paket_nama']; ?></td>
      <td><?php echo $row_data['jenis_paket_name']; ?></td>
      <td><?php echo $row_data['kotaasal_name']; ?></td>
      <td><?php echo $row_data['kotatujuan_name']; ?></td>
      <td><?php $tcharge += $row_data['tarif'];echo number_format($row_data['tarif'],0,',','.').",-"; ?></td>
      <td><?php echo $row_data['waktu']; ?></td>

      <td align="center" class="hide"><?php if(strstr($_SESSION['akses'],"JS-5-2")) { ?><a href="index.php?component=tarif&amp;task=edit&amp;id=<?php echo $row_data['tarif_id']; ?>"><img src="images/edit_.png" border="0" /></a><?php } ?> <?php if(strstr($_SESSION['akses'],"JS-5-3")) { ?><a href="index.php?component=tarif&amp;task=delete&amp;id=<?php echo $row_data['tarif_id']; ?>" class="ask"><img src="images/delete_.png" border="0" /></a><?php } ?></td>
    </tr>
    <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
	<?php if($totalRows_data > $maxRows_data) { ?>
    <tr class="hide">
      <td colspan="6"><table border="0" align="left" width="50%">
          <tr>
            <td width="3%" align="center"><?php if ($pageNum_data > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, 0, $queryString_data); ?>"><img src="First.gif" border=0 ></a>
                <?php } // Show if not first page ?>            </td>
            <td width="3%" align="center"><?php if ($pageNum_data > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, max(0, $pageNum_data - 1), $queryString_data); ?>"><img src="Previous.gif" border=0></a>
                <?php } // Show if not first page ?>            </td>
            <td width="3%" align="center"><?php if ($pageNum_data < $totalPages_data) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, min($totalPages_data, $pageNum_data + 1), $queryString_data); ?>"><img src="Next.gif" border=0></a>
                <?php } // Show if not last page ?>            </td>
            <td width="3%" align="center"><?php if ($pageNum_data < $totalPages_data) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, $totalPages_data, $queryString_data); ?>"><img src="Last.gif" border=0></a>
                <?php } // Show if not last page ?>            </td>
			<td width="88%">Halaman : <?php echo $pageNum_data+1; ?>, Ditampilkan <?php echo $totalRow_data; ?> dari <?php echo $totalRows_data; ?> total data</td>
          </tr>
        </table></td>
    </tr>
	<?php } ?>
   <?php }else{ ?>
  <tr bgcolor="#FFFFFF">
    <td colspan="4">Data tidak ada !!! </td>
  </tr>
  <?php } ?>
  <tr class="hide">
    <td colspan="4"><?php if(strstr($_SESSION[akses],"JS-5-1")) { ?><a href="index.php?component=tarif&amp;task=add"><img src="images/add_new.png" border="0" />
    </a><?php } ?></td>
  </tr>
</table>
