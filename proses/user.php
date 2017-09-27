<?php require_once('../connections/con_gl.php'); ?>

<?php

mysql_select_db($database_con_gl, $con_gl);

$query_cekpk = "SELECT gl_admin.username FROM gl_admin WHERE gl_admin.username='$_POST[username]'";

$cekpk = mysql_query($query_cekpk, $con_gl) or die(mysql_error());

$row_cekpk = mysql_fetch_assoc($cekpk);

$totalRows_cekpk = mysql_num_rows($cekpk);



$act = $_GET[act];

$url = "index.php?component=user";

$akses = $_POST[user_1].$_POST[user_2].$_POST[user_3].$_POST[user_4].$_POST[user_5].$_POST[periode_1].$_POST[periode_2].$_POST[periode_3].$_POST[periode_4].$_POST[klasifikasi_1].$_POST[klasifikasi_2].$_POST[klasifikasi_3].$_POST[klasifikasi_4].$_POST[periode].$_POST[info].$_POST[akun_1].$_POST[akun_2].$_POST[akun_3].$_POST[akun_4].$_POST[kontak_1].$_POST[kontak_2].$_POST[kontak_3].$_POST[kontak_4].$_POST[golaset_1].$_POST[golaset_2].$_POST[golaset_3].$_POST[golaset_4].$_POST[atp_1].$_POST[atp_2].$_POST[atp_3].$_POST[atp_4].$_POST[penyusutan_1].$_POST[penyusutan_2].$_POST[penyusutan_3].$_POST[penyusutan_4].$_POST[transaksi_1].$_POST[transaksi_2].$_POST[transaksi_3].$_POST[transaksi_4].$_POST[jservice_1].$_POST[jservice_2].$_POST[jservice_3].$_POST[jservice_4].$_POST[service_1].$_POST[service_2].$_POST[service_3].$_POST[service_4].$_POST[cretail_1].$_POST[cretail_2].$_POST[cretail_3].$_POST[cretail_4].$_POST[ccorporate_1].$_POST[ccorporate_2].$_POST[ccorporate_3].$_POST[ccorporate_4].$_POST[sretail_1].$_POST[sretail_2].$_POST[sretail_3].$_POST[sretail_4].$_POST[transfer_1].$_POST[transfer_2].$_POST[transfer_3].$_POST[transfer_4].$_POST[kasmasuk_1].$_POST[kasmasuk_2].$_POST[kasmasuk_3].$_POST[kasmasuk_4].$_POST[kaskeluar_1].$_POST[kaskeluar_2].$_POST[kaskeluar_3].$_POST[kaskeluar_4].$_POST[persediaan_1].$_POST[persediaan_2].$_POST[persediaan_3].$_POST[persediaan_4].$_POST[stokopname].$_POST[barang_1].$_POST[barang_2].$_POST[barang_3].$_POST[barang_4].$_POST[kelompok_1].$_POST[kelompok_2].$_POST[kelompok_3].$_POST[kelompok_4].$_POST[satuan_1].$_POST[satuan_2].$_POST[satuan_3].$_POST[satuan_4].$_POST[kartustok].$_POST[gudang_1].$_POST[gudang_2].$_POST[gudang_3].$_POST[gudang_4].$_POST[purchase_1].$_POST[purchase_2].$_POST[purchase_3].$_POST[purchase_4].$_POST[pengiriman_pb].$_POST[retur_pb_1].$_POST[retur_pb_2].$_POST[retur_pb_3].$_POST[retur_pb_4].$_POST[pembayaranhutang_1].$_POST[pembayaranhutang_2].$_POST[pembayaranhutang_3].$_POST[pembayaranhutang_4].$_POST[kartuhutang].$_POST[sales_1].$_POST[sales_2].$_POST[sales_3].$_POST[sales_4].$_POST[pengiriman_pj].$_POST[retur_pj_1].$_POST[retur_pj_2].$_POST[retur_pj_3].$_POST[retur_pj_4].$_POST[pembayaranpiutang_1].$_POST[pembayaranpiutang_2].$_POST[pembayaranpiutang_3].$_POST[pembayaranpiutang_4].$_POST[kartupiutang].$_POST[rugilaba].$_POST[t_harian].$_POST[neraca].$_POST[jurnal].$_POST[aruskas].$_POST[bukubesar].$_POST[r_penjualan].$_POST[hutangusaha].$_POST[piutangusaha].$_POST[r_iklan].$_POST[rekap_retur].$_POST[mkservice_1].$_POST[mkservice_2].$_POST[mkservice_3].$_POST[mkservice_4].$_POST[jkservice_1].$_POST[jkservice_2].$_POST[jkservice_3].$_POST[jkservice_4].$_POST[phservice_1].$_POST[phservice_2].$_POST[phservice_3].$_POST[phservice_4].$_POST[jbservice_1].$_POST[jbservice_2].$_POST[jbservice_3].$_POST[jbservice_4].$_POST[skservice_1].$_POST[skservice_2].$_POST[skservice_3].$_POST[skservice_4].$_POST[jaccident_1].$_POST[jaccident_2].$_POST[jaccident_3].$_POST[jaccident_4].$_POST[unitkerja_1].$_POST[unitkerja_2].$_POST[unitkerja_3].$_POST[unitkerja_4].$_POST[jenisasuransi_1].$_POST[jenisasuransi_2].$_POST[jenisasuransi_3].$_POST[jenisasuransi_4].$_POST[rekasuransi_1].$_POST[rekasuransi_2].$_POST[rekasuransi_3].$_POST[rekasuransi_4].$_POST[rekbengkel_1].$_POST[rekbengkel_2].$_POST[rekbengkel_3].$_POST[rekbengkel_4].$_POST[reksupplier_1].$_POST[reksupplier_2].$_POST[reksupplier_3].$_POST[reksupplier_4].$_POST[extendstnk_1].$_POST[extendstnk_2].$_POST[extendstnk_3].$_POST[extendstnk_4].$_POST[extendpolis_1].$_POST[extendpolis_2].$_POST[extendpolis_3].$_POST[extendpolis_4].$_POST[extendkir_1].$_POST[extendkir_2].$_POST[extendkir_3].$_POST[extendkir_4].$_POST[mutasi_1].$_POST[mutasi_2].$_POST[mutasi_3].$_POST[mutasi_4].$_POST[replace_1].$_POST[replace_2].$_POST[replace_3].$_POST[replace_4].$_POST[skontrak_1].$_POST[skontrak_2].$_POST[skontrak_3].$_POST[skontrak_4].$_POST[ikontrak_1].$_POST[ikontrak_2].$_POST[ikontrak_3].$_POST[ikontrak_4].$_POST[area_1].$_POST[area_2].$_POST[area_3].$_POST[area_4].$_POST[checkoutin_1].$_POST[checkoutin_2].$_POST[checkoutin_3].$_POST[checkoutin_4].$_POST[accident_1].$_POST[accident_2].$_POST[accident_3].$_POST[accident_4].$_POST[kasir_1].$_POST[kasir_2].$_POST[kasir_3].$_POST[kasir_4].$_POST[do_1].$_POST[do_2].$_POST[do_3].$_POST[do_4].$_POST; 



/* Validasi */

if (trim($_POST['username']) == '') {

	$error[] = '- Username harus diisi !!!';

}

if($act=='add' AND $totalRows_cekpk > 0) {

	$error[] = '- Username sudah digunakan !!!';

}

if (trim($_POST['password']) == '') {

	$error[] = '- Password harus diisi !!!';

}

if (trim($akses) == '') {

	$error[] = '- Akses harus dicheck min 1 !!!';

}

/*End validasi */

if (isset($error)) {

	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);

}else{

	$pass = simple_encrypt($_POST['password']);
	if($act =='add') {

	echo $query = "INSERT INTO gl_admin (id, username, password, link, akses) VALUES (NULL, '$_POST[username]', '$pass', '$_POST[karyawan]', '$akses')"; 

	}else if($act=='edit'){

	$query ="UPDATE gl_admin SET username='$_POST[username]', link='$_POST[karyawan]', akses='$akses'";

	if($_POST['g_pass']=='1') {

		$query .= ", password='$pass'";	
	}
	$query .=" WHERE id='$_POST[id]'";

	}else{

	$query = "delete from gl_admin where id='$_POST[id]'";

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