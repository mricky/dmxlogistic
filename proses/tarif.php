<?php require_once('../connections/con_gl.php'); ?>

<?php include('../connections/config.php'); ?>

<?php 

$act = $_GET[act];

//$url = "http://localhost/backendiwp/index.php?component=shape";

$url = base_url("index.php?component=tarif");



/* Validasi */


if (trim($_POST['idorigin']) == '') {

	$error[] = '- Kota Asal harus dipilih';

}

if (trim($_POST['iddestination']) == '') {

	$error[] = '-  Kota Tujuan harus dipilih';

}


/*End validasi */

if (isset($error)) {

	echo "<b>Error</b>: <br />".implode("<br />", $error);

}else{

    	$today = date("Y-m-d"); 

	if($act =='add') {

                    
    		$now = strtotime('now');
            $query = "INSERT INTO tarif (layanan_id,jenis_id,kota_asal,kota_tujuan,satuan_id,tarif,waktu,keterangan,created_at)"
                    . " VALUES ('$_POST[layananpaket]','$_POST[jenispaket]','$_POST[idorigin]','$_POST[iddestination]','$_POST[satuan]','$_POST[tarif]','$_POST[waktu]','$_POST[keterangan]',$now);";

            //'$_POST[]'

         //  print_r($query);

        }else if($act=='edit'){
			$now = strtotime('now');
            $query = "UPDATE tarif SET layanan_id='$_POST[layananpaket]',jenis_id='$_POST[jenispaket]',kota_asal='$_POST[idorigin]',kota_tujuan='$_POST[iddestination]',satuan_id='$_POST[satuan]',tarif='$_POST[tarif]',waktu='$_POST[waktu]',keterangan='$_POST[keterangan]', updated_at = $now WHERE tarif_id='$_POST[id]'";

			 //print_r($query);
			
	}else{

            //echo $target."/" . $_POST['image_edit'];

            $query = "delete from tarif where tarif_id='$_POST[id]'";

              

	}            	

        mysql_select_db($database_con_gl, $con_gl);

		$runquery = mysql_query($query, $con_gl);  

        if($runquery) {

		echo "<img src=\"images/ok.png\" align=\"left\" width=\"16\">&nbsp;&nbsp;Data berhasil ";if($act=='add' OR $act=='edit') { echo "disimpan";}else{ echo "dihapus"; } echo " ...";

	}else{

		echo "<img src=\"images/alert.png\" align=\"left\" width=\"16\"> Data gagal disimpan !!!";

	}

}

?>

<?php if($runquery) { ?><script type="text/javascript">setTimeout("location.href='<?php echo $url;?>'", 2000);</script><?php } ?>