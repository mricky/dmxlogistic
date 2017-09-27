<?php /*Added by suwondo*/ ?>
<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"JS-6");
$currentPage = $_SERVER["PHP_SELF"];
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT id, merk FROM gl_merkkendaraan ORDER BY merk ASC";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);

?>
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<h1>Data Merk Kendaraan</h1>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
	<tr valign="top" bgcolor="#FFFFFF" class="hide">
        <td colspan="10" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;">
			<form id="search" name="search" method="post" action="">
			<!-- Edit by suwondo -->
			  Pencarian data : 
				<label>
					<input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: merk kendaraan" onclick="this.select(); $(this).autocomplete('components/merkkendaraan/search.autocomplete.php', { width: 330 });" size="45" maxlength="100" onkeyup="javascript: $(this).autocomplete('components/merkkendaraan/search.autocomplete.php', { width: 330 }); $(this).result(function(event, data, formatted){ idx = formatted.split(' - '); window.location.href='index.php?component=merkkendaraan&task=list&open=window&cr_kel=ALL&cr_txt='+idx[0]; });" <?php echo $_REQUEST['cr_txt'];?> />
				</label>
				<label><input name="Search" type="submit" id="Search" value="Search" /></label>
			</form>
		<?php
		if(isset($_POST['Search'])) {
			echo "<script>window.location=\"index.php?component=merkkendaraan&task=list&open=window&cr_kel=ALL&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";
		}
		?>
		</td>
	</tr>
	<tr>
		<th width="219"><strong>Merk Kendaraan</strong></th>
		<th width="700"><strong>Keterangan</strong></th>
		<th width="132" align="center" class="hide"><strong>Aksi</strong></th>
	</tr>
	<?php
	$key = trim($_REQUEST['cr_txt']);
	$query = mysql_query("select * from gl_merkkendaraan where merk like '%$key%' order by merk asc") or die (mysql_error());
	while(list($id, $merk, $keterangan) = mysql_fetch_row($query)){
		echo "<tr>";
		echo "<td>$merk</td><td>$keterangan</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('merk').value='$id'; window.opener.document.getElementById('txtmerk').value='$merk'; window.close(1000);\" /></td>";
		echo "</tr>";
	}
	?>
 </table>