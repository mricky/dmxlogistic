<?php require_once('../connections/con_gl.php'); ?>
<?php
$id = isset($_GET['idprovinsi']) ? intval($_GET['idprovinsi']) : 0;
$query = "SELECT id_kab_kota,kab_kota FROM kab_kota WHERE id_provinsi='$id'";
$result = mysql_query($query);
$respon = array();
while ($hasil = mysql_fetch_array($result))
{
    $respon[] = $hasil;
}
echo json_encode($respon);
?>
