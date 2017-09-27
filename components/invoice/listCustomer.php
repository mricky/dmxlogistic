<?php /*Added by suwondo*/ ?>

<?php require('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"JS-6");

$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_con_gl, $con_gl);

$query_klas = "SELECT IDCUSTOMER, NAMACUSTOMER,ALAMAT,TELEPON,FAX,HP,EMAIL,MARKETING FROM customer ORDER BY NAMACUSTOMER ASC";

$klas = mysql_query($query_klas, $con_gl) or die(mysql_error());

$row_klas = mysql_fetch_assoc($klas);

$totalRows_klas = mysql_num_rows($klas);



?>

<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />

<h1>Data Customer</h1>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">

	<tr valign="top" bgcolor="#FFFFFF" class="hide">

        <td colspan="10" align="right" style="border-bottom:solid 1px #E2EAC1;border-right:solid 1px #E2EAC1;">

			<form id="search" name="search" method="post" action="">

			<!-- Edit by suwondo -->

			  Pencarian data : 

				<label>

					<input name="cr_txt" type="text" id="cr_txt" placeholder="Find by: Nama" onclick="this.select(); $(this).autocomplete('components/invoice/searchCustomer.autocomplete.php', { width: 330 });" size="45" maxlength="100" onkeyup="javascript: $(this).autocomplete('components/invoice/searchCustomer.autocomplete.php', { width: 330 }); $(this).result(function(event, data, formatted){ idx = formatted.split(' - '); window.location.href='index.php?component=invoice&task=listCustomer&open=window&cr_kel=ALL&cr_txt='+idx[0]; });" <?php echo $_REQUEST['cr_txt'];?> />

				</label>

				<label><input name="Search" type="submit" id="Search" value="Search" /></label>

			</form>

		<?php

		if(isset($_POST['Search'])) {

			echo "<script>window.location=\"index.php?component=invoice&task=listCustomer&open=window&cr_kel=ALL&cr_txt=".str_replace(" ","+",$_POST[cr_txt])."\";</script>";

		}

		?>

		</td>

	</tr>

	<tr>

		<th width="219"><strong>Customer</strong></th>
    	<th width="219"><strong>Alamat</strong></th>
        <th width="219"><strong>Telepon</strong></th>
        <th width="219"><strong>Hp</strong></th>
		<th width="700"><strong>Email</strong></th>
		<th width="700"><strong>Marketing</strong></th>
		<th width="132" align="center" class="hide"><strong>Aksi</strong></th>

	</tr>

	<?php

	$key = trim($_REQUEST['cr_txt']);

	$query = mysql_query("select IDCUSTOMER, NAMACUSTOMER,ALAMAT,TELEPON,FAX,HP,EMAIL,MARKETING from customer where NAMACUSTOMER like '%$key%' order by NAMACUSTOMER asc") or die (mysql_error());

	while(list($id, $nama, $alamat,$telepon,$fax,$hp,$email,$marketing) = mysql_fetch_row($query)){

		echo "<tr>";

		echo "<td>$nama</td><td>$alamat</td><td>$telepon</td><td>$hp</td><td>$email</td><td>$marketing</td><td align='center'><input type='button' value='pilih' onclick=\"javascript: 
window.opener.document.getElementById('customer').value='$nama';
window.opener.document.getElementById('idcustomer').value='$id'; window.close(1000);\" /></td>";

		echo "</tr>";

	}

	?>

 </table>