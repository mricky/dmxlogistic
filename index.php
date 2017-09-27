<?php 

	error_reporting(0); 
    session_start(); 
	include('include/function.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Backend :: DMX Logistic</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menu_style.css" rel="stylesheet" type="text/css" />
<link href="css/ui.all.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<?php if($_GET['open']=='window') { ?>

<style>

body, #topnav {

	background:none;	

}

</style>

<?php } ?>



<link rel="Shortcut Icon" type="image/x-icon" href="images/favicon.ico">



<script type="text/javascript" src="js/jquery.js"></script>



<script type="text/javascript" src="js/jqueryui.js"></script>



<!--<script type="text/javascript" src="js/adminmenu.js"></script>-->



<script type="text/javascript" src="js/jquery.min.js"></script>



<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>



<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>



<!--<script type="text/javascript" src="js/jquery-1.4.js"></script>-->

<script type="text/javascript" src="js/jquery.autocomplete.js"></script>



        <style type="text/css">	

		

		#running_text{

			width:100%;

			display:block;

			margin:2px auto;

			}

			.marquee_header{

				margin-left:0.5%;

				float:left;

				display:block;

				width: 6%;

			  	padding:5px 0 5px 1%;

			  	

				overflow: hidden;

			  	border:2px solid #FC0;

			  	background:#F8F8F8;

			  	color:#FFF;

				-moz-border-radius: 10px 10px 10px 10px;

				border-radius: 10px 0px 0px 10px;

				font-weight:bold;

				font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;

			}

			.marquee-with-options {

			  display:block;

			  width: 90%;

			  padding-left:1%;

			  padding-right:1%;

			  padding-bottom:4px;

			  padding-top:4px;

			  overflow: hidden;

			  border-right:1px solid #FC0;

			  border-top:2px solid #FC0;

			  border-bottom:2px solid #FC0;

			  background:rgba(0,0,0,0.7);

			  color:#FFF;

			  font-size:11px;

			  font-family:Arial, Helvetica, sans-serif;

			}

			.marquee-with-options .berita{

				margin: 0px 50px 0px 0px;

			}

			 .berita img{

				margin: 0px 0px 0px 5px;

			}

			.berita_waktu{

				color:#FF0;

				margin-right:5px;

				

			}

		</style>

        

        <!-- end of javascript running text -->

<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>

<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script type="text/javascript">



	$(document).ready(function() {



		$('.ask').jConfirmAction();

		$("#test").fancybox({

				'width'				: '75%',

				'height'			: '75%',

				'autoScale'			: false,

				'transitionIn'		: 'none',

				'transitionOut'		: 'none',

				'type'				: 'iframe'

			});



	});



	$(function(){



		// striped table



		$(".tableform tr:nth-child(even)").addClass("rowhighlight");
		$("form table tr:nth-child(even)").addClass("rowhighlight");
		$(".datatable tr:nth-child(even)").addClass("rowhighlight");
		$("form table tr:nth-child(even)").addClass("rowhighlight");



   });



	jQuery(function($){



   		$("#ip").mask("999.99.999.999 / 999.99.999.999");
		$(".jam").mask("99:99");	
		$(".nkontrak").mask("999/AA/AAA/Corp-BDP/AA/9999");


   });

   

   function number_format(number,decimals,dec_point,thousands_sep){number=(number+'').replace(/[^0-9+\-Ee.]/g, '');var n=!isFinite(+number)?0:+number,prec=!isFinite(+decimals)?0:Math.abs(decimals),sep=(typeof thousands_sep ==='undefined')?',':thousands_sep,dec = (typeof dec_point === 'undefined')?'.':dec_point,s='',toFixedFix=function(n,prec){var k=Math.pow(10,prec);return ''+Math.round(n*k)/k;};/*Fix for IE parseFloat(0.55).toFixed(0) = 0;*/s= (prec?toFixedFix(n,prec):''+Math.round(n)).split('.');if (s[0].length>3){s[0]=s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,sep);}if ((s[1] || '').length<prec){s[1]=s[1] || '';s[1]+=new Array(prec-s[1].length+1).join('0');}return s.join(dec);}

   function terbilang(bilangan){if(isNaN(bilangan))bilangan=0;bilangan=String(bilangan);var angka=new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');var kata=new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');var tingkat=new Array('','Ribu','Juta','Milyar','Triliun');var panjang_bilangan=bilangan.length;if(panjang_bilangan>15){kaLimat="Diluar Batas";return kaLimat;}for(i=1;i<=panjang_bilangan;i++){angka[i]=bilangan.substr(-(i),1);}i=1;j=0;kaLimat="";while(i<=panjang_bilangan){subkaLimat="";kata1="";kata2="";kata3="";if(angka[i+2]!="0"){if(angka[i+2]=="1"){kata1="Seratus";}else{kata1=kata[angka[i+2]]+" Ratus";}}if(angka[i+1]!="0"){if(angka[i+1]=="1"){if (angka[i]=="0"){kata2="Sepuluh";}else if(angka[i]=="1"){kata2="Sebelas";}else{kata2=kata[angka[i]]+" Belas";}}else{kata2=kata[angka[i+1]]+" Puluh";}}if(angka[i]!="0"){if(angka[i+1]!="1"){kata3=kata[angka[i]];}}if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){subkaLimat=kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";}kaLimat=subkaLimat+kaLimat;i=i+3;j=j+1;}if((angka[5]=="0") && (angka[6] == "0")){kaLimat=kaLimat.replace("Satu Ribu","Seribu");}return kaLimat;}



</script>



<SCRIPT language=JavaScript>



var win = null;



function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable,menubar=yes'
win = window.open(mypage,myname,settings)
}



</SCRIPT>



<?php include('js/menu_js.php');?>



<style media="print">



body {



	background:#FFFFFF;



}



.hide, #mynotes, #topnav, #welcome, #logo_container, #navigation, #box-exportdata, #footer {



	display:none;



}



</style>



</head>



<body>

<!--

<div id="mynotes"><textarea id="mynotesbox" rows="15" cols="80">FMS :: Fleet Management System</textarea><br /><input type="button" value="Save" id="savenotes" /></div>

-->



<?php 

 

if(empty($_GET['open'])) { ?>

<div id= "top_header">

        <div id="date">

        	<img src="images/time_26.png" width="12" />&nbsp; <?php  echo  date("l - d M Y");  ?>        

        </div>

</div> 

<div id="header"> 

        <div class="header_title">

        	 

             <h1 id="header"><a href="index.php" title="Backend DMX">                     

             

             <div id="logo_float">

             	<img src="images/truck_express.png" />

             </div>

             DMX</a></h1> 

        </div>

        <h3>Sistem Informasi Management Logistic</h3>

        

		

           <?php  if(isset($_SESSION[admin])) {

		      ?>

              		<a href="logout.php" title="logout">

			  		<div class='header_logout'>

						<div class='img_user'>

							<img src='images/logout_48.png' alt='image user'>

						</div>

						<br />

                        <span style="text-align:center; display:block">LOGOUT</span> 

                    </div>

                    </a>

              <?php  	

			  echo "<div class='header_user'>";		 

				echo "

						<div class='img_user'>

							<img src='images/m_person.png' alt='image user'>

						</div>

					";

				?><span>Welcome ,</span> <strong> <?php echo ucfirst($_SESSION[admin]);

				?>


					</div>

                    

				<?php	

				 }else{ ?>&nbsp;<?php }  ?>

  

</div>

<?php if(isset($_SESSION[admin])) { ?>

<div id="navigation">  



<ul class="menuH decor1" style="border:none;">



<?php if(strstr($_SESSION[akses],"A-1") OR strstr($_SESSION[akses],"A-2") OR strstr($_SESSION[akses],"A-4") OR strstr($_SESSION[akses],"PD-7") OR strstr($_SESSION[akses],"A-3") OR strstr($_SESSION[akses],"D-1") OR strstr($_SESSION[akses],"D-2") OR strstr($_SESSION[akses],"D-3") OR strstr($_SESSION[akses],"D-4") OR strstr($_SESSION[akses],"D-5") OR strstr($_SESSION[akses],"PD-3") OR strstr($_SESSION[akses],"PD-4") OR strstr($_SESSION[akses],"PD-5")) { ?>



<li class="root-menu"><a href="#" class="arrow-root">Setting</a>


<ul>



	<?php if(strstr($_SESSION[akses],"A-1")) { ?>



    <!--<li><a href="index.php?component=xx"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Set Username / Password</a></li>-->



	<?php } ?>



	<?php if(strstr($_SESSION[akses],"A-4")) { ?>



    <!--<li><a href=""><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Tentang Perusahaan</a></li>-->

    <?php } ?>

   
     <?php if(strstr($_SESSION[akses],"JS-1") OR strstr($_SESSION[akses],"JS-2") OR strstr($_SESSION[akses],"JS-3") OR strstr($_SESSION[akses],"JS-4") OR strstr($_SESSION[akses],"JS-5") OR strstr($_SESSION[akses],"JS-6") OR strstr($_SESSION[akses],"JS-7")) { ?>


     <?php if($_SESSION[unitkerja] != 4) { ?>
    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Customer</a>
    <ul>
    	
    	<li><a href="index.php?component=customer"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Customer</a></li>
        	<li><a href="index.php?component=consignee"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Consignee</a></li>		      	
        
        <li><a href="index.php?component=kota"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Kota</a></li>
       
      </ul>
    </li>
     <?php } ?>
    <?php } ?>
  <?php if($_SESSION[unitkerja] != 4) { ?>
    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Karyawan</a>
    <ul>
  	
   	<li><a href="index.php?component=unitkerja"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Unit Kerja</a></li>

    

        
        <li><a href="index.php?component=kontak"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Data Karyawan</a></li>
       
    </ul>
    </li>
    
    <?php } ?>
    <?php if($_SESSION[unitkerja] != 4) { ?>
    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Agent</a>
    <ul>
    	
    	<li><a href="index.php?component=agent&amp;idhandling=5"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Agent Maskapai</a></li>
       
        <li><a href="index.php?component=agent&amp;idhandling=1"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Agent Shipping</a></li>
       
        <li><a href="index.php?component=agent&amp;idhandling=7"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Agent Trucking</a></li>
     
        <li><a href="index.php?component=agent&amp;idhandling=2"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Agent Delivery</a></li>
      
        <li><a href="index.php?component=agent&amp;idhandling=4"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Agent RA</a></li>
       
        <li><a href="index.php?component=agent&amp;idhandling=6"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Agent GRDH</a></li>
     
        <li><a href="index.php?component=agent&amp;idhandling=3"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Agent Warehouse</a></li>
       
        
    </ul>
    </li>
    <?php } ?>
    <?php if($_SESSION[unitkerja] != 4) { ?>
    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Kode Kota</a>
    <ul>
    	
    	<li><a href="index.php?component=kota"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Kota</a></li>     
        <li><a href="index.php?component=terusan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Terusan</a></li>      
        
    </ul>
    </li>
    <?php } ?>
  


<?php if($_SESSION[unitkerja] != 4) { ?>

    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Tarif</a>
    <ul>
   	
  	<li><a href="index.php?component=tarif"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Tarif</a></li>


       <li><a href="index.php?component=tariflayanan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Layanan</a></li>
 	<li><a href="index.php?component=paket"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Jenis Paket</a></li>
    <li><a href="index.php?component=satuan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Satuan</a></li>


    </ul>
    </li>
    <?php } ?>
    <li><a href="javascript:void(0);" onclick="opencalcu();"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Kalkulator</a></li>
	<?php if(isset($_SESSION['admin'])) { ?>
    <li><a href="logout.php"><img src="images/alert2.png" align="left" hspace="1" vspace="4" width="18"/>&nbsp;Keluar</a></li>
	<?php } ?>
</ul>
</li>
<?php } ?>
<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Orders</a>
<ul>
 <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi STT</a>
         <ul>
         <li><a href="index.php?component=stt&amp;task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi STT</a></li>
          
          <li><a href="index.php?component=stt"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Transaksi STT</a></li>
          <?php if($_SESSION[unitkerja] != 4) { ?>
           <li><a href="index.php?component=biayastt"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Biaya STT</a></li>
           <?php } ?>
 </ul>

 </li>
 <li><a href="index.php?component=tracking"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Tracking STT</a></li>
</ul>

</li>


<?php if($_SESSION['unitkerja'] != 4) { ?>
<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Keuangan</a>
<?php } ?>
<ul>
    <?php if(strstr($_SESSION[akses],"MS-8")) { ?>
     <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Pembayaran Piutang</a>
         <ul>
         <li><a href="index.php?component=invoice&amp;task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi Invoice</a></li>
          <li><a href="index.php?component=invoice"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Invoice</a></li>
           <li><a href="index.php?component=piutang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Piutang STT</a></li>
             <li><a href="index.php?component=void"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Void Penerimaan Uang</a></li>
 </ul>
 
 </li>
    <?php } ?>
     <?php if(strstr($_SESSION[akses],"MS-8")) { ?>
    <li><a><a href="index.php?component=tagihan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Pembayaran Biaya</a></a></li>
    <?php } ?>
     <?php if(strstr($_SESSION[akses],"MS-8")) { ?>
    <?php } ?>

</ul>
</li>
<ul>
</li> 
 </ul>
</li>
<?php if(strstr($_SESSION[akses],"DD-6-1") OR strstr($_SESSION[akses],"DD-6") OR strstr($_SESSION[akses],"L-4") OR strstr($_SESSION[akses],"L-6")) { ?>
<ul>
</ul>
</li>
<?php } ?>
<?php if(strstr($_SESSION[akses],"KB-2-1") OR strstr($_SESSION[akses],"KB-2") OR strstr($_SESSION[akses],"KB-3-1") OR strstr($_SESSION[akses],"KB-3") OR strstr($_SESSION[akses],"KB-1-1") OR strstr($_SESSION[akses],"KB-1")) { ?>
<ul>
</ul>
</li>
<?php } ?>


<?php if(strstr($_SESSION[akses],"PB-1-1") OR strstr($_SESSION[akses],"PB-1") OR strstr($_SESSION[akses],"PB-2") OR strstr($_SESSION[akses],"PB-3-1") OR strstr($_SESSION[akses],"PB-3") OR strstr($_SESSION[akses],"PB-4-1") OR strstr($_SESSION[akses],"PB-4") OR strstr($_SESSION[akses],"PB-5") OR strstr($_SESSION[akses],"PB-6")) { ?>

<?php } ?>



<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Reporting</a>
<ul>
  <li><a href="index.php?component=reportSTT"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Report  STT</a></li>
   
   <li><a href="index.php?component=reportSales"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Report  Sales</a></li>
      <?php if($_SESSION['unitkerja'] == 3 || $_SESSION['unitkerja'] == 5 || $_SESSION['unitkerja'] == 1) { ?><li><a href="index.php?component=reportCost"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Report  Cost STT</a></li><?php }?>
    <?php if($_SESSION['unitkerja'] == 1 || $_SESSION['unitkerja'] == 3) { ?><li><a href="index.php?component=reportProfit"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Report Profit</a></li><?php }?>
    <?php if($_SESSION['unitkerja'] == 2 || $_SESSION['unitkerja'] == 3 || $_SESSION['unitkerja'] == 3) { ?><li><a href="index.php?component=reportPiutangSTT"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Report Piutang STT</a></li><?php }?>
    <?php if($_SESSION['unitkerja'] == 2 || $_SESSION['unitkerja'] == 3 || $_SESSION['unitkerja'] == 3) { ?> <li><a href="index.php?component=reportPiutangInvoice"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Report Piutang Invoice</a></li><?php }?>
</ul>

</li>



<li class="root-menu"><a href="index.php?component=copyright" class="arrow-root">Copyright</a></li>



</ul>



</div>
<?php } ?>

<?php } ?>



<div id="content_container">



  <div id="content">



  <?php getBody($_SESSION[admin],$_GET[component],$_GET[task]);?>



  </div>



  <div class="clear" style="margin-bottom:45px;"></div>



</div>



<?php //if(isset($_SESSION[admin])) { ?>

<div id="footer">Copyright &copy; <a href="#" target="_blank">www.gavindosoft.com</a>.  All Rights Reserved.</div>
<?php //} ?>

</body>
</html>