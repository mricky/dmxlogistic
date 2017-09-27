<?php require_once('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"DD-2-2");

// ---

mysql_select_db($database_con_gl, $con_gl);

$query_edit = "SELECT * FROM gl_kontak WHERE id = '$_GET[id]'";

$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());

$row_edit = mysql_fetch_assoc($edit);

$totalRows_edit = mysql_num_rows($edit);

// get lokasi kantor ( gudang )

mysql_select_db($database_con_gl, $con_gl);

$query_lokasi = "select * from gl_gudang order by gudang";

$lokasi       = mysql_query($query_lokasi,$con_gl) or die(mysql_error());

$row_lokasi   = mysql_fetch_assoc($lokasi);

$total_lokasi = mysql_num_rows($lokasi);

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

<link type="text/css" rel="stylesheet" href="css/jquery.wysiwyg.css" />

<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>

<script type="text/javascript">

// --- cek karyawan

function checkKaryawan(val) {

	if(val=='Karyawan') {

		document.getElementById('lkantor').disabled='';

		document.getElementById('jkar').disabled='';

	}else if(val=='Customer') {

		document.getElementById('tcus').disabled='';	

	}else{

		// -- karyawan

		document.getElementById('lkantor').value='';

		document.getElementById('lkantor').disabled='disabled';

		document.getElementById('jkar').value='';

		document.getElementById('jkar').disabled='disabled';

		// -- customer

		document.getElementById('tcus').value='';

		document.getElementById('tcus').disabled='disabled';

	}

}

// ---

$(document).ready(function() {



	$().ajaxStart(function() {

		$('#loading').show();

		$('#result').hide();

	}).ajaxStop(function() {

		$('#loading').hide();

		$('#result').fadeIn('slow');

	});



	$('#edit').submit(function() {

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

      $('#alamat').wysiwyg();

	  $('#keterangan').wysiwyg();

  });

</script>

<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>

<div id="result" style="display:none;"></div>

<h1>Edit Kontak</h1>

<form action="proses/kontak.php?act=edit" method="POST" name="edit" id="edit">

<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="datatable">

  <tr>

    <td width="21%" align="right">Type : </td>

    <td width="79%"><label>

      <select name="type" id="type" onchange="checkKaryawan(this.value);">

        <option value="Karyawan" selected="selected" <?php if (!(strcmp("Karyawan", $row_edit['type']))) {echo "selected=\"selected\"";} ?>>Karyawan</option>

        <option value="Supplier" <?php if (!(strcmp("Supplier", $row_edit['type']))) {echo "selected=\"selected\"";} ?>>Supplier</option>

        <option value="Customer" <?php if (!(strcmp("Customer", $row_edit['type']))) {echo "selected=\"selected\"";} ?>>Customer</option>

        <option value="Asuransi" <?php if (!(strcmp("Asuransi", $row_edit['type']))) {echo "selected=\"selected\"";} ?>>Asuransi</option>

        <option value="Bengkel" <?php if (!(strcmp("Bengkel", $row_edit['type']))) {echo "selected=\"selected\"";} ?>>Bengkel Rekanan</option>

      </select>

    </label><label>

        <select name="lkantor" id="lkantor" <?php if($row_edit['type']<>'Karyawan') { ?>disabled="disabled"<?php } ?>>

          <option value="">Lokasi Kantor</option>

          <?php if($total_lokasi > 0) { do { ?>

          <option value="<?php echo $row_lokasi['id'];?>" <?php if($row_lokasi['id']==$row_edit['gudang']) { ?>selected="selected"<?php } ?>><?php echo $row_lokasi['gudang'];?></option>

          <?php }while($row_lokasi = mysql_fetch_assoc($lokasi)); } ?>

        </select>

      </label>

      <label>

        <select name="jkar" id="jkar" <?php if($row_edit['type']<>'Karyawan') { ?>disabled="disabled"<?php } ?>>

          <option value="" <?php if (!(strcmp("", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Jenis Karyawan</option>

          <option value="staff" <?php if (!(strcmp("staff", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Staff</option>

          <option value="sales" <?php if (!(strcmp("sales", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Salesmen</option>
          
          <option value="driver" <?php if (!(strcmp("driver", $row_edit['tkaryawan']))) {echo "selected=\"selected\"";} ?>>Driver</option>

        </select>

      </label>

      <label>

        <select name="tcus" id="tcus" <?php if($row_edit['type']<>'Customer') { ?>disabled="disabled"<?php } ?>>

          <option value="">Tipe Customer</option>

          <option value="Corporate" <?php if($row_edit['tcustomer']=='Corporate') { ?>selected="selected"<?php } ?>>Corporate</option>

          <option value="Retail" <?php if($row_edit['tcustomer']=='Retail') { ?>selected="selected"<?php } ?>>Retail</option>

        </select>

      </label></td>

  </tr>

  <tr>

    <td align="right">NPWP : </td>

    <td><label>

      <input name="npwp" type="text" id="npwp" value="<?php echo $row_edit['npwp']; ?>" size="30" maxlength="100"/>

    </label></td>

  </tr>

  <tr>

    <td align="right">Nama*  : </td>

    <td><label>

      <input name="nama" type="text" id="nama" value="<?php echo $row_edit['nama']; ?>" size="30" maxlength="100"/>

    </label></td>

  </tr>

  <tr valign="top">

    <td align="right">Alamat* : </td>

    <td><label>

      <textarea name="alamat" cols="85" rows="5" id="alamat"><?php echo $row_edit['alamat']; ?></textarea>

    </label></td>

  </tr>

  <tr valign="top">

    <td align="right">No.Telepon : </td>

    <td><label>

      <input name="tlp" type="text" id="tlp" value="<?php echo $row_edit['tlp']; ?>" size="10" maxlength="20" />

    </label></td>

  </tr>

  <tr>

    <td align="right">Email : </td>

    <td><label>

      <input name="email" type="text" id="email" value="<?php echo $row_edit['email']; ?>" size="30" maxlength="100" />

      <input name="id" type="hidden" id="id" value="<?php echo $row_edit['id']; ?>" />

      Format : abcde@xxxx.com </label></td>

  </tr>

  <tr valign="top">

    <td align="right">Aktif :</td>

    <td><label>

      <input name="tglinput" type="text" class="calendar" id="tglinput" value="<?php echo $row_edit['tgl_daftar'];?>" size="10" maxlength="10"/>

    </label>

      <label>

        <input name="aktif" type="checkbox" id="aktif" value="1" <?php if (!(strcmp($row_edit['aktif'],1))) {echo "checked=\"checked\"";} ?> />

      </label>

      <small>Check jika aktif</small></td>

  </tr>

  <tr valign="top">

    <td align="right">Keterangan : </td>

    <td><label>

      <textarea name="keterangan" cols="85" rows="5" id="keterangan"><?php echo $row_edit['keterangan']; ?></textarea>

      </label></td>

  </tr>

  <tr>

    <td align="left"><label><em>*Harus diisi
      <input name="open" type="hidden" id="open" value="<?php echo $_GET['open'];?>" />
    </em></label></td>

    <td><label>

      <input name="Save" type="submit" id="Save" value="Simpan" />

      </label>
      <label>
        <input type="button" name="Button" value="Batal" onclick="javascript:<?php if($_GET['open']=='window') { ?>window.close(2000);<?php }else{ ?>history.go(-1);<?php } ?>" />
      </label></td>

  </tr>

</table>

</form>