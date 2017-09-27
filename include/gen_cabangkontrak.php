<?php require_once('../connections/con_gl.php'); ?>

<?php

//session_start();

$kon = $_GET['kontrak'];

// get tgl

mysql_select_db($database_con_gl, $con_gl);

$query_gcab = "select gudang from gl_kontrak where no='$kon'";

$gcab = mysql_query($query_gcab, $con_gl) or die(mysql_error());

$row_gcab = mysql_fetch_assoc($gcab);

//--

mysql_select_db($database_con_gl, $con_gl);

$query_gudang = "SELECT id, gudang FROM gl_gudang";

if(!strstr($_SESSION[akses],'A-1-4')) {

	$query_gudang .= " where id='$_SESSION[lokasi]'";

}

$query_gudang .=" ORDER BY gudang ASC";

$gudang = mysql_query($query_gudang, $con_gl) or die(mysql_error());

$row_gudang = mysql_fetch_assoc($gudang);

$totalRows_gudang = mysql_num_rows($gudang);

?>

<select name="gudang" id="gudang" style="width:160px;" disabled="disabled">



        <?php



do {  



?>



        <option value="<?php echo $row_gudang['id']?>" <?php if($row_gcab['gudang']==$row_gudang['id']) { ?>selected="selected"<?php } ?>><?php echo $row_gudang['gudang']?></option>



        <?php



} while ($row_gudang = mysql_fetch_assoc($gudang));



  $rows = mysql_num_rows($gudang);



  if($rows > 0) {



      mysql_data_seek($gudang, 0);



	  $row_gudang = mysql_fetch_assoc($gudang);



  }



?>



      </select>