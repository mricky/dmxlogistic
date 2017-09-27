<?php require_once('../connections/con_gl.php'); ?>

<?php include('../connections/config.php'); ?>

<?php 

$act = $_GET[act];

//$url = "http://localhost/backendiwp/index.php?component=shape";

$url = base_url("index.php?component=customer");

//$nop = str_replace(" ","",strtoupper($_POST['merk']));

$nop = strtoupper($_POST['hp']);

$ope = $_POST['open'];



#$sourcePath = $_FILES['imagefile']['tmp_name'];       // Storing source path of the file in a variable

#$targetPath = "galleries/".$_FILES['imagefile']['name']; // Target path where file is to be stored

#echo'<pre>xXx';print_r($_FILES);echo'</pre>';

#echo'<pre>xXx';print_r(is_uploaded_file($_FILES['imagefile']['tmp_name']));echo'</pre>';

#move_uploaded_file($sourcePath,$targetPath) ;

#return FALSE;





/* Validasi */

if ($act=='add' AND trim($_POST['nama']) == '') {

	$error[] = '- Nama harus diisi';

}

if ($act=='add' AND trim($_POST['alamat']) == '') {

	$error[] = '- Alamat harus diisi';

}
if ($act=='add' AND trim($_POST['hp']) == '') {

	$error[] = '- Hp harus diisi';

}



if($act=='add' AND (trim($_POST['nama']) <> ''))

{

	// cek no polisi

	mysql_select_db($database_con_gl, $con_gl);

	$query_cekno = "select customer from nama where NAMACUSTOMER='$nop'";

	$cekno       = mysql_query($query_cekno, $con_gl);

	$row_cekno   = mysql_fetch_assoc($cekno);

	$total_cekno = mysql_num_rows($cekno);

	if($total_cekno > 0) { 

		$error[] = '- Nama Customer '.$nop.' sudah terdaftar';

	}

}











/*End validasi */

if (isset($error)) {

	echo "<b>Error</b>: <br />".implode("<br />", $error);

}else{

    	$today = date("Y-m-d"); 

	if($act =='add') {

                    
			$kode =  "CST".strtotime('now');
            $query = "INSERT INTO customer (KODECUSTOMER,NAMACUSTOMER,ALAMAT,TELEPON,FAX,CONTACTPERSON,HP,EMAIL,MARKETING)"

                    . " VALUES ('$kode','$_POST[nama]','$_POST[alamat]','$_POST[telepon]','$_POST[fax]','$_POST[contact]','$_POST[hp]','$_POST[email]','$_POST[marketing]');";

            //'$_POST[]'

          // print_r($query);
		  // die($query);

        }else if($act=='edit'){

            $query = "UPDATE customer SET NAMACUSTOMER='$_POST[nama]',ALAMAT='$_POST[alamat]',TELEPON='$_POST[telepon]',FAX='$_POST[fax]',CONTACTPERSON='$_POST[contact]',HP='$_POST[hp]',EMAIL='$_POST[email]',MARKETING='$_POST[marketing]' WHERE IDCUSTOMER='$_POST[id]'";

		//print_r($query);

		//break;

			

	}else{

            //echo $target."/" . $_POST['image_edit'];

            $query = "delete from customer where IDCUSTOMER='$_POST[id]'";

              //print_r($query);

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