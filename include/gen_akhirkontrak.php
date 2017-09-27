<?php
$dur = $_GET['durasi'];
$awl = $_GET['awal'];
$akh = date("Y/m/d", strtotime("$awl +$dur month"));

//unset($_SESSION['durasi']);
$_SESSION['durasi'] = $_GET['durasi'];
?>
<input name="akhir" type="text" id="akhir" value="<?php echo $akh; ?>" size="12" maxlength="12" readonly="readonly"/>