<?php require_once('../connections/con_gl.php'); ?>
<?php include('../connections/config.php'); ?>
<?php 
$act = $_GET[act];
//$url = "http://localhost/backendiwp/index.php?component=shape";
$url = base_url("index.php?component=gsgemstone");
//$nop = str_replace(" ","",strtoupper($_POST['merk']));
$nop = strtoupper($_POST['barcode']);
$ope = $_POST['open'];

#$sourcePath = $_FILES['imagefile']['tmp_name'];       // Storing source path of the file in a variable
#$targetPath = "galleries/".$_FILES['imagefile']['name']; // Target path where file is to be stored
#echo'<pre>xXx';print_r($_FILES);echo'</pre>';
#echo'<pre>xXx';print_r(is_uploaded_file($_FILES['imagefile']['tmp_name']));echo'</pre>';
#move_uploaded_file($sourcePath,$targetPath) ;
#return FALSE;


/* Validasi */
if (trim($_POST['barcode']) == '') {
	$error[] = '- Kode Barcode harus diisi';
}
if (trim($_POST['reportdate']) == '') {
	$error[] = '- Report Date Barcode harus diisi';
}

if($act=='add' AND (trim($_POST['barcode']) <> ''))
{
	// cek no polisi
	mysql_select_db($database_con_gl, $con_gl);
	$query_cekno = "select gemstone_code from gsgemstones where gsgemstones='$nop'";
	$cekno       = mysql_query($query_cekno, $con_gl);
	$row_cekno   = mysql_fetch_assoc($cekno);
	$total_cekno = mysql_num_rows($cekno);
	if($total_cekno > 0) { 
		$error[] = '- Kode Bacode Name '.$nop.' sudah terdaftar';
	}
}





/*End validasi */
if (isset($error)) {
	echo "<b>Error</b>: <br />".implode("<br />", $error);
}else{
    	$today = date("Y-m-d"); 
	if($act =='add') {
                    
            $query = "INSERT INTO gsgemstones (gemstone_code,report_date,marketname_code,gem_code,shape_code,cutting_style_code,length,width,height,weight,color_code,clarity_code,cut_code,polish_code,symmetry_code,fluorescence_code,item_tipe_code,supplier_code,item_status_code,description,created_date)"
                    . " VALUES ('$_POST[barcode]','$_POST[reportdate]','$_POST[market]','$_POST[gem]','$_POST[shape]','$_POST[cuttingstyle]','$_POST[length]','$_POST[width]','$_POST[height]','$_POST[weight]','$_POST[color]','$_POST[clarity]','$_POST[cut]','$_POST[polish]','$_POST[symmetry]','$_POST[fluorescence]','4','$_POST[supplier]','$_POST[item_status]','$_POST[description]','$today');";
            //'$_POST[]'
           print_r($query);
        }else if($act=='edit'){
            $query = "UPDATE gsgemstones SET gemstone_code='$_POST[barcode]',marketname_code='$_POST[market]',report_date='$_POST[reportdate]',gem_code='$_POST[gem]',shape_code='$_POST[shape]',cuttingstyle_code='$_POST[cuttingstyle]',length='$_POST[length]',width='$_POST[width]',height='$_POST[height]',weight='$_POST[weight]',color_code='$_POST[color]',clarity_code='$_POST[clarity]',cut_code='$_POST[cut]',polish_code='$_POST[polish]',symmetry_code='$_POST[symmetry]',fluorescence_code='$_POST[fluorescence]',supplier_code='$_POST[supplier]',consinyor_code='$_POST[consinyor]',item_status_code='$_POST[item_status]',display_price_currency_code='$_POST[currency]',display_price='$_POST[price]',comment='$_POST[description]',description='$_POST[description]' WHERE gemstone_id='$_POST[id]'";
			print_r($query);
	}else{
	
            //echo $target."/" . $_POST['image_edit'];
            $query = "delete from ref_dm_shape where shape_code='$_POST[id]'";
              
	}            	
        mysql_select_db($database_con_gl, $con_gl);
	$runquery = mysql_query($query, $con_gl);  
        if($runquery) {
		echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil ";if($act=='add' OR $act=='edit') { echo "disimpan";}else{ echo "dihapus"; } echo " ...";
	}else{
		echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
	}
}
?>
<?php if($runquery) { ?><script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script><?php } ?>