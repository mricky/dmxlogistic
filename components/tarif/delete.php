<?php require_once('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"MS-8-1");

$colname_edit = "-1";
if (isset($_GET['id'])) {
  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
  
}

mysql_select_db($database_con_gl, $con_gl);
$query_edit = sprintf("SELECT * FROM v_tarif WHERE tarif_id = '$_GET[id]'", $colname_edit);
$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
print_r($query_edit);

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
<h1>Delete Tarif</h1>
<form action="proses/tarif.php?act=delete" method="POST" name="edit" id="edit" >
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
    
    <tr valign="top">
      <td width="14%" align="right" bgcolor="#FFFFFF">Layanan :</td>
      <td width="24%" bgcolor="#FFFFFF">
        <!-- Added by suwondo -->
        <select name="layananpaket" id="layananpaket" style="width:100px;">
          <?php
do {  
?>
          <option value="<?php echo $row_layanan['layanan_paket_id']?>"<?php if (!(strcmp($row_layanan['layanan_paket_id'], $row_edit['layanan_paket_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_layanan['layanan_paket_nama']?></option>
                     
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
      <td align="right" bgcolor="#FFFFFF">Jenis :</td>
      <td bgcolor="#FFFFFF">
        <!-- Added by suwondo -->
        <select name="jenispaket" id="jenispaket" style="width:100px;">
          <?php
do {  
?>
          <option value="<?php echo $row_jenis['jenis_paket_id']?>"<?php if (!(strcmp($row_jenis['jenis_paket_id'], $row_edit['jenis_paket_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_jenis['jenis_paket_name']?></option>
                     
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
      <td bgcolor="#FFFFFF"><span style="background:none;border:none;">
        <input type="hidden" name="idorigin" id="idorigin" size="2" value="<?php echo $row_edit['kotaasal_id']; ?>" />
        <input type="text" name="origin" id="origin" size="25" placeholder="Kota Asal" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " value="<?php echo $row_edit['kotaasal_name']; ?>" onclick="NewWindow('index.php?component=tarif&amp;task=listOrigin&amp;open=window','name','825','450','yes');return false" />
      </span></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Kota Tujuan</td>
      <td bgcolor="#FFFFFF"><span style="background:none;border:none;">
        <input type="hidden" name="iddestination" id="iddestination" size="2" value="<?php echo $row_edit['kotatujuan_id']; ?>"  />
        <input type="text" name="destination" id="destination" size="25" placeholder="Kota Tujuan" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " value="<?php echo $row_edit['kotatujuan_name']; ?>" onclick="NewWindow('index.php?component=tarif&amp;task=listDestination&amp;open=window','name','825','450','yes');return false" />
      </span></td>
    </tr>
    
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Tarif</td>
      <td bgcolor="#FFFFFF"><input name="tarif" type="text" id="tarif" size="30" maxlength="100" value="<?php echo $row_edit['tarif']; ?>"	 onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';"/></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Satuan</td>
      <td bgcolor="#FFFFFF"><select name="satuan" id="satuan" style="width:100px;">
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
      <td bgcolor="#FFFFFF"><input name="waktu" type="text" id="waktu" size="30" maxlength="100" value="<?php echo $row_edit['waktu']; ?>"	 /></td>
    </tr>
    
    <tr valign="top">
      <td align="right">Keterangan :</td>
      <td valign="right"><textarea name="keterangan" cols="40" rows="5" id="keterangan"><?php echo $row_edit['keterangan']; ?></textarea>
        <input name="id" type="hidden" id="id" value="<?php echo $row_edit['tarif_id']; ?>" /></td>
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
