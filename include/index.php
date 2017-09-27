<?php 

	error_reporting(0); 
	//session_start(); 

	include('include/function.php');

	

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml"><head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>FMS :: Fleet Management System</title>



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



<script type="text/javascript" src="js/jquery-1.4.js"></script>

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

        	 

             <h1 id="header"><a href="index.php" title="Fleet Management System">

             <!--

             <div id="logo_float">

             	<img src="images/cip_logo.png" style="position:absolute; left:30px; top:30px; width:65px;" />

             </div>

             -->

             

             <div id="logo_float">

             	<img src="images/m_logo.png" />

             </div>

             FMS</a></h1> 

        </div>

        <h3>Fleet Management System</h3>

        

		

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

							<img src='images/m_logo.png' alt='image user'>

						</div>

					";

				?><span>Welcome ,</span> <strong> <?php echo ucfirst($_SESSION[admin]);

				?>

                <!--

                	</strong>&nbsp;&nbsp;  <a id="red" href="logout.php" title="Logout"> [ Logout ]</a> 

				-->

					</div>

                    

				<?php	

				 }else{ ?>&nbsp;<?php }  ?>

  

</div>

<!--

<div id="logo_container"><a href="index.php">

	Index</a>



</div>

-->



<?php if(isset($_SESSION[admin])) { ?>

<div id="navigation">  



<ul class="menuH decor1" style="border:none;">



<?php if(strstr($_SESSION[akses],"A-1") OR strstr($_SESSION[akses],"A-2") OR strstr($_SESSION[akses],"A-4") OR strstr($_SESSION[akses],"PD-7") OR strstr($_SESSION[akses],"A-3") OR strstr($_SESSION[akses],"D-1") OR strstr($_SESSION[akses],"D-2") OR strstr($_SESSION[akses],"D-3") OR strstr($_SESSION[akses],"D-4") OR strstr($_SESSION[akses],"D-5") OR strstr($_SESSION[akses],"PD-3") OR strstr($_SESSION[akses],"PD-4") OR strstr($_SESSION[akses],"PD-5")) { ?>



<li class="root-menu"><a href="#" class="arrow-root">Setting</a>



<ul>



	<?php if(strstr($_SESSION[akses],"A-1")) { ?>



    <li><a href="index.php?component=xx"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Set Username / Password</a></li>



	<?php } ?>



	<?php if(strstr($_SESSION[akses],"A-4")) { ?>



    <li><a href="index.php?component=perusahaan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Tentang Perusahaan</a></li>



	<?php } ?>

    <?php if(strstr($_SESSION[akses],"A-4")) { ?>



    <li><a href="index.php?component=emailblast"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Email Blast</a></li>



	<?php } ?>



    <?php if(strstr($_SESSION[akses],"PD-7") OR strstr($_SESSION[akses],"PD-6")) { ?>



    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Lokasi Kantor</a>



    	<ul>



        <?php if(strstr($_SESSION[akses],"PD-7")) { ?>



        <li><a href="index.php?component=area"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Wilayah/Area</a></li>



		<?php if(strstr($_SESSION[akses],"PD-6")) { ?>



        <li><a href="index.php?component=gudang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Cabang</a></li>



		<?php } ?>



		<?php } ?>





        </ul>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"A-2")) { ?>



    <!--<li><a href="index.php?component=budgeting"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Set Budgeting</a></li>-->



	<?php } ?>



    <?php if(strstr($_SESSION[akses],"A-3") OR strstr($_SESSION[akses],"DD-1")) { ?>



    <!--<li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Manage Akun</a>



    	<ul>



        <?php if(strstr($_SESSION[akses],"A-3")) { ?>



        <li><a href="index.php?component=klasifikasiakun"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Klasifikasi Akun</a></li>



		<?php } ?>



		<?php if(strstr($_SESSION[akses],"DD-1")) { ?>



        <li><a href="index.php?component=akun"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Akun</a></li>



		<?php } ?>



        <?php if(strstr($_SESSION[akses],"DD-2")) { ?>



        <li><a href="index.php?component=gudang&task=setcoa"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Akun Cabang</a></li>



		<?php } ?>



        </ul>



    </li>

-->

    <?php } ?>



    <?php if(strstr($_SESSION[akses],"DD-3") OR strstr($_SESSION[akses],"DD-4") OR strstr($_SESSION[akses],"DD-5")) { ?>

<!--

    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Aset Perusahaan</a>



    	<ul>



        <?php if(strstr($_SESSION[akses],"DD-3")) { ?>



        <li><a href="index.php?component=golonganaset"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Golongan Aset</a></li>



		<?php } ?>



		<?php if(strstr($_SESSION[akses],"DD-4")) { ?>



        <li><a href="index.php?component=asetperusahaan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Aset Tetap Perusahaan</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"DD-5")) { ?>



        <li><a href="index.php?component=penyusutanaset"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Penyusutan Aset Perusahaan</a></li>



		<?php } ?>



        </ul>



    </li>

-->

    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PD-3") OR strstr($_SESSION[akses],"PD-4") OR strstr($_SESSION[akses],"PD-5")) { ?>



    <!--<li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Barang/Jasa/Arsip</a>



    <ul>



    	<?php if(strstr($_SESSION[akses],"PD-4")) { ?>



    	<li><a href="index.php?component=kelompokbarang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Kelompok Barang/Jasa</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"PD-3")) { ?>



        <li><a href="index.php?component=barang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Data Barang/Jasa</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"PD-5")) { ?>



        <li><a href="index.php?component=satuan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Satuan Barang</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"PD-5")) { ?>



        <li><a href="index.php?component=katagoriarsip"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Katagori Arsip</a></li>



        <?php } ?>



    </ul>



    </li>

-->

    <?php } ?>



    <?php if(strstr($_SESSION[akses],"JS-1") OR strstr($_SESSION[akses],"JS-2") OR strstr($_SESSION[akses],"JS-3") OR strstr($_SESSION[akses],"JS-4") OR strstr($_SESSION[akses],"JS-5") OR strstr($_SESSION[akses],"JS-6") OR strstr($_SESSION[akses],"JS-7")) { ?>



    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Kendaraan</a>



    <ul>



    	<?php if(strstr($_SESSION[akses],"JS-5")) { ?>



    	<li><a href="index.php?component=merkkendaraan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Merk Kendaraan</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"JS-6")) { ?>



        <li><a href="index.php?component=tipekendaraan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Tipe Kendaraan</a></li>



        <?php } ?>



    	<?php if(strstr($_SESSION[akses],"JS-7")) { ?>



    	<li><a href="index.php?component=jeniskendaraan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Jenis Kendaraan</a></li>



        <?php } ?>

        <?php if(strstr($_SESSION[akses],"JS-4")) { ?>

		 <li><a href="index.php?component=barang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Paket Sewa</a></li>

<?php } ?>

        <?php if(strstr($_SESSION[akses],"JS-4")) { ?>



        <li><a href="index.php?component=jenisservice"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Paket Harga Sewa</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"JS-3")) { ?>



        <li><a href="index.php?component=jenisbbm"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Jenis BBM</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"JS-2")) { ?>



        <li><a href="index.php?component=status"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Status Kendaraan</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"JS-1")) { ?>

<!--

        <li><a href="index.php?component=jeniskecelakaan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Jenis Kecelakaan</a></li>-->



        <?php } ?>



    </ul>



    </li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"UK-1") OR strstr($_SESSION[akses],"DD-2")) { ?>



    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Karyawan</a>



    <ul>



    	<?php if(strstr($_SESSION[akses],"UK-1")) { ?>



    	<li><a href="index.php?component=unitkerja"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Unit Kerja</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"DD-2")) { ?>



        <li><a href="index.php?component=kontak"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Data Karyawan</a></li>



        <?php } ?>



    </ul>



    </li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"JA-1") OR strstr($_SESSION[akses],"RB-1")) { ?>



    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Rekanan Asuransi</a>



    <ul>



    	<?php if(strstr($_SESSION[akses],"JA-1")) { ?>



    	<li><a href="index.php?component=jenisasuransi"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Jenis Asuransi</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"RB-1")) { ?>



        <li><a href="index.php?component=asuransirekanan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Perusahaan Asuransi</a></li>



        <?php } ?>



    </ul>



    </li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"RB-2")) { ?>



    <li><a href="index.php?component=bengkelrekanan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Master Rekanan Bengkel</a></li>



	<?php } ?>



<!--

    <?php if(strstr($_SESSION[akses],"RB-3")) { ?>



    <li><a href="index.php?component=supplier"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Marter Rekanan Supplier</a></li>



	<?php } ?>

-->

    <li><a href="javascript:void(0);" onclick="opencalcu();"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Kalkulator</a></li>



	<?php if(isset($_SESSION['admin'])) { ?>



    <li><a href="logout.php"><img src="images/alert2.png" align="left" hspace="1" vspace="4" width="18"/>&nbsp;Keluar</a></li>



	<?php } ?>



</ul>



</li>



<?php } ?>



<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Reminder</a>



<ul>



    <li><a href="index.php?component=reminderkontrak"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Kontrak akan Berakhir</a></li>



    <li><a href="index.php?component=reminderstnk"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar STNK akan Berakhir</a></li>



    <li><a href="index.php?component=reminderkir"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar KIR akan Berakhir</a></li>



    <li><a href="index.php?component=reminderasuransi"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Asuransi akan Berakhir</a></li>



    <li><a href="index.php?component=reminderservice"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Service Kendaraan</a></li>



</ul>



</li>





<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Sales</a>



<ul>



    <?php if(strstr($_SESSION[akses],"DD-7")) { ?>

    <li><a href="index.php?component=stockavaibility"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Stock Avaibility</a></li>

    <li><a href="index.php?component=jenisservice"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Harga Paket Sewa</a></li>

    <li><a href="index.php?component=customerretail"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Customer Retail</a></li>



	<?php } ?>



	<?php if(strstr($_SESSION[akses],"DD-8")) { ?>



    <li><a href="index.php?component=customercorporate"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Customer Corporate</a></li>



	<?php } ?>



    <?php if(strstr($_SESSION[akses],"MS-8")) { ?>



    <li><a><a href="index.php?component=masterkendaraan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Stok Kendaraan</a></a></li>



	<?php } ?>



	<?php if(strstr($_SESSION[akses],"PJ-7-1") OR strstr($_SESSION[akses],"PJ-7")) { ?>



    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi Order Retail</a>



	<?php } ?>



    	<ul>



        <?php if(strstr($_SESSION[akses],"PJ-7")) { ?>

        

		<li><a href="index.php?component=sretail&amp;task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi Order</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"PJ-7-1")) { ?>



        <li><a href="index.php?component=sretail"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Transaksi Retail</a></li>



        <?php } ?>



        </ul>



    </li>



<?php if(strstr($_SESSION[akses],"KR-1-1") OR strstr($_SESSION[akses],"KR-1")) { ?>



    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi Order Corporate</a>



<?php } ?>



    	<ul>



        <?php if(strstr($_SESSION[akses],"KR-1-1")) { ?>

        

		<li><a href="index.php?component=kontrak&amp;task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Kontrak Baru</a></li>



        <?php } ?>



        <?php if(strstr($_SESSION[akses],"KR-1")) { ?>



        <li><a href="index.php?component=kontrak"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Kontrak</a></li>



        <?php } ?>



        </ul>



    </li>



    <?php if(strstr($_SESSION[akses],"OI-1")) { ?>



    <li><a href="index.php?component=transaksicheckinout"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Rencana Check OUT/IN</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"L-7")) { ?>



    <!--<li><a href="index.php?component=revenue"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Revenue by Sales</a></li>-->



    <?php } ?>



</ul>



</li>



<?php if(strstr($_SESSION[akses],"PJ-7-1") OR strstr($_SESSION[akses],"PJ-7")) { ?>



<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Operational</a>



<?php } ?>



<ul>



    <?php if(strstr($_SESSION[akses],"MS-8")) { ?>



    <li><a><a href="index.php?component=masterkendaraan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Stok Kendaraan</a></a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PJ-7-1") OR strstr($_SESSION[akses],"PJ-7")) { ?>



    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;DO-Delivery Order Kendanraan</a>





    	<ul>



        	<li><a href="index.php?component=delivery&amp;task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Generated DO</a></li>

			

            <li><a href="index.php?component=delivery"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Print SPJ/BASTK</a></li>



        </ul>



    </li>



    <?php } ?>





    <?php if(strstr($_SESSION[akses],"OI-1-1") OR strstr($_SESSION[akses],"OI-1")) { ?>



    <li><a><a href="index.php?component=transaksicheckinout"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Rencana Check OUT/IN</a></a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"EX-1") OR strstr($_SESSION[akses],"EX-2") OR strstr($_SESSION[akses],"EX-3") OR strstr($_SESSION[akses],"EX-4") OR strstr($_SESSION[akses],"EX-5")) { ?>



     <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi Extend</a>

    

    	<ul>



		<?php if(strstr($_SESSION[akses],"EX-1")) { ?>



        <li><a href="index.php?component=transaksiextendstnk"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;STNK</a></li>



		<?php } ?>



	    <?php if(strstr($_SESSION[akses],"EX-2")) { ?>

		

        <li><a href="index.php?component=transaksiextendasuransi"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Asuransi</a></li>



		<?php } ?>



	    <?php if(strstr($_SESSION[akses],"EX-3")) { ?>



        <li><a href="index.php?component=transaksiextendkir"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;KIR</a></li>



		<?php } ?>



        </ul>



    </li>



	<?php } ?>



    <?php if(strstr($_SESSION[akses],"EX-4")) { ?>



    <li><a href="index.php?component=transaksimutasi"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi Mutasi</a></li>



	<?php } ?>



    <?php if(strstr($_SESSION[akses],"EX-5")) { ?>



    <li><a href="index.php?component=transaksireplacement"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi Replacement</a></li>

	

	<?php } ?>





</ul>



</li>



<?php if(strstr($_SESSION[akses],"PJ-7-1") OR strstr($_SESSION[akses],"PJ-7")) { ?>



<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Kasir</a>



<?php } ?>



<ul>



    <?php if(strstr($_SESSION[akses],"MS-8")) { ?>



    <li><a><a href="index.php?component=sretail"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Invoice Retail</a></a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PJ-7-1") OR strstr($_SESSION[akses],"PJ-7")) { ?>



    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Invoice Kontrak</a>



    <?php } ?>



    	<ul>

<!--

        	<li><a href="index.php?component=kinvoice&amp;task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Generated Invoice</a></li>-->

			

            <li><a href="index.php?component=kinvoice"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Invoice Kontrak</a></li>



        </ul>



    </li>



    <?php if(strstr($_SESSION[akses],"MS-8")) { ?>



    <li><a><a href="index.php?component=delivery"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Print SPJ/BASTK</a></a></li>



    <?php } ?>



   <!-- <li><a href="index.php?component=pembayaranpiutang&task=add"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Pembayaran Piutang</a></li>



    <li><a href="index.php?component=pembayaranpiutang&task"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Pembayaran Piutang</a></li>-->



</ul>



</li>





<?php if(strstr($_SESSION[akses],"DD-6-1") OR strstr($_SESSION[akses],"DD-6") OR strstr($_SESSION[akses],"L-4") OR strstr($_SESSION[akses],"L-6")) { ?>



<!--<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Buku Besar</a>-->



<ul>



	<?php if(strstr($_SESSION[akses],"DD-6-1")) { ?>

<!--

    <li><a><a href="index.php?component=transaksiharian&task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Transaksi Harian</a></a></li>-->



	<?php } ?>



    <?php if(strstr($_SESSION[akses],"DD-6")) { ?>



<!--    <li><a href="index.php?component=transaksiharian"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Transaksi Harian</a></li>-->



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"L-4")) { ?>



    <li><a href="index.php?component=jurnal"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Jurnal</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"L-6")) { ?>



    <li><a href="index.php?component=bukubesar"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Buku Besar</a></li>



    <?php } ?>



</ul>



</li>



<?php } ?>



<?php if(strstr($_SESSION[akses],"KB-2-1") OR strstr($_SESSION[akses],"KB-2") OR strstr($_SESSION[akses],"KB-3-1") OR strstr($_SESSION[akses],"KB-3") OR strstr($_SESSION[akses],"KB-1-1") OR strstr($_SESSION[akses],"KB-1")) { ?>



<!--<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Kas & Bank</a>-->



<ul>



	<?php if(strstr($_SESSION[akses],"KB-2-1")) { ?>



	<li><a href="index.php?component=kasmasuk&task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Kas Masuk</a></li>



	<?php } ?>



    <?php if(strstr($_SESSION[akses],"KB-2")) { ?>



    <li><a href="index.php?component=kasmasuk"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Kas Masuk</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"KB-3-1")) { ?>



    <li><a href="index.php?component=kaskeluar&task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Kas Keluar</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"KB-3")) { ?>



    <li><a href="index.php?component=kaskeluar"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Kas Keluar</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"KB-1-1")) { ?>



    <li><a href="index.php?component=transferkas&task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Transfer Kas</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"KB-1")) { ?>



    <li><a href="index.php?component=transferkas"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Transfer Kas</a></li>



    <?php } ?>



</ul>



</li>



<?php } ?>



<?php if(strstr($_SESSION[akses],"PD-1-1") OR strstr($_SESSION[akses],"PD-1") OR strstr($_SESSION[akses],"PD-2") OR strstr($_SESSION[akses],"PD-6")) { ?>

<!--

<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Persediaan</a>



<ul>



	<?php if(strstr($_SESSION[akses],"PD-1-1")) { ?>



	<li><a href="index.php?component=persediaan&task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Persediaan</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PD-1")) { ?>



    <li><a href="index.php?component=persediaan"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Persediaan</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PD-2")) { ?>



    <li><a href="index.php?component=stokopname"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Stok Barang</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PD-6")) { ?>



    <li><a href="index.php?component=kartustok"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Kartu Stok</a></li>



    <?php } ?>



</ul>



</li>

-->

<?php } ?>



<?php if(strstr($_SESSION[akses],"PB-1-1") OR strstr($_SESSION[akses],"PB-1") OR strstr($_SESSION[akses],"PB-2") OR strstr($_SESSION[akses],"PB-3-1") OR strstr($_SESSION[akses],"PB-3") OR strstr($_SESSION[akses],"PB-4-1") OR strstr($_SESSION[akses],"PB-4") OR strstr($_SESSION[akses],"PB-5") OR strstr($_SESSION[akses],"PB-6")) { ?>

<!--

<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Pembelian</a>



<ul>



	<?php if(strstr($_SESSION[akses],"PB-1-1")) { ?>



	<li><a href="index.php?component=pembelian&task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Pembelian</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PB-1")) { ?>



    <li><a href="index.php?component=pembelian"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Pembelian</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PB-2")) { ?>



    <li><a href="index.php?component=pengirimanbarangpembelian"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Penerimaan Barang</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PB-3-1")) { ?>



    <li><a href="index.php?component=returpembelian&task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Retur Pembelian</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PB-3")) { ?>



    <li><a href="index.php?component=returpembelian"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Retur Pembelian</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PB-4-1")) { ?>



    <li><a href="index.php?component=pembayaranhutang&task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Pembayaran Hutang</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PB-4")) { ?>



    <li><a href="index.php?component=pembayaranhutang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Pembayaran Hutang</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PB-5")) { ?>



    <li><a href="index.php?component=hutang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Hutang Usaha</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PB-6")) { ?>



    <li><a href="index.php?component=kartuhutang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Kartu Hutang Usaha</a></li>



    <?php } ?>



</ul>



</li>

-->

<?php } ?>



<?php if(strstr($_SESSION[akses],"PJ-4-1") OR strstr($_SESSION[akses],"PJ-4") OR strstr($_SESSION[akses],"PJ-5") OR strstr($_SESSION[akses],"PJ-6")) { ?>

<!--

<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Penjualan</a>



<ul>



	<?php if(strstr($_SESSION[akses],"PJ-4-1")) { ?>



    <li><a href="index.php?component=pembayaranpiutang&task=add"><img src="images/add_.png" align="left" hspace="1" vspace="4"/>&nbsp;Pembayaran Piutang</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PJ-4")) { ?>



    <li><a href="index.php?component=pembayaranpiutang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Pembayaran Piutang</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PJ-5")) { ?>



    <li><a href="index.php?component=piutang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Daftar Piutang Usaha</a></li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"PJ-6")) { ?>



    <li><a href="index.php?component=kartupiutang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Kartu Piutang Usaha</a></li>



    <?php } ?>



</ul>



</li>

-->

<?php } ?>



<?php if(strstr($_SESSION[akses],"L-5") OR strstr($_SESSION[akses],"L-1") OR strstr($_SESSION[akses],"L-3") OR strstr($_SESSION[akses],"L-7") OR strstr($_SESSION[akses],"L-8") OR strstr($_SESSION[akses],"L-9")) { ?>



<li class="root-menu"><a href="javascript:void(0);" class="arrow-root">Laporan</a>



<ul>



    <?php if(strstr($_SESSION[akses],"A-3") OR strstr($_SESSION[akses],"D-1")) { ?>



    <!--<li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Laporan Akutansi</a>-->



    	<ul>



  		<?php if(strstr($_SESSION[akses],"L-5")) { ?>



		<li><a href="index.php?component=aruskas"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Arus Kas</a></li>



	    <?php if(strstr($_SESSION[akses],"L-1")) { ?>



	    <li><a href="index.php?component=rugilaba"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Rugi Laba</a></li>



	    <?php } ?>



	    <?php if(strstr($_SESSION[akses],"L-3")) { ?>



	    <li><a href="index.php?component=neraca"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Neraca</a></li>



	    <?php } ?>



		<?php } ?>



        </ul>



    </li>



    <?php } ?>



    <?php if(strstr($_SESSION[akses],"A-3") OR strstr($_SESSION[akses],"D-1")) { ?>



    <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Laporan Operasional</a>



    	<ul>



  		<?php if(strstr($_SESSION[akses],"L-5")) { ?>



		<li><a href="index.php?component=status_unit"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Status Unit TLI</a></li>



	    <?php if(strstr($_SESSION[akses],"L-1")) { ?>



		<li><a href="index.php?component=unit_cabang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Unit Per Cabang</a></li>



	    <?php } ?>



	    <?php if(strstr($_SESSION[akses],"L-3")) { ?>



		<li><a href="index.php?component=jumlah_cabang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Jumlah Cabang</a></li>



	    <?php } ?>



	    <?php if(strstr($_SESSION[akses],"L-7")) { ?>



		<li><a href="index.php?component=unit_tahun"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Data Unit Per Tahun</a></li>

        <?php } ?>



	    <?php if(strstr($_SESSION[akses],"L-7")) { ?>



		<li><a href="index.php?component=efektivitasunit"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Efektivias Unit</a></li>



    	<?php } ?>





		<?php } ?>



        </ul>



    </li>



    <?php } ?>

  <li><a class="arrow"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Laporan Keuangan</a>

  <ul>



  		<?php if(strstr($_SESSION[akses],"L-5")) { ?>



		<li><a href="index.php?component=hasilsewa"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Hasil Sewa </a></li>



	    <?php if(strstr($_SESSION[akses],"L-1")) { ?>



		<li><a href="index.php?component=phasilsewa"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Penerimaan Hasil Sewa </a></li>



	    <?php } ?>



	    <?php if(strstr($_SESSION[akses],"L-3")) { ?>



		<li><a href="index.php?component=xxx"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Analisa Umur Piutang Dagang</a></li>



	    <?php } ?>



	    <?php if(strstr($_SESSION[akses],"L-7")) { ?>



		<li><a href="index.php?component=rekappiutang"><img src="images/invoices.png" align="left" hspace="1" vspace="4"/>&nbsp;Rekapitulasi Piutang Dagang</a></li>



    	<?php } ?>





		<?php } ?>



        </ul>

  </li>

</ul>



</li>



<?php } ?>



<li class="root-menu"><a href="index.php?component=copyright" class="arrow-root">Copyright</a></li>



</ul>



</div>

<!-- running text -->



<!-- end of running text -->





<?php } ?>

<?php } ?>



<div id="content_container">



  <div id="content">



  <?php getBody($_SESSION[admin],$_GET[component],$_GET[task]);?>



  </div>



  <div class="clear" style="margin-bottom:45px;"></div>



</div>



<?php //if(isset($_SESSION[admin])) { ?>



<div id="footer">Copyright &copy; <a href="#" target="_blank">PT. GLOBAL MANDIRI AUTONUSA</a>.  All Rights Reserved.</div>



<?php //} ?>



</body>



</html>