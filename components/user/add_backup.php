<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"A-1");
mysql_select_db($database_con_gl, $con_gl);
$query_kary = "SELECT id, nama FROM gl_kontak WHERE type = 'Karyawan' ORDER BY nama ASC";
$kary = mysql_query($query_kary, $con_gl) or die(mysql_error());
$row_kary = mysql_fetch_assoc($kary);
$totalRows_kary = mysql_num_rows($kary);
?>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$().ajaxStart(function() {
		$('#loading').show();
		$('#result').hide();
	}).ajaxStop(function() {
		$('#loading').hide();
		$('#result').fadeIn('slow');
	});

	$('#add').submit(function() {
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				$('#result').html(data);
			}
		})
		return false;
	});
  $('#result').click(function(){
  $(this).hide();
  });
})
$(function()
  {
      $('#alamat').wysiwyg();
	  $('#b_alamat').wysiwyg();
  });
</script>
<link type="text/css" rel="stylesheet" href="css/jquery.wysiwyg.css" />
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<h1>Tambah User</h1>
<form action="proses/user.php?act=add" method="POST" name="add" id="add">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
      <td align="right">Username* : </td>
      <td><label>
        <input name="username" type="text" id="username" size="20" maxlength="20" />
      </label></td>
    </tr>
    <tr>
      <td align="right">Password* : </td>
      <td><label>
        <input name="password" type="password" id="password" size="20" maxlength="20" />
      </label></td>
    </tr>
    <tr>
      <td align="right">Link Karyawan : </td>
      <td><label>
        <select name="karyawan" id="karyawan">
          <option value="0">Not Set</option>
          <?php
do {  
?>
          <option value="<?php echo $row_kary['id']?>"><?php echo $row_kary['nama']?></option>
          <?php
} while ($row_kary = mysql_fetch_assoc($kary));
  $rows = mysql_num_rows($kary);
  if($rows > 0) {
      mysql_data_seek($kary, 0);
	  $row_kary = mysql_fetch_assoc($kary);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr valign="top">
      <td align="right">Akses : </td>
      <td><label></label>
          <table width="100%" border="0" cellpadding="4" cellspacing="0">
            <tr bgcolor="#EEEEEE">
              <td width="14%"><strong>Aturan</strong></td>
              <td width="14%"><strong>Data - Data </strong></td>
              <td width="14%"><strong>Kas &amp; Bank </strong></td>
            </tr>
            <tr>
              <td width="14%" bgcolor="#FFFBF0"><label>
                <input name="user" type="checkbox" id="user" value="A-1" />
                </label>
                User</td>
              <td width="14%" bgcolor="#FFFBF0"><label>
                <input name="akun" type="checkbox" id="akun" value="D-1" />
                </label>
                Akun</td>
              <td width="14%" bgcolor="#FFFBF0"><label>
                <input name="transfer" type="checkbox" id="transfer" value="KB-1" />
                </label>
                Transfer</td>
            </tr>
            <tr>
              <td width="14%" bgcolor="#FFFBF0"><label>
                <input name="periode" type="checkbox" id="periode" value="A-2" />
                </label>
                Periode</td>
              <td width="14%" bgcolor="#FFFBF0"><label>
                <input name="kontak" type="checkbox" id="kontak" value="D-2" />
                </label>
                Kontak</td>
              <td width="14%" bgcolor="#FFFBF0"><label>
                <input name="kasmasuk" type="checkbox" id="kasmasuk" value="KB-2" />
                </label>
                Kas Masuk </td>
            </tr>
            <tr>
              <td width="14%" bgcolor="#FFFBF0"><label>
                <input name="klasifikasi" type="checkbox" id="klasifikasi" value="A-3" />
                </label>
                Klasifikasi</td>
              <td width="14%" bgcolor="#FFFBF0"><label>
                <input name="golaset" type="checkbox" id="golaset" value="D-3" />
                </label>
                Gol. Aset </td>
              <td width="14%" bgcolor="#FFFBF0"><label>
                <input name="kaskeluar" type="checkbox" id="kaskeluar" value="KB-3" />
                </label>
                Kas Keluar </td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="info" type="checkbox" id="info" value="A-4" />
                </label>
                Info P'usahan </td>
              <td bgcolor="#FFFBF0"><label>
                <input name="atp" type="checkbox" id="atp" value="D-4" />
                </label>
                ATP</td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0">&nbsp;</td>
              <td bgcolor="#FFFBF0"><label>
                <input name="penyusutan" type="checkbox" id="penyusutan" value="D-5" />
                </label>
                Peny. Aset </td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0">&nbsp;</td>
              <td bgcolor="#FFFBF0"><label>
                <input name="transaksi" type="checkbox" id="transaksi" value="D-6" />
                </label>
                Transaksi Harian </td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0">&nbsp;</td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
            </tr>
            <tr bgcolor="#EEEEEE">
              <td><strong>Persediaan</strong></td>
              <td><strong>Pembelian</strong></td>
              <td><strong>Penjualan</strong></td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="persediaan" type="checkbox" id="persediaan" value="PD-1" />
                </label>
                Persediaan</td>
              <td bgcolor="#FFFBF0"><label>
                <input name="purchase" type="checkbox" id="purchase" value="PB-1" />
                </label>
                Purchase Order </td>
              <td bgcolor="#FFFBF0"><label>
                <input name="sales" type="checkbox" id="sales" value="PJ-1" />
                </label>
                Sales Order </td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="stokopname" type="checkbox" id="stokopname" value="PD-2" />
                </label>
                Stok Opname </td>
              <td bgcolor="#FFFBF0"><label>
                <input name="pengiriman_pb" type="checkbox" id="pengiriman_pb" value="PB-2" />
                </label>
                Pengiriman</td>
              <td bgcolor="#FFFBF0"><label>
                <input name="pengiriman_pj" type="checkbox" id="pengiriman_pj" value="PJ-2" />
                </label>
                Pengiriman</td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="barang" type="checkbox" id="barang" value="PD-3" />
                </label>
                Barang</td>
              <td bgcolor="#FFFBF0"><label>
                <input name="retur_pb" type="checkbox" id="retur_pb" value="PB-3" />
                </label>
                Retur</td>
              <td bgcolor="#FFFBF0"><label>
                <input name="retur_pj" type="checkbox" id="retur_pj" value="PJ-3" />
                </label>
                Retur</td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="kelompok" type="checkbox" id="kelompok" value="PD-4" />
                </label>
                Kelompok Barang </td>
              <td bgcolor="#FFFBF0"><label></label>
                  <label>
                  <input name="pembayaranhutang" type="checkbox" id="pembayaranhutang" value="PB-4" />
                  </label>
                Pembayaran Hutang </td>
              <td bgcolor="#FFFBF0"><label>
                <input name="pembayaranpiutang" type="checkbox" id="pembayaranpiutang" value="PJ-4" />
                </label>
                Pembayaran Piutang </td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="satuan" type="checkbox" id="satuan" value="PD-5" />
                </label>
                Satuan Barang </td>
              <td bgcolor="#FFFBF0"><label>
                <input name="hutangusaha" type="checkbox" id="hutangusaha" value="PB-5" />
                </label>
                Hutang Usaha</td>
              <td bgcolor="#FFFBF0"><label>
                <input name="piutangusaha" type="checkbox" id="piutangusaha" value="PJ-5" />
                Piutang Usaha </label></td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="kartustok" type="checkbox" id="kartustok" value="PD-6" />
                </label>
                Kartu Stok </td>
              <td bgcolor="#FFFBF0"><label>
                <input name="kartuhutang" type="checkbox" id="kartuhutang" value="PB-6" />
                </label>
                Kartu Hutang </td>
              <td bgcolor="#FFFBF0"><label>
                <input name="kartupiutang" type="checkbox" id="kartupiutang" value="PJ-6" />
                </label>
                Kartu Piutang </td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="gudang" type="checkbox" id="gudang" value="PD-7" />
                </label>
                Gudang</td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0">&nbsp;</td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
            </tr>
            <tr bgcolor="#EEEEEE">
              <td><strong>Laporan</strong></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="rugilaba" type="checkbox" id="rugilaba" value="L-1" />
                </label>
                Rugi Laba </td>
              <td bgcolor="#FFFBF0"><label>
                <input name="neraca" type="checkbox" id="neraca" value="L-3" />
                </label>
                Neraca</td>
              <td bgcolor="#FFFBF0"><label>
                <input name="aruskas" type="checkbox" id="aruskas" value="L-5" />
                </label>
                Arus Kas </td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="t_harian" type="checkbox" id="t_harian" value="L-2" />
                </label>
                Transaksi Harian </td>
              <td bgcolor="#FFFBF0"><label>
                <input name="jurnal" type="checkbox" id="jurnal" value="L-4" />
                </label>
                Jurnal</td>
              <td bgcolor="#FFFBF0"><label>
                <input name="bukubesar" type="checkbox" id="bukubesar" value="L-6" />
                </label>
                Buku Besar </td>
            </tr>
            <tr>
              <td bgcolor="#FFFBF0"><label>
                <input name="r_penjualan" type="checkbox" id="r_penjualan" value="L-7" />
                </label>
                Rekap Penjualan </td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
              <td bgcolor="#FFFBF0">&nbsp;</td>
            </tr>
        </table></td>
    </tr>
    <tr>
      <td align="left">
        <em>* Required !!!</em>
      <input name="id" type="hidden" id="id" /></td>
      <td><label><input name="Save" type="submit" id="Save" value="Simpan" /></label>
        <label>
        <input type="button" name="Button" value="Batal" onClick="javascript:history.go(-1);">
      </label></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="add">
</form>
