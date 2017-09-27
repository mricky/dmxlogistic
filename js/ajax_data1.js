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

// ---

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

//---

function getHargaKendaraan() {

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
	
	var hse = document.getElementById('harga').value;
	
	var spr = document.getElementById('supir').value;
	
	var bbm = document.getElementById('bbm').value;
	
	var tol = document.getElementById('tol').value;
	
	var par = document.getElementById('parkir').value;
	
	var ako = document.getElementById('akomodasi').value;
	
	var oth = document.getElementById('other').value;

	var queryString = "?act=" + act + '&brg=' + bar + '&rid=' + xid + '&jenis=' + jen + '&hargasewa=' + hse + '&supir=' + spr + '&bbm=' + bbm + '&tol=' + tol + '&parkir=' + par + '&akomodasi=' + ako + '&other=' + oth;

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