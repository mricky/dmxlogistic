<?php require_once('../connections/con_gl.php'); ?>
<?php
$act = $_GET[act];
$url = "index.php?component=sretail";
// -- validasi
if($act <>'delete') { 
	if (trim($_POST['noreferensi']) == '') {
		$error[] = '- No Referensi harus diisi !!!';
	}
	if ((trim($_POST['tanggal']) == '') OR (trim($_POST['jatuhtempo']) == '')) {
		$error[] = '- Tanggal Order harus diisi !!!';
	}
	if (trim($_POST['dari']) == '') {
		$error[] = '- Customer harus dipilih !!!';
	}
	if (trim($_POST['barang']) == '') {
		$error[] = '- Paket Sewa harus dipilih !!!';
	}
	if (trim($_POST['kendaraan']) == '') {
		$error[] = '- Kendaraan harus dipilih !!!';
	}
	if (trim($_POST['transaksi']) == '') {
		$error[] = '- Detail Transaksi harus diisi !!!';
	}
	if ($_POST['ntotal'] <= 0) {
		$error[] = '- Periksa Total Transaksi anda !!!';
	}
}
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	switch($act) {
	case("delete"):
		$query = "delete from gl_rtrans where no_ref='$_POST[noreferensi]'";
		$query2 = "delete from gl_trans where no_ref='$_POST[noreferensi]'";
		// hapus data
		mysql_select_db($database_con_gl, $con_gl);
		$runquery = mysql_query($query, $con_gl);
		if($runquery) { 
			// ---
			mysql_query($query2, $con_gl);
			// ---
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil dihapus ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal dihapus !!!";
		}
	break;
	case("edit"):
		$query ="UPDATE gl_rtrans SET tgl='$_POST[tanggal]', jatuhtempo='$_POST[jatuhtempo]', keterangan='$_POST[keterangan]', jenis='$_POST[jenis]', gudang='$_POST[gudang]', kontak='$_POST[dari]', recipient='$_POST[recipient]', akbiaya='$_POST[akunbiaya]', akpjk='$_POST[akunpajak]', checkin='$_POST[checkin]', waktucheckin='$_POST[waktucheckin]', checkout='$_POST[checkout]', waktucheckout='$_POST[waktucheckout]', supir='$_POST[supir]', bbm='$_POST[bbm]', tol='$_POST[tol]', parkir='$_POST[parkir]', akomod='$_POST[akomodasi]', other='$_POST[other]' WHERE no_ref='$_POST[noreferensi]'";
		//---
		mysql_select_db($database_con_gl, $con_gl);
		$query_getkpd = "SELECT gl_kontak.nama FROM gl_kontak WHERE gl_kontak.id='$_POST[dari]'";
		$getkpd = mysql_query($query_getkpd, $con_gl) or die(mysql_error());
		$row_getkpd = mysql_fetch_assoc($getkpd);
		//--- save piutang
		if($_POST[akunkredit]<>'' AND $_POST[ntotal] > 0) {
  			$nil = $_POST[ntotal];
  			mysql_select_db($database_con_gl, $con_gl);
  			if($_POST[id_hutang]=='') {
  				mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Piutang Penjualan $row_getkpd[nama]', '$_POST[ntotal]', 'D', '$_POST[akunkredit]')", $con_gl);
  			}else{
  				mysql_query("update gl_trans set akun='$_POST[akunkredit]', total='$nil', pos='D' where id='$_POST[id_hutang]'", $con_gl);
  			}
  		}else{
			if($_POST[id_hutang]<>'') {
				mysql_query("delete from gl_trans where id='$_POST[id_hutang]'", $con_gl);
			}
		}
		// --- save biaya
		if($_POST[akunbiaya] <>'' AND $_POST[biaya] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
  				if($_POST[id_biaya]=='') {
  					mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Biaya Lain', '$_POST[biaya]', 'K', '$_POST[akunbiaya]')", $con_gl);
  				}else{
  					mysql_query("update gl_trans set akun='$_POST[akunbiaya]', total='$_POST[biaya]' where id='$_POST[id_biaya]'", $con_gl);
  				}
  		}else{
			if($_POST[id_biaya]<>'') {
				mysql_query("delete from gl_trans where id='$_POST[id_biaya]'", $con_gl);
			}
		}
		// --- save pajak
		if($_POST[akunpajak] <>'' AND $_POST[pajak] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
  			if($_POST[idpajak]=='') {
  					mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Pajak', '$_POST[pajak]', 'K', '$_POST[akunpajak]')", $con_gl);
  			}else{
  				mysql_query("update gl_trans set akun='$_POST[akunpajak]', total='$_POST[pajak]' where id='$_POST[idpajak]'", $con_gl);
  			}
  		}else{
			if($_POST[idpajak]<>'') {
				mysql_query("delete from gl_trans where id='$_POST[idpajak]'", $con_gl);
			}
		}
		// --- edit transaksi
		mysql_select_db($database_con_gl, $con_gl);
		$editquery = "UPDATE gl_trans SET transaksi= '$_POST[transaksi]', total= '$_POST[hargasatuan]', barang= '$_POST[barang]', kendaraan='$_POST[kendaraan]', jumlah= '$_POST[jumlah]', hargasatuan='$_POST[xharga]', diskon='$_POST[diskon]' WHERE id='$_POST[id_transaksi]'";
		mysql_query($editquery, $con_gl);
		//-- save data
		mysql_select_db($database_con_gl, $con_gl);
		$runquery = mysql_query($query, $con_gl);
		if($runquery) { 
			$update_tr = mysql_query("update gl_trans set transaksi='$_POST[transaksi]', total='$_POST[hargasatuan]', hargasatuan='$_POST[xharga]', diskon='$_POST[diskon]', kendaraan='$_POST[kendaraan]' where id='$_POST[id_transaksi]'", $con_gl) or die(mysql_error());
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		}
	break;
	default:
		mysql_select_db($database_con_gl, $con_gl);
		$query_getkpd = "SELECT gl_kontak.nama FROM gl_kontak WHERE gl_kontak.id='$_POST[dari]'";
		$getkpd = mysql_query($query_getkpd, $con_gl) or die(mysql_error());
		$row_getkpd = mysql_fetch_assoc($getkpd);
		// ---
		$query = "INSERT INTO gl_rtrans (no_ref, tgl, keterangan, gudang, kontak, jenis, jatuhtempo, recipient, akbiaya, akpjk, checkin, waktucheckin, checkout, waktucheckout, supir, bbm, tol, parkir, akomod, other) VALUES ('$_POST[noreferensi]', '$_POST[tanggal]', '$_POST[keterangan]', '$_POST[gudang]', '$_POST[dari]', '$_POST[jenis]', '$_POST[jatuhtempo]', '$_POST[recipient]', '$_POST[akunbiaya]', '$_POST[akunpajak]', '$_POST[checkin]', '$_POST[waktucheckin]', '$_POST[checkout]', '$_POST[waktucheckout]', '$_POST[supir]', '$_POST[bbm]', '$_POST[tol]', '$_POST[parkir]', '$_POST[akomodasi]', '$_POST[other]')";
		// insert piutang
		if($_POST[akunkredit]<>'' AND $_POST[ntotal] > 0) {
  			$nil = $_POST[ntotal];
  			mysql_select_db($database_con_gl, $con_gl);
 			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Piutang Penjualan $row_getkpd[nama]', '$nil', 'D', '$_POST[akunkredit]')", $con_gl);
  		}
		// insert biaya
		if($_POST[akunbiaya] <>'' AND $_POST[biaya] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
  			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Biaya Lain', '$_POST[biaya]', 'K', '$_POST[akunbiaya]')", $con_gl);
 		}
		// insert pajak
  		if($_POST[akunpajak] <>'' AND $_POST[pajak] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
 			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Pajak', '$_POST[pajak]', 'K', '$_POST[akunpajak]')", $con_gl);
  		}
		// insert sewa kendaraan
		mysql_select_db($database_con_gl, $con_gl);
		$query_get_ak_sedia = "SELECT gl_kelompok.ak_jual, gl_barang.kelompok FROM gl_kelompok, gl_barang WHERE gl_barang.id='$_POST[barang]'  AND gl_barang.kelompok = gl_kelompok.id";
		$get_ak_sedia = mysql_query($query_get_ak_sedia, $con_gl) or die(mysql_error());
		$row_get_ak_sedia = mysql_fetch_assoc($get_ak_sedia);
		$totalRows_get_ak_sedia = mysql_num_rows($get_ak_sedia);
		// ---
		mysql_select_db($database_con_gl, $con_gl);
		$addquery = "INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun, barang, kendaraan, jumlah, satuan, hargasatuan, diskon) VALUES (NULL, '$_POST[noreferensi]', '$_POST[transaksi]', '$_POST[hargasatuan]', 'K', '$row_get_ak_sedia[ak_jual]', '$_POST[barang]', '$_POST[kendaraan]', '$_POST[jumlah]', '2', '$_POST[xharga]', '$_POST[diskon]')";
		mysql_query($addquery, $con_gl);
		// save data
		mysql_select_db($database_con_gl, $con_gl);
		$runquery = mysql_query($query, $con_gl);
		if($runquery) { 
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		}
	break;
	}
}
?>