<?php /*Added by suwondo*/ ?>
<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"JS-6");
$currentPage = $_SERVER["PHP_SELF"];
?>
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<h1>Data Master Karyawan</h1>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
	<tr valign="top" bgcolor="#FFFFFF" class="hide">
        <td colspan="12" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;">
			<form id="search" name="search" method="post" action="">
			<!-- Edit by suwondo -->
			  Pencarian data : 
				<label>
					<input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: nama, alamat & no telp" onclick="this.select(); $(this).autocomplete('components/kontak/search.autocomplete.php', { width: 330 });" size="45" maxlength="100" onkeyup="javascript: $(this).autocomplete('components/kontak/search.autocomplete.php', { width: 330 }); $(this).result(function(event, data, formatted){ idx = formatted.split(' - '); window.location.href='index.php?component=kontak&task=listkaryawan&open=window&cr_kel=ALL&cr_txt='+idx[0]; });" <?php echo $_REQUEST['cr_txt'];?> />
				</label>
				<label><input name="Search" type="submit" id="Search" value="Search" /></label>
			</form>
		<?php
		if(isset($_POST['Search'])) {
			echo "<script>window.location=\"index.php?component=kontak&task=listkaryawan&open=window&cr_kel=ALL&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";
		}
		?>		</td>
	</tr>
	<tr>
		<th width="225"><strong>Nama Karyawan</strong></th>
		<th width="451"><strong>Alamat</strong></th>
		<th width="188">No. Telp </th>
		<th width="236">Cabang</th>
		<th width="167" align="center" class="hide"><strong>Aksi</strong></th>
	</tr>
	<?php
	$key = trim($_REQUEST['cr_txt']);
	$query = mysql_query("SELECT a.id, a.nama, a. alamat, a.tlp,  b.nama as namacabang FROM gl_kontak a, gl_gudang b WHERE b.id=a.gudang AND a.type='Karyawan' AND (a.nama like '%$key%' OR a.alamat like '%$key%' OR a.tlp like '%$key%') order by a.id asc") or die (mysql_error());
	
	 printf($query);
	while(list($id, $nama, $alamat, $tlp, $cabang) = mysql_fetch_row($query)){
		echo "<tr>";
		echo "<td>$nama</td><td>$alamat</td><td>$tlp</td><td>$cabang</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('karyawan').value='$id'; window.opener.document.getElementById('txtkaryawan').value='$nama'; window.close(1000);\" /></td>";
		echo "</tr>";	}
	?>
   
 </table>
