<?php require_once('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"MS-8-1");
$day = date("Y/m/d");
// get kendaraan

// get driver

?>
<script type="text/javascript" src="js/ajax_data.js"></script>
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
<link type="text/css" rel="stylesheet" href="css/jquery.wysiwyg.css" />
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
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
$(function()
  {
	  $('#keterangan').wysiwyg();
  });
</script>
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<h1>Tambah Pengeluaran Uang</h1>
<form action="proses/pengeluaranbiaya.php?act=add" method="POST" name="add" id="add" >
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable">
    
	<tr valign="top">
	  <td align="right" bgcolor="#FFFFFF">Tanggal Datang Invoice* :</td>
	  <td bgcolor="#FFFFFF"><input name="tanggaldatanginvoice" type="text" class="calendar" id="tanggaldatanginvoice" value="<?php echo $day; ?>" size="12" maxlength="12"/></td>
    </tr>
	<tr valign="top">
      <td width="23%" align="right" bgcolor="#FFFFFF">Tanggal Invoie .*</td>
      <td width="77%" bgcolor="#FFFFFF"><label></label>
      <label>
      <input name="tanggalinvoice" type="text" class="calendar" id="tanggalinvoice" value="<?php echo $day; ?>" size="12" maxlength="12"/>
      </label></td>
    </tr>

	
    
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">No Invoice</td>
      <td bgcolor="#FFFFFF"><input type="text" name="noinvoice" id="noinvoice" size="28" style="background-color:#fff;border:1px solid #999; height:16px;"/></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Agent </td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="idagent" id="idagent" />
        <input type="text" name="agent" id="agent" size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=tagihan&amp;task=listAgent&amp;open=window','name','825','450','yes');return false" />
        <?php if(strstr($_SESSION['akses'],"JS-5-1")) { ?>
        
        <?php } ?></td>
    </tr>
    <tr valign="top">
      <td colspan="2" align="left" bgcolor="#FFFFFF"><h2>Informasi Tagihan </h2></td>
    </tr>
    
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Nominal Rp.</td>
      <td bgcolor="#FFFFFF"><label id="corporate" style="display:none;">
        <!-- Added by suwondo -->
        <input type="hidden" name="nokontrak" id="nokontrak" />
	  <input type="text" name="txtnokontrak" id="txtnokontrak" size="28" readonly style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=kontrak&amp;task=list&amp;open=window','name','825','450','yes');return false" placeholder="Klik untuk no. kontrak" /></label>        <input type="text" name="nominal" value="0" id="nominal" size="28"  style="background-color:#fff;border:1px solid #999; height:16px;" onkeyup="javascript:if(this.value=='' || isNaN(this.value)) this.value='0';"/></td>
    </tr>
    <tr valign="top">
      <td align="right" bgcolor="#FFFFFF">Keterangan : </td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="keterangan" cols="85" rows="5" id="keterangan"></textarea>
        <input name="id" type="hidden" id="id" />
      </label></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#FFFFFF"><em>*Harus diisi
        <input name="open" type="hidden" id="open" value="<?php echo $_GET['open'];?>" />
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
