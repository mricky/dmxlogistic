<?php require('connections/con_gl.php'); ?>
<?php
cekAkses($_SESSION[akses],"A-4");
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "changeadmin")) {
$cekimage = substr($_FILES['logo']['type'],0,5);
$tmpname = $_FILES['logo']['tmp_name'];
$destfile = "logo.jpg";
if($cekimage =='image') {
copy($tmpname,$destfile);
}
$logo ="logo.jpg";
  $updateSQL = sprintf("UPDATE gl_company SET npwp=%s, alamat=%s, telp=%s, fax=%s, logo=%s, perusahaan=%s, cabang=%s, norek=%s, atasnama=%s, a_kas=%s, a_hut=%s, a_piu=%s, a_beb=%s, a_paj=%s, a_hpp=%s, a_pend=%s, r_kontrak=%s, r_kir=%s, r_stnk=%s, r_asuransi=%s, r_servise=%s WHERE id=%s",
                       GetSQLValueString($_POST['npwp'], "text"),
					   GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['telp'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($logo, "text"),
                       GetSQLValueString($_POST['perusahaan'], "text"),
					   GetSQLValueString($_POST['cabang'], "text"),
					   GetSQLValueString($_POST['norekening'], "text"),
					   GetSQLValueString($_POST['atasnama'], "text"),
					   GetSQLValueString($_POST['kasbank'], "text"),
					   GetSQLValueString($_POST['hutang'], "text"),
					   GetSQLValueString($_POST['piutang'], "text"),
					   GetSQLValueString($_POST['beban'], "text"),
					   GetSQLValueString($_POST['pajak'], "text"),
					   GetSQLValueString($_POST['hpp'], "text"),
					   GetSQLValueString($_POST['pendapatan'], "text"),
					   GetSQLValueString($_POST['r_kontrak'], "int"),
					   GetSQLValueString($_POST['r_kir'], "int"),
					   GetSQLValueString($_POST['r_stnk'], "int"),
					   GetSQLValueString($_POST['r_asuransi'], "int"),
					   GetSQLValueString($_POST['r_servise'], "int"),
					   GetSQLValueString($_POST['id'], "int")); //echo $updateSQL;

  mysql_select_db($database_con_gl, $con_gl);
  $Result1 = mysql_query($updateSQL, $con_gl) or die(mysql_error());
echo "<script type=\"text/javascript\">window.location=\"index.php?component=perusahaan\";</script>";
}


mysql_select_db($database_con_gl, $con_gl);
$query_getadmin = "SELECT * FROM gl_gudang where id = $_SESSION[cabang_id]";
$getadmin = mysql_query($query_getadmin, $con_gl) or die(mysql_error());
$row_getadmin = mysql_fetch_assoc($getadmin);
$totalRows_getadmin = mysql_num_rows($getadmin);

?>
<link type="text/css" rel="stylesheet" href="css/jquery.wysiwyg.css" />
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript">
$(function()
  {
      $('#alamat').wysiwyg();
	  //$('#b_alamat').wysiwyg();
  });
</script>
<h1>Info Perusahaan  </h1>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="changeadmin" id="changeadmin">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="datatable">
    <tr>
      <td colspan="2"><a name="info" id="info"><strong><a href="#info">Info Perusahaan</a> | <a href="#rekening">Rekening Bank</a></strong></td>
    </tr>
    
    <tr>
      <td width="175" align="right" valign="top" bgcolor="#FFFFFF">NPWP : </td>
      <td width="703" bgcolor="#FFFFFF"><label>
      <input name="npwp" type="text" id="npwp" value="<?php echo $row_getadmin['pajak_npwp']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Nama Perusahaan : </td>
      <td bgcolor="#FFFFFF"><label>
        <input name="perusahaan" type="text" id="perusahaan" value="<?php echo $row_getadmin['nama']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Alamat : </td>
      <td bgcolor="#FFFFFF"><label>
        <textarea name="alamat" cols="85" rows="5" id="alamat"><?php echo $row_getadmin['alamat']; ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Telp : </td>
      <td bgcolor="#FFFFFF"><label>
        <input name="telp" type="text" id="telp" value="<?php echo $row_getadmin['tlp']; ?>" size="20" maxlength="20" />
      </label></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Fax : </td>
      <td bgcolor="#FFFFFF"><label>
        <input name="fax" type="text" id="fax" value="<?php echo $row_getadmin['fax']; ?>" size="20" maxlength="20" />
      </label></td>
    </tr>
    

    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF"><strong>Rekening Bank</strong><a name="rekening" id="rekening"></a> </td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Bank :</td>
      <td bgcolor="#FFFFFF"><input name="bank" type="text" id="bank" value="<?php echo $row_getadmin['bank']; ?>" size="30" maxlength="100" /></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Cabang : </td>
      <td bgcolor="#FFFFFF"><label>
        <input name="cabang" type="text" id="cabang" value="<?php echo $row_getadmin['cabang_bank']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">No.Rekening : </td>
      <td bgcolor="#FFFFFF"><label>
        <input name="norek" type="text" id="norek" value="<?php echo $row_getadmin['norek']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFFFFF">Atas Nama  : </td>
      <td bgcolor="#FFFFFF"><label>
        <input name="atasnama" type="text" id="atasnama" value="<?php echo $row_getadmin['atasnama']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF"><strong>Rekening Bank</strong><a name="rekening" id="rekening2"></a> </td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Bank :</td>
      <td bgcolor="#FFFFFF"><input name="bank2" type="text" id="bank2" value="<?php echo $row_getadmin['bank2']; ?>" size="30" maxlength="100" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Cabang : </td>
      <td bgcolor="#FFFFFF"><label>
        <input name="cabang2" type="text" id="cabang2" value="<?php echo $row_getadmin['cabang_bank2']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">No.Rekening :</td>
      <td bgcolor="#FFFFFF"><label>
        <input name="norek2" type="text" id="norek2" value="<?php echo $row_getadmin['norek2']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Atas Nama  :</td>
      <td bgcolor="#FFFFFF"><label>
        <input name="atasnama2" type="text" id="atasnama2" value="<?php echo $row_getadmin['atasnama2']; ?>" size="30" maxlength="100" />
      </label></td>
    </tr>
    
    <tr>
      <td bgcolor="#FFFFFF"><input name="id" type="hidden" id="id" value="<?php echo $row_getadmin['id']; ?>"></td>
      <td bgcolor="#FFFFFF"><label>
        <input name="Save" type="submit" id="Save" value="Simpan" disabled="disabled">
      </label></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="changeadmin">
</form>
<?php
mysql_free_result($ak_6);

mysql_free_result($ak_7);
?>
