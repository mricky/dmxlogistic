<?php require_once('../connections/con_gl.php'); ?>
<?php
$cid = $_GET['cid'];
//--
mysql_select_db($database_con_gl, $con_gl);
$query_cust = "select * from gl_kontak where id='$cid'";
$cust       = mysql_query($query_cust, $con_gl) or die(mysql_error());
$row_cust   = mysql_fetch_assoc($cust);
?>
<style>
#cusinfo tr td {
	font-size:10px;	
}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="datatable" id="cusinfo">
  <tr>
    <th colspan="4" align="center">INFORMASI PELANGGAN</th>
  </tr>
  <tr>
    <td align="right" valign="top"><div align="left">INFO PEMESAN </div></td>
    <td width="38%" valign="top">&nbsp;</td>
    <td width="15%" valign="top">INFO REFERENSI </td>
    <td width="32%" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top">NPWP :</td>
    <td valign="top"><?php echo $row_cust['npwp'];?></td>
    <td width="15%" align="right" valign="top">Nama :</td>
    <td valign="top"><?php echo $row_cust['nama1'];?></td>
  </tr>
  <tr>
    <td width="15%" align="right" valign="top">Nama :</td>
    <td valign="top"><?php echo $row_cust['nama'];?></td>
    <td align="right" valign="top">Alamat :</td>
    <td valign="top"><?php echo $row_cust['alamat1'];?></td>
  </tr>
  <tr>
    <td align="right" valign="top">Alamat :</td>
    <td valign="top"><?php echo $row_cust['alamat'];?></td>
    <td align="right" valign="top">No. Tlp :</td>
    <td valign="top"><?php echo $row_cust['tlp1'];?></td>
  </tr>
  <tr>
    <td align="right" valign="top">Email :</td>
    <td valign="top"><?php echo $row_cust['email'];?></td>
    <td align="right" valign="top"> Jabatan :</td>
    <td valign="top"><?php echo $row_cust['jabatan1'];?></td>
  </tr>
  
  <tr>
    <td align="right" valign="top">No.Telpon :</td>
    <td valign="top"><?php echo $row_cust['tlp'];?></td>
    <td align="right" valign="top"> :</td>
    <td valign="top"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Keterangan :</td>
    <td valign="top"><?php echo $row_cust['keterangan'];?></td>
  </tr>
</table>
