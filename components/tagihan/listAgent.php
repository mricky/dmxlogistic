<?php /*Added by suwondo*/ ?>
<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"JS-6");
$currentPage = $_SERVER["PHP_SELF"];
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "SELECT ID_AGENT,NAMAAGENT, ALAMAT, BANK,ACCOUNTNUMBER,ATASNAMA from agent";
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);

?>
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<h1>Pilih Agent </h1>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
  <tr valign="top" bgcolor="#FFFFFF" class="hide">
        <td colspan="15" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;">
			<form id="search" name="search" method="post" action="">
			<!-- Edit by suwondo -->
			  Enter a city name to filter: 
				<label>
					<input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: City" onclick="this.select(); $(this).autocomplete('components/handling/search.autocomplete.php', { width: 330 });" size="45" maxlength="100" onkeyup="javascript: $(this).autocomplete('components/handling/search.autocomplete.php', { width: 330 }); $(this).result(function(event, data, formatted){ idx = formatted.split(' - '); window.location.href='index.php?component=handling&task=list&open=window&cr_kel=ALL&cr_txt='+idx[0]; });" <?php echo $_REQUEST['cr_txt'];?> />
				</label>
				<label><input name="Search" type="submit" id="Search" value="Search" /></label>
			</form>
		<?php
		if(isset($_POST['Search'])) {
			echo "<script>window.location=\"index.php?component=handling&task=list&open=window&cr_kel=ALL&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";
		}
		?>		</td>
	</tr>
	<tr>
	  <th width="700">Nama Agent</th>
		
   		<th width="700">Alamat</th>
   		<th width="700"><strong>Bank</strong></th>
   		<th width="700">No Akun</th>
   		<th width="700">Atas Nama</th>

		<th width="132" align="center" class="hide"><strong>Action</strong></th>
	</tr>
	<?php
	$key = trim($_REQUEST['cr_txt']);
	$query = mysql_query("select ID_AGENT,NAMAAGENT, ALAMAT, BANK,ACCOUNTNUMBER,ATASNAMA from agent where NAMAAGENT like '%$key%'") or die (mysql_error());
	while(list($id, $nama,$alamat,$bank,$accountnumber,$atasnama) = mysql_fetch_row($query)){
		echo "<tr>";
		echo "<td>$nama</td><td>$alamat</td><td>$bank</td><td>$accountnumber</td><td>$atasnama</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('idagent').value='$id'; window.opener.document.getElementById('agent').value='$nama'; window.close(1000);\" /></td>";
		echo "</tr>";
	}
	?>
 </table>
