<?php require_once('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"DD-4");
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_data = 8;
$pageNum_data = 0;
if (isset($_GET['pageNum_data'])) {
  $pageNum_data = $_GET['pageNum_data'];
}
$startRow_data = $pageNum_data * $maxRows_data;
$cr_txt = str_replace("+"," ",$_REQUEST[cr_txt]);
mysql_select_db($database_con_gl, $con_gl);
$query_data = "select  a.id, a.gsgmstone_id, a.gsgmstone_image_name,b.image_type,a.description from ref_images_gsgemstone a inner join ref_image_type b ON (a.image_type_id = b.id) where a.gsgmstone_id = '$_GET[id]'";
// printf($query_data);
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

list($code, $item_type_name) = mysql_fetch_row(mysql_query("select a.gemstone_code,b.item_tipe_name from gsgemstones a inner join item_type b on( a.item_type_id = b.item_tipe_code) where a.gemstone_code = '$_GET[id]' AND a.item_type_id = '$_GET[item_type]'"));

print_r($item_type_name);
?>
<h1>Image  
<?php echo $item_type_name. '['.$code.']'; ?></h1>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"><tr class="hide"><td colspan="4" align="right"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
  <tr class="hide">
    <td width="146"><a href="include/upload_image_gemstone.php?act=add&id=<?php echo $_GET['id'];?>" onclick="NewWindow(this.href,'name','920','425','yes');return false"><img src="images/add_new.png" border="0" /></a></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <th width="220" height="33">Category </th>
    <th width="220"><strong>Image Url</strong></th>
    <th width="220">Image</th>
    <th width="220">Description</th>
    <th width="220">Action</th>
    </tr>
  <?php if($totalRows_data > 0) { ?>
  <?php do { ?>
  <tr valign="top" bgcolor="#FFFFFF">
    <td align="left"><?php echo $row_data['image_type'];?></td>
    <td align="left"><?php echo $row_data['gsgmstone_image_name'];?></td>
    <td align="left"><img src="<?php echo "galleries/gsgemstone/".$row_data['image_type']."/".$row_data['gsgmstone_image_name']; ?>" alt="" width="150" height="100" /></td>
    <td align="left"><?php echo $row_data['description'];?></td>
    <td align="left"><?php if(strstr($_SESSION['akses'],"JS-5-2")) { ?>
      <a href="include/upload_image_gemstone.php?act=edit&id=<?php echo $_GET['id'];?>&id_image=<?php echo $row_data['id'];?>" onclick="NewWindow(this.href,'name','920','425','yes');return false"><img src="images/edit_.png" alt="edit" border="0" /></a>
      <?php } ?>
      <?php if(strstr($_SESSION['akses'],"JS-5-3")) { ?>
      <a href="include/upload_image_diamond.php?act=delete&id=<?php echo $_GET['id'];?>&id_image=<?php echo $row_data['id'];?>" onclick="NewWindow(this.href,'name','920','425','yes');return false"><img src="images/delete_.png" alt="delete" border="0" /></a>
      <?php } ?></td>
    </tr>
  <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
  <?php if($totalRows_data > $maxRows_data) { ?>
  <tr class="hide">
    <td colspan="7"><table border="0" align="left" id="pagination">
      <tr>
        <td width="23%" align="center"><?php if ($pageNum_data > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, 0, $queryString_data); ?>"><img src="First.gif" border=0 /></a>
              <?php } // Show if not first page ?>        </td>
        <td width="31%" align="center"><?php if ($pageNum_data > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, max(0, $pageNum_data - 1), $queryString_data); ?>"><img src="Previous.gif" border=0 /></a>
              <?php } // Show if not first page ?>        </td>
        <td width="23%" align="center"><?php if ($pageNum_data < $totalPages_data) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, min($totalPages_data, $pageNum_data + 1), $queryString_data); ?>"><img src="Next.gif" border=0 /></a>
              <?php } // Show if not last page ?>        </td>
        <td width="23%" align="center"><?php if ($pageNum_data < $totalPages_data) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_data=%d%s", $currentPage, $totalPages_data, $queryString_data); ?>"><img src="Last.gif" border=0 /></a>
              <?php } // Show if not last page ?>        </td>
      </tr>
    </table></td>
  </tr>
  <?php } ?>
  <?php }else{ ?>
  <tr bgcolor="#FFFFFF">
    <td colspan="7">Data tidak ada !!! </td>
  </tr>
  <?php } ?>
  <tr class="hide">
    <td><a href="include/upload_arsip.php?id=<?php echo $_GET['id'];?>" onclick="NewWindow(this.href,'name','920','425','yes');return false"><img src="images/add_new.png" border="0" /></a></td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table></td>
  </tr>
</table>
<?php
mysql_free_result($data);
?>