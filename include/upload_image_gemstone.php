<?php require_once('../connections/con_gl.php'); ?>

<?php include('../connections/config.php'); ?>

<?php

//session_start();

$act = $_GET[act];



if($act != add)

{

$colname_edit = "-1";

if (isset($_GET['id'])) {

  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id_image'] : addslashes($_GET['id_image']);

  

}

mysql_select_db($database_con_gl, $con_gl);

$query_edit = sprintf("SELECT * FROM ref_images_gsgemstone WHERE id = '$_GET[id_image]'", $colname_edit);

$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());

$row_edit = mysql_fetch_assoc($edit);

$totalRows_edit = mysql_num_rows($edit);

print_r($query_edit);

}

//cekAkses($_SESSION[akses],"DD-2-4");

mysql_select_db($database_con_gl, $con_gl);

$query_klas = "SELECT id,image_type FROM ref_image_type ORDER BY id ASC";

$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());

$row_klas = mysql_fetch_assoc($klas);

$totalRows_klas = mysql_num_rows($klas);



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





$f_tmp = $_FILES['imagefile']['tmp_name'];

$f_nam = str_replace(" ","",strtolower($_FILES['imagefile']['name']));

$f_tip = $_FILES['imagefile'];



if($_POST['image_type'] == '1')

{

		$folder = 'detail';

}

else if($_POST['image_type'] == '2')

{

		$folder = 'header';

}

else

{

		$folder = 'promo';

}



$target = "../" . GALLERIES ."/gsgemstone/".$folder;

echo ($target);

if($act =='add' || $act =='edit')

{

    if(empty($f_tmp)) {

            $error[] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Pilih file arsip yang ingin diupload !!!';

    }

}

//echo $f_tip;

if (isset($error)) {

?>

<div id="loading" style="color:#FFF;border:solid 1px #F00;padding:5px;background:#F00;"><?php echo "<img src=\"../images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:#FFF;\">Error : </b> <br />".implode("<br />", $error); ?></div>

<?php }else{ ?>

<div id="loading" style="color:#1a4d80;border:solid 1px #215800;padding:5px;background:#F0FFED;">

<?php

	if($act =='add') {

	

          

		 if(upload_image_gallery($f_tmp, $target."/".$_FILES['imagefile']['name']))

            {

                $query = "INSERT INTO ref_images_gsgemstone (gsgmstone_id, image_type_id, gsgmstone_image_name,description) VALUES ('$_GET[id]', '$_POST[image_type]', '$f_nam','$_POST[description]')";

                 mysql_select_db($database_con_gl, $con_gl);

                $runquery = mysql_query($query, $con_gl);

            }

            else

            {

                echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal upload !!! x";

            }

	

	}

	else if($act == 'edit')

	{

	

	 		if(file_exists($target."/" . $_POST['image_edit']))

            {

                unlink($target."/" . $_POST['image_edit']);

            }

			

			

            if(upload_image_gallery($f_tmp, $target."/".$_FILES['imagefile']['name']))

            {

                $query = "UPDATE ref_images_gsgemstone SET gsgmstone_image_name='$f_nam', image_type_id='$_POST[image_type]', description='$_POST[description]' WHERE id='$_GET[id_image]'";

				print_r($query);

                mysql_select_db($database_con_gl, $con_gl);

                $runquery = mysql_query($query, $con_gl);  

				 echo'<pre>oOo:: ';print_r(upload_image_gallery($f_tmp, $target."/".$_FILES['imagefile']['name']));echo'</pre>';                          

                    

            }

            else {

                echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal upload !!! x";;

            }

	

	}else{

            //echo $target."/" . $_POST['image_edit'];

            $query = "delete from ref_images_jewelry where id='$_GET[id_image]'";

            mysql_select_db($database_con_gl, $con_gl);

            $runquery = mysql_query($query, $con_gl);  

            

            if(file_exists($target."/" . $_POST['image_edit']))

            {

                unlink($target."/" . $_POST['image_edit']);

            }

            

            

	   

	}

	

if($runquery)

{

echo "<img src=\"../images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Tambah Arsip berhasil ...";

			echo "<script>top.opener.location.reload();self.close();</script>";

}

else

{

echo "<img src=\"../images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:#FFF;\">Error : </b> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Tambah Arsip gagal, coba lagi !!!";	

}

?>

</div>

<?php } ?>

<?php } ?>

<h1>New Image</h1>

<form action="" method="POST" enctype="multipart/form-data" name="add" id="add" >

  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">

    <tr valign="top">

      <td align="right" bgcolor="#FFFFFF">Image Type : </td>

      <td bgcolor="#FFFFFF"><select name="image_type" id="image_type" style="width:200px;">

            <?php if($totalRows_klas > 0) { do { ?>

            <option value="<?php echo $row_klas['id'];?>"<?php if (!(strcmp($row_klas['id'], $row_edit['image_type_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_klas['image_type'];?></option>

            <?php }while($row_klas = mysql_fetch_assoc($klas)); } ?>

          </select></td>

    </tr>

    <tr valign="top">

      <td width="20%" align="right" bgcolor="#FFFFFF">Upload Image :</td>

      <td width="80%" bgcolor="#FFFFFF"><label>

        <input type="file" name="imagefile" id="imagefile" />

      </label></td>

    </tr>

    <tr valign="top">

      <td align="right" bgcolor="#FFFFFF">&nbsp;</td>

      <td bgcolor="#FFFFFF"><input name="id" type="text" id="id" value="<?php echo $row_edit['gsgmstone_id']; ?>" />

        <input name="image_edit" type="text" id="image_edit" value="<?php echo $row_edit['gsgmstone_image_name']; ?>" /></td>

    </tr>

    <tr valign="top">

      <td align="right" bgcolor="#FFFFFF">Description : </td>

      <td bgcolor="#FFFFFF"><label>

        <textarea name="description" cols="85" rows="5" id="description"><?php echo $row_edit['description']; ?></textarea>

        <input name="id" type="hidden" id="id" />

        <input name="kontak" type="hidden" id="kontak" value="<?php echo $_GET['id'];?>" />

      </label></td>

    </tr>

    <tr>

      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi

        <input name="open" type="hidden" id="open" value="<?php echo $_GET['open'];?>" />

      </em></td>

      <td bgcolor="#FFFFFF"><label>

        <input name="Save" type="submit" id="Save" value="Simpan" />

        </label>

        <label>

          <input type="button" name="Button" value="Batal" onClick="javascript:window.close(2000);" />

        </label></td>

    </tr>

  </table>

</form>

</body>