<?php
$id = $_GET['id'];
?>
<title>Upload Photo Kendaraan</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<br /><br /><br /><br /><img src="../images/chi_logo_big.png" hspace="4" vspace="10" border="0" /><br /><br />
<div style="padding:5px;">
<h1>Upload Photo</h1>
<?php if(isset($_POST['upload'])) { ?>
<div id="resultPost">
	<?php
		// get file
		$nam = $_FILES['foto']['name'];
		$tmp = $_FILES['foto']['tmp_name'];
		$img = substr($_FILES['foto']['type'],0,5);
		if($img <>'image') {
			echo "<img src=\"../images/alert.png\" hspace=\"4\" width=\"16\"> File harus gambar !!!";
		}else{
			// upload foto
			// generated name foto
			$nam     = $_FILES['foto']['name'];
			$g_nam   = explode(".",$nam);
			$j_gnam  = count($g_nam);
			$gen_nam = $id.".png";
			// --- upload foto
			$tmp     = $_FILES['foto']['tmp_name'];
			$des_file= "../photo_mobil/".$gen_nam;
			if(copy($tmp,$des_file)) {
				// resize foto
				include('resize_image.php');
				$get_photo = "../photo_mobil/".$gen_nam;
				$res_photo =  new SimpleImage();
   				$res_photo->load($get_photo);
   				$res_photo->resizeToHeight(85);
   				$res_photo->save($get_photo);
				echo "<img src=\"../images/check.png\" hspace=\"4\"> Photo telah disimpan ...";	
				echo "<script>top.opener.location.reload();setTimeout(function(){ self.close();},2000);</script>";
			}else{
				echo "<img src=\"../images/check.png\" hspace=\"4\"> Upload photo gagal, coba lagi !!!";
			}
		}
	?>
</div>
<?php } ?>
<form action="" method="post" enctype="multipart/form-data" name="upload" id="upload">
  <table width="100%" border="0" cellspacing="0" cellpadding="4" class="datatable">
    <tr>
      <td width="20%" align="right">Nopol</td>
      <td width="1%">:</td>
      <td><?php echo $id;?></td>
    </tr>
    <tr>
      <td align="right">Pilih Photo</td>
      <td>:</td>
      <td><label>
        <input type="file" name="foto" id="foto">
        (* hanya gambar</label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="upload" id="upload" value="Upload">
      </label>
        <label>
          <input type="button" name="button2" id="button2" value="Batal" onClick="javascript:top.opener.location.reload();setTimeout(function(){ self.close();},1000);">
        </label></td>
    </tr>
  </table>
</form>
</div>
