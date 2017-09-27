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

/*if (trim($_POST['akun']) == '') {
	$error[] = '- Akun Kas harus dipilih !!!';
}*/
if (trim($_POST['dari']) == '') {
	$error[] = '- Customer harus dipilih !!!';
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
/*if(!is_numeric($_POST[total_dp])) {
	$error [] = '- DP harus angka !!!';
}*/
/*End validasi */
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	if($act =='add') {
	mysql_select_db($database_con_gl, $con_gl);
	$query_getkpd = "SELECT gl_kontak.nama FROM gl_kontak WHERE gl_kontak.id='$_POST[dari]'";
	$getkpd = mysql_query($query_getkpd, $con_gl) or die(mysql_error());
	$row_getkpd = mysql_fetch_assoc($getkpd);

	$query = "INSERT INTO gl_rtrans (no_ref, tgl, keterangan, gudang, kontak, jenis, jatuhtempo, recipient, akbiaya, akpjk, checkin, waktucheckin, checkout, waktucheckout, supir, bbm, tol, parkir, akomod, other) VALUES ('$_POST[noreferensi]', '$_POST[tanggal]', '$_POST[keterangan]', '$_POST[gudang]', '$_POST[dari]', '$_POST[jenis]', '$_POST[jatuhtempo]', '$_POST[recipient]', '$_POST[akunbiaya]', '$_POST[akunpajak]', '$_POST[checkin]', '$_POST[waktucheckin]', '$_POST[checkout]', '$_POST[waktucheckout]', '$_POST[supir]', '$_POST[bbm]', '$_POST[tol]', '$_POST[parkir]', '$_POST[akomodasi]', '$_POST[other]')";
	
		if($_POST[akunkredit]<>'' AND $_POST[ntotal] > 0) {
  			$nil = $_POST[ntotal];
  			mysql_select_db($database_con_gl, $con_gl);
 			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Piutang Penjualan $row_getkpd[nama]', '$nil', 'D', '$_POST[akunkredit]')", $con_gl);
  		}
  		if($_POST[akunbiaya] <>'' AND $_POST[biaya] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
  			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Biaya Lain', '$_POST[biaya]', 'K', '$_POST[akunbiaya]')", $con_gl);
 		}
  		if($_POST[akunpajak] <>'' AND $_POST[pajak] > 0) {
  			mysql_select_db($database_con_gl, $con_gl);
 			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Beban Pajak', '$_POST[pajak]', 'K', '$_POST[akunpajak]')", $con_gl);
  		}
  		if($_POST[akun_dp] <> '' AND is_numeric($_POST[total_dp]) AND $_POST[total_dp] > 0) {
			$vref = explode(",",$_POST[f_kas]);
			$ref_f = $vref[0];
			$ref_cr = str_replace("SJ","CR",$_POST['noreferensi']);
			mysql_select_db($database_con_gl, $con_gl);
			$get_ak_dp = "select akun from gl_trans where no_ref='$ref_f' AND pos='K'";
			$rungetdp = mysql_query($get_ak_dp, $con_gl);
			$rowgetdp = mysql_fetch_assoc($rungetdp);
			
  			mysql_select_db($database_con_gl, $con_gl);
			$xquery = "INSERT INTO gl_rtrans (no_ref, tgl, keterangan, jenis, kontak) VALUES ('$ref_cr', '$_POST[tanggal]', '$_POST[keterangan]', '3', '$_POST[dari]')";
			mysql_query($xquery, $con_gl);
  			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun, tglbayar) VALUES (NULL, '$ref_cr', 'Pembayaran Piutang Usaha', '$_POST[total_dp]', 'D', '$rowgetdp[akun]','$_POST[tanggal]')", $con_gl);
			mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun, x_ref, tglbayar) VALUES (NULL, '$ref_cr', 'Pembayaran $_POST[noreferensi]', '$_POST[total_dp]', 'K', '$_POST[akunkredit]', '$_POST[noreferensi]','$_POST[tanggal]')", $con_gl);
			mysql_query("update gl_trans set tglbayar='$_POST[tanggal]' where no_ref='$ref_f'", $con_gl);
			//mysql_query("delete from gl_rtrans where no_ref='$ref_f'", $con_gl);
			//mysql_query("delete from gl_trans where no_ref='$ref_f'", $con_gl);
  		}
	}else if($act=='edit'){
	$query ="UPDATE gl_rtrans SET tgl='$_POST[tanggal]', jatuhtempo='$_POST[jatuhtempo]', keterangan='$_POST[keterangan]', jenis='$_POST[jenis]', gudang='$_POST[gudang]', kontak='$_POST[dari]', recipient='$_POST[recipient]', akbiaya='$_POST[akunbiaya]', akpjk='$_POST[akunpajak]', checkin='$_POST[checkin]', waktucheckin='$_POST[waktucheckin]', checkout='$_POST[checkout]', waktucheckout='$_POST[waktucheckout]', supir='$_POST[supir]', bbm='$_POST[bbm]', tol='$_POST[tol]', parkir='$_POST[parkir]', akomod='$_POST[akomod]', other='$_POST[other]' WHERE no_ref='$_POST[noreferensi]'";
	
	//mysql_query("update gl_trans set total='$_POST[total_2]', akun='$_POST[akun]' where id='$_POST[id_persediaan]'", $con_gl);
	
	mysql_select_db($database_con_gl, $con_gl);
	$query_getkpd = "SELECT gl_kontak.nama FROM gl_kontak WHERE gl_kontak.id='$_POST[dari]'";
	$getkpd = mysql_query($query_getkpd, $con_gl) or die(mysql_error());
	$row_getkpd = mysql_fetch_assoc($getkpd);
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
  		if($_POST[bayar] <> 0) {
 			mysql_select_db($database_con_gl, $con_gl);
  			if($_POST[idbayar]=='') {
  				mysql_query("INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun) VALUES (NULL, '$_POST[noreferensi]', 'Pembayaran dari $row_getkpd[nama]', '$_POST[bayar]', 'D', '$_POST[akun]')", $con_gl);
  			}else{
  				mysql_query("update gl_trans set akun='$_POST[akun]', total='$_POST[bayar]' where id='$_POST[idbayar]'", $con_gl);
  			}
  		}else{
			if($_POST[idbayar]<>'') {
				mysql_query("delete from gl_trans where id='$_POST[idbayar]'", $con_gl);
			}
		}
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
		echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil ";if($act=='add' OR $act=='edit') { echo "disimpan";}else{ echo "dihapus"; } echo " ...";
	}else{
		echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
	}
}
?>
<?php if($runquery) { ?><script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script><?php } ?>