<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"PD-7");
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_data = 30;
$pageNum_data = 0;
if (isset($_GET['pageNum_data'])) {
  $pageNum_data = $_GET['pageNum_data'];
}
$startRow_data = $pageNum_data * $maxRows_data;
$cr_txt = str_replace("+"," ",$_REQUEST[cr_txt]);
mysql_select_db($database_con_gl, $con_gl);
$query_data = "SELECT * from gl_gudang";
if($_GET[cr_txt]<>'' AND $_GET[cr_txt]<>'+') { 
$decode_cr = str_replace("+"," ",$_GET[cr_txt]);
$query_data .=" where id LIKE '%%$decode_cr%%' OR gudang LIKE '%%$decode_cr%%' OR keterangan LIKE '%%$decode_cr%%'";
}
$query_data .=" order by gudang asc";
$data = mysql_query($query_data, $con_gl) or die(mysql_error());
$row_data = mysql_fetch_assoc($data);
$totalRows_data = mysql_num_rows($data);

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
<h1>Lokasi Kantor/Cabang</h1>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 
  <tr valign="top" bgcolor="#FFFFFF" class="hide">
        <td><?php if(strstr($_SESSION[akses],"PD-7-1")) { ?><a href="index.php?component=gudang&amp;task=add"><img src="images/add_new.png" border="0" /></a><?php } ?></td>
        <td colspan="3" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;"><form id="search" name="search" method="post" action="">
          <label>
      <input name="cr_txt" type="text" id="cr_txt" value="<?php echo $_REQUEST['cr_txt'];?>" size="30" maxlength="100" />
      </label>
      <label>
      <input name="Search" type="submit" id="Search" value="Cari" />
      </label>
    </form>
	<?php
	if(isset($_POST['Search'])) {
		echo "<script>window.location=\"index.php?component=gudang&cr_kel=".$_POST[cr_kel]."&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";
	}
	?></td>
  </tr>
  <tr>
    <th width="145"><strong>Kota/Area</strong></th>
    <th width="280"><strong>Lokasi Kantor</strong></th>
    <th><strong>Keterangan</strong></th>
    <th width="125" align="center" class="hide"><strong>Aksi</strong></th>
  </tr>
  <?php if($totalRows_data > 0) { ?>
  <?php do { ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td><?php echo $row_data['area']; ?></td>
      <td><?php echo $row_data['gudang']; ?></td>
      <td><?php echo $row_data['keterangan']; ?></td>
      <td align="center" class="hide"><?php if(strstr($_SESSION[akses],"PD-7-2")) { ?><a href="index.php?component=gudang&amp;task=edit&amp;id=<?php echo $row_data['id']; ?>"><img src="images/edit_.png" border="0" /></a><?php } ?> <?php if(strstr($_SESSION[akses],"PD-7-3")) { ?><a href="index.php?component=gudang&amp;task=delete&amp;id=<?php echo $row_data['id']; ?>" class="ask"><img src="images/delete_.png" border="0" /></a><?php } ?></td>
    </tr>
    <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
	<?php if($totalRows_data > $maxRows_data) { ?>
    <tr class="hide">
      <td colspan="4"><table border="0" align="left">
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
    <td colspan="4">Data tidak ada !!! </td>
  </tr>
  <?php } ?>
  <tr class="hide">
    <td colspan="4"><?php if(strstr($_SESSION[akses],"PD-7-1")) { ?><a href="index.php?component=gudang&amp;task=add"><img src="images/add_new.png" border="0" /></a><?php } ?></td>
  </tr>
</table>