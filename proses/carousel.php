<?php require_once('../connections/con_gl.php'); ?>
<?php include('../connections/config.php'); ?>
<?php 
$act = $_GET[act];
//$url = "http://localhost/backendiwp/index.php?component=shape";
$url = base_url("index.php?component=carousel");
//$nop = str_replace(" ","",strtoupper($_POST['merk']));
$nop = strtoupper($_POST['link']);
$ope = $_POST['open'];


/* Validasi */
if (trim($_POST['link']) == '') {
	$error[] = '- Link Related Name harus diisi';
}


$f_tmp = $_FILES['imagefile']['tmp_name'];
$f_nam = str_replace(" ","",strtolower($_FILES['imagefile']['name']));
$f_tip = $_FILES['imagefile'];
$target = "../" . GALLERIES;

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
           

            if(upload_image_gallery($f_tmp, $target."/carousel/".$_FILES['imagefile']['name']))
            {
                $query = "INSERT INTO carousel (carousel_image,carousel_link) VALUES ( '$f_nam','$_POST[link]')";
                 mysql_select_db($database_con_gl, $con_gl);
                $runquery = mysql_query($query, $con_gl);
            }
            else
            {
                echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal upload !!! x";
            }
        
        
        }else if($act=='edit'){
	
            //$_POST['image_edit'];]
            if(file_exists($target."/carousel/" . $_POST['image_edit']))
            {
                unlink($target."/carousel/" . $_POST['image_edit']);
            }
            
            if(upload_image_gallery($f_tmp, $target."/carousel/".$_FILES['imagefile']['name']))
            {
                $query = "UPDATE carousel SET carousel_link='$_POST[link]', carousel_image='$f_nam' WHERE id='$_POST[id]'";
                mysql_select_db($database_con_gl, $con_gl);
                $runquery = mysql_query($query, $con_gl);                            
                    
            }
            else {
                echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal upload !!! x";;
            }
                 
            
            
	}else{
            //echo $target."/" . $_POST['image_edit'];
            $query = "delete from ref_dm_shape where shape_code='$_POST[id]'";
            mysql_select_db($database_con_gl, $con_gl);
            $runquery = mysql_query($query, $con_gl);  
            
            if(file_exists($target."/carousel/" . $_POST['image_edit']))
            {
                unlink($target."/carousel/" . $_POST['image_edit']);
            }
            
            
	   
	}
             	
	
}
?>
<?php if($runquery AND $ope=='window') { ?>
	<script type="text/javascript">top.opener.sendRespondArea();self.close(2000);</script>
<?php }else if($ope==''){ ?>
	<script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script>
<?php } ?>