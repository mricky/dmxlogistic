<?php /*Added by suwondo*/ ?>
<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"JS-6");
$currentPage = $_SERVER["PHP_SELF"];
$idagent = $_GET['id'];
//echo $idagent;
mysql_select_db($database_con_gl, $con_gl);
$query_agent = "SELECT * from agent where ID_AGENT = '$idagent'";
$agent = mysql_query($query_agent, $con_gl) or die(mysql_error());
$row_agent = mysql_fetch_assoc($agent);
$totalRows_agent = mysql_num_rows($agent);


$handling =  $row_agent['IDAGENTHANDLING'];
$weight = $_GET['weight'];
echo "Weight : ".$weight." Kg";

//printf($idcustomer);

?>
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<h1>Pilih Pricelist Agent <?php echo $row_agent['NAMAAGENT'];?></h1>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
  <tr valign="top" bgcolor="#FFFFFF" class="hide">	</tr>
	<tr>
		
   		<th width="100"><strong>Kota Asal</strong></th>
        <th width="100"><strong>Kota Tujuan</strong></th>
        <th width="100"><strong>Kota Terusan</strong></th>
        <th width="100">Armada</th>
        <th width="100">Rate</th>
        <th width="100">Min KG</th>

		<th width="132" align="center" class="hide"><strong>Action</strong></th>
	</tr>
	<?php
	$key = trim($_REQUEST['cr_txt']);
	$query = mysql_query("select IDAGENT,KOTAASAL, KOTATUJUAN,NAMATERUSAN,NAMAJNSKIRIM,RATEHANDLING, MINPAKET from v_pricelistagent where IDAGENT = $idagent") or die (mysql_error());
	while(list($IDAGENT,$KOTAASAL,$KOTATUJUAN,$NAMATERUSAN,$NAMAJNSKIRIM,$RATEHANDLING,$MINPAKET) = mysql_fetch_row($query)){
		
		if($handling == 1)
		{
			$cost = $weight * $RATEHANDLING;
			echo "<tr>";
			echo "<td>$KOTAASAL</td><td>$KOTATUJUAN</td><td>$NAMATERUSAN</td><td>$NAMAJNSKIRIM</td><td>$RATEHANDLING</td><td>$MINPAKET</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: 
			window.opener.document.getElementById('costshipping').value='$cost';
	window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 2)
		{
			// DELIVERY
			$cost = $weight * $RATEHANDLING;
			echo "<tr>";
			echo "<td>$KOTAASAL</td><td>$KOTATUJUAN</td><td>$NAMATERUSAN</td><td>$NAMAJNSKIRIM</td><td>$RATEHANDLING</td><td>$MINPAKET</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: 
			window.opener.document.getElementById('costdelivery').value='$cost';
	window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 3)
		{
			// WAREHOOUSE
			$cost = $weight * $RATEHANDLING;
			echo "<tr>";
			echo "<td>$KOTAASAL</td><td>$KOTATUJUAN</td><td>$NAMATERUSAN</td><td>$NAMAJNSKIRIM</td><td>$RATEHANDLING</td><td>$MINPAKET</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: 
			window.opener.document.getElementById('costwarehouse').value='$cost';
	window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 4)
		{
			// RA
				$cost = $weight * $RATEHANDLING;
			echo "<tr>";
			echo "<td>$KOTAASAL</td><td>$KOTATUJUAN</td><td>$NAMATERUSAN</td><td>$NAMAJNSKIRIM</td><td>$RATEHANDLING</td><td>$MINPAKET</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: 
			window.opener.document.getElementById('costra').value='$cost';
	window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 5)
		{
			// FRIGHT tidak dikalikan weight
			$cost = $RATEHANDLING;
			echo "<tr>";
			echo "<td>$KOTAASAL</td><td>$KOTATUJUAN</td><td>$NAMATERUSAN</td><td>$NAMAJNSKIRIM</td><td>$RATEHANDLING</td><td>$MINPAKET</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: 
			window.opener.document.getElementById('costfreight').value='$cost';
	window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else if($handling == 6)
		{
			// GRDH
			$cost = $weight * $RATEHANDLING;
			echo "<tr>";
			echo "<td>$KOTAASAL</td><td>$KOTATUJUAN</td><td>$NAMATERUSAN</td><td>$NAMAJNSKIRIM</td><td>$RATEHANDLING</td><td>$MINPAKET</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: 
			window.opener.document.getElementById('costgrdh').value='$cost';
	window.close(1000);\" /></td>";
			echo "</tr>";
		}
		else 
		{
			// TRUCKING
			$cost = $weight * $RATEHANDLING;
			echo "<tr>";
			echo "<td>$KOTAASAL</td><td>$KOTATUJUAN</td><td>$NAMATERUSAN</td><td>$NAMAJNSKIRIM</td><td>$RATEHANDLING</td><td>$MINPAKET</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: 
			window.opener.document.getElementById('costrucking').value='$cost';
	window.close(1000);\" /></td>";
			echo "</tr>";
		}	
			
		
	
	}
	?>
 </table>
