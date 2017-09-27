<?php require_once('../connections/con_gl.php'); ?>

<?php

$sat = $_GET[satuan];

$brg = $_GET[barang];

$ken = $_GET[kendaraan];

$gud = $_GET[gudang];

$jum = $_GET[jumlah];

$hrgsat = $_GET[hargasatuan];

$nref = $_GET['noreferensi'];

$trans = $_GET['transaksi'];

$diskon = $_GET[diskon];

//$nilai = intval($_GET['nilai']);

$total = $_GET['total'];

$ak = $_GET['akun'];

$rul = $_GET['rules'];

$id_x = $_GET['refid'];

$agen = $_GET[agen];

$tnilai = 0;

$task = $_GET[task];



mysql_select_db($database_con_gl, $con_gl);

$query_fkas = "select gl_rtrans.no_ref, gl_trans.transaksi, sum(gl_trans.total) as total from gl_trans, gl_rtrans where gl_rtrans.kontak='$agen' AND gl_rtrans.no_ref = gl_trans.no_ref AND (gl_rtrans.no_ref LIKE '%%TH%%' OR gl_rtrans.no_ref LIKE '%%CR%%' OR gl_rtrans.no_ref LIKE '%%TRF%%') AND gl_trans.pos='K' AND gl_trans.tglbayar is NULL group by gl_rtrans.no_ref desc";

$fkas = mysql_query($query_fkas, $con_gl) or die(mysql_error());

$row_fkas = mysql_fetch_assoc($fkas);

$totalRows_fkas = mysql_num_rows($fkas);

//echo $query_fkas;

mysql_select_db($database_con_gl, $con_gl);

$query_klaskas = "SELECT kd, klasifikasi FROM gl_klas WHERE tipe = 2 ORDER BY kd,klasifikasi ASC";

$klaskas = mysql_query($query_klaskas, $con_gl) or die(mysql_error());

$row_klaskas = mysql_fetch_assoc($klaskas);

$totalRows_klaskas = mysql_num_rows($klaskas);



mysql_select_db($database_con_gl, $con_gl);

$query_cek_brg = "SELECT gl_barang.id, gl_kelompok.jenis FROM gl_barang, gl_kelompok WHERE gl_barang.id='$brg' AND gl_kelompok.id=gl_barang.kelompok AND gl_kelompok.jenis=2";

$cek_brg = mysql_query($query_cek_brg, $con_gl) or die(mysql_error());

$row_cek_brg = mysql_fetch_assoc($cek_brg);

$totalRows_cek_brg = mysql_num_rows($cek_brg);



mysql_select_db($database_con_gl, $con_gl);

$query_klas = "SELECT kd, klasifikasi, keterangan, neraca, ruglab tipe FROM gl_klas ORDER BY kd,klasifikasi ASC";

$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());

$row_klas = mysql_fetch_assoc($klas);

$totalRows_klas = mysql_num_rows($klas);



mysql_select_db($database_con_gl, $con_gl);

$query_getidh = "SELECT gl_trans.id, gl_trans.akun, gl_trans.total FROM gl_trans WHERE gl_trans.no_ref='$_REQUEST[noreferensi]' AND gl_trans.transaksi='Hutang Pembelian pada Kas'";

$getidh = mysql_query($query_getidh, $con_gl) or die(mysql_error());

$row_getidh = mysql_fetch_assoc($getidh);

$totalRows_getidh = mysql_num_rows($getidh);



mysql_select_db($database_con_gl, $con_gl);

$query_satuan = "SELECT id, satuan FROM gl_satuan ORDER BY satuan ASC";

$satuan = mysql_query($query_satuan, $con_gl) or die(mysql_error());

$row_satuan = mysql_fetch_assoc($satuan);

$totalRows_satuan = mysql_num_rows($satuan);



mysql_select_db($database_con_gl, $con_gl);

$query_kelom = "SELECT id, kelompok FROM gl_kelompok WHERE jual = 1 ORDER BY kelompok ASC";

$kelom = mysql_query($query_kelom, $con_gl) or die(mysql_error());

$row_kelom = mysql_fetch_assoc($kelom);

$totalRows_kelom = mysql_num_rows($kelom);



if($rul =='Hapus') {

	mysql_select_db($database_con_gl, $con_gl);

	$query_xtrans = "SELECT gl_trans.no_ref, gl_trans.barang, gl_trans.jumlah, gl_trans.satuan, gl_trans.akun FROM gl_trans WHERE gl_trans.id='$_GET[value]'";

	$xtrans = mysql_query($query_xtrans, $con_gl) or die(mysql_error());

	$row_xtrans = mysql_fetch_assoc($xtrans);

	$totalRows_xtrans = mysql_num_rows($xtrans);

	

	mysql_select_db($database_con_gl, $con_gl);

	$query_g_gud = "SELECT no_ref, gudang FROM gl_rtrans where no_ref='$row_xtrans[no_ref]'";

	$g_gud = mysql_query($query_g_gud, $con_gl) or die(mysql_error());

	$row_g_gud = mysql_fetch_assoc($g_gud);

	$totalRows_g_gud = mysql_num_rows($g_gud);

	

	mysql_select_db($database_con_gl, $con_gl);

	$query_cekopname = "select * from gl_stok where gudang='$gud' AND barang='$row_xtrans[barang]' AND satuan='$row_xtrans[satuan]'";

	$cekopname = mysql_query($query_cekopname, $con_gl) or die(mysql_error());

	$row_cekopname = mysql_fetch_assoc($cekopname);

	$totalRows_cekopname = mysql_num_rows($cekopname);

	

	$stoknow = intval($row_cekopname['stok']) + $row_xtrans['jumlah'];

	mysql_select_db($database_con_gl, $con_gl);

	//if($totalRows_cek_brg == 0) {

	$weks = "update gl_stok set stok='$stoknow' where id ='$row_cekopname[id]'";

	mysql_query($weks, $con_gl);

	//echo $query_xtrans."<br/>".$query_cekopname."<br/>".$weks;

	//}

	mysql_query("delete from gl_trans where id='$_GET[value]'", $con_gl);

}



if($nref <>'' AND $brg <>'' AND $sat <>'' AND $gud <>'' AND (is_numeric($jum) AND $jum > 0) AND (is_numeric($total) AND $total > 0) AND (is_numeric($hrgsat) AND $hrgsat > 0) AND $trans <>'') {

	if($rul=='Tambah') {

	/*mysql_select_db($database_con_gl, $con_gl);

	$query_cek_rtr = "SELECT no_ref FROM gl_rtrans where no_ref='$nref'";

	$cek_rtr = mysql_query($query_cek_rtr, $con_gl) or die(mysql_error());

	$row_cek_rtr = mysql_fetch_assoc($cek_rtr);

	$totalRows_cek_rtr = mysql_num_rows($cek_rtr);

*/

	mysql_select_db($database_con_gl, $con_gl);

	$query_get_ak_sedia = "SELECT gl_kelompok.ak_jual, gl_barang.kelompok FROM gl_kelompok, gl_barang WHERE gl_barang.id='$brg'  AND gl_barang.kelompok = gl_kelompok.id";

	$get_ak_sedia = mysql_query($query_get_ak_sedia, $con_gl) or die(mysql_error());

	$row_get_ak_sedia = mysql_fetch_assoc($get_ak_sedia);

	$totalRows_get_ak_sedia = mysql_num_rows($get_ak_sedia);

 	mysql_select_db($database_con_gl, $con_gl);

  	$addquery = "INSERT INTO gl_trans (id, no_ref, transaksi, total, pos, akun, barang, kendaraan, jumlah, satuan, hargasatuan, diskon) VALUES (NULL, '$nref', '$trans', '$total', 'K', '$row_get_ak_sedia[ak_jual]', '$brg', '$ken', '$jum', '$sat', '$hrgsat', '$diskon')";

	mysql_query($addquery, $con_gl);

	

	$query_stockcek = "SELECT gl_stok.id, gl_stok.stok FROM gl_stok WHERE gl_stok.gudang='$gud' AND gl_stok.barang='$brg' AND gl_stok.satuan='$sat'";

	$stockcek = mysql_query($query_stockcek, $con_gl) or die(mysql_error());

	$row_stockcek = mysql_fetch_assoc($stockcek);

	$totalRows_stockcek = mysql_num_rows($stockcek);

		if($totalRows_stockcek > 0) {

			$stoknow = $row_stockcek['stok'] - $jum;

			$stokquery = "update gl_stok set stok='$stoknow' where id='$row_stockcek[id]'";

		}else{

			$stoknow = 0 - $jum;

			$stokquery = "INSERT INTO gl_stok (id, gudang, barang, satuan, stok) VALUES (NULL, '$gud', '$brg', '$sat', '$stoknow')";

		}

		mysql_select_db($database_con_gl, $con_gl);

		mysql_query($stokquery, $con_gl);

		//echo $stokquery;

	}else if($rul =='Simpan') {

	mysql_select_db($database_con_gl, $con_gl);

	$query_xtrans = "SELECT gl_trans.no_ref, gl_trans.barang, gl_trans.jumlah, gl_trans.satuan, gl_trans.akun FROM gl_trans WHERE gl_trans.id='$_GET[value]'";

	$xtrans = mysql_query($query_xtrans, $con_gl) or die(mysql_error());

	$row_xtrans = mysql_fetch_assoc($xtrans);

	$totalRows_xtrans = mysql_num_rows($xtrans);

	

	mysql_select_db($database_con_gl, $con_gl);

	$query_g_gud = "SELECT no_ref, gudang FROM gl_rtrans where no_ref='$row_xtrans[no_ref]'";

	$g_gud = mysql_query($query_g_gud, $con_gl) or die(mysql_error());

	$row_g_gud = mysql_fetch_assoc($g_gud);

	$totalRows_g_gud = mysql_num_rows($g_gud);

	//if($totalRows_cek_brg == 0) {

	mysql_select_db($database_con_gl, $con_gl);

	$query_cekopname = "select * from gl_stok where gudang='$gud' AND barang='$row_xtrans[barang]' AND satuan='$row_xtrans[satuan]'";

	$cekopname = mysql_query($query_cekopname, $con_gl) or die(mysql_error());

	$row_cekopname = mysql_fetch_assoc($cekopname);

	$totalRows_cekopname = mysql_num_rows($cekopname);

		if($gud == $row_cekopname['gudang'] AND $brg == $row_cekopname['barang'] AND $sat == $row_cekopname['satuan']) {

			$stoknow = ($row_cekopname['stok'] + $row_xtrans['jumlah']) - $jum;

			mysql_select_db($database_con_gl, $con_gl);

			// update stok

			$wew = "update gl_stok set stok='$stoknow' where id ='$row_cekopname[id]'";

			mysql_query($wew, $con_gl);

		}else{

			$stoknow = $row_cekopname['stok'] + $row_xtrans['jumlah'];

			mysql_query("update gl_stok set stok='$stoknow' where id ='$row_cekopname[id]'", $con_gl);

			

			mysql_select_db($database_con_gl, $con_gl);

			$cek_stok = mysql_query("select * from gl_stok where gudang='$gud' AND barang='$brg' AND satuan='$sat'", $con_gl);

			$rowcek_stok = mysql_num_rows($cek_stok);

			$totalcek_stok = mysql_num_rows($cek_stok);

			if($totalcek_stok == 0) {

				mysql_query("INSERT INTO gl_stok (id, gudang, barang, satuan, stok) VALUES (NULL, '$gud', '$brg', '$sat', '$jum')", $con_gl);

			}else{

				// update stok

				$stoknow = $row_cekopname['stok'] - $row_xtrans['jumlah'];

				mysql_query("update gl_stok set stok='$stoknow' where id ='$rowcek_stok[id]'", $con_gl);

			}

		}

	//}

	mysql_select_db($database_con_gl, $con_gl);

	$editquery = "UPDATE gl_trans SET transaksi= '$trans', total= '$total', barang= '$brg', kendaraan='$ken', jumlah= '$jum', satuan= '$sat', hargasatuan='$hrgsat', diskon='$diskon' WHERE id='$_GET[value]'";

	mysql_query($editquery, $con_gl);

	}

}

mysql_select_db($database_con_gl, $con_gl);

$query_tr = "SELECT gl_trans.id, gl_trans.total, gl_trans.jumlah, gl_trans.hargasatuan, gl_trans.transaksi, gl_trans.diskon, gl_akun.akun, gl_akun.id as akun_id, gl_barang.id as brg_id, gl_barang.barang, gl_trans.kendaraan, gl_satuan.satuan FROM gl_trans, gl_akun, gl_barang, gl_satuan WHERE gl_akun.id = gl_trans.akun AND gl_barang.id = gl_trans.barang AND gl_satuan.id = gl_trans.satuan AND gl_trans.no_ref='$nref' AND gl_trans.pos='K' ORDER BY gl_trans.id desc";

$tr = mysql_query($query_tr, $con_gl) or die(mysql_error());

$row_tr = mysql_fetch_assoc($tr);

$totalRows_tr = mysql_num_rows($tr);



mysql_select_db($database_con_gl, $con_gl);

$query_klasbeban = "SELECT * FROM gl_klas WHERE gl_klas.tipe=10";

$klasbeban = mysql_query($query_klasbeban, $con_gl) or die(mysql_error());

$row_klasbeban = mysql_fetch_assoc($klasbeban);

$totalRows_klasbeban = mysql_num_rows($klasbeban);



mysql_select_db($database_con_gl, $con_gl);

$query_klasbeban2 = "SELECT * FROM gl_klas WHERE gl_klas.tipe=9";

$klasbeban2 = mysql_query($query_klasbeban2, $con_gl) or die(mysql_error());

$row_klasbeban2 = mysql_fetch_assoc($klasbeban2);

$totalRows_klasbeban2 = mysql_num_rows($klasbeban2);



mysql_select_db($database_con_gl, $con_gl);

$query_klaskas = "SELECT * FROM gl_klas WHERE gl_klas.tipe=2";

$klaskas = mysql_query($query_klaskas, $con_gl) or die(mysql_error());

$row_klaskas = mysql_fetch_assoc($klaskas);

$totalRows_klaskas = mysql_num_rows($klaskas);



mysql_select_db($database_con_gl, $con_gl);

$query_salesmen = "SELECT gl_kontak.id, gl_kontak.nama FROM gl_kontak WHERE gl_kontak.type='Karyawan' AND tkaryawan='sales' AND aktif='1' order by nama";

$salesmen = mysql_query($query_salesmen, $con_gl) or die(mysql_error());

$row_salesmen = mysql_fetch_assoc($salesmen);

$totalRows_salesmen = mysql_num_rows($salesmen);



mysql_select_db($database_con_gl, $con_gl);

$query_def_ak = "SELECT gl_company.a_kas, gl_company.a_beb, gl_company.a_paj FROM gl_company";

$def_ak = mysql_query($query_def_ak, $con_gl) or die(mysql_error());

$row_def_ak = mysql_fetch_assoc($def_ak);

$totalRows_def_ak = mysql_num_rows($def_ak);

// get biaya operasional

$query_operasi = "select sum(supir) as t_supir, sum(bbm) as t_bbm, sum(tol) as t_tol, sum(parkir) as t_parkir, sum(akomod) as t_akomod, sum(other) as t_other from gl_jenbar where ";

//---

?>

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">

  <?php if(($nref =='' OR $brg=='' OR $sat=='' OR $gud=='' OR (!is_numeric($jum) AND $jum <= 0) OR (!is_numeric($total) AND $total <= 0) OR (!is_numeric($hrgsat) AND $hrgsat <= 0) OR $trans=='') AND $rul <>'Hapus') { ?>

  <tr>

    <th width="42%" align="center"><strong>Barang - Kendaraan</strong></th>

    <th width="5%" align="center"><strong>Satuan</strong></th>

    <th width="5%" align="center"><strong>Jumlah</strong></th>

    <th width="8%" align="center"><strong>Harga Satuan </strong></th>

    <th width="5%" align="center"><strong>Diskon</strong></th>

    <th width="6%" align="center"><strong>Total</strong></th>

    <th align="center"><strong>Transaksi</strong></th>

    <th width="6%" align="center"><strong>Aksi</strong></th>

  </tr>

  <tr>

    <td align="center" style="color:#FF0000;font-size:10px;"><?php if(!$run_query AND $brg=='') { ?>

        <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Pilih Barang -

      <?php }else{ ?>

        <img src="images/ok.png" width="24" height="24"/>

        <?php } ?></td>

    <td align="center" style="color:#FF0000;font-size:10px;"><?php if(!$run_query AND $brg=='') { ?>

        <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Pilih

      <?php }else{ ?>

        <img src="images/ok.png" width="24" height="24"/>

        <?php } ?></td>

    <td align="center" style="color:#FF0000;font-size:10px;"><?php if(!$run_query AND (!is_numeric($jum) OR $jum <= 0)) { ?>

        <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Angka

      <?php }else{ ?>

        <img src="images/ok.png" width="24" height="24"/>

        <?php } ?></td>

    <td align="center" style="color:#FF0000;font-size:10px;"><?php if(!$run_query AND (!is_numeric($hrgsat) OR $hrgsat <= 0)) { ?>

        <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Angka

      <?php }else{ ?>

        <img src="images/ok.png" width="24" height="24"/>

        <?php } ?></td>

    <td align="center" style="color:#FF0000;font-size:10px;"><?php if(!$run_query AND (!is_numeric($diskon))) { ?>

        <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Angka

      <?php }else{ ?>

        <img src="images/ok.png" width="24" height="24"/>

        <?php } ?></td>

    <td align="center" style="color:#FF0000;font-size:10px;"><?php if(!$run_query AND (!is_numeric($total) OR $total <= 0)) { ?>

        <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Angka

      <?php }else{ ?>

        <img src="images/ok.png" width="24" height="24"/>

        <?php } ?></td>

    <td align="center" valign="top" style="color:#FF0000;font-size:10px;"><?php if($trans=='') { ?>

        <img src="images/alert2.png" width="24" height="24" border="0" align="absmiddle" /> Diisi

      <?php }else{ ?>

        <img src="images/ok.png" width="24" height="24" />

        <?php } ?></td>

    <td align="center" style="color:#FF0000;">&nbsp;</td>

  </tr>

  <?php } ?>

  <?php if($totalRows_tr > 0) { ?>

  <tr>

    <th align="center"><strong>Barang </strong></th>

    <th align="center"><strong>Satuan</strong></th>

    <th align="center"><strong>Jumlah</strong></th>

    <th align="center"><strong>Harga Satuan </strong></th>

    <th align="center"><strong>Diskon</strong></th>

    <th align="center"><strong>Total</strong></th>

    <th align="center"><strong>Transaksi</strong></th>

    <th align="center"><strong>Aksi</strong></th>

  </tr>

  <?php $ib=1; $ntotal = 0; do { ?>

  <?php
  // cek kendaraan

  if($row_tr['kendaraan']<>'') { 

  	// --- get kendaraan

	mysql_select_db($database_con_gl, $con_gl);

	$query_kend = "select a.id, a.jenis, b.nopol, b.tipe from gl_jkendaraan a ,gl_kendaraan b where a.id = b.jenis AND b.nopol='$row_tr[kendaraan]' order by a.jenis, b.nopol";

	$kend       = mysql_query($query_kend, $con_gl) or die(mysql_error());

	$row_kend   = mysql_fetch_assoc($kend);

	$total_kend = mysql_num_rows($kend);

	// ---

  }
  $query_operasi .= "(jenis='$row_kend[id]' AND barang='$row_tr[brg_id]')";

  if($ib < $totalRows_tr) {

		$query_operasi .= " OR ";	

	}

	$ib++;
  ?>

    <tr valign="top" bgcolor="#FFFFFF">

      <td align="center" ><?php echo $row_tr['barang']; ?><?php if($row_tr['kendaraan']<>'') { ?> <?php echo $row_kend['jenis'];?>-<?php echo $row_kend['tipe'];?> ( <?php echo $row_kend['nopol'];?> )<?php } ?></td>

      <td align="center" ><?php echo $row_tr['satuan']; ?></td>

      <td align="center" ><?php echo $row_tr['jumlah']; ?></td>

      <td align="right" ><?php echo number_format($row_tr['hargasatuan'],0,',','.').",-"; ?></td>

      <td align="center" ><?php echo $row_tr['diskon'];?>%</td>

      <td align="right" ><?php echo number_format($row_tr['total'],0,',','.').",-"; $ntotal += $row_tr['total'];?></td>

      <td align="center" ><?php echo $row_tr['transaksi']; ?></td>

      <td align="center" ><label>

        <button value="Edit" onclick="ajaxEditFormPenjualan(<?php echo $row_tr['id']; ?>);" type="button" class="editbutton" title="Edit Transaksi">&nbsp;</button>

      </label> <label>

                  <input name="hapus" type="button" id="hapus" value="&nbsp;" onclick="ajaxManagePenjualan('Hapus',<?php echo $row_tr['id']; ?>);" title="Hapus Transaksi" class="deletebutton"/>

      </label></td>

    </tr>

  <?php } while ($row_tr = mysql_fetch_assoc($tr)); ?>

  <?php

  // get biaya operasional
  $operasi = mysql_query($query_operasi, $con_gl) or die(mysql_error());

  $row_operasi = mysql_fetch_assoc($operasi);

  //echo $query_operasi;

  $subtotal_biaya = intval($row_operasi['t_supir'] + $row_operasi['t_bbm'] + $row_operasi['t_tol'] + $row_operasi['t_parkir'] + $row_operasi['t_akomod'] + $row_operasi['t_other']);

  ?>

  <tr valign="top">

    <td height="33" align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Sub Total  : </td>

    <td align="right" bgcolor="#FFFFFF" ><label>

      <input name="xntotal" type="text" id="xntotal" value="<?php echo intval($ntotal);?>" size="10" maxlength="10" onfocus="this.blur();"/>

    </label></td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Biaya Jasa Supir :</td>

    <td align="right" bgcolor="#FFFFFF" ><label>

      <input name="supir" type="text" id="supir" value="<?php echo intval($row_operasi['t_supir']);?>" size="10" maxlength="10" onchange="javascript:this.form.biaya.value = (2*this.form.supir.value) - this.form.supir.value + (2*this.form.bbm.value) - this.form.bbm.value + (2*this.form.tol.value) - this.form.tol.value + (2*this.form.parkir.value) - this.form.parkir.value + (2*this.form.akomodasi.value) - this.form.akomodasi.value + (2*this.form.other.value) - this.form.other.value"/>

    </label></td>

    <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Biaya BBM :</td>

    <td align="right" bgcolor="#FFFFFF" ><label>

      <input name="bbm" type="text" id="bbm" value="<?php echo intval($row_operasi['t_bbm']);?>" size="10" maxlength="10" onchange="javascript:this.form.biaya.value = (2*this.form.supir.value) - this.form.supir.value + (2*this.form.bbm.value) - this.form.bbm.value + (2*this.form.tol.value) - this.form.tol.value + (2*this.form.parkir.value) - this.form.parkir.value + (2*this.form.akomodasi.value) - this.form.akomodasi.value + (2*this.form.other.value) - this.form.other.value"/>

    </label></td>

    <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Biaya Tol :</td>

    <td align="right" bgcolor="#FFFFFF" ><label>

      <input name="tol" type="text" id="tol" value="<?php echo intval($row_operasi['t_tol']);?>" size="10" maxlength="10" onchange="javascript:this.form.biaya.value = (2*this.form.supir.value) - this.form.supir.value + (2*this.form.bbm.value) - this.form.bbm.value + (2*this.form.tol.value) - this.form.tol.value + (2*this.form.parkir.value) - this.form.parkir.value + (2*this.form.akomodasi.value) - this.form.akomodasi.value + (2*this.form.other.value) - this.form.other.value"/>

    </label></td>

    <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Biaya Parkir :</td>

    <td align="right" bgcolor="#FFFFFF" ><label>

      <input name="parkir" type="text" id="parkir" value="<?php echo intval($row_operasi['t_parkir']);?>" size="10" maxlength="10" onchange="javascript:this.form.biaya.value = (2*this.form.supir.value) - this.form.supir.value + (2*this.form.bbm.value) - this.form.bbm.value + (2*this.form.tol.value) - this.form.tol.value + (2*this.form.parkir.value) - this.form.parkir.value + (2*this.form.akomodasi.value) - this.form.akomodasi.value + (2*this.form.other.value) - this.form.other.value"/>

    </label></td>

    <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Biaya Akomodasi :</td>

    <td align="right" bgcolor="#FFFFFF" ><label>

      <input name="akomodasi" type="text" id="akomodasi" value="<?php echo intval($row_operasi['t_akomod']);?>" size="10" maxlength="10" onchange="javascript:this.form.biaya.value = (2*this.form.supir.value) - this.form.supir.value + (2*this.form.bbm.value) - this.form.bbm.value + (2*this.form.tol.value) - this.form.tol.value + (2*this.form.parkir.value) - this.form.parkir.value + (2*this.form.akomodasi.value) - this.form.akomodasi.value + (2*this.form.other.value) - this.form.other.value"/>

    </label></td>

    <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Biaya Lainnya :</td>

    <td align="right" bgcolor="#FFFFFF" ><label>

      <input name="other" type="text" id="other" value="<?php echo intval($row_operasi['t_other']);?>" size="10" maxlength="10" onchange="javascript:this.form.biaya.value = (2*this.form.supir.value) - this.form.supir.value + (2*this.form.bbm.value) - this.form.bbm.value + (2*this.form.tol.value) - this.form.tol.value + (2*this.form.parkir.value) - this.form.parkir.value + (2*this.form.akomodasi.value) - this.form.akomodasi.value + (2*this.form.other.value) - this.form.other.value"/>

    </label></td>

    <td align="left" bgcolor="#FFFFFF" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Total Biaya : </td>

    <td align="right" bgcolor="#FFFFFF" ><label>

      <input name="biaya" type="text" id="biaya" value="<?php echo $subtotal_biaya;?>" size="10" maxlength="10" onchange="javascript:this.form.ntotal.value = (2*this.form.xntotal.value) - this.form.xntotal.value + (2*this.form.biaya.value) - this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;this.form.saldohutang.value=(2*this.form.xntotal.value) - this.form.xntotal.value + (2*this.form.biaya.value) - this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;"/>

    </label></td>

    <td align="left" bgcolor="#FFFFFF" ><label>

      <select name="akunbiaya" id="akunbiaya">

        <?php

do {  

?>

        <?php

mysql_select_db($database_con_gl, $con_gl);

$query_akun = "SELECT id, akun, klasifikasi, keterangan FROM gl_akun where klasifikasi = '$row_klasbeban[kd]' ORDER BY id,akun ASC";

$akun = mysql_query($query_akun, $con_gl) or die(mysql_error());

$row_akun = mysql_fetch_assoc($akun);

$totalRows_akun = mysql_num_rows($akun);

?>

        <option value="" style="background:#EEEEEE; font-weight:bold;"><?php echo $row_klasbeban['klasifikasi'];?></option>

        <?php do { ?>

        <option value="<?php echo $row_akun['id']?>" <?php if($row_def_ak['a_beb']==$row_akun['id']) { ?>selected="selected"<?php } ?>>-<?php echo $row_akun['akun']?></option>

        <?php } while ($row_akun = mysql_fetch_assoc($akun));?>

        <?php

} while ($row_klasbeban = mysql_fetch_assoc($klasbeban));

  $rows = mysql_num_rows($klasbeban);

  if($rows > 0) {

      mysql_data_seek($klasbeban, 0);

	  $row_klasbeban = mysql_fetch_assoc($klasbeban);

  }

?>

      </select>

    </label></td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Pajak :</td>

    <td align="right" bgcolor="#FFFFFF" ><input name="bobot" type="text" id="bobot" value="0" size="10" maxlength="10" onchange="javascript:if(this.value &lt; 100) { this.form.pajak.value = (this.form.xntotal.value * this.value) / 100;this.form.ntotal.value = (2*this.form.xntotal.value) - this.form.xntotal.value + (2*this.form.biaya.value) - this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;this.form.saldohutang.value=this.form.ntotal.value-this.form.bayar.value;}else{ this.form.pajak.value = this.value;this.form.ntotal.value = (2*this.form.xntotal.value) - this.form.xntotal.value + (2*this.form.biaya.value) - this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;this.form.saldohutang.value=(2*this.form.xntotal.value) - this.form.xntotal.value + (2*this.form.biaya.value) - this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;}"/></td>

    <td align="left" bgcolor="#FFFFFF" >0-99 (%), &gt; 100 (Nilai) </td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >&nbsp;</td>

    <td align="right" bgcolor="#FFFFFF" ><label>

      <input name="pajak" type="text" id="pajak" value="0" size="10" maxlength="10" onchange="javascript:this.form.ntotal.value = (2*this.form.xntotal.value) - this.form.xntotal.value + (2*this.form.biaya.value) - this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;this.form.saldohutang.value=(2*this.form.xntotal.value) - this.form.xntotal.value + (2*this.form.biaya.value) - this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;"/>

    </label></td>

    <td align="left" bgcolor="#FFFFFF" ><label>

      <select name="akunpajak" id="akunpajak">

        <?php

do {  

?>

        <?php

mysql_select_db($database_con_gl, $con_gl);

$query_akun = "SELECT id, akun, klasifikasi, keterangan FROM gl_akun where klasifikasi = '$row_klasbeban2[kd]' ORDER BY id,akun ASC";

$akun = mysql_query($query_akun, $con_gl) or die(mysql_error());

$row_akun = mysql_fetch_assoc($akun);

$totalRows_akun = mysql_num_rows($akun);

?>

        <option value="" style="background:#EEEEEE; font-weight:bold;"><?php echo $row_klasbeban2['klasifikasi'];?></option>

        <?php do { ?>

        <option value="<?php echo $row_akun['id']?>" <?php if($row_def_ak['a_paj']==$row_akun['id']) { ?>selected="selected"<?php } ?>>-<?php echo $row_akun['akun']?></option>

        <?php } while ($row_akun = mysql_fetch_assoc($akun));?>

        <?php

} while ($row_klasbeban2 = mysql_fetch_assoc($klasbeban2));

  $rows = mysql_num_rows($klasbeban);

  if($rows > 0) {

      mysql_data_seek($klasbeban, 0);

	  $row_klasbeban = mysql_fetch_assoc($klasbeban);

  }

?>

      </select>

    </label></td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top">

    <td align="left" >Salesman:

      <label>

      <select name="recipient" id="recipient">

        <?php

do {  

?>

        <option value="<?php echo $row_salesmen['id']?>"><?php echo $row_salesmen['nama']?></option>

        <?php

} while ($row_salesmen = mysql_fetch_assoc($salesmen));

  $rows = mysql_num_rows($salesmen);

  if($rows > 0) {

      mysql_data_seek($salesmen, 0);

	  $row_salesmen = mysql_fetch_assoc($salesmen);

  }

?>

      </select>

      </label></td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Total : </td>

    <td align="right" bgcolor="#FFFFFF" ><input name="ntotal" type="text" id="ntotal" value="<?php echo intval($ntotal);?>" size="10" maxlength="10" onchange="this.form.saldohutang.value=this.value-this.form.bayar.value;"/></td>

    <td align="left" bgcolor="#FFFFFF" ><label></label></td>

    <td align="center" >&nbsp;</td>

  </tr>

  <?php //if($task =='add') { ?>

  <tr valign="top">

    <td align="left" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" > Dari Kas Masuk  : </td>

    <td colspan="3" align="left" bgcolor="#FFFFFF" ><label>

      <select name="f_kas" id="f_kas" onchange="setDP(this.value);">

        <option value="">Pilih</option>

        <?php if($totalRows_fkas > 0) { ?>

		<?php

do {  

?>

        <option value="<?php echo $row_fkas['no_ref']?>,<?php echo intval($row_fkas['total']);?>"><?php echo $row_fkas['no_ref'];?> ( <?php echo number_format($row_fkas['total'],0,',','.').",-";?> )</option>

        <?php

} while ($row_fkas = mysql_fetch_assoc($fkas));

  $rows = mysql_num_rows($fkas);

  if($rows > 0) {

      mysql_data_seek($fkas, 0);

	  $row_fkas = mysql_fetch_assoc($fkas);

  }

?><?php } ?>

      </select>

    </label>

      <input name="bayar" type="checkbox" id="bayar" value="checkbox" onclick="if(this.checked) { this.form.total_dp.disabled='';this.form.f_kas.disabled='disabled';this.form.total_dp.value = this.form.ntotal.value;}else{ this.form.total_dp.disabled='disabled';this.form.f_kas.disabled='';this.form.total_dp.value = 0;}"/>

    Pembayaran Tunai </td>

  </tr>

  <tr valign="top">

    <td align="left" ><label></label></td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Total Bayar  : </td>

    <td align="right" bgcolor="#FFFFFF" ><div id="boxDP">

<label>

      <input name="total_dp" type="text" id="total_dp" value="0" size="10" maxlength="10" disabled="disabled"/>

    </label>

	</div></td>

    <td align="left" bgcolor="#FFFFFF" ><label>

    <select name="akun_dp" id="akun_dp">

      <?php

do {  

mysql_select_db($database_con_gl, $con_gl);

$query_kasakun = "SELECT id, akun FROM gl_akun where klasifikasi='$row_klaskas[kd]' ORDER BY akun ASC";

$kasakun = mysql_query($query_kasakun, $con_gl) or die(mysql_error());

$row_kasakun = mysql_fetch_assoc($kasakun);

$totalRows_kasakun = mysql_num_rows($kasakun);

?>

      <option value="" style="background:#DDDDDD;font-weight:bold;"><?php echo $row_klaskas['klasifikasi']?></option>

      <?php if($totalRows_kasakun > 0) { ?>

      <?php do { ?>

      <option value="<?php echo $row_kasakun['id']; ?>" <?php if($row_def_ak['a_kas']==$row_kasakun['id']) { ?>selected="selected"<?php } ?>>-<?php echo $row_kasakun['akun']; ?></option>

      <?php } while ($row_kasakun = mysql_fetch_assoc($kasakun)); ?>

      <?php } ?>

      <?php

} while ($row_klaskas = mysql_fetch_assoc($klaskas));

  $rows = mysql_num_rows($klaskas);

  if($rows > 0) {

      mysql_data_seek($klaskas, 0);

	  $row_klaskas = mysql_fetch_assoc($klaskas);

  }

?>

    </select>

    </label></td>

    <td align="center" >&nbsp;</td>

  </tr>

  <?php //} ?>

  <!--<tr valign="top">

    <td width="20%" align="center" >&nbsp;</td>

    <td width="10%" align="center" >&nbsp;</td>

    <td width="10%" align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Bayar / Uang muka : </td>

    <td align="right" bgcolor="#FFFFFF" ><input name="bayar" type="text" id="bayar" value="0" size="10" maxlength="10" onchange="javascript:this.form.saldohutang.value = this.form.ntotal.value-this.form.bayar.value;"/></td>

    <td width="20%" align="left" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>-->

  <!--<tr valign="top">

    <td width="20%" align="left" ><label></label></td>

    <td width="10%" align="center" >&nbsp;</td>

    <td width="10%" align="center" >&nbsp;</td>

    <td colspan="2" align="right" >Saldo Hutang : </td>

    <td align="right" bgcolor="#FFFFFF" ><input name="saldohutang" type="text" id="saldohutang" value="<?php //echo intval($ntotal);?>" size="10" maxlength="10"/></td>

    <td width="20%" align="left" ><input name="payment" type="checkbox" id="payment" value="checkbox" onclick="if(this.checked) { this.form.bayar.value= this.form.ntotal.value;this.form.saldohutang.value=0;}else{ this.form.bayar.value=0;this.form.saldohutang.value=this.form.ntotal.value;}"/>

Cek jika tunai </td>

    <td align="center" >&nbsp;</td>

  </tr>-->

  <!--<tr valign="top" bgcolor="#FFFFFF">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="right" >Pajak :</td>

    <td align="right" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top" bgcolor="#FFFFFF">

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="right" >Biaya Lainnya : </td>

    <td align="right" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

    <td align="center" >&nbsp;</td>

  </tr>

  <tr valign="top" bgcolor="#FFFFFF">

        <td align="center" >&nbsp;</td>

        <td align="center" >&nbsp;</td>

        <td align="center" >&nbsp;</td>

        <td align="right" >Total Net : </td>

        <td align="right" >&nbsp;</td>

        <td align="center" >&nbsp;</td>

        <td align="center" >&nbsp;</td>

      </tr>-->

  <?php } ?>

  <tr>

    <th align="center"><strong>Barang - Kendaraan</strong></th>

    <th align="center"><strong>Satuan</strong></th>

    <th align="center"><strong>Jumlah</strong></th>

    <th align="center"><strong>Harga Satuan </strong></th>

    <th align="center"><strong>Diskon</strong></th>

    <th align="center"><strong>Total</strong></th>

    <th align="center"><strong>Transaksi</strong></th>

    <th align="center"><strong>Aksi</strong></th>

  </tr>

  <tr valign="top" bgcolor="#FFFFFF">

    <td align="center" ><label>

      <select name="barang" id="barang" style="width:240px;" onchange="getListKendaraan();">

        <?php

do {  

mysql_select_db($database_con_gl, $con_gl);

$query_getpro = "SELECT id, barang, keterangan FROM gl_barang where kelompok='$row_kelom[id]' order by barang";

$getpro = mysql_query($query_getpro, $con_gl) or die(mysql_error());

$row_getpro = mysql_fetch_assoc($getpro);

$totalRows_getpro = mysql_num_rows($getpro);

?>

        <?php

 if($totalRows_getpro  > 0) { ?>

        <option value="" style="background:#DDDDDD;font-weight:bold;"><?php echo $row_kelom['kelompok']?></option>

        <?php do { ?>

        <option value="<?php echo $row_getpro['id']; ?>" title="<?php echo $row_getpro['keterangan']; ?>"> - <?php echo $row_getpro['barang']; ?></option>

        <?php }  while ($row_getpro = mysql_fetch_assoc($getpro)); ?>

        <?php } ?>

        <?php

} while ($row_kelom = mysql_fetch_assoc($kelom));

  $rows = mysql_num_rows($kelom);

  if($rows > 0) {

      mysql_data_seek($kelom, 0);

	  $row_kelom = mysql_fetch_assoc($kelom);

  }

?>

      </select>

    </label>

    <label id="divListKendaraan">

                <select name="kendaraan" id="kendaraan" style="width:240px;">

                  <option value="">Pilih Kendaraan</option>

                </select>

              </label></td>

    <td align="center" ><label>

      <select name="satuan" id="satuan">

        <?php

do {  

?>

        <option value="<?php echo $row_satuan['id']?>"><?php echo $row_satuan['satuan']?></option>

        <?php

} while ($row_satuan = mysql_fetch_assoc($satuan));

  $rows = mysql_num_rows($satuan);

  if($rows > 0) {

      mysql_data_seek($satuan, 0);

	  $row_satuan = mysql_fetch_assoc($satuan);

  }

?>

      </select>

    </label></td>

    <td align="center" ><label>

      <input name="jumlah" type="text" id="jumlah" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);" size="5" maxlength="5"/>

    </label></td>

    <td align="center" ><label id="divHargaKendaraan">

      <input name="hargasatuan" type="text" id="hargasatuan" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);" size="10" maxlength="10"/>

    </label></td>

    <td align="center" ><label>

      <input name="diskon" type="text" id="diskon" onchange="javascript:this.form.total.value=(this.form.jumlah.value * this.form.hargasatuan.value) - (this.form.jumlah.value * this.form.hargasatuan.value * this.form.diskon.value / 100);" value="0" size="2" maxlength="3"/>

      </label>

      %</td>

    <td align="center" ><label>

      <input name="total" type="text" id="total" size="10" maxlength="15"/>

    </label></td>

    <td align="center" ><label>

      <textarea name="transaksi" cols="35" rows="2" id="transaksi"></textarea>

    </label></td>

    <td align="center" ><label></label>

        <label>

        <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxManagePenjualan('Tambah');" class="checkbutton" title="Tambah Transaksi"/>

        <input name="tsk" type="hidden" id="tsk" value="<?php echo $task;?>" />

        </label></td>

  </tr>

</table>

