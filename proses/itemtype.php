<?php require_once('../connections/con_gl.php'); ?>
<?php include('../connections/config.php'); ?>
<?php 
$act = $_GET[act];
//$url = "http://localhost/backendiwp/index.php?component=shape";
$url = base_url("index.php?component=itemtype");
//$nop = str_replace(" ","",strtoupper($_POST['merk']));
$nop = strtoupper($_POST['item_name']);
$ope = $_POST['open'];

#$sourcePath = $_FILES['imagefile']['tmp_name'];       // Storing source path of the file in a variable
#$targetPath = "galleries/".$_FILES['imagefile']['name']; // Target path where file is to be stored
#echo'<pre>xXx';print_r($_FILES);echo'</pre>';
#echo'<pre>xXx';print_r(is_uploaded_file($_FILES['imagefile']['tmp_name']));echo'</pre>';
#move_uploaded_file($sourcePath,$targetPath) ;
#return FALSE;


/* Validasi */
if (trim($_POST['item_name']) == '') {
	$error[] = '- Item Name harus diisi';
}
if($act=='add' AND (trim($_POST['item_name']) <> ''))
{
	// cek no polisi
	mysql_select_db($database_con_gl, $con_gl);
	$query_cekno = "select item_tipe_name from item_type where item_tipe_name='$nop'";
	$cekno       = mysql_query($query_cekno, $con_gl);
	$row_cekno   = mysql_fetch_assoc($cekno);
	$total_cekno = mysql_num_rows($cekno);
	if($total_cekno > 0) { 
		$error[] = '- Item Name '.$nop.' sudah terdaftar';
	}
}

$f_tmp = $_FILES['imagefile']['tmp_name'];
$f_nam = str_replace(" ","",strtolower($_FILES['imagefile']['name']));
$f_tip = $_FILES['imagefile'];
$target = "../" . GALLERIES . "/itemcategory";

if($act =='add' || $act =='edit')
{
    if(empty($f_tmp)) {
            $error[] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Pilih file arsip yang ingin diupload !!!';
    }
}



/*End validasi */
if (isset($error)) {
	echo "<b>Error</b>: <br />".implode("<br />", $error);
}else{
	if($act =='add') {
           
                    
           #echo'<pre>yyy';print_r($target);echo'</pre>';
           #echo'<pre>xXx';print_r(is_uploaded_file($_FILES['imagefile']['tmp_name']));echo'</pre>';
           //echo'<pre>oOo:: ';print_r(upload_image_gallery($f_tmp, $target));echo'</pre>';
           

            if(upload_image_gallery($f_tmp, $target."/".$_FILES['imagefile']['name']))
            {
                $query = "INSERT INTO item_type (item_tipe_name, item_tipe_image,item_tipe_description) VALUES ('$_POST[item_name]', '$f_nam','$_POST[description]')";
                 mysql_select_db($database_con_gl, $con_gl);
                $runquery = mysql_query($query, $con_gl);
            }
            else
            {
                echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal upload !!! x";
            }
        
        
        }else if($act=='edit'){
	
            //$_POST['image_edit'];]
            if(file_exists($target."/" . $_POST['image_edit']))
            {
                unlink($target."/" . $_POST['image_edit']);
            }
            if(upload_image_gallery($f_tmp, $target."/".$_FILES['imagefile']['name']))
            {
                $query = "UPDATE item_type SET item_tipe_name='$_POST[item_name]', item_tipe_image='$f_nam', item_tipe_description='$_POST[description]' WHERE item_tipe_code='$_POST[id]'";
                mysql_select_db($database_con_gl, $con_gl);
                $runquery = mysql_query($query, $con_gl);                            
                    
            }
            else {
                echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal upload !!! x";;
            }
                 
            
            
	}else{
            //echo $target."/" . $_POST['image_edit'];
            $query = "delete from item_type where item_tipe_code='$_POST[id]'";
            mysql_select_db($database_con_gl, $con_gl);
            $runquery = mysql_query($query, $con_gl);  
            
            if(file_exists($target."/" . $_POST['image_edit']))
            {
                unlink($target."/" . $_POST['image_edit']);
            }
            
            
	   
	}
             	
	
}
?>
<?php if($runquery AND $ope=='window') { ?>
	<script type="text/javascript">top.opener.sendRespondArea();self.close(2000);</script>
<?php }else if($ope==''){ ?>
	<script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script>
<?php } ?>