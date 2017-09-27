<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"A-1");
$maxRows_data = 8;
$pageNum_data = 0;
if (isset($_GET['pageNum_data'])) {
  $pageNum_data = $_GET['pageNum_data'];
}
$startRow_data = $pageNum_data * $maxRows_data;

mysql_select_db($database_con_gl, $con_gl);
$query_data = "SELECT gl_admin.id, gl_admin.username, gl_admin.password, gl_admin.akses, gl_admin.link, gl_kontak.nama FROM gl_admin, gl_kontak where (gl_admin.link = gl_kontak.id OR gl_admin.link=0) ";
if($_GET[q]<>'' AND $_GET[q]<>'+') {
$decq = str_replace("+"," ",$_GET[q]);
$query_data .=" AND (gl_admin.username LIKE '%%$decq%%' OR gl_admin.password LIKE '%%$decq%%' OR gl_admin.akses LIKE '%%$decq%%' OR gl_kontak.nama LIKE '%%$decq%%')";
} 
$query_data .=" GROUP BY `username`";
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
include('include/widget_exportdata.php');
?>


<div class="tablebg">
<h1>User Admin </h1>
<table class="datatable" width="100%" border="0" cellspacing="1" cellpadding="3">
<tr valign="top">
  <td width="230"><?php if(strstr($_SESSION[akses],"A-1-1")) { ?><a href="index.php?component=<?php echo $_GET[component];?>&task=add"><img src="images/add_new.png" border="0" /></a><?php } ?></td>
  <td width="230">&nbsp;</td>
  <td colspan="3" align="right"><form id="search" name="search" method="post" action="">
    <label>
    <input name="q" type="text" id="q" value="<?php echo str_replace("+"," ",$_GET[q]);?>" size="30" />
    </label>
      <label>
      <input name="Search" type="submit" id="Search" value="Search" />
      </label>
  </form>
  <?php if(isset($_POST[Search])) { echo "<script>window.location=\"index.php?component=".$_GET[component]."&q=".str_replace(" ","+",$_POST[q])."\";</script>";} ?>  </td>
  </tr>
<tr>
  <th width="226" align="left">Username</th>
  <th>Password</th>
  <th>Link</th>
  <th colspan="2" align="center">Manage</th>
</tr>
<?php if($totalRows_data > 0) { ?>
<?php do { ?>
  <tr valign="top">
    <td align="left"><?php echo $row_data['username'];?></td>
    <td align="center"><?php echo $row_data['password'];?></td>
    <td align="left">
      <?php if($row_data['link']<>0) { echo $row_data['nama'];}?>    </td>
    <td width="62" align="center"><?php if(strstr($_SESSION[akses],"A-1-2")) { ?><a href="index.php?component=<?php echo $_GET[component];?>&amp;task=edit&amp;id=<?php echo $row_data['id'];?>"><img src="images/edit_.png" border="0" /></a><?php } ?></td>
    <td width="62" align="center"><?php if(strstr($_SESSION[akses],"A-1-3")) { ?><a href="index.php?component=<?php echo $_GET[component];?>&amp;task=delete&amp;id=<?php echo $row_data['id'];?>" class="ask"><img src="images/delete_.png" border="0" /></a><?php } ?></td>
  </tr>
    <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
	<?php if($totalRows_data > $maxRows_data) { ?>
    <tr class="hide">
      <td colspan="10"><table border="0" align="left" width="50%">
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
    <td colspan="4"><?php if(strstr($_SESSION['akses'],"A-1-1")) { ?><a href="index.php?component=user&amp;task=add"><img src="images/add_new.png" border="0" /></a><?php } ?></td>
  </tr>
</table>
</div>
<?php
mysql_free_result($data);
?>
