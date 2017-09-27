<?php /*Added by suwondo*/ ?>
<?php require('connections/con_gl.php'); ?>
<?php

cekAkses($_SESSION[akses],"JS-6");
$currentPage = $_SERVER["PHP_SELF"];

$handling = $_GET['agent'];
//echo $handling;
mysql_select_db($database_con_gl, $con_gl);
$query_klas = "select ID_AGENT,HANDLING,KODEAGENT,NAMAAGENT,ALAMAT,TELEPON from v_agent where IDAGENTHANDLING = $handling ";
printf($query_klas);
//printf($query_klas);
$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());
$row_klas = mysql_fetch_assoc($klas);
$totalRows_klas = mysql_num_rows($klas);

?>

<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<h1>Pilih Nama Agent</h1>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
  <tr valign="top" bgcolor="#FFFFFF" class="hide">
        <td colspan="16" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;">
			<form id="search" name="search" method="post" action="">
			<!-- Edit by suwondo -->
			  Enter a agent name to filter: 
				<label>
					<input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: City" onClick="this.select(); $(this).autocomplete('components/service/search.autocomplete.php', { width: 330 });" size="45" maxlength="100" onKeyUp="javascript: $(this).autocomplete('components/service/search.autocomplete.php', { width: 330 }); $(this).result(function(event, data, formatted){ idx = formatted.split(' - '); window.location.href='index.php?component=service&task=list&open=window&cr_kel=ALL&cr_txt='+idx[0]; });" <?php echo $_REQUEST['cr_txt'];?> />
				</label>
				<label><input name="Search" type="submit" id="Search" value="Search" /></label>
			</form>
		<?php
		if(isset($_POST['Search'])) {
			echo "<script>window.location=\"index.php?component=service&task=list&open=window&cr_kel=ALL&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";
		}
		?>		</td>
	</tr>
	<tr>
		<th width="700"><strong>HANDLING</strong></th>
  		<th width="700">KODE</th>
   		<th width="700">AGENT</th>
   		<th width="700">ALAMAT</th>
   		<th width="700">TELEPON</th>
   		<th width="132" align="center" class="hide"><strong>Action</strong></th>
	</tr>
	<?php
	$key = trim($_REQUEST['cr_txt']);
	$query = mysql_query("select ID_AGENT,HANDLING,KODEAGENT,NAMAAGENT,ALAMAT,TELEPON from v_agent WHERE IDAGENTHANDLING = $handling") or die (mysql_error());
	while(list($id,$handlingname, $kode, $agent,$alamat,$telepon) = mysql_fetch_row($query)){
		if($handling == 1)
		{
			// SHIPPING
			echo "<tr>";
			echo "<td>$handlingname</td><td>$kode</td><td>$agent</td><td>$alamat</td><td>$telepon</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('agentshipping').value='$agent'; window.opener.document.getElementById('idshipping').value='$id'; window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 2)
		{
			// DELIVERY
			echo "<tr>";
			echo "<td>$handlingname</td><td>$kode</td><td>$agent</td><td>$alamat</td><td>$telepon</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('agentdelivery').value='$agent'; window.opener.document.getElementById('iddelivery').value='$id'; window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 3)
		{
			// WAREHOOUSE
			echo "<tr>";
			echo "<td>$handlingname</td><td>$kode</td><td>$agent</td><td>$alamat</td><td>$telepon</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('agentwarehouse').value='$agent'; window.opener.document.getElementById('idwarehouse').value='$id'; window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 4)
		{
			// RA
			echo "<tr>";
			echo "<td>$handlingname</td><td>$kode</td><td>$agent</td><td>$alamat</td><td>$telepon</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('agentra').value='$agent'; window.opener.document.getElementById('idra').value='$id'; window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 5)
		{
			// FRIGHT
			echo "<tr>";
			echo "<td>$handlingname</td><td>$kode</td><td>$agent</td><td>$alamat</td><td>$telepon</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('agentfright').value='$agent'; window.opener.document.getElementById('idfright').value='$id'; window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 6)
		{
			// GRDH
			echo "<tr>";
			echo "<td>$handlingname</td><td>$kode</td><td>$agent</td><td>$alamat</td><td>$telepon</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('agentgrdh').value='$agent'; window.opener.document.getElementById('idgrdh').value='$id'; window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else 
		{
			// TRUCKING
			echo "<tr>";
			echo "<td>$handlingname</td><td>$kode</td><td>$agent</td><td>$alamat</td><td>$telepon</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: window.opener.document.getElementById('agenttrucking').value='$agent'; window.opener.document.getElementById('idtrucking').value='$id'; window.close(1000);\" /></td>";
			echo "</tr>";
		}
		
		
	}
	?>
 </table>
