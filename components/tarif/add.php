<?php require_once('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"MS-8-1");

mysql_select_db($database_con_gl, $con_gl);
$query_layanan = "SELECT layanan_paket_id, layanan_paket_nama FROM layanan_paket";
$item_layanan = mysql_query($query_layanan, $con_gl) or die(mysql_error());
$row_layanan = mysql_fetch_assoc($item_layanan);
$totalRows_layanan = mysql_num_rows($item_layanan);
// Shape
mysql_select_db($database_con_gl, $con_gl);
$query_jenis = "SELECT jenis_paket_id, jenis_paket_name FROM jenis_paket";
$item_jenis = mysql_query($query_jenis, $con_gl) or die(mysql_error());
$row_jenis = mysql_fetch_assoc($item_jenis);
$totalRows_jenis = mysql_num_rows($item_jenis);

// satuan
mysql_select_db($database_con_gl, $con_gl);
$query_satuan = "SELECT SATUAN_ID, NAMASATUAN FROM satuan";
$item_satuan = mysql_query($query_satuan, $con_gl) or die(mysql_error());
$row_satuan = mysql_fetch_assoc($item_satuan);
$totalRows_satuan = mysql_num_rows($item_satuan);


?>





<link href="ccss/ui.datepicker.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript">
<!--
$(function()
      {
        $('.calendar').datepicker({
            appendText : "",
            dateFormat : 'yy/mm/dd'
          });
      });
	  
</script>
<script type="text/javascript" src="js/ajax_data.js"></script>
<script type="text/javascript">

$(document).ready(function() {

	$().ajaxStart(function() {
		$('#loading').show();
		$('#result').hide();
	}).ajaxStop(function() {
		$('#loading').hide();
		$('#result').fadeIn('slow');
	});

	$('#add').submit(function() {
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


<style type="text/css">
<!--
.ed {border-style:solid;
border-width:thin;
border-color:#00CCFF;
padding:5px;
margin-bottom: 4px;
}
-->
</style>
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<h1>New Tarif</h1>
<form action="proses/tarif.php?act=add" method="POST" name="add" id="add" >
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
    
    
    
    
    <tr valign="top">
      <td width="15%" align="right" bgcolor="#FFFFFF">Layanan</td>
       <td width="85%" bgcolor="#FFFFFF"><select name="layananpaket" id="layananpaket" style="width:100px;">
         <?php
do {  
?>
         <option value="<?php echo $row_layanan['layanan_paket_id']?>"><?php echo $row_layanan['layanan_paket_nama']?></option>
         <?php
} while ($row_layanan = mysql_fetch_assoc($item_layanan));
  $row_layanan = mysql_num_rows($item_layanan);
  if($row_layanan > 0) {
      mysql_data_seek($row_layanan, 0);
	  $row_gem = mysql_fetch_assoc($row_layanan);
  }
?>
       </select></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF"> Jenis :</td>
      <td bgcolor="#FFFFFF">
        <!-- Added by suwondo -->
        <select name="jenispaket" id="jenispaket" style="width:100px;">
          <?php
do {  
?>
          <option value="<?php echo $row_jenis['jenis_paket_id']?>"><?php echo $row_jenis['jenis_paket_name']?></option>
          <?php
} while ($row_jenis = mysql_fetch_assoc($item_jenis));
  $rows_jenis = mysql_num_rows($item_jenis);
  if($rows_jenis > 0) {
      mysql_data_seek($item_jenis, 0);
	  $row_jenis = mysql_fetch_assoc($item_jenis);
  }
?>
        </select></td>
    </tr>
    
    
    
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Kota Asal</td>
      <td valign="right"><span style="background:none;border:none;">
        <input type="hidden" name="idorigin" id="idorigin" size="2" />
        <input type="text" name="origin" id="origin" size="25" placeholder="Kota Asal" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onclick="NewWindow('index.php?component=tarif&amp;task=listOrigin&amp;open=window','name','825','450','yes');return false" />
      </span></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Kota Tujuan</td>
      <td valign="right"><span style="background:none;border:none;">
        <input type="hidden" name="iddestination" id="iddestination" size="2" />
        <input type="text" name="destination" id="destination" size="25" placeholder="Kota Tujuan" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onclick="NewWindow('index.php?component=tarif&amp;task=listDestination&amp;open=window','name','825','450','yes');return false" />
      </span></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Tarif</td>
      <td valign="right"><input name="tarif" type="text" id="tarif" value="0" size="30" maxlength="100" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';"/></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Satuan</td>
      <td valign="right"><select name="satuan" id="satuan" style="width:100px;">
        <?php
do {  
?>
        <option value="<?php echo $row_satuan['SATUAN_ID']?>"><?php echo $row_satuan['NAMASATUAN']?></option>
        <?php
} while ($row_satuan = mysql_fetch_assoc($item_satuan));
  $rows_satuan = mysql_num_rows($item_satuan);
  if($rows_satuan > 0) {
      mysql_data_seek($item_satuan, 0);
	  $row_satuan = mysql_fetch_assoc($item_satuan);
  }
?>
      </select></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Waktu</td>
      <td valign="right"><input name="waktu" type="text" id="waktu" size="30" maxlength="100" /></td>
    </tr>
    
    <tr valign="top">
      <td valign="right">Keterangan :</td>
      <td valign="right"><textarea name="keterangan" cols="40" rows="5" id="keterangan"></textarea>
        <input name="id" type="hidden" id="id" /></td>
      </tr>
    
    <tr>
      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi</em></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="Save" type="submit" id="Save" value="Simpan" />
        </label>
          <label>
          <input type="button" name="Button" value="Batal" onClick="javascript:history.go(-1);">
        </label></td>
    </tr>
  </table>
</form>
