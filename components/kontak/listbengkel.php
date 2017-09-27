<?php /*Added by suwondo*/ ?>
<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"JS-6");
$currentPage = $_SERVER["PHP_SELF"];
?>
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<h1>Data Master Rekanan Asuransi</h1>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
	<tr valign="top" bgcolor="#FFFFFF" class="hide">
        <td colspan="11" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;">
			<form id="search" name="search" method="post" action="">
			<!-- Edit by suwondo -->
			  Pencarian data : 
				<label>
					<input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: nama, alamat & no telp" onclick="this.select(); $(this).autocomplete('components/kontak/search.autocomplete.php', { width: 330 });" size="45" maxlength="100" onkeyup="javascript: $(this).autocomplete('components/kontak/search.autocomplete.php', { width: 330 }); $(this).result(function(event, data, formatted){ idx = formatted.split(' - '); window.location.href='index.php?component=kontak&task=listbengkel&open=window&cr_kel=ALL&cr_txt='+idx[0]; });" <?php echo $_REQUEST['cr_txt'];?> />
				</label>
				<label><input name="Search" type="submit" id="Search" value="Search" /></label>
			</form>
		<?php
		if(isset($_POST['Search'])) {
			echo "<script>window.location=\"index.php?component=kontak&task=listbengkel&open=window&cr_kel=ALL&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";
		}
		?>		</td>
	</tr>
	<tr>
		<th width="266"><strong>Nama Perusahaan</strong></th>
		<th width="602"><strong>Alamat</strong></th>
		<th width="246">No. Telp </th>
		<th width="163" align="center" class="hide"><strong>Aksi</strong></th>
	</tr>
	<?php
	$key = trim($_REQUEST['cr_txt']);
	$query = mysql_query("SELECT * FROM gl_kontak WHERE true AND (nama like '%$key%' OR alamat like '%$key%' OR tlp like '%$key%') order by id asc") or die (mysql_error());
	while(list($id, $nama, $alamat, $tlp) = mysql_fetch_row($query)){
		echo "<tr>";
		echo "<td>$nama</td><td>$alamat</td><td>$tlp</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('dari').value='$id'; window.opener.document.getElementById('qtxt').value='$nama'; window.opener.setKeterangan('$id'); window.opener.getDetailCustomer('$id'); window.close(1000);\" /></td>";
		echo "</tr>";
	}
	?>
 </table>
