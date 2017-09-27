<?php
//message
$message = $_POST['msg'];
//mail body - image position, background, font color, font size...
$body ='<html>
<head>
<style>
body
{
background: #fff;
font-family: "lucida grande", tahoma, verdana;
font-size:16px;
font-weight: bold;
color: #fff;
}
.content{
overflow:hidden;
background-color: #336699;
margin: 10px;
padding:10px;
}
</style>
</head>
<body>
<div class="content">
<h1>My HTML Mail</h1>
'.$message.'<br />
<img src="http://phpform.net/images/contact2.png" /><br />
</div>
</body>';
//to send HTML mail, the Content-type header must be set:
$headers='MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html;charset=iso-8859-1' . "\r\n";
$headers .= 'From: System Admin <noreply@example.com>' . "\r\n";
$to = $_POST['to'];
$subject = "My HTML Mail";
//mail function
$mail = mail($to, $subject, $body, $headers);
require './proses/phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer();

		$mail->isSMTP();

		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = 'ssl'; //tls or ssl
	
		$mail->Host = 'motoravecarrental.com';

		
		$mail->Port = 465;

		$mail->Username = 'reservation@motoravecarrental.com';
		$mail->Password = 'carrent2015';
		$mail->From = 'reservation@motoravecarrental.com';
		$mail->FromName = "MOTORAVE RENTAL";

		/**
		 * konfigurasi email penerima
		 */
		$mail->AddAddress('mricky.it@gmail.com', 'Dery');
		$mail->AddCC('mricky.it@gmail.com','Dede');
		/**
		 * konfigurasi pesan
		 */
		$checkin = date('d F Y', strtotime($_POST['checkin']));
		$checkout = date('d F Y', strtotime($_POST['checkout']));
		
				
		$mail->isHTML(true);
		$mail->Subject = 'BOOM ... ! PROMO RENTAL HARGA MURAH';
		
		$url = "http://www.motoravecarrental.com/fms-sys/proses/mailer.php?asd=$encrypt_no_ref";
		//$url = "http://192.168.112.243/rental/proses/mailer.php/";
		$mail->AddEmbeddedImage('http://www.motoravecarrental.com/fms-sys/promo_bandung.jpg', 'button', 'http://www.motoravecarrental.com/fms-sys/promo_bandung.jpg');
		$myBody = "<html>";
		$myBody .= "<head>";
		$myBody .= "<title>MRENT PROMO</title>";
		//$myBody .= "<link href=\"button.css\" rel=\"stylesheet\" type=\"text/css\" />";
		$myBody .= "</head>";
		$myBody .= "<body>";
		$myBody .= "<table width=\"600\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		$myBody .= "<tr>";
		$myBody .= "<td align=\"center\" valign=\"middle\" bgcolor=\"#000000\" style=\"background-color:#000000; padding:20px; color:#ffffff;\">";
		$myBody .= "<div style=\"font-size:24px;\">MOTORAVE CAR RENT</div>";
		$myBody .= "</td>";
		//$myBody .= "<td align=\"right\" valign=\"top\"><img src=\"cid:logoimg\" width=\"197\" height=\"182\" style=\"display:block;\"></td>";
		$myBody .= "</tr>";
		$myBody .= "</table>";
		$myBody .= "<table width=\"600\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#971800\" style=\"background-color:#971800;\">";
		$myBody .=  "<tr>";
		$myBody .= 		"<td align=\"center\" valign=\"middle\" bgcolor=\"#971800\" style=\"background-color:#971800; padding:4px; color:#fc9600;\">";
		$myBody .= 		"<div style=\"font-size:14px;\"><b>PROMO BULAN JUNI<b></div>";
		$myBody .= 		"</td>";
		$myBody .=	"</tr>";
		$myBody .=	"<tr>";
		$myBody .=	"<td align=\"left\" valign=\"top\" bgcolor=\"#e7e0b7\" style=\"background-color:#e7e0b7; padding:20px;\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" style=\"margin-bottom:10px;\">";
		$myBody .=		"<div style=\"font-size:14px; color:#000000;\">";
		$myBody .=		"Dear MOTORAVE CAR RENTAL Customer, Thank you for choosing MOTORAVE CAR RENTAL as your booking partner! <br><br> This is just to inform you that the following customer has booked a car. <br><br>
						Here is your guest reservation information:</div><br>";
		$myBody .=		"<hr align=\"center\"><br>";
		$myBody .=		"<div style=\"font-size:14px;  color:#000000\"> ";
		$myBody .=		"<pre><font face =\"Arial\"><b>Guest Name</b>		: $_POST[qtxt] </font></pre>
						<pre><font face =\"Arial\"><b>Phone</b> 			: $row_customer[tlp] </font></pre> 
						<pre><font face =\"Arial\"><b>Car Name</b> 		: $_POST[kendaraan] </font></pre>
						<pre><font face =\"Arial\"><b>Service Type</b>		: $_POST[txtbarang] </font></pre>
						<pre><font face =\"Arial\"><b>Pick Up</b>			: $checkin </font></pre>
						<pre><font face =\"Arial\"><b>Drop Off</b> 			: $checkout </font></pre>
						<pre><font face =\"Arial\"><b>Regional Area </b>	: $_POST[txtcabang] </font></pre>
						<pre><font face =\"Arial\"><b>Pick Up Detail</b>	 	: $_POST[transaksi] </font></pre></div><br>";
		
		$myBody .=		"<hr align=\"center\"><br>";
		$myBody .=		"<div style=\"font-size:14px; color:#000000;\">";
		$myBody .=		"Please confirm that you have received this booking by click submit button below..</div><br>";
		$myBody .= 	 	"<div align=\"center\" ><a href=\"$url\"><img src=\"cid:button\" style=\"display:block;\"></a></div>";
		
		$myBody .= 	 	"</td>";
		$myBody .= 	  "</tr>";
		$myBody .= 	  "</table>";
		
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

if(!$mail) {   
     echo "Error sending email";   
} else {
    echo "Your email was sent successfully.";
}
?>