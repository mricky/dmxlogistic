function cekAkun(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('akunDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('akunDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	//var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id;

	ajaxRequest.open("GET", "include/getakun.php" + queryString, true);

	ajaxRequest.send(null); 

}



function cekKode(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('kodeDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('kodeDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	//var noref = document.getElementById('noreferensi').value;

	var ref_kode = act;

	var queryString = "?kode=" + ref_kode;

	ajaxRequest.open("GET", "include/getkode.php" + queryString, true);

	ajaxRequest.send(null); 

}



function cekReferensi(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('refDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('refDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	//var noref = document.getElementById('noreferensi').value;

	var ref_kode = act;

	var queryString = "?ref=" + ref_kode;

	ajaxRequest.open("GET", "include/getreferensi.php" + queryString, true);

	ajaxRequest.send(null); 

}

<!-- 

//Browser Support Code

function ajaxManageTransaksi(act,val){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var kred = document.getElementById('kredit').value;

	var ak = document.getElementById('akun').value;

	var deb = document.getElementById('debet').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&debet=" + deb + "&akun=" + ak + "&kredit=" + kred + "&transaksi=" + trans + "&noreferensi=" + noref + "&value=" + valw;

	ajaxRequest.open("GET", "include/manage_trans.php" + queryString, true);

	ajaxRequest.send(null); 

}



//-->



function ajaxEditForm(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var refid = document.getElementById('idtrans').value;

	var rul = act;

	var queryString = "?rules=" + rul + "&noreferensi=" + noref + "&id=" + refid;

	ajaxRequest.open("GET", "include/edit_trans.php" + queryString, true);

	ajaxRequest.send(null); 

}



function setKeterangan(val) {

var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divKeterangan');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divKeterangan');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var tipes = val;

	var queryString = "?kontak=" + tipes;

	ajaxRequest.open("GET", "include/set_keterangan.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxManageKasmasuk(act,val){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var nil = document.getElementById('nilai').value;

	var ak = document.getElementById('akun').value;

	//var tot = document.getElementById('total').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&akun=" + ak + "&nilai=" + nil + "&transaksi=" + trans + "&noreferensi=" + noref + "&value=" + valw;

	ajaxRequest.open("GET", "include/manage_kasmasuk.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxEditFormKasmasuk(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id + "&noreferensi=" + noref;

	ajaxRequest.open("GET", "include/edit_formkasmasuk.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxManageKaskeluar(act,val){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var nil = document.getElementById('nilai').value;

	var ak = document.getElementById('akun').value;

	//var tot = document.getElementById('total').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&akun=" + ak + "&nilai=" + nil + "&transaksi=" + trans + "&noreferensi=" + noref + "&value=" + valw;

	ajaxRequest.open("GET", "include/manage_kaskeluar.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxEditFormKaskeluar(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id + "&noreferensi=" + noref;

	ajaxRequest.open("GET", "include/edit_formkaskeluar.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxManagePenyesuaian(act,val){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var ak = document.getElementById('akun').value;

	var brg = document.getElementById('barang').value;

	var sat = document.getElementById('satuan').value;

	var hrgsat = document.getElementById('hargasatuan').value;

	var gud = document.getElementById('gudang').value;

	var jum = document.getElementById('jumlah').value;

	var tot = document.getElementById('total').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&akun=" + ak + "&transaksi=" + trans + "&total=" + tot + "&noreferensi=" + noref + "&value=" + valw + "&barang=" + brg + "&satuan=" + sat + "&hargasatuan=" + hrgsat + "&gudang=" + gud + "&jumlah=" + jum;

	ajaxRequest.open("GET", "include/manage_persediaan.php" + queryString, true);

	ajaxRequest.send(null); 

}



//-->



function ajaxEditFormPenyesuaian(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id + "&noreferensi=" + noref;

	ajaxRequest.open("GET", "include/edit_formpersediaan.php" + queryString, true);

	ajaxRequest.send(null); 

}



function cektipetrans(vale) {

var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('tipetrans');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('tipetrans');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var tipes = vale;

	var k_page = document.getElementById('page').value;

	var queryString = "?tipe=" + tipes + "&page=" + k_page;

	ajaxRequest.open("GET", "include/cek_tipetrans.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxManagePembelian(act,val){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var ak = document.getElementById('akun').value;

	var brg = document.getElementById('barang').value;

	var sat = document.getElementById('satuan').value;

	var hrgsat = document.getElementById('hargasatuan').value;

	var gud = document.getElementById('gudang').value;

	var jum = document.getElementById('jumlah').value;

	var tot = document.getElementById('total').value;

	var disk = document.getElementById('diskon').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&akun=" + ak + "&transaksi=" + trans + "&total=" + tot + "&noreferensi=" + noref + "&value=" + valw + "&barang=" + brg + "&satuan=" + sat + "&hargasatuan=" + hrgsat + "&gudang=" + gud + "&jumlah=" + jum + "&diskon=" + disk;

	ajaxRequest.open("GET", "include/manage_pembelian.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxEditFormPembelian(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id + "&noreferensi=" + noref;

	ajaxRequest.open("GET", "include/edit_formpembelian.php" + queryString, true);

	ajaxRequest.send(null); 

}



function cekReturPembelianAvailable(){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('boxRetur');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('boxRetur');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	//var noref = document.getElementById('noreferensi').value;

	var gud = document.getElementById('gudang').value;

	var kont = document.getElementById('dari').value;

	var brg = document.getElementById('barang').value;

	var sat = document.getElementById('satuan').value;

	var queryString = "?gudang=" + gud + "&kontak=" + kont + "&barang=" + brg + "&satuan=" + sat;

	ajaxRequest.open("GET", "include/addcek_retur.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxManageReturPembelian(act,val) {

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var ak = document.getElementById('akun').value;

	var brg = document.getElementById('barang').value;

	var sat = document.getElementById('satuan').value;

	var hrgsat = document.getElementById('hargasatuan').value;

	var gud = document.getElementById('gudang').value;

	var jum = document.getElementById('jumlah').value;

	var tot = document.getElementById('total').value;

	var disk = document.getElementById('diskon').value;

	var r_ref = document.getElementById('xx_ref').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&akun=" + ak + "&transaksi=" + trans + "&total=" + tot + "&noreferensi=" + noref + "&value=" + valw + "&barang=" + brg + "&satuan=" + sat + "&hargasatuan=" + hrgsat + "&gudang=" + gud + "&jumlah=" + jum + "&diskon=" + disk + "&retur_ref=" + r_ref;

	ajaxRequest.open("GET", "include/manage_returpembelian.php" + queryString, true);

	ajaxRequest.send(null); 	

}



function ajaxEditFormReturPembelian(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id + "&noreferensi=" + noref;

	ajaxRequest.open("GET", "include/edit_formreturpembelian.php" + queryString, true);

	ajaxRequest.send(null); 

}



function hitungHutang(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divTotal');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divTotal');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	//var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?invoice=" + ref_id;

	ajaxRequest.open("GET", "include/get_hutang.php" + queryString, true);

	ajaxRequest.send(null); 

}



function hitungPiutang(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divTotal');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divTotal');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	//var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?invoice=" + ref_id;

	ajaxRequest.open("GET", "include/get_piutang.php" + queryString, true);

	ajaxRequest.send(null); 

}



function setInvoice(val) {

var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divInvoice');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divInvoice');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var tipes = val;

	var queryString = "?kontak=" + tipes;

	ajaxRequest.open("GET", "include/set_invoice.php" + queryString, true);

	ajaxRequest.send(null); 

}



function setInvoice2(val) {

var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divInvoice');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divInvoice');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var tipes = val;

	var queryString = "?kontak=" + tipes;

	ajaxRequest.open("GET", "include/set_invoice2.php" + queryString, true);

	ajaxRequest.send(null); 

}



function setTransaksi(val) {

var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divTransaksi');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divTransaksi');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var tipes = val;

	var queryString = "?invoice=" + tipes;

	ajaxRequest.open("GET", "include/set_transaksi.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxManagePembayaranHutang(act,val){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var nil = document.getElementById('nilai').value;

	var inv = document.getElementById('invoice').value;

	var kpd = document.getElementById('kepada').value;

	var ak = document.getElementById('akunkas').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&invoice=" + inv + "&nilai=" + nil + "&transaksi=" + trans + "&noreferensi=" + noref + "&value=" + valw + "&kontak=" + kpd + "&akun=" + ak;

	ajaxRequest.open("GET", "include/manage_pembhutang.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxEditFormPembayaranHutang(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var kont = document.getElementById('kepada').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id + "&noreferensi=" + noref + "&kontak=" + kont;

	ajaxRequest.open("GET", "include/edit_formpembhutang.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxEditFormPembayaranPiutang(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var kont = document.getElementById('kepada').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id + "&noreferensi=" + noref + "&kontak=" + kont;

	ajaxRequest.open("GET", "include/edit_formpembpiutang.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxManagePembayaranPiutang(act,val){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var nil = document.getElementById('nilai').value;

	var inv = document.getElementById('invoice').value;

	var kpd = document.getElementById('kepada').value;

	var ak = document.getElementById('akunkas').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&invoice=" + inv + "&nilai=" + nil + "&transaksi=" + trans + "&noreferensi=" + noref + "&value=" + valw + "&kontak=" + kpd + "&akun=" + ak;

	ajaxRequest.open("GET", "include/manage_pembpiutang.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxManagePenjualan(act,val){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var tsk = document.getElementById('tsk').value;

	var brg = document.getElementById('barang').value;

	var ken = document.getElementById('kendaraan').value;

	var sat = document.getElementById('satuan').value;

	var hrgsat = document.getElementById('hargasatuan').value;

	var gud = document.getElementById('gudang').value;

	var jum = document.getElementById('jumlah').value;

	var tot = document.getElementById('total').value;

	var disk = document.getElementById('diskon').value;

	var kont = document.getElementById('cid').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&transaksi=" + trans + "&total=" + tot + "&noreferensi=" + noref + "&value=" + valw + "&barang=" + brg + "&kendaraan=" + ken + "&satuan=" + sat + "&hargasatuan=" + hrgsat + "&gudang=" + gud + "&jumlah=" + jum + "&diskon=" + disk + "&agen=" + kont + "&task=" + tsk;

	ajaxRequest.open("GET", "include/manage_penjualan.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxEditFormPenjualan(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id + "&noreferensi=" + noref;

	ajaxRequest.open("GET", "include/edit_formpenjualan.php" + queryString, true);

	ajaxRequest.send(null); 

}



function cekReturPenjualanAvailable(){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('boxRetur');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('boxRetur');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	//var noref = document.getElementById('noreferensi').value;

	var gud = document.getElementById('gudang').value;

	var kont = document.getElementById('dari').value;

	var brg = document.getElementById('barang').value;

	var sat = document.getElementById('satuan').value;

	var queryString = "?gudang=" + gud + "&kontak=" + kont + "&barang=" + brg + "&satuan=" + sat;

	ajaxRequest.open("GET", "include/addcek_retur2.php" + queryString, true);

	ajaxRequest.send(null); 

}



function ajaxManageReturPenjualan(act,val) {

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var trans = document.getElementById('transaksi').value;

	var ak = document.getElementById('akun').value;

	var brg = document.getElementById('barang').value;

	var sat = document.getElementById('satuan').value;

	var hrgsat = document.getElementById('hargasatuan').value;

	var gud = document.getElementById('gudang').value;

	var jum = document.getElementById('jumlah').value;

	var tot = document.getElementById('total').value;

	var disk = document.getElementById('diskon').value;

	var r_ref = document.getElementById('xx_ref').value;

	var rul = act;

	var valw = val;

	var queryString = "?rules=" + rul + "&akun=" + ak + "&transaksi=" + trans + "&total=" + tot + "&noreferensi=" + noref + "&value=" + valw + "&barang=" + brg + "&satuan=" + sat + "&hargasatuan=" + hrgsat + "&gudang=" + gud + "&jumlah=" + jum + "&diskon=" + disk + "&retur_ref=" + r_ref;

	ajaxRequest.open("GET", "include/manage_returpenjualan.php" + queryString, true);

	ajaxRequest.send(null); 	

}



function ajaxEditFormReturPenjualan(act){

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var noref = document.getElementById('noreferensi').value;

	var ref_id = act;

	var queryString = "?refid=" + ref_id + "&noreferensi=" + noref;

	ajaxRequest.open("GET", "include/edit_formreturpenjualan.php" + queryString, true);

	ajaxRequest.send(null); 

}



function setDP(val) {

var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('boxDP');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('boxDP');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var tipes = val;

	var queryString = "?ref=" + tipes;

	ajaxRequest.open("GET", "include/set_dp.php" + queryString, true);

	ajaxRequest.send(null); 

}

// ---

function getListKendaraan() {

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divListKendaraan');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divListKendaraan');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var bar = document.getElementById('barang').value;

	var queryString = "?bid=" + bar;

	ajaxRequest.open("GET", "include/get_listkendaraan.php" + queryString, true);

	ajaxRequest.send(null);

}

function getListCabang() {

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divListCabang');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divListCabang');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var bar = document.getElementById('area').value;

	var queryString = "?bid=" + bar;

	ajaxRequest.open("GET", "include/get_listcabang.php" + queryString, true);

	ajaxRequest.send(null);

}

function getHargaKendaraan(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('divHargaKendaraan');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
			document.getElementById('hargaafterppn').value=document.getElementById('hargasatuan').value * (document.getElementById('ppn').value/100);
			document.getElementById('hargaafterpph').value=document.getElementById('hargasatuan').value * (document.getElementById('pph').value/100);
		}
		if (ajaxRequest.readyState == 3) {
			var ajaxDisplay = document.getElementById('divHargaKendaraan');
			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";
		}
	}
	var bar = document.getElementById('barang').value;
	var ken = document.getElementById('kendaraan').value;
	var jum = document.getElementById('jumlah').value;
	var queryString = "?kid=" + ken + "&barang=" + bar + "&jumlah=" + jum;
	ajaxRequest.open("GET", "include/get_hargakendaraan.php" + queryString, true);
	ajaxRequest.send(null);
}

function getTotal(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('divHargaTotal');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
		if (ajaxRequest.readyState == 3) {
			var ajaxDisplay = document.getElementById('divHargaTotal');
			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";
		}
	}
	var bar = document.getElementById('barang').value;
	var ken = document.getElementById('kendaraan').value;
	var jum = document.getElementById('jumlah').value;
	var queryString = "?kid=" + ken + "&barang=" + bar + "&jumlah=" + jum;
	ajaxRequest.open("GET", "include/get_hargatotal.php" + queryString, true);
	ajaxRequest.send(null);
}

function getGrandTotal(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('divHargaGrandTotal');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
		if (ajaxRequest.readyState == 3) {
			var ajaxDisplay = document.getElementById('divHargaGrandTotal');
			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";
		}
	}
	var bar = document.getElementById('barang').value;
	var ken = document.getElementById('kendaraan').value;
	var jum = document.getElementById('jumlah').value;
	var diskon = document.getElementById('diskon').value;
	var ppn = document.getElementById('ppn').value;
	var pph = document.getElementById('pph').value;
	//var pph = document.getElementById('pph').value;
	var uangmuka = document.getElementById('uangmuka').value;
	var queryString = "?kid=" + ken + "&barang=" + bar + "&jumlah=" + jum + "&diskon=" + diskon + "&ppn=" + ppn + "&pph=" + pph +"&uangmuka=" + uangmuka;
	ajaxRequest.open("GET", "include/get_hargagrandtotal.php" + queryString, true);
	ajaxRequest.send(null);
}

// ---

function ajaxManageMasterBarang(act,xid) {

	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divMasterBarang');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divMasterBarang');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var bar = document.getElementById('barang').value;

	var jen = document.getElementById('id').value;
	
	var area = document.getElementById('area').value;
	
	var hse = document.getElementById('harga').value;
	
	var spr = document.getElementById('supir').value;
	
	var bbm = document.getElementById('bbm').value;
	
	var tol = document.getElementById('tol').value;
	
	var par = document.getElementById('parkir').value;
	
	var ako = document.getElementById('akomodasi').value;
	
	var oth = document.getElementById('other').value;

	var queryString = "?act=" + act + '&brg=' + bar + '&rid=' + xid + '&area=' + area + '&jenis=' + jen + '&hargasewa=' + hse + '&supir=' + spr + '&bbm=' + bbm + '&tol=' + tol + '&parkir=' + par + '&akomodasi=' + ako + '&other=' + oth;

	ajaxRequest.open("GET", "include/manage_masterbarang.php" + queryString, true);

	ajaxRequest.send(null);

}
//---
function browseKontak(tip) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divKontak');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divKontak');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var qtx = document.getElementById('qtxt').value;

	var queryString = "?tipe=" + tip + '&q=' + qtx;

	ajaxRequest.open("GET", "include/browse_kontak.php" + queryString, true);

	ajaxRequest.send(null);
}
//---
function getDetailCustomer(cid) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divDetail');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divDetail');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var ccc = cid;

	var queryString = "?cid=" + ccc;

	ajaxRequest.open("GET", "include/get_detailcustomer.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function getBiayaBBM() {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divBBM');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divBBM');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var bar = document.getElementById('barang').value;

	var ken = document.getElementById('kendaraan').value;

	var queryString = "?kid=" + ken + "&barang=" + bar;

	ajaxRequest.open("GET", "include/get_biayabbm.php" + queryString, true);

	ajaxRequest.send(null);
}

function bikinAjax(){
	if(window.ActiveXObject){
		try{
			return new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			return new ActiveXObject("Msxml2.XMLHTTP");
		}
	}
	else if(window.XMLHttpRequest){
		return new XMLHttpRequest();
	}
}

var xmlhttp = bikinAjax();
function kirimRequest(halaman, parameter, konten, komponen){
	var obj = window.document.getElementById(konten);
	obj.innerHTML = "<font color='green'><blink>Loading...</blink></font>";
	if(xmlhttp.readyState==4 || xmlhttp.readyState==0){
		xmlhttp.open('POST', halaman, true);
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				if(komponen=='div') obj.innerHTML=parseScript(xmlhttp.responseText);
				else obj.value=parseScript(xmlhttp.responseText);
			}
		}
		xmlhttp.send(parameter);
	}
}

function parseScript(_source)
{
		var source = _source;
		var scripts = new Array();
		
		while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
			var s = source.indexOf("<script");
			var s_e = source.indexOf(">", s);
			var e = source.indexOf("</script", s);
			var e_e = source.indexOf(">", e);
 
			scripts.push(source.substring(s_e+1, e));
			source = source.substring(0, s) + source.substring(e_e+1);
		}
 
		for(var i=0; i<scripts.length; i++) {
			try {
				eval(scripts[i]);
			}
			catch(ex) {
				// do what you want here when a script fails
			}
		}
		// Return the cleaned source
		return source;
}

// ---
function getBiayaTol() {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divTol');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divTol');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var bar = document.getElementById('barang').value;

	var ken = document.getElementById('kendaraan').value;

	var queryString = "?kid=" + ken + "&barang=" + bar;

	ajaxRequest.open("GET", "include/get_biayatol.php" + queryString, true);

	ajaxRequest.send(null);
}
//---
function getBiayaParkir() {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divParkir');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divParkir');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var bar = document.getElementById('barang').value;

	var ken = document.getElementById('kendaraan').value;

	var queryString = "?kid=" + ken + "&barang=" + bar;

	ajaxRequest.open("GET", "include/get_biayaparkir.php" + queryString, true);

	ajaxRequest.send(null);
}
//---
function getBiayaSupir() {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divSupir');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divSupir');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var bar = document.getElementById('barang').value;

	var ken = document.getElementById('kendaraan').value;

	var queryString = "?kid=" + ken + "&barang=" + bar;

	ajaxRequest.open("GET", "include/get_biayasupir.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function getBiayaAkomodasi() {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divAkomodasi');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divAkomodasi');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var bar = document.getElementById('barang').value;

	var ken = document.getElementById('kendaraan').value;

	var queryString = "?kid=" + ken + "&barang=" + bar;

	ajaxRequest.open("GET", "include/get_biayaakomodasi.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function getBiayaOther() {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divOther');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divOther');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var bar = document.getElementById('barang').value;

	var ken = document.getElementById('kendaraan').value;

	var queryString = "?kid=" + ken + "&barang=" + bar;

	ajaxRequest.open("GET", "include/get_biayaother.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function genAkhirKontrak() {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divAkhirKontrak');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divAkhirKontrak');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var dur = document.getElementById('durasi').value;

	var awl = document.getElementById('awal').value;

	var queryString = "?awal=" + awl + "&durasi=" + dur;

	ajaxRequest.open("GET", "include/gen_akhirkontrak.php" + queryString, true);

	ajaxRequest.send(null);
}
//---
function findKendaraan(qx) { 
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divListKendaraan');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divListKendaraan');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}

	var queryString = "?q=" + qx;

	ajaxRequest.open("GET", "include/find_kendaraan.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function ajaxSetKendaraan(act,rid) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var kon = document.getElementById('noreferensi').value;
	var ken = document.getElementById('kendaraan').value;
	var har = document.getElementById('hargasatuan').value;
	var dis = document.getElementById('diskon').value;
	var bia = document.getElementById('biaya').value;
	var tot = document.getElementById('total').value;
	var tra = document.getElementById('transaksi').value;
	var queryString = "?action=" + act + "&rid=" + rid + "&kontrak=" + kon + "&kendaraan=" + ken + "&harga=" + har + "&biaya=" + bia + "&diskon=" + dis + "&total=" + tot + "&transaksi=" + tra;

	ajaxRequest.open("GET", "include/set_kendaraan.php" + queryString, true);

	ajaxRequest.send(null);
}

// ---
function genTglKontrak(kr) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divTanggal');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divTanggal');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?kontrak=" + kr;

	ajaxRequest.open("GET", "include/gen_tglkontrak.php" + queryString, true);

	ajaxRequest.send(null);	
}
//---
function genperiodebyr(kr) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divPeriode');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divPeriode');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?kontrak=" + kr;

	ajaxRequest.open("GET", "include/gen_periodebyr.php" + queryString, true);

	ajaxRequest.send(null);	
}

// ---
function genCabangKontrak(kr) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divCabang');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divCabang');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?kontrak=" + kr;

	ajaxRequest.open("GET", "include/gen_cabangkontrak.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function genCustomerKontrak(kr) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divKontak');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divKontak');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?kontrak=" + kr;

	ajaxRequest.open("GET", "include/gen_customerkontrak.php" + queryString, true);

	ajaxRequest.send(null);
}
//---
function genKeteranganKontrak(kr) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divKeterangan');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divKeterangan');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?kontrak=" + kr;

	ajaxRequest.open("GET", "include/gen_keterangankontrak.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function genSKendaraanKontrak(kr) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('ajaxDiv');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?kontrak=" + kr;

	ajaxRequest.open("GET", "include/gen_skendaraankontrak.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function getAvalaibleKendaraan(ty,text,nor,rep) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divKendaraan');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divKendaraan');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?q=" + text + "&t=" + ty + "&noref=" + nor + "&replace=" + rep;

	ajaxRequest.open("GET", "include/get_availablekendaraan.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function genNoRefOrder(tg) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divOrder');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divOrder');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?tgl=" + tg;

	ajaxRequest.open("GET", "include/gen_noreforder.php" + queryString, true);

	ajaxRequest.send(null);
}
// ---
function genAreaKontrak(ko) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divArea');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divArea');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?kontrak=" + ko;

	ajaxRequest.open("GET", "include/gen_areakontrak.php" + queryString, true);

	ajaxRequest.send(null);	
}
// ---
function getKelompokBarang(lok) {
var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divKelompokBarang');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divKelompokBarang');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?lokasi=" + lok;

	ajaxRequest.open("GET", "include/get_kelompokbarang.php" + queryString, true);

	ajaxRequest.send(null);
}
// --
function getDefAkun(lok) {
var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divDefAkun');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divDefAkun');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?lokasi=" + lok;

	ajaxRequest.open("GET", "include/get_defakun.php" + queryString, true);

	ajaxRequest.send(null);	
}
// --  check deposit
function checkDeposit(kon) {
	var ajaxRequest;  // The variable that makes Ajax possible!

	

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser broke!");

				return false;

			}

		}

	}

	// Create a function that will receive data sent from the server

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var ajaxDisplay = document.getElementById('divDeposit');

			ajaxDisplay.innerHTML = ajaxRequest.responseText;

		}

		if (ajaxRequest.readyState == 3) {

			var ajaxDisplay = document.getElementById('divDeposit');

			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";

		}

	}
	var queryString = "?kontak=" + kon;

	ajaxRequest.open("GET", "include/check_deposit.php" + queryString, true);

	ajaxRequest.send(null);	
}
