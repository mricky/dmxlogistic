<?php require_once('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"DD-2");
// ---
mysql_select_db($database_con_gl, $con_gl);
$query_getadmin = "SELECT * FROM gl_gudang where id='$_SESSION[lokasi]'";
$getadmin = mysql_query($query_getadmin, $con_gl) or die(mysql_error());
$row_getadmin = mysql_fetch_assoc($getadmin);
$totalRows_getadmin = mysql_num_rows($getadmin);
// ---
mysql_select_db($database_con_gl, $con_gl);
$query_gudang = "SELECT id, gudang FROM gl_gudang";
if(!strstr($_SESSION[akses],'A-1-4')) {
	$query_gudang .= " where id='$_SESSION[lokasi]'";
}
$query_gudang .=" ORDER BY gudang ASC";
$gudang = mysql_query($query_gudang, $con_gl) or die(mysql_error());
$row_gudang = mysql_fetch_assoc($gudang);
$totalRows_gudang = mysql_num_rows($gudang);
// get akun
mysql_select_db($database_con_gl, $con_gl);
$query_noakun = "select a.id, a.akun, b.klasifikasi from gl_akun a, gl_klas b where a.klasifikasi = b.kd AND a.gudang <>'$_SESSION[lokasi]' order by b.klasifikasi, a.akun";
$noakun = mysql_query($query_noakun, $con_gl) or die(mysql_error());
$row_noakun = mysql_fetch_assoc($noakun);
$totalRows_noakun = mysql_num_rows($noakun);
// ---
mysql_select_db($database_con_gl, $con_gl);
$query_ak_1 = "SELECT gl_klas.klasifikasi, gl_akun.id, gl_akun.akun FROM gl_klas, gl_akun WHERE gl_klas.tipe=2 AND gl_akun.klasifikasi = gl_klas.kd AND gl_akun.gudang='$_SESSION[lokasi]' ORDER BY gl_klas.klasifikasi, gl_akun.id";
$ak_1 = mysql_query($query_ak_1, $con_gl) or die(mysql_error());
$row_ak_1 = mysql_fetch_assoc($ak_1);
$totalRows_ak_1 = mysql_num_rows($ak_1);

mysql_select_db($database_con_gl, $con_gl);
$query_ak_2 = "SELECT gl_klas.klasifikasi, gl_akun.id, gl_akun.akun FROM gl_klas, gl_akun WHERE gl_klas.tipe=7 AND gl_akun.klasifikasi = gl_klas.kd AND gl_akun.gudang='$_SESSION[lokasi]' ORDER BY gl_klas.klasifikasi, gl_akun.id";
$ak_2 = mysql_query($query_ak_2, $con_gl) or die(mysql_error());
$row_ak_2 = mysql_fetch_assoc($ak_2);
$totalRows_ak_2 = mysql_num_rows($ak_2);

mysql_select_db($database_con_gl, $con_gl);
$query_ak_3 = "SELECT gl_klas.klasifikasi, gl_akun.id, gl_akun.akun FROM gl_klas, gl_akun WHERE gl_klas.tipe=6 AND gl_akun.klasifikasi = gl_klas.kd AND gl_akun.gudang='$_SESSION[lokasi]' ORDER BY gl_klas.klasifikasi, gl_akun.id";
$ak_3 = mysql_query($query_ak_3, $con_gl) or die(mysql_error());
$row_ak_3 = mysql_fetch_assoc($ak_3);
$totalRows_ak_3 = mysql_num_rows($ak_3);

mysql_select_db($database_con_gl, $con_gl);
$query_ak_4 = "SELECT gl_klas.klasifikasi, gl_akun.id, gl_akun.akun FROM gl_klas, gl_akun WHERE gl_klas.tipe=10 AND gl_akun.klasifikasi = gl_klas.kd AND gl_akun.gudang='$_SESSION[lokasi]' ORDER BY gl_klas.klasifikasi, gl_akun.id";
$ak_4 = mysql_query($query_ak_4, $con_gl) or die(mysql_error());
$row_ak_4 = mysql_fetch_assoc($ak_4);
$totalRows_ak_4 = mysql_num_rows($ak_4);

mysql_select_db($database_con_gl, $con_gl);
$query_ak_5 = "SELECT gl_klas.klasifikasi, gl_akun.id, gl_akun.akun FROM gl_klas, gl_akun WHERE gl_klas.tipe=9 AND gl_akun.klasifikasi = gl_klas.kd AND gl_akun.gudang='$_SESSION[lokasi]' ORDER BY gl_klas.klasifikasi, gl_akun.id";
$ak_5 = mysql_query($query_ak_5, $con_gl) or die(mysql_error());
$row_ak_5 = mysql_fetch_assoc($ak_5);
$totalRows_ak_5 = mysql_num_rows($ak_5);

mysql_select_db($database_con_gl, $con_gl);
$query_ak_6 = "SELECT gl_klas.klasifikasi, gl_akun.id, gl_akun.akun FROM gl_klas, gl_akun WHERE gl_klas.tipe=4 AND gl_akun.klasifikasi = gl_klas.kd AND gl_akun.gudang='$_SESSION[lokasi]' ORDER BY gl_klas.klasifikasi, gl_akun.id";
$ak_6 = mysql_query($query_ak_6, $con_gl) or die(mysql_error());
$row_ak_6 = mysql_fetch_assoc($ak_6);
$totalRows_ak_6 = mysql_num_rows($ak_6);

mysql_select_db($database_con_gl, $con_gl);
$query_ak_7 = "SELECT gl_klas.klasifikasi, gl_akun.id, gl_akun.akun FROM gl_klas, gl_akun WHERE gl_klas.tipe=5 AND gl_akun.klasifikasi = gl_klas.kd AND gl_akun.gudang='$_SESSION[lokasi]' ORDER BY gl_klas.klasifikasi, gl_akun.id";
$ak_7 = mysql_query($query_ak_7, $con_gl) or die(mysql_error());
$row_ak_7 = mysql_fetch_assoc($ak_7);
$totalRows_ak_7 = mysql_num_rows($ak_7);
?>
<script type="text/javascript">
$(document).ready(function() {

	$().ajaxStart(function() {
		$('#loading').show();
		$('#result').hide();
	}).ajaxStop(function() {
		$('#loading').hide();
		$('#result').fadeIn('slow');
	});

	$('#setcoa').submit(function() {
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				$('#result').html(data);
			}
		})
		return false;
	});
  $('#result').click(function(){
  $(this).hide();
  });
})
</script>
<script>
function findAkunCOA() {
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
			var ajaxDisplay = document.getElementById('divAkunCOA');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
		if (ajaxRequest.readyState == 3) {
			var ajaxDisplay = document.getElementById('divAkunCOA');
			ajaxDisplay.innerHTML = "<img src='images/ajax-loader.gif' />";
		}
	}
	var queryString = "?q=" + document.getElementById('q').value;
	ajaxRequest.open("GET", "include/find_akuncoa.php" + queryString, true);
	ajaxRequest.send(null);	
}
</script>
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<h1>Setting Akun Cabang</h1>
<form action="proses/gudang.php?act=setcoa" method="POST" name="setcoa" id="setcoa" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    <tr valign="top">
      <td width="20%" align="right" bgcolor="#FFFFFF">Cabang* : </td>
      <td width="80%" bgcolor="#FFFFFF"><label>
        <select name="gudang" id="gudang">
          <?php
do {  
?>
          <option value="<?php echo $row_gudang['id'];?>" <?php if($row_gudang['id']==$_SESSION['lokasi']) { ?>selected="selected"<?php } ?>><?php echo $row_gudang['gudang']?></option>
          <?php
} while ($row_gudang = mysql_fetch_assoc($gudang));
  $rows = mysql_num_rows($gudang);
  if($rows > 0) {
      mysql_data_seek($gudang, 0);
	  $row_gudang = mysql_fetch_assoc($gudang);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Pencarian Akun :</td>
      <td bgcolor="#FFFFFF"><label>
        <input name="q" type="text" id="q" size="30" maxlength="100" value="Cari Akun ..." onClick="this.value='';" onChange="findAkunCOA();">
        <input type="button" name="button" id="button" value="Cari" onClick="findAkunCOA();">
      </label></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Pilih Akun : </td>
      <td bgcolor="#FFFFFF"><table width="100%" cellpadding="4" cellspacing="0"><tr>
            <th width="4%" align="center">No</th>
            <th width="4%" align="center"><label>
              <input type="checkbox" name="checkbox" value="checkbox" onClick="if(this.checked) { for (i=0;i<<?php echo $totalRows_noakun;?>;i++){document.getElementById('data'+i).checked=true;}}else{ for (i=0;i<<?php echo $totalRows_noakun;?>;i++){document.getElementById('data'+i).checked=false;}}"/>
            </label></th>
            <th width="35%">Klasifikasi</th>
            <th>Nama Akun</th>
          </tr></table><div style="height:200px;overflow:scroll" id="divAkunCOA">
        <table width="100%" border="0" cellspacing="0" cellpadding="4">
          <?php $no = 0; if($totalRows_noakun > 0) { do { ?>
          <tr valign="top">
            <td width="4%" align="right"><?php echo $no+1;?>.</td>
            <td width="4%" align="center"><input name="data[]" type="checkbox" id="data<?php echo $no;?>" value="<?php echo $row_noakun['id'];?>" /></td>
            <td width="35%"><?php echo $row_noakun['klasifikasi'];?></td>
            <td><?php echo $row_noakun['akun'];?></td>
          </tr>
          <?php $no++; }while($row_noakun = mysql_fetch_assoc($noakun)); } ?>
        </table>
      </div></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Kas / Bank : </td>
      <td valign="top" bgcolor="#FFFFFF"><label>
        <select name="kasbank" id="kasbank">
          <option value="" <?php if (!(strcmp("", $row_getadmin['a_kas']))) {echo "selected=\"selected\"";} ?>>Not Set</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ak_1['id']?>"<?php if (!(strcmp($row_ak_1['id'], $row_getadmin['a_kas']))) {echo "selected=\"selected\"";} ?>><?php echo $row_ak_1['id']?> - <?php echo $row_ak_1['akun']?></option>
          <?php
} while ($row_ak_1 = mysql_fetch_assoc($ak_1));
  $rows = mysql_num_rows($ak_1);
  if($rows > 0) {
      mysql_data_seek($ak_1, 0);
	  $row_ak_1 = mysql_fetch_assoc($ak_1);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">HPP : </td>
      <td valign="top" bgcolor="#FFFFFF"><label>
        <select name="hpp" id="hpp">
          <option value="" <?php if (!(strcmp("", $row_getadmin['a_hpp']))) {echo "selected=\"selected\"";} ?>>Not Set</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ak_6['id']?>"<?php if (!(strcmp($row_ak_6['id'], $row_getadmin['a_hpp']))) {echo "selected=\"selected\"";} ?>><?php echo $row_ak_6['id']?> - <?php echo $row_ak_6['akun']?></option>
          <?php
} while ($row_ak_6 = mysql_fetch_assoc($ak_6));
  $rows = mysql_num_rows($ak_6);
  if($rows > 0) {
      mysql_data_seek($ak_6, 0);
	  $row_ak_6 = mysql_fetch_assoc($ak_6);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Pendapatan : </td>
      <td valign="top" bgcolor="#FFFFFF"><label>
        <select name="pendapatan" id="pendapatan">
          <option value="" <?php if (!(strcmp("", $row_getadmin['a_pend']))) {echo "selected=\"selected\"";} ?>>Not Set</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ak_7['id']?>"<?php if (!(strcmp($row_ak_7['id'], $row_getadmin['a_pend']))) {echo "selected=\"selected\"";} ?>><?php echo $row_ak_7['id']?> - <?php echo $row_ak_7['akun']?></option>
          <?php
} while ($row_ak_7 = mysql_fetch_assoc($ak_7));
  $rows = mysql_num_rows($ak_7);
  if($rows > 0) {
      mysql_data_seek($ak_7, 0);
	  $row_ak_7 = mysql_fetch_assoc($ak_7);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Hutang : </td>
      <td valign="top" bgcolor="#FFFFFF"><label>
        <select name="hutang" id="hutang">
          <option value="" <?php if (!(strcmp("", $row_getadmin['a_hut']))) {echo "selected=\"selected\"";} ?>>Not Set</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ak_2['id']?>"<?php if (!(strcmp($row_ak_2['id'], $row_getadmin['a_hut']))) {echo "selected=\"selected\"";} ?>><?php echo $row_ak_2['id']?> - <?php echo $row_ak_2['akun']?></option>
          <?php
} while ($row_ak_2 = mysql_fetch_assoc($ak_2));
  $rows = mysql_num_rows($ak_2);
  if($rows > 0) {
      mysql_data_seek($ak_2, 0);
	  $row_ak_2 = mysql_fetch_assoc($ak_2);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Piutang : </td>
      <td valign="top" bgcolor="#FFFFFF"><label>
        <select name="piutang" id="piutang">
          <option value="" <?php if (!(strcmp("", $row_getadmin['a_piu']))) {echo "selected=\"selected\"";} ?>>Not Set</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ak_3['id']?>"<?php if (!(strcmp($row_ak_3['id'], $row_getadmin['a_piu']))) {echo "selected=\"selected\"";} ?>><?php echo $row_ak_3['id']?> - <?php echo $row_ak_3['akun']?></option>
          <?php
} while ($row_ak_3 = mysql_fetch_assoc($ak_3));
  $rows = mysql_num_rows($ak_3);
  if($rows > 0) {
      mysql_data_seek($ak_3, 0);
	  $row_ak_3 = mysql_fetch_assoc($ak_3);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Beban :</td>
      <td bgcolor="#FFFFFF"><label>
        <select name="beban" id="beban">
          <option value="" <?php if (!(strcmp("", $row_getadmin['a_beb']))) {echo "selected=\"selected\"";} ?>>Not Set</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ak_4['id']?>"<?php if (!(strcmp($row_ak_4['id'], $row_getadmin['a_beb']))) {echo "selected=\"selected\"";} ?>><?php echo $row_ak_4['id']?> - <?php echo $row_ak_4['akun']?></option>
          <?php
} while ($row_ak_4 = mysql_fetch_assoc($ak_4));
  $rows = mysql_num_rows($ak_4);
  if($rows > 0) {
      mysql_data_seek($ak_4, 0);
	  $row_ak_4 = mysql_fetch_assoc($ak_4);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Pajak : </td>
      <td bgcolor="#FFFFFF"><label>
        <select name="pajak" id="pajak">
          <option value="" <?php if (!(strcmp("", $row_getadmin['a_paj']))) {echo "selected=\"selected\"";} ?>>Not Set</option>
          <?php
do {  
?>
          <option value="<?php echo $row_ak_5['id']?>"<?php if (!(strcmp($row_ak_5['id'], $row_getadmin['a_paj']))) {echo "selected=\"selected\"";} ?>><?php echo $row_ak_5['id']?> - <?php echo $row_ak_5['akun']?></option>
          <?php
} while ($row_ak_5 = mysql_fetch_assoc($ak_5));
  $rows = mysql_num_rows($ak_5);
  if($rows > 0) {
      mysql_data_seek($ak_5, 0);
	  $row_ak_5 = mysql_fetch_assoc($ak_5);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi
        
      </em></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="Save" type="submit" id="Save" value="Simpan" />
        </label>
        <label>
          <input type="button" name="Button" value="Batal" onclick="javascript:<?php if($_GET['open']=='window') { ?>window.close(2000);<?php }else{ ?>history.go(-1);<?php } ?>" />
        </label></td>
    </tr>
  </table>
</form>