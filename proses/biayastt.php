<?php
// session_start();
 require_once('../connections/con_gl.php');require './phpmailer/PHPMailerAutoload.php'; ?>
<?php include('../connections/config.php'); ?>
<?php
$act = $_GET[act];
$url = base_url("index.php?component=biayastt");
echo $act;


// -- validasi
if(($act =='add') || ($act == 'edit')) { 
	
	if (trim($_POST['nostt']) == '') {
		$error[] = '- NO STT harus diisi !!!';
	}
	
	if (trim($_POST['idcustomer']) == '') {
		$error[] = '- Customer harus diisi !!!';
	}
	if (trim($_POST['idpenerima']) == '') {
		$error[] = '- Penerima harus diisi !!!';
	}
	
	if (trim($_POST['tanggalstt']) == '') {
		$error[] = '- Tanggal STT harus diisi !!!';
	}
	if (trim($_POST['tanggalkirim']) == '') {
		$error[] = '- Tanggal Kirim harus diisi !!!';
	}
	if (trim($_POST['idorigin']) == '') {
		$error[] = '- Kota Asal harus dipilih !!!';
	}
	if (trim($_POST['iddestination']) == '') {
		$error[] = '- Kota Tujuan harus dipilih !!!';
	}
	if (trim($_POST['idnextdest']) == '') {
		$error[] = '- Kota Terusan harus dipilih !!!';
	}
	if (trim($_POST['idservice']) == '') {
		$error[] = '- Layanan harus dipilih !!!';
	}
	if (trim($_POST['idhandling']) == '') {
		$error[] = '- Mode Armada harus dipilih !!!';
	}
	if (trim($_POST['rate']) == 0) {
		$error[] = '- Rate Tidak boleh 0 !!!';
	}
	
			
}
else if($act == "delete")
{
	// cek no pembayaran
	mysql_select_db($database_con_gl, $con_gl);
	$query_cekno = "select no_order from gl_pembayaran where no_order='$_POST[noreferensi]'";
	$cekno       = mysql_query($query_cekno, $con_gl);
	$row_cekno   = mysql_fetch_assoc($cekno);
	$total_cekno = mysql_num_rows($cekno);
	if($total_cekno > 0) { 
		$error[] = '- Lakukan Void Pembayaran '.$nop.' sudah terdaftar pembayaran';
	}
}
else if ($act == 'bayar')
{
if (trim($_POST['keterangan']) == '') {
		$error[] = '- Keterangan harus diisi !!!';
	}
	if(intval($_POST['pembayaran'] > intval($_POST['kekurangan'])))
	{
		$error[] = '- Pembayaran melebihi nominal sisa pembayaran !!!';
	}

}
if (isset($error)) {
	echo "<img src=\"images/alert.png\" width=\"16\" align=\"left\"/>&nbsp;&nbsp;<b style=\"color:red;\">Error : </b> <br />".implode("<br />", $error);
}else{
	switch($act) {
	case("add"):
	
	mysql_select_db($database_con_gl, $con_gl);		
		$now = strtotime('now');
		$query = "INSERT INTO detailstt (IDCUSTOMER,IDPENERIMA,NOCONNOTE,TGLCONNOTE,TGLMANIFEST,IDSERVICE,IDHANDLING,IDORIGIN,IDDESC,IDTERUSAN,COLLY,WEIGHT,DIM_P,DIM_L,DIM_T,RATE_KIRIM,CHARGE_KIRIM,PPNPERCENT,PPN,INSURANCE,INCURANCEPERCENT,NBARANGINSURANCE,PACKING,NOSMU,COST_SHIPPING,COST_DELIVERY,COST_TRUCKING,COST_WAREHOUSE,COST_RA,COST_SMU,COST_GRDH,COST_FEEMARKETING,COST_REFUNDCUST,SHIPPING,DELIVERY,WAREHOUSE,RA,TRUCKING,GRDH,IDSTATUS,CREATED_BY,CREATED_AT,GUDANG) VALUES ('$_POST[idcustomer]','$_POST[idpenerima]', '$_POST[nostt]', '$_POST[tanggalstt]', '$_POST[tanggalkirim]', '$_POST[idservice]', '$_POST[idhandling]', '$_POST[idorigin]','$_POST[iddestination]', '$_POST[idnextdest]', '$_POST[colly]','$_POST[weight]', '$_POST[panjang]', '$_POST[lebar]', '$_POST[tinggi]', '$_POST[rate]', '$_POST[charge]', '$_POST[ppn]','$_POST[nominalppn]', '$_POST[chargeinsurace]', '$_POST[insurance]','$_POST[chargeinsurace]', '$_POST[chargepacking]','$_POST[nosmu]','$_POST[costshipping]','$_POST[costdelivery]','$_POST[costrucking]','$_POST[costwarehouse]','$_POST[costra]','$_POST[costfreight]','$_POST[costgrdh]','$_POST[feemarketing]',
'$_POST[refundcust]',
'$_POST[agentshipping]','$_POST[agentdelivery]','$_POST[agentwarehouse]','$_POST[agentra]','$_POST[agenttrucking]','$_POST[agentgrdh]','$_POST[statusstt]','$_SESSION[nama]',$now,'$_SESSION[cabang_id]')";
		
		//save email
		//print_r($query);
		//die($query);
		
		
		
		$runquery = mysql_query($query, $con_gl) or die (mysql_error());
		if($runquery) { 
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		}
		

		mysql_select_db($database_con_gl, $con_gl);
 		$customer = mysql_query("SELECT * from customer WHERE IDCUSTOMER = '$_POST[idcustomer]'", $con_gl) or die(mysql_error());
		$row_customer = mysql_fetch_assoc($customer);
		
		mysql_select_db($database_con_gl, $con_gl);
 		$penerima = mysql_query("SELECT * from penerima WHERE IDPENERIMA = '$_POST[idpenerima]'", $con_gl) or die(mysql_error());
		$row_penerima = mysql_fetch_assoc($penerima);
		
//		die($row_customer);

		$mail = new PHPMailer();

		$mail->isSMTP();

		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = 'ssl'; //tls or ssl

		$mail->Host = 'mail.dmxlogistic.com';

		//ssl -> 465; tls -> 587
		$mail->Port = 465;
		$mail->Username = 'noreply@dmxlogistic.com';
		$mail->Password = 'sukses2017';
		$mail->From = 'noreply@dmxlogistic.com';
		$mail->FromName = "DMX LOGISTIC";
		$charge = number_format($_POST['totalsales'],0,',','.').",-";
		/**
		 * konfigurasi email penerima
		 */
		$mail->AddAddress($row_customer['EMAIL'], 'System Reservation');
		$mail->AddAddress($row_penerima['EMAIL'],'System Reservation DMX forward consignee');
		//$mail->AddAddress('bo_bie123@yahoo.com ','Sytem Reservation Bimex forward');
		$mail->AddCC('dmxlogistic@yahoo.com','System Reservation DMX Logistic forward');
		/**
		 * konfigurasi pesan
		 */
		$checkin = date('d F Y', strtotime($_POST['checkin']));
		$checkout = date('d F Y', strtotime($_POST['checkout']));
		
		
		
		$mail->isHTML(true);
		$mail->Subject = 'CONFIRMATION';
		
		$url = "http://localhost/DMXSERVER/proses/mailer.php?asd=$encrypt_no_ref";
		//$url = "http://192.168.112.243/rental/proses/mailer.php/";
		$mail->AddEmbeddedImage('images/m_logo_dmx.png', 'logo', 'images/m_logo_dmx.png');
		$myBody = "<html>";
		$myBody .= "<head>";
		$myBody .= "<title>CONFIRMATION</title>";
		//$myBody .= "<link href=\"button.css\" rel=\"stylesheet\" type=\"text/css\" />";
		$myBody .= "</head>";
		$myBody .= "<body>";
		//$myBody .= ;
		$myBody .= "<table width=\"600\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		$myBody .= "<tr>";
		$myBody .="<td width=\"155\" align=\"left\" valign=\"left\" bgcolor=\"#336699\" style=\"background-color:#FFFFFF; padding:0px; color:#336699;\">";		
		$myBody .="<p>";
		$myBody .="<img src=\"cid:logo\" style=\"display:block;\" width=\"80\" height=\"23\" />www.dmxlogistic.com";
		$myBody .="</p>";
		$myBody .="</td>";
		$myBody .= "<td align=\"center\" valign=\"middle\" bgcolor=\"#336699\" style=\"background-color:#FFFFFF; padding:4px; color:#FFFFFF;\">";
		$myBody .= "</td>";
		$myBody .= "</tr>";
		$myBody .= "</table>
<table width=\"600\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#009900\" style=\"background-color:#009900;\">";
		$myBody .= "<tr>";
		$myBody .= "<td colspan=\"3\" align=\"center\" valign=\"middle\" bgcolor=\"#009900\" style=\"background-color:#009900; padding:4px; color:#fc9600;\">";
		$myBody .= "<div style=\"font-size:14px;\">";
		$myBody .= "<b>CONFIRMATION<b></div>";
		$myBody .= "</td>";
		$myBody .= "</tr>";		
		$myBody .="<tr>";
		$myBody .="<td colspan=\"3\" align=\"left\" valign=\"top\" bgcolor=\"#e7e0b7\" style=\"background-color:#e7e0b7; padding:10px;\">";
		$myBody .="    Dear Customer, Thank you for choosing DMX Logistic as your delivery package partner!<br>This is just to inform you that the following customer has booked our delivery service.";
		$myBody .="<br>Here is your guest reservation information:<br><br>";
		$myBody .="</td>";	
			
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">No Connote";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[nostt]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
	    $myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Date Connote";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[tanggalstt]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		 $myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Date Manifest";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[tanggalkirim]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Customer Name";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$row_customer[NAMACUSTOMER]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Address";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$row_customer[ALAMAT]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Phone";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$row_customer[TELEPON]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
			$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Email";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$row_customer[EMAIL]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Consignee Name";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$row_penerima[NAMAPENERIMA]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Address";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$row_penerima[ALAMAT]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Phone";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$row_penerima[TELEPON]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
			$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Email";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$row_penerima[EMAIL]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Service";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[service]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Handling";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[handling]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Origin";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[origin]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Destination";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[destination]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
    	
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Weight";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[weight]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Colly";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[colly]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Charge";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$charge";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
	    $myBody .="<tr>";
		$myBody .="<td colspan=\"3\" align=\"left\" valign=\"top\" bgcolor=\"#e7e0b7\" style=\"background-color:#e7e0b7; padding:2px;\">";
		
		$myBody .="</td>";
		$myBody .="</tr>";
		
		$myBody .="<tr>";
    	$myBody .="<td colspan=\"3\" align=\"left\" valign=\"top\" bgcolor=\"#e7e0b7\" style=\"background-color:#e7e0b7; padding:2px;\">&nbsp;</td>";
  		$myBody .="<tr>";
        $myBody .="<td colspan=\"3\" align=\"left\" valign=\"top\" bgcolor=\"#e7e0b7\" style=\"background-color:#e7e0b7; padding:2px;\"><strong>PT.Dhiwantara Muda Express (DMX) Logistic </strong></td>";
  		$myBody  .="<tr>";
   		$myBody  .="<td colspan=\"3\" align=\"left\" valign=\"top\" bgcolor=\"#e7e0b7\" style=\"background-color:#e7e0b7; padding:2px;\">Office (62) 022 -  731 0179 / Fax : (62) 022 -  732 0417<br></td>";
  		$myBody .="</tr>";
 		$myBody .="<tr>";
    	$myBody  .="<td colspan=\"3\" align=\"left\" valign=\"top\" bgcolor=\"#e7e0b7\" style=\"background-color:#e7e0b7; padding:2px;\">Jl. Pualam No. 7 Buah Batu - Bandung ,  Bandung, West Java, Indonesia</td>";
        $myBody  .="</tr>";
		
		$myBody .="<tr>";
        $myBody  .="<td colspan=\"3\" align=\"left\" valign=\"top\" bgcolor=\"#e7e0b7\" style=\"background-color:#e7e0b7; padding:2px;\">&nbsp;</td>";
 		$myBody  .="</tr>";
  		$myBody  .="<tr>";
	    $myBody   .="<td colspan=\"3\" align=\"left\" valign=\"top\" bgcolor=\"#e7e0b7\" style=\"background-color:#e7e0b7; padding:2px;\"><small>This e-mail message may  contain confidential or legally privileged information and is intended only for  the use of the intended recipient(s). Any unauthorized disclosure,  dissemination, distribution, copying or the taking of any action in reliance on  the information herein is prohibited. E-mails are not secure and cannot be  guaranteed to be error free as they can be intercepted, amended, or contain  viruses. Anyone who communicates with us by e-mail is deemed to have accepted  these risks. PT.Dhiwantara Muda Express (DMX) Logistic is not responsible for errors or  omissions in this message and denies any responsibility for any damage arising  from the use of e-mail. Any opinion and other statement contained in this  message and any attachment are solely those of the author and do not  necessarily represent those of the company.</small></td></tr>";
		
		
		$myBody .="</tr>";
		$myBody .= "</table>";
		$myBody .= "</body>";
		$myBody .= "</html>";

		$mail->Body = $myBody;
		//$mail->AltBody = $_POST['email_body'];
		//$mail->msgHTML(file_get_contents('mailer.html'), dirname(__FILE__));
		if (!$mail->Send()) {
			$output = json_encode(array("message" => "Mailer Error: " . $mail->ErrorInfo));
			die($output);
			exit;
		}
		
		$output = json_encode(array("message" => "Email telah terkirim.. ".$_POST['txtemail']));
		die($output);
	
	break;
	case("delete"):
	
		$query = "delete from gl_retailtrans where no_ref='$_POST[noreferensi]'";
		$query2 = "delete from gl_detailtrans where no_ref='$_POST[noreferensi]'";
		$query3 = "delete from gl_book where no_ref='$_POST[noreferensi]'";
		// hapus data
		mysql_select_db($database_con_gl, $con_gl);
		$runquery = mysql_query($query, $con_gl);
		if($runquery) { 
			// ---
			mysql_query($query2, $con_gl);
			mysql_query($query3, $con_gl);
			// ---
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil dihapus ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal dihapus !!!";
		}
	break;
	case("bayar"):
		$today = date("Y-m-d"); 
		$gudang = $_POST['gudang'];
		$res = mysql_query("SELECT getARNumber(74) AS result");
		 	if ($res === false) {
				echo mysql_errno().': '.mysql_error();
			}
			while ($obj = mysql_fetch_object($res)) {
		$query = "INSERT INTO gl_pembayaran (no_order,no_ref, no_transaksi, tgl_bayar, jns_pemb, tipe_pemb, pmb_nominal, hold_status,keterangan) VALUES 				                 ('$_POST[no_ref]','$_POST[no_ref]','$obj->result','$today', '$_POST[cr_jenisbayar]','$_POST[cr_tipebayar]','$_POST[pembayaran]','$_SESSION[nama]','$_POST[keterangan]')";
			}
		
		// save data
		mysql_select_db($database_con_gl, $con_gl);
		$runquery = mysql_query($query, $con_gl) or die (mysql_error());
		if($runquery) { 
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";

			echo "<script type=\"text/javascript\">window.opener.location.href='".$url."'; window.close();</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		}
		
		

		
		
	break;
	case("edit"):
		$now = strtotime('now');
			$query = "UPDATE detailstt   SET IDCUSTOMER='$_POST[idcustomer]',IDPENERIMA='$_POST[idpenerima]',NOCONNOTE='$_POST[nostt]',TGLCONNOTE='$_POST[tanggalstt]',TGLMANIFEST='$_POST[tanggalkirim]',IDSERVICE='$_POST[idservice]',IDHANDLING='$_POST[idhandling]',IDORIGIN='$_POST[idorigin]',IDDESC='$_POST[iddestination]',IDTERUSAN='$_POST[idnextdest]',COLLY='$_POST[colly]',WEIGHT='$_POST[weight]',DIM_P='$_POST[panjang]',DIM_L='$_POST[lebar]',DIM_T='$_POST[tinggi]',RATE_KIRIM='$_POST[rate]',CHARGE_KIRIM='$_POST[charge]',PPNPERCENT='$_POST[ppn]',PPN='$_POST[nominalppn]',INSURANCE='$_POST[chargeinsurace]',INCURANCEPERCENT='$_POST[insurance]',NBARANGINSURANCE='$_POST[chargeinsurace]',PACKING='$_POST[chargepacking]',NOSMU='$_POST[nosmu]',FRIGHT='$_POST[agentfright]',COST_SHIPPING='$_POST[costshipping]',COST_DELIVERY='$_POST[costdelivery]',COST_TRUCKING='$_POST[costrucking]',COST_WAREHOUSE='$_POST[costwarehouse]',COST_RA='$_POST[costra]',COST_SMU='$_POST[costfreight]',COST_GRDH='$_POST[costgrdh]',COST_FEEMARKETING='$_POST[feemarketing]',COST_REFUNDCUST='$_POST[refundcust]',SHIPPING='$_POST[agentshipping]',DELIVERY='$_POST[agentdelivery]',WAREHOUSE='$_POST[agentwarehouse]',RA='$_POST[agentra]',TRUCKING='$_POST[agenttrucking]',GRDH='$_POST[agentgrdh]',IDSTATUS='$_POST[statusstt]',UPDATED_BY='$_SESSION[nama]',UPDATED_AT=$now WHERE ID = $_POST[idstt]";
		// die($query);
		$runquery = mysql_query($query, $con_gl) or die (mysql_error());
		if($runquery) { 
			echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil disimpan ...";
			echo "<script type=\"text/javascript\">setTimeout(\"location.href='".$url."'\", 2000);</script>";
		}else{
			echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";
		}


	break;
	default:
		
			
		
	break;
	}
}
?>