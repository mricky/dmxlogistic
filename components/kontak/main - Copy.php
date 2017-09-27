<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"D-2");
$currentPage = $_SERVER["PHP_SELF"];
mysql_select_db($database_con_gl, $con_gl);
$query_l_kel = "SELECT id, area FROM gl_area ORDER BY area ASC";
$l_kel = mysql_query($query_l_kel, $con_gl) or die(mysql_error());
$row_l_kel = mysql_fetch_assoc($l_kel);
$totalRows_l_kel = mysql_num_rows($l_kel);

$maxRows_data = 10;
$pageNum_data = 0;
if (isset($_GET['pageNum_data'])) {
  $pageNum_data = $_GET['pageNum_data'];
}
$startRow_data = $pageNum_data * $maxRows_data;
$cr_txt = str_replace("+"," ",$_REQUEST[cr_txt]);
mysql_select_db($database_con_gl, $con_gl);
$query_data = "SELECT gl_kontak.id, gl_kontak.nama, gl_unitkerja.unitkerja, gl_kontak.alamat, gl_kontak.tlp, gl_kontak.email, gl_kontak.keterangan, gl_gudang.gudang FROM gl_kontak, gl_unitkerja, gl_gudang WHERE gl_kontak.type ='Karyawan' AND gl_unitkerja.id=gl_kontak.unitkerja AND gl_gudang.id=gl_kontak.gudang";
if($_REQUEST['cr_kel'] <>'' OR $_POST['cr_txt']) {
	$query_data .=" where ";
	if($_REQUEST['cr_kel'] <>'') {
		$query_data .=" type ='$_REQUEST[cr_kel]'";
		if($_REQUEST['cr_txt'] <>'') {
			$query_data .= "AND (gl_kontak.id ='$cr_txt' OR gl_kontak.nama LIKE '%%$cr_txt%%' OR gl_kontak.unitkerja LIKE '%%$cr_txt%%' OR gl_kontak.alamat LIKE '%%$cr_txt%%' OR gl_kontak.tlp LIKE '%%$cr_txt%%' OR gl_gudang.gudang LIKE '%%$cr_txt%%')";
		}
	}
}
$query_data .=" ORDER BY nama";
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
<h1>Daftar Data Karyawan</h1>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 
  <tr class="hide">
    <td width="183"><?php if(strstr($_SESSION[akses],"D-2-1")) { ?><a href="index.php?component=kontak&amp;task=add"><img src="images/add_new.png" border="0" /></a><?php } ?></td>
    <td colspan="7" align="right"><form id="search" name="search" method="post" action="">
      <label></label>
      <label>
      <select name="cr_kel" id="cr_kel">
        <option value="ALL" <?php if (!(strcmp("ALL", $_GET[cr_kel]))) {echo "selected=\"selected\"";} ?>>Pilih Area</option>
        <?php
		do {  
		?>
        <option value="<?php echo $row_l_kel['id']?>"<?php if (!(strcmp($row_l_kel['id'], $_GET[cr_kel]))) {echo "selected=\"selected\"";} ?>><?php echo $row_l_kel['area']?></		option>
        <?php
} while ($row_l_kel = mysql_fetch_assoc($l_kel));
  $rows = mysql_num_rows($l_kel);
  if($rows > 0) {
      mysql_data_seek($l_kel, 0);
	  $row_l_kel = mysql_fetch_assoc($l_kel);
  }
?>
      </select>
      <input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: nama,unit kerja,cabang,no.telp"; onclick="this.value='';"<?php echo $_POST['cr_txt'];?>" size="40" maxlength="100" />
      </label>
      <label>
      <input name="Search" type="submit" id="Search" value="Search" />
      </label>
        </form><?php
	if(isset($_POST['Search'])) {
		echo "<script>window.location=\"index.php?component=kontak&cr_klas=".$_POST[cr_klas]."&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";
	}
	?></td>
  </tr>
  <tr>
    <th><strong>Nama</strong></th>
    <th width="135">Unit Kerja </th>
    <th width="298"><strong>Alamat</strong></th>
    <th width="95"><strong>Telepon</strong></th>
    <th width="91"><strong>Email</strong></th>
    <th width="108">Kantor/Cabang</th>
    <th width="172"><strong>Keterangan</strong></th>
    <th width="138" align="center" class="hide"><strong>Aksi</strong></th>
  </tr>
  <?php if($totalRows_data > 0) { ?>
  <?php do { ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td><?php echo $row_data['nama']; ?>&nbsp;</td>
      <td><?php echo $row_data['unitkerja']; ?></td>
      <td><?php echo $row_data['alamat']; ?>&nbsp;</td>
      <td><?php echo $row_data['tlp']; ?>&nbsp;</td>
      <td><?php echo $row_data['email']; ?>&nbsp;</td>
      <td><?php echo $row_data['gudang']; ?></td>
      <td><?php echo $row_data['keterangan']; ?>&nbsp;</td>
      <td align="center" class="hide"><?php if(strstr($_SESSION[akses],"D-2-2")) { ?><a href="index.php?component=kontak&amp;task=edit&amp;id=<?php echo $row_data[id];?>"><img src="images/edit_.png" border="0"/></a><?php } ?> <?php if(strstr($_SESSION[akses],"D-2-3")) { ?><a href="index.php?component=kontak&amp;task=delete&amp;id=<?php echo $row_data[id];?>" class="ask"><img src="images/delete_.png" border="0"/></a><?php } ?></td>
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
    <td colspan="8">Data tidak ada !!! </td>
  </tr>
  <?php } ?>
  <tr class="hide">
    <td><?php if(strstr($_SESSION[akses],"D-2-1")) { ?><a href="index.php?component=kontak&amp;task=add"><img src="images/add_new.png" border="0" /></a><?php } ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
mysql_free_result($data);
?>
