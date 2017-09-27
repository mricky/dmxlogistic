<?php require('connections/con_gl.php'); ?>



<?php



//session_start();



$url = "index.php";



if (trim($_POST['username']) == '') {



	$error[] = '- Username harus diisi !!!';



}



if (trim($_POST['password']) == '') {



	$error[] = '- Password harus diisi !!!';



}



if (isset($error)) {



	echo "<img src=\"images/alert.png\" align=\"left\" hspace=\"5\" style=\"margin-top:2px;\"/><b>Error</b>: <br />".implode("<br />", $error);



}else{



	mysql_select_db($database_con_gl, $con_gl);



	$query_login = "SELECT gl_admin.akses, gl_admin.username, gl_admin.id, gl_kontak.id as kid, gl_kontak.nama,gl_kontak.unitkerja, gl_kontak.gudang as cabang_id,(select g.nama from gl_gudang g where g.id = gl_kontak.gudang) as cabang_name FROM gl_admin, gl_kontak WHERE gl_admin.username='$_POST[username]' AND gl_admin.password='".simple_encrypt(trim($_POST['password']))."' AND gl_kontak.id = gl_admin.link"; //echo $query_login;
	//printf($query_login);


	$login = mysql_query($query_login, $con_gl) or die(mysql_error());


	$row_login = mysql_fetch_assoc($login);



	$totalRows_login = mysql_num_rows($login);



?>



<?php if($totalRows_login > 0) { ?>



	<?php
		$_SESSION[admin] = $row_login['username'];
		$_SESSION[akses] = $row_login['akses'];
		$_SESSION[nama]  = $row_login['nama'];
		$_SESSION[cabang_id]= $row_login['cabang_id'];
		$_SESSION[cabang_name]= $row_login['cabang_name'];
		$_SESSION[area]= $row_login['area'];
		$_SESSION[kontakid] = $row_login['kid'];
     	$_SESSION[unitkerja] = $row_login['unitkerja'];
		//echo $_SESSION['unitkerja'];
// '<pre>';print_r($query_login);echo '</pre>';
 // die($_SESSION[cabang_name]);


		echo "<img src=\"images/check.png\" align=\"left\" hspace=\"5\"/> Login berhasil ...";



	?>



	<script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 1000);</script>



<?php }else{ ?>



	<img src="images/alert.png" align="left" hspace="5" style="margin-top:2px;"/><b>Error</b>: <br />Username dan Password salah !!!



<?php } ?>



<?php } ?>