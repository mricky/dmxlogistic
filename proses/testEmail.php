<?php 
//session_start(); 
require_once('../connections/con_gl.php');require './phpmailer/PHPMailerAutoload.php'; ?>
<?php include('../connections/config.php'); ?>
<?php

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

		/**
		 * konfigurasi email penerima
		 */
		$mail->AddAddress('mricky.it@gmail.com', 'Sytem Reservation');
		$mail->AddAddress('mricky.it@gmail.com','Sytem Reservation Bimex forward');
		//$mail->AddAddress('bo_bie123@yahoo.com ','Sytem Reservation Bimex forward');
		$mail->AddCC('mricky.it@gmail.com','Sytem Reservation Bimex forward');
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
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post No Connote";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
	    $myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Date Connote";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">post date connote";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		 $myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Date Manifest";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">post date manifest".$checkin;
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Customer Name";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post Customer Name";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Address";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post Customer Address";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Phone";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post Customer phone";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
			$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Email";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post Customer Email";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Consignee Name";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post Consignee Name";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Address";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post Consignee Address";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Phone";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post Consignee phone";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
			$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Email";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post Consignee Email";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Service";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">POST SERVICE";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Handling";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">POST Handling";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Origin";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Origin";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Destination";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Post Destination";
	    $myBody .="</td>";
	    $myBody .="</tr>";
    	
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Weight";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[txtpengemudi]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Colly";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[hppengemudi]";
	    $myBody .="</td>";
	    $myBody .="</tr>";
		
		$myBody .="<tr>";
		$myBody .="<td width=\"202\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">Charge";					
		$myBody .= "</td>";
   	    $myBody .="<td width=\"15\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">:";
		$myBody .="</td>";
   	    $myBody .="<td width=\"379\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\" style=\"background-color:#e7e0b7; padding:2px;\">$_POST[transaksi]";
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

?>