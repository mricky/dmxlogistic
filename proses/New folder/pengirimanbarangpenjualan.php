<?php require_once('../connections/con_gl.php'); ?>
<?php
mysql_select_db($database_con_gl, $con_gl);
$query_cekpk = "SELECT gl_rtrans.no_ref FROM gl_rtrans WHERE gl_rtrans.no_ref='$_POST[noreferensi]'";
$cekpk = mysql_query($query_cekpk, $con_gl) or die(mysql_error());
$row_cekpk = mysql_fetch_assoc($cekpk);
$totalRows_cekpk = mysql_num_rows($cekpk);

$act = $_GET[act];
$url = "index.php?component=penjualan";

/* Validasi */
if (trim($_POST['akunkredit']) == '') {
	$error[] = '- Akun Kas harus dipilih !!!';
}
if (trim($_POST['dari']) == '') {
	$error[] = '- Kontak harus dipilih !!!';
}
if (trim($_POST['noreferensi']) == '') {
	$error[] = '- No Referensi harus diisi !!!';
}
if (trim($_POST['tanggal']) == '') {
	$error[] = '- Tanggal harus diisi !!!';
}
if($act=='add' AND $totalRows_cekpk > 0) {
	$error[] = '- No Referensi sudah digunakan !!!';
}
if ($_POST['ntotal']==0) {
	$error[] = '- Isi Transaksi dahulu !!!';
}
if (trim($_POST['biaya']) == '' XOR trim($_POST['akunbiaya']) == '') {
	$error[] = '- Periksa Biaya & Akun Biaya !!!';
}
if (trim($_POST['pajak']) == '' XOR trim($_POST['akunpajak']) == '') {
	$error[] = '- Periksa Pajak & Akun Pajak !!!';
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	mysql_select_db($database_con_gl, $con_gl);
	$query_getkpd = "SELECT gl_kontak.nama FROM gl_kontak WHERE gl_kontak.id='$_POST[dari]'";
	$getkpd = mysql_query($query_getkpd, $con_gl) or die(mysql_error());
	$row_getkpd = mysql_fetch_assoc($getkpd);

	$query = "INSERT INTO gl_rtrans (no_ref, tgl, keterangan, gudang, kontak, jenis, jatuhtempo, recipient, akbiaya, akpjk) VALUES ('$_POST[noreferensi]', '$_POST[tanggal]', '$_POST[keterangan]', '$_POST[gudang]', '$_POST[dari]', '$_POST[jenis]', '$_POST[jatuhtempo]', '$_POST[recipient]', '$_POST[akunbiaya]', '$_POST[akunpajak]')";
	
		if($_POST[akunkredit]<>'' AND $_POST[saldohutang] > 0) {
  			$nil = $_POST[saldohutang];
  			mysql_select_db($database_con_gl, $con_gl);
 			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Piutang Penjualan ke $row_getkpd[nama]', '$nil', 'K', '$_POST[akunkredit]')", $con_gl);
  		}
  		if($_POST[akunbiaya] <>'' AND $_POST[biaya] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
  			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Biaya Lain', '$_POST[biaya]', 'D', '$_POST[akunbiaya]')", $con_gl);
 		}
  		if($_POST[akunpajak] <>'' AND $_POST[pajak] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
 			 mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Pajak', '$_POST[pajak]', 'D', '$_POST[akunpajak]')", $con_gl);
  		}
  		if($_POST[bayar] <> '') {
  			mysql_select_db($database_con_gl, $con_gl);
  			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Pembayaran ke $row_getkpd[nama]', '$_POST[bayar]', 'K', '$_POST[akun]')", $con_gl);
  		}
	}else if($act=='edit'){
	$query ="UPDATE gl_rtrans SET tgl='$_POST[tanggal]', jatuhtempo='$_POST[jatuhtempo]', keterangan='$_POST[keterangan]', jenis='$_POST[jenis]', gudang='$_POST[gudang]', kontak='$_POST[dari]', recipient='$_POST[recipient]', akbiaya='$_POST[akunbiaya]', akpjk='$_POST[akunpajak]' WHERE no_ref='$_POST[noreferensi]'";
	
	//mysql_query("update gl_trans set total='$_POST[total_2]', akun='$_POST[akun]' where id='$_POST[id_persediaan]'", $con_gl);
	
	mysql_select_db($database_con_gl, $con_gl);
	$query_getkpd = "SELECT gl_kontak.nama FROM gl_kontak WHERE gl_kontak.id='$_POST[dari]'";
	$getkpd = mysql_query($query_getkpd, $con_gl) or die(mysql_error());
	$row_getkpd = mysql_fetch_assoc($getkpd);
		if($_POST[akunkredit]<>'' AND $_POST[saldohutang] > 0) {
  			$nil = $_POST[saldohutang];
  			mysql_select_db($database_con_gl, $con_gl);
  			if($_POST[id_hutang]=='') {
  				mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Hutang Pembelian $row_getkpd[nama]', '$_POST[saldohutang]', 'K', '$_POST[akunkredit]')", $con_gl);
  			}else{
  				mysql_query("update gl_trans set akun='$_POST[akunkredit]', total='$nil' where id='$_POST[id_hutang]'", $con_gl);
  			}
  		}
  		if($_POST[akunbiaya] <>'' AND $_POST[biaya] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
  				if($_POST[id_biaya]=='') {
  					mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Biaya Lain', '$_POST[biaya]', 'D', '$_POST[akunbiaya]')", $con_gl);
  				}else{
  					mysql_query("update gl_trans set akun='$_POST[akunbiaya]', total='$_POST[biaya]' where id='$_POST[id_biaya]'", $con_gl);
  				}
  		}
  		if($_POST[akunpajak] <>'' AND $_POST[pajak] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
  			if($_POST[idpajak]=='') {
  					mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Pajak', '$_POST[pajak]', 'D', '$_POST[akunpajak]')", $con_gl);
  			}else{
  				mysql_query("update gl_trans set akun='$_POST[akunpajak]', total='$_POST[pajak]' where id='$_POST[idpajak]'", $con_gl);
  			}
  		}
  		if($_POST[bayar] <> 0) {
 			mysql_select_db($database_con_gl, $con_gl);
  			if($_POST[idbayar]=='') {
  				mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Pembayaran Ke $row_getkpd[nama]', '$_POST[bayar]', 'K', '$_POST[akun]')", $con_gl);
  			}else{
  				mysql_query("update gl_trans set akun='$_POST[akun]', total='$_POST[bayar]' where id='$_POST[idbayar]'", $con_gl);
  			}
  		}
	}else if($act=='shipping'){
		$query = "UPDATE gl_rtrans SET tglkirim='$_POST[kirim]' WHERE no_ref='$_POST[noreferensi]'";
	}else{
	$query = "delete from gl_rtrans where no_ref='$_POST[noreferensi]'";
	$query2 = "delete from gl_trans where no_ref='$_POST[noreferensi]'";
	}
	mysql_select_db($database_con_gl, $con_gl);
	$runquery = mysql_query($query, $con_gl);
	if($query2 <>'') {
		mysql_query($query2, $con_gl);
	}
	if($runquery) {
		echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil ";if($act=='add' OR $act=='edit' OR $act=='shipping') { echo "disimpan";}else{ echo "dihapus"; } echo " ...";
	}else{
		echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
	}
}
?>
<?php if($runquery) { ?><script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script><?php } ?>