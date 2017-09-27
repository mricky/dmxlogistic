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
$query_data = "SELECT a.id, a.kontak, b.katagori, a.tipe, a.arsip, a.keterangan from gl_arsip a, gl_katagoriarsip b where b.id=a.katagori AND a.kontak='$_GET[id]'";
$query_data .=" ORDER BY a.tipe, a.arsip";
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
list($namakontak, $tcustomer) = mysql_fetch_row(mysql_query("select nama, tcustomer from gl_kontak where id = '$_GET[id]'"));
?>
<h1>Data Arsip <?php if($tcustomer=='Retail') echo "Cust. Retail (".$namakontak.")"; if($tcustomer=='Corporate') echo "Cust. Coorporate (".$namakontak.")"; ?></h1>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
  <tr class="hide">
    <td>Dokumen Check List :</td>
    <td width="100" align="right"><div align="right">RETAIL : </div></td>
    <td colspan="2" align="right"><div align="left">
        <input name="1" type="checkbox" id="1" value="1" />
      Copy KTP Pemohon </div></td>
    <td colspan="5" align="right">&nbsp;</td>
  </tr>
  <tr class="hide">
    <td>&nbsp;</td>
    <td align="right"><div align="left">
        <div align="right">CORPORATE :</div>
    </div></td>
    <td colspan="2" align="right"><div align="left">
        <input name="1" type="checkbox" id="1" value="1" />
      Copy Akta </div></td>
    <td colspan="2" align="right"><div align="left">
        <input name="12" type="checkbox" id="12" value="1" />
      Copy SIUP </div></td>
    <td width="204" colspan="-2" align="right"><div align="left">
        <input name="13" type="checkbox" id="13" value="1" />
      Copy TDP </div></td>
    <td width="212" align="right"><div align="left">
        <input name="14" type="checkbox" id="14" value="1" />
      Copy Domisili </div></td>
    <td align="right"><div align="left">
        <input name="15" type="checkbox" id="15" value="1" />
      Copy NPWP </div></td>
  </tr>
  <tr class="hide">
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right"><div align="left">
        <input name="1" type="checkbox" id="1" value="1" />
      Copy KTP Pemohon </div></td>
    <td colspan="2" align="right"><div align="left">
        <input name="122" type="checkbox" id="122" value="1" />
      Copy KTP Penjamin </div></td>
    <td colspan="-2" align="right"><div align="left">
        <input name="123" type="checkbox" id="123" value="1" />
      Copy SIM Pemakai </div></td>
    <td align="right"><div align="left">
        <input name="124" type="checkbox" id="124" value="1" />
      PO-Purchase Order </div></td>
    <td align="right"><div align="left">
        <input name="125" type="checkbox" id="125" value="1" />
      Copy Rek. Koran </div></td>
  </tr>
  <tr class="hide">
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td colspan="2" align="right"><div align="left">
        <input name="1" type="checkbox" id="1" value="1" />
      Copy KK</div></td>
    <td colspan="2" align="right"><div align="left">
        <input name="122" type="checkbox" id="122" value="1" />
      Copy Setifikat &amp; PBB </div></td>
    <td colspan="-2" align="right"><div align="left">
        <input name="123" type="checkbox" id="123" value="1" />
      Surat Penunjukan </div></td>
    <td align="right"><div align="left"></div></td>
    <td align="right"><div align="left"></div></td>
  </tr> 
  
  <tr class="hide">
    <td width="146"><a href="include/upload_arsip.php?id=<?php echo $_GET['id'];?>" onclick="NewWindow(this.href,'name','920','425','yes');return false"><img src="images/add_new.png" border="0" /></a></td>
    <td colspan="8" align="right"><form id="search" name="search" method="post" action="">
      <label>
        <input name="cr_txt" type="text" id="cr_txt" value="<?php echo $_GET['cr_txt'];?>" size="30" maxlength="100" placeholder="Find By : Nama Arsip, Katagori Arsip, Keterangan" />
      </label>
      <label>
      <input name="Search" type="submit" id="Search" value="Search" />
      </label>
        </form><?php
	if(isset($_POST['Search'])) {
		$url_find = "<script>window.location=\"index.php?component=arsiptask=".$_GET[task]."&id=".$_GET[id]."&cr_txt=".str_replace(" ","+",$_POST[cr_txt]);
		if(isset($_GET['open'])) { 
			$url_find .= "&open=".$_GET['open'];
		}
		$url_find .= "\";</script>";
		echo $url_find;
	}
	?></td>
  </tr>
   
  <tr>
    <th>Katagori Arsip </th>
    <th colspan="4"><strong>Tipe Arsip</strong></th>
    <th width="95"><strong>Nama Arsip</strong></th>
    <th colspan="-2">&nbsp;</th>
    <th><strong>Keterangan</strong></th>
    <th width="157" align="center" class="hide"><strong>Aksi</strong></th>
  </tr>
  <?php if($totalRows_data > 0) { ?>
  <?php do { ?>
    <tr valign="top" bgcolor="#FFFFFF">
      <td align="left"><?php echo $row_data['katagori'];?></td>
      <td colspan="3" align="left"><?php echo $row_data['tipe'];?></td>
      <td width="121" align="right"><a href="download.php?filename=<?php echo $row_data['arsip'];?>" title="Download Arsip"><img src="images/download.png" width="16" border="0" align="right" /></a></td>
      <td colspan="2" align="left"><?php echo $row_data['arsip'];?></td>
      <td><?php echo $row_data['keterangan'];?></td>
      <td align="center" class="hide"><a href="include/editupload_arsip.php?id=<?php echo $row_data['id'];?>" onclick="NewWindow(this.href,'name','920','425','yes');return false"><img src="images/edit_.png" border="0" /></a> <a href="include/deleteupload_arsip.php?id=<?php echo $row_data['id'];?>" onclick="NewWindow(this.href,'name','920','425','yes');return false"><img src="images/delete_.png" border="0"/></a></td>
    </tr>
    <?php } while ($row_data = mysql_fetch_assoc($data)); ?>
	<?php if($totalRows_data > $maxRows_data) { ?>
    <tr class="hide">
      <td colspan="9"><table border="0" align="left" id="pagination">
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
    <td colspan="9">Data tidak ada !!! </td>
  </tr>
  <?php } ?>
  <tr class="hide">
    <td><a href="include/upload_arsip.php?id=<?php echo $_GET['id'];?>" onclick="NewWindow(this.href,'name','920','425','yes');return false"><img src="images/add_new.png" border="0" /></a></td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
mysql_free_result($data);
?>