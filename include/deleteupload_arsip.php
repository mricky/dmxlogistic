<?php require_once('../connections/con_gl.php'); ?>
<?php
session_start();
//cekAkses($_SESSION[akses],"DD-2-4");
// get data
mysql_select_db($database_con_gl, $con_gl);
$query_getdata = "select * from gl_arsip where id='$_GET[id]'";
$getdata = mysql_query($query_getdata, $con_gl) or die(mysql_error());
$row_getdata = mysql_fetch_assoc($getdata);
?>
<link type="text/css" rel="stylesheet" href="../css/style.css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.wysiwyg.css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.wysiwyg.js"></script>
<script type="text/javascript">
$(function()
  {
	  $('#keterangan').wysiwyg();
  });
</script>
<body style="background:none;padding:8px;">
<?php if(isset($_POST['Save'])) { ?>
<?php
// validasi data
$ars = $_POST['arsip'];
$fars= $_POST['filearsip'];
$ket = $_POST['keterangan'];
$f_tmp = $_FILES['filearsip']['tmp_name'];
$f_nam = str_replace(" ","",strtolower($_FILES['filearsip']['name']));
$f_tip = $_FILES['filearsip']['type'];
/*if($f_tip=='') {
	$error[] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Pilih file arsip yang ingin diupload !!!';
}*/
if (isset($error)) {
?>
<div id="loading" style="color:#FFF;border:solid 1px #F00;padding:5px;background:#F00;"><?php echo "<img src=\"../images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:#FFF;\">Error : </b> <br />".implode("<br />", $error); ?></div>
<?php }else{ ?>
<div id="loading" style="color:#1a4d80;border:solid 1px #215800;padding:5px;background:#F0FFED;">
<?php
	$query = "delete from gl_arsip";
	$f_dest = "../data_arsip/".$f_nam;
		if(file_exists("../data_arsip/".$_POST['filearsip_db'])) { 
			unlink("../data_arsip/".$_POST['filearsip_db']);
		}
	$query .= " where id='$_POST[id]'";
	mysql_select_db($database_con_gl, $con_gl);
	if(mysql_query($query, $con_gl)) {
		echo "<img src=\"../images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Tambah Arsip berhasil ...";
		echo "<script>top.opener.location.reload();self.close();</script>";
	}else{
		echo "<img src=\"../images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:#FFF;\">Error : </b> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Tambah Arsip gagal, coba lagi !!!";	
	}
}
?>
</div>
<?php } ?>
<h1>Hapus Data Arsip</h1>
<form action="" method="POST" enctype="multipart/form-data" name="add" id="add" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Upload Arsip :</td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <input type="file" name="filearsip" id="filearsip" />
      </label>
      <input name="filearsip_db" type="hidden" id="filearsip_db" value="<?php echo $row_getdata['arsip'];?>"></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Keterangan : </td>
      <td bgcolor="#FFFFFF"><label>
        <strong>
        <textarea name="keterangan" cols="85" rows="5" id="keterangan"><?php echo $row_getdata['keterangan'];?></textarea>
        </strong>
<input name="id" type="hidden" id="id" value="<?php echo $row_getdata['id'];?>" />
        <input name="kontak" type="hidden" id="kontak" value="<?php echo $_GET['id'];?>" />
      </label></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi
        <input name="open" type="hidden" id="open" value="<?php echo $_GET['open'];?>" />
      </em></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="Save" type="submit" id="Save" value="Hapus" onClick="return confirm('Hapus data ?');"/>
        </label>
        <label>
          <input type="button" name="Button" value="Batal" onClick="javascript:window.close(2000);" />
        </label></td>
    </tr>
  </table>
</form>
</body>