function opencalcu() {
	window.open('calculator.php','calculator','height=300,width=500');
}

var menu1=new Array()
menu1[0]='<a href="index.php?component=user">Set Username / Password</a>'
menu1[1]='<a href="index.php?component=perusahaan">Tentang Perusahaan</a>'
menu1[2]='<a href="index.php?component=klasifikasiakun" style="border-bottom:solid 1px white;">Klasifikasi Akun</a>'
menu1[3]='<a href="#" onclick="opencalcu();">Kalkulator</a>'
menu1[4]='<a href="logout.php">Keluar</a>'

var menu2=new Array()
menu2[0]='<a href="index.php?component=akun">Daftar Akun</a>'
menu2[1]='<a href="index.php?component=kontak" style="border-bottom:solid 1px white;">Daftar Kontak</a>'
menu2[2]='<a href="index.php?component=golonganaset">Golongan Aset</a>'
menu2[3]='<a href="index.php?component=asetperusahaan">Aset Tetap Perusahaan</a>'
menu2[4]='<a href="index.php?component=penyusutanaset">Penyusutan Aset Perusahaan</a>'

var menu3=new Array()
menu3[0]='<a href="index.php?component=transaksiharian&task=add">Input Transaksi Harian</a>'
menu3[1]='<a href="index.php?component=transaksiharian" style="border-bottom:solid 1px white;">Daftar Transaksi Harian</a>'
menu3[2]='<a href="index.php?component=jurnal">Daftar Jurnal</a>'
menu3[3]='<a href="index.php?component=bukubesar">Daftar Buku Besar</a>'

var menu4=new Array()
menu4[0]='<a href="index.php?component=kasmasuk&task=add">Input Kas Masuk</a>'
menu4[1]='<a href="index.php?component=kasmasuk" style="border-bottom:solid 1px white;">Daftar Kas Masuk</a>'
menu4[2]='<a href="index.php?component=kaskeluar&task=add">Input Kas Keluar</a>'
menu4[3]='<a href="index.php?component=kaskeluar" style="border-bottom:solid 1px white;">Daftar Kas Keluar</a>'
menu4[4]='<a href="index.php?component=transferkas&task=add">Input Transfer Kas</a>'
menu4[5]='<a href="index.php?component=transferkas">Daftar Transfer Kas</a>'

var menu5=new Array()
menu5[0]='<a href="index.php?component=persediaan&task=add">Input Persediaan</a>'
menu5[1]='<a href="index.php?component=persediaan" style="border-bottom:solid 1px white;">Daftar Persediaan</a>'
menu5[2]='<a href="index.php?component=stokopname" style="border-bottom:solid 1px white;">Stok Opname</a>'
menu5[3]='<a href="index.php?component=barang">Daftar Barang</a>'
menu5[4]='<a href="index.php?component=kelompokbarang">Daftar Kelompok Barang</a>'
menu5[5]='<a href="index.php?component=satuan">Daftar Satuan</a>'
menu5[6]='<a href="index.php?component=kartustok" style="border-bottom:solid 1px white;">Kartu Stok</a>'
menu5[7]='<a href="index.php?component=gudang">Daftar Gudang</a>'

var menu6=new Array()
menu6[0]='<a href="index.php?component=pembelian&task=add">Input Pembelian</a>'
menu6[1]='<a href="index.php?component=pembelian" style="border-bottom:solid 1px white;">Daftar Pembelian</a>'
<!--menu6[2]='<a href="index.php?component=pengirimanbarangpembelian&task=add">Input Pengiriman Barang</a>'-->
menu6[3]='<a href="index.php?component=pengirimanbarangpembelian" style="border-bottom:solid 1px white;">Daftar Pengiriman Barang</a>'
menu6[4]='<a href="index.php?component=returpembelian&task=add">Input Retur Pembelian</a>'
menu6[5]='<a href="index.php?component=returpembelian" style="border-bottom:solid 1px white;">Daftar Retur Pembelian</a>'
menu6[6]='<a href="index.php?component=pembayaranhutang&task=add">Input Pembayaran Hutang</a>'
menu6[7]='<a href="index.php?component=pembayaranhutang" style="border-bottom:solid 1px white;">Daftar Pembayaran Hutang</a>'
menu6[8]='<a href="index.php?component=hutang">Daftar Hutang Usaha</a>'
menu6[9]='<a href="index.php?component=kartuhutang">Kartu Hutang Usaha</a>'

var menu7=new Array()
menu7[0]='<a href="index.php?component=penjualan&task=add">Input Penjualan</a>'
menu7[1]='<a href="index.php?component=penjualan" style="border-bottom:solid 1px white;">Daftar Penjualan</a>'
<!--menu7[2]='<a href="index.php?component=pengirimanbarangpenjualan&task=add">Input Pengiriman Barang</a>'-->
menu7[3]='<a href="index.php?component=pengirimanbarangpenjualan" style="border-bottom:solid 1px white;">Daftar Pengiriman Barang</a>'
menu7[4]='<a href="index.php?component=returpenjualan&task=add">Input Retur Penjualan</a>'
menu7[5]='<a href="index.php?component=returpenjualan" style="border-bottom:solid 1px white;">Daftar Retur Penjualan</a>'
menu7[6]='<a href="index.php?component=pembayaranpiutang&task=add">Input Pembayaran Piutang</a>'
menu7[7]='<a href="index.php?component=pembayaranpiutang" style="border-bottom:solid 1px white;">Daftar Pembayaran Piutang</a>'
menu7[8]='<a href="index.php?component=piutang">Daftar Piutang Usaha</a>'
menu7[9]='<a href="index.php?component=kartupiutang">Kartu Piutang Usaha</a>'

var menu8=new Array()
menu8[0]='<a href="index.php?component=aruskas">Arus Kas</a>'
menu8[1]='<a href="index.php?component=rugilaba">Rugi Laba</a>'
menu8[2]='<a href="index.php?component=neraca" style="border-bottom:solid 1px white;">Neraca</a>'
/*menu8[3]='<a href="index.php?component=transaksiharian&task=cetak">Cetak Transaksi Harian</a>'
menu8[4]='<a href="index.php?component=jurnal&task=cetak">Cetak Jurnal</a>'
menu8[5]='<a href="index.php?component=bukubesar&task=cetak" style="border-bottom:solid 1px white;">Cetak Buku Besar</a>'*/
menu8[3]='<a href="index.php?component=rekap_penjualan">Rekap Penjualan</a>'
menu8[4]='<a href="index.php?component=rekap_iklan">Rekap Iklan</a>'

var menu9=new Array()
menu9[0]='<a href="#" target="_blank">Documentation</a>'

var menuwidth='170px' //default menu width
var menubgcolor='#E7EDF4'  //menu bgcolor
var disappeardelay=250  //menu disappear speed onMouseout (in miliseconds)
var hidemenu_onclick="yes" //hide menu when user clicks within menu?

var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="dropmenudiv" style="visibility:hidden;width:'+menuwidth+';background-color:'+menubgcolor+'" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}


function showhide(obj, e, visible, hidden, menuwidth){
if (ie4||ns6)
dropmenuobj.style.left=dropmenuobj.style.top="-500px"
if (menuwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=menuwidth
}
if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
obj.visibility=visible
else if (e.type=="click")
obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth
}
else{
var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move up?
edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight
if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either?
edgeoffset=dropmenuobj.y+obj.offsetHeight-topedge
}
}
return edgeoffset
}

function populatemenu(what){
if (ie4||ns6)
dropmenuobj.innerHTML=what.join("")
}


function dropdownmenu(obj, e, menucontents, menuwidth){
if (window.event) event.cancelBubble=true
else if (e.stopPropagation) e.stopPropagation()
clearhidemenu()
dropmenuobj=document.getElementById? document.getElementById("dropmenudiv") : dropmenudiv
populatemenu(menucontents)

if (ie4||ns6){
showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth)

dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px"
}

return clickreturnvalue()
}

function clickreturnvalue(){
if (ie4||ns6) return false
else return true
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function dynamichide(e){
if (ie4&&!dropmenuobj.contains(e.toElement))
delayhidemenu()
else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhidemenu()
}

function hidemenu(e){
if (typeof dropmenuobj!="undefined"){
if (ie4||ns6)
dropmenuobj.style.visibility="hidden"
}
}

function delayhidemenu(){
if (ie4||ns6)
delayhide=setTimeout("hidemenu()",disappeardelay)
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}

if (hidemenu_onclick=="yes")
document.onclick=hidemenu