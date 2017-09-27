<?php require_once('../connections/con_gl.php'); ?>

<?php

//session_start();

/*if($_SESSION['admin'] =='') {

	echo "<script>window.location=\"history.go(-1)\";</script>";

}*/

include('function.php');

?>

<?php

$colname_data = "-1";

if (isset($_GET['referensi'])) {

  $colname_data = (get_magic_quotes_gpc()) ? $_GET['referensi'] : addslashes($_GET['referensi']);

}

mysql_select_db($database_con_gl, $con_gl);

$query_data = sprintf("SELECT * FROM gl_retailtrans WHERE no_ref = '%s'", $colname_data);

$data = mysql_query($query_data, $con_gl) or die(mysql_error());

$row_data = mysql_fetch_assoc($data);

$totalRows_data = mysql_num_rows($data);



mysql_select_db($database_con_gl, $con_gl);

$query_period = "SELECT id, awal, akhir, saldoawal FROM gl_periode ORDER BY id ASC";

$period = mysql_query($query_period, $con_gl) or die(mysql_error());

$row_period = mysql_fetch_assoc($period);

$totalRows_period = mysql_num_rows($period);

?>

<?php 



mysql_select_db($database_con_gl, $con_gl);

$query_jurnal = "SELECT DISTINCT gl_trans.kode FROM gl_trans, gl_akun WHERE gl_akun.id = gl_trans.akun AND gl_trans.no_ref='$row_data[no_ref]' ORDER BY gl_trans.kode,gl_trans.pos asc ";

//print_r($query_jurnal);

$jurnal = mysql_query($query_jurnal, $con_gl) or die(mysql_error());

$row_jurnal = mysql_fetch_assoc($jurnal);

$totalRows_jurnal = mysql_num_rows($jurnal);



mysql_select_db($database_con_gl, $con_gl);

$query_trans = "SELECT gl_trans.id, gl_trans.kode, gl_trans.akun as coa, gl_akun.akun as namakun, gl_trans.pos, gl_trans.transaksi, gl_trans.total, gl_trans.barang, gl_trans.jumlah, gl_trans.hargasatuan, gl_trans.diskon, gl_trans.satuan FROM gl_trans, gl_akun WHERE gl_akun.id = gl_trans.akun AND gl_trans.no_ref='$row_data[no_ref]' ORDER by gl_trans.kode, gl_trans.pos asc";

//print_r($query_trans);

 $trans = mysql_query($query_trans, $con_gl) or die(mysql_error());

 //$row_trans = mysql_fetch_assoc($trans);

 $totalRows_trans = mysql_num_rows($trans);

//global $dataJurnal;

//$dataJurnal = array();

//$dataJurnal[] = $row_trans;

	?>

<link rel="stylesheet" type="text/css" href="../css/style.css" />

<style>

.datatable tr td {

	font-size:11px;

}

</style>

<title>Jurnal Voucher No Referensi : <?php echo $_GET[referensi];?></title><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable"> 

  <tr bgcolor="#FFFFFF">

    <td colspan="3" align="center"><h1 style="padding:0;margin:0;">JURNAL VOUCHER #<?php echo $_GET[referensi];?></h1>&nbsp;</td>

  </tr>

      <tr valign="top" bgcolor="#DDDDDD">

        <th align="left"><strong>Tanggal</strong></th>

        <th align="left"><strong>No Referensi </strong></th>

        <th width="617" align="left"><strong>Keterangan</strong></th>

  </tr>

    <tr valign="top" bgcolor="#FFFFFF">

      <td width="149">

        <?php tanggal($row_data['tgl'],"tampilkan"); ?>      </td>

      <td width="237"><?php echo $row_data['no_ref']; ?></td>

      <td align="left"><?php echo $row_data['keterangan']; ?></td>

    </tr>

	<tr valign="top">

        <td colspan="3"><table width="100%" border="0" align="right" cellpadding="3" cellspacing="0" class="datatable">

        <?php 

		// print_f(getDataJurnal());

          do 

		  {

			   if($row_jurnal['kode'] == 'KK')

			   {

				   $jenis = "Jurnal Kas Keluar";

			   }

			   else if($row_jurnal['kode'] == 'SJ')

			   {

				   $jenis = "Jurnal Penjualan";

			   }

			   else if($row_jurnal['kode'] == 'KM')

			   {

				   $jenis = "Jurnal Kas Masuk";

			   }

			   else

			   {

				   $jenis = "Not Defined";

			   }

		  

		   ?>

	      <tr bgcolor="#EEEEEE">

		      <th colspan="5" align="left"><?php echo $jenis;?></th>

	      </tr>

	      <tr bgcolor="#EEEEEE">

           

            <th width="24%" align="left"><strong>Transaksi </strong></th>

            <th width="36%" align="left" valign="top"><strong>Akun</strong></th>

            <th width="25%" align="center" valign="top"><strong>Debet</strong></th>

            <th width="15%" align="center" valign="top"><strong>Kredit</strong></th>

          </tr>

	       <?php   

     	   

				//echo $row_jurnal['kode'];

			    mysql_data_seek($trans, 0);	

				$totdeb=0; $totkre=0;

				while ($row_trans = mysql_fetch_array($trans))

				{

					

					if($row_trans['kode'] == $row_jurnal['kode'])

					{

						 

					?>

                    

					<tr valign="top" bgcolor="#FFFFFF">

            <td><?php echo $row_trans['transaksi']; ?></td>

            <td align="left" valign="top"><?php echo $row_trans['namakun']; ?></td>                       

            

            <td align="right" valign="top"><?php if($row_trans['pos']=='D') { $totdeb += $row_trans['total']; echo number_format($row_trans['total'],0,',','.').",-";}else{ echo "0,00,-";} ?></td>

            <td align="right" valign="top"><?php if($row_trans['pos']=='K') { $totkre += $row_trans['total']; echo number_format($row_trans['total'],0,',','.').",-";}else{ echo "0,00,-";} ?></td>

          

          <?php

					}

					

                }

				    

			?>

		   	</tr>

           <tr valign="top">

                <td colspan="2" align="right"><strong>Total : </strong></td>

                <td align="right" valign="top" bgcolor="#EEEEEE"><strong><?php echo number_format($totdeb,0,',','.').",-";?></strong></td>

                <td align="right" valign="top" bgcolor="#EEEEEE"><strong><?php echo number_format($totkre,0,',','.').",-";?></strong></td>

          </tr>	          

     	    

      <?php 

	

	  } while($row_jurnal = mysql_fetch_assoc($jurnal))  // looping pertama

	 

	  ?>

         

          

              </table></td>

    </tr>

     

  <tr>

    <td colspan="3">Data tidak ada !!! </td>

  </tr>

 

  

  <!--<tr>

    <td colspan="3"><a href="../doc/transaksihariandoc.php?files=data_transaksiharian_<?php //echo $_GET[referensi];?>&query=<?php //echo str_replace(" ","+",$query_data);?>" title="Export Word"><img src="../images/_word.png" width="20" height="20" border="0" /> Export Word</a></td>

  </tr>-->

</table>

<?php

          





mysql_free_result($data);

mysql_free_result($period);

?>

