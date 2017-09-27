<?php require_once('../connections/con_gl.php'); ?>

<?php

//session_start();

// get variable

$act = $_GET['action'];

$id  = $_GET['rid'];

$kon = $_GET['kontrak'];

$ken = $_GET['kendaraan'];

$har = $_GET['harga'];

$dis = $_GET['diskon'];

$tot = $_GET['total'];

$tra = $_GET['transaksi'];

// --- validasi

if($act =='tambah') {

	if($kon <>'' AND $ken <>'' AND is_numeric($har) AND is_numeric($dis) AND is_numeric($tot)) {

		$valid = 1;

		$query_save = "insert into gl_dkontrak values (NULL,'$kon','$ken','$har','$dis','$tot','$tra')";

	}else{

		$valid = 0;	

	}

}else if($act=='edit' AND $id <>'') {

	if($id <>'' AND $ken <>'' AND is_numeric($har) AND is_numeric($dis) AND is_numeric($tot)) {

		$valid = 1;

		$query_save = "update gl_dkontrak set kendaraan='$ken', harga='$har', diskon='$dis', total='$tot', transaksi='$tra' where id='$id'";

	}else{

		$valid = 0;

	}

}else if($act=='hapus' AND $id <>'') {

	if($id <>'') {

		$valid = 1;

		$query_save = "delete from gl_dkontrak where id='$id'";

	}else{

		$valid = 0;

	}

}else if($act=='formedit' AND $id <>'') {

	mysql_select_db($database_con_gl, $con_gl);

	$query_fedit = "select a.id, a.kendaraan as nopolisi, a.harga, a.diskon, a.total, a.transaksi, b.nopolisi, c.tipekendaraan from gl_dkontrak a, gl_masterkendaraan b, gl_tipekendaraan c where a.id='$id' AND a.kendaraan = b.nopolisi AND b.tipekendaraan = c.id order by a.id";

	$fedit = mysql_query($query_fedit, $con_gl) or die(mysql_error());

	$row_fedit = mysql_fetch_assoc($fedit);

	// update avalaibe

	mysql_query("update gl_masterkendaraan set tersedia='1' where nopolisi='$row_fedit[nopolisi]'", $con_gl) or die(mysql_error());

}

// --- proses data

if($query_save <>'') {

	mysql_select_db($database_con_gl, $con_gl);

	$save = mysql_query($query_save, $con_gl) or die(mysql_error());

}

// ---

mysql_select_db($database_con_gl, $con_gl);

$query_kelom = "select a. id, a.tipekendaraan, b.nopolisi from gl_tipekendaraan a, gl_masterkendaraan b where a.id = b.tipekendaraan AND b.tersedia='1'";

if(!strstr($_SESSION[akses],'A-1-4')) {

	$query_kelom .=" AND b.gudang='$_SESSION[lokasi]'";	

}

$query_kelom .=" order by a.tipekendaraan, b.nopolisi";

$kelom = mysql_query($query_kelom, $con_gl) or die(mysql_error());

$row_kelom = mysql_fetch_assoc($kelom);

$totalRows_kelom = mysql_num_rows($kelom);

// --- list kendaraan

mysql_select_db($database_con_gl, $con_gl);

$query_lkend = "select a.id, a.kendaraan as nopolisi, a.harga, a.diskon, a.total, a.transaksi, b. nopolisi, c.tipekendaraan from gl_dkontrak a, gl_masterkendaraan b, gl_tipekendaraan c where a.kontrak='$kon' AND a.kendaraan = b.nopolisi AND b.tipekendaraan = c.id order by a.id";

$lkend = mysql_query($query_lkend, $con_gl) or die(mysql_error());

$row_lkend = mysql_fetch_assoc($lkend);

$total_lkend = mysql_num_rows($lkend);

?>

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">



          <tr>



            <th width="42%" align="center"><strong>Pilih Kendaraan</strong></th>



            <th width="8%" align="center"><strong>Harga </strong></th>



            <th width="5%" align="center"><strong>Diskon</strong></th>



            <th width="12%" align="center"><strong>Total</strong></th>



            <th align="center"><strong>Info</strong></th>



            <th width="6%" align="center"><strong>Aksi</strong></th>



          </tr>

		  <?php if($total_lkend > 0) { $subtotal = 0; do { ?>

          <?php if($act=='formedit' AND $id == $row_lkend['id']) { ?>

          <tr valign="top" bgcolor="#FFFFFF">

            <td align="left" style="background:none;border:none;"><label>

              <input name="q" type="text" id="q" value="Cari data ..." size="12" maxlength="100" onclick="this.value='';" onchange="findKendaraan(this.value);"/>

            </label>

              <label id="divListKendaraan">

                <select name="kendaraan" id="kendaraan" style="width:385px;">

                  <option value="">Pilih Kendaraan</option>

                  <?php if($totalRows_kelom > 0) { do { ?>

                  <option value="<?php echo $row_kelom['nopolisi'];?>" <?php if($row_kelom['nopolisi']==$row_lkend['nopolisi']){ ?>selected<?php } ?>><?php echo $row_kelom['tipekendaraan'];?> - <?php echo $row_kelom['nopolisi'];?></option>

                  <?php }while($row_kelom = mysql_fetch_assoc($kelom)); } ?>

                </select>

              </label></td>

            <td align="center" style="background:none;border:none;"><label id="divHargaKendaraan">

              <input name="hargasatuan" type="text" id="hargasatuan" onchange="javascript:this.form.total.value=this.form.hargasatuan.value - (this.form.hargasatuan.value * this.form.diskon.value / 100);" value="<?php echo $row_lkend['harga'];?>" size="10" maxlength="10"/>

            </label></td>

            <td align="center" style="background:none;border:none;"><label>

              <input name="diskon" type="text" id="diskon" onchange="javascript:this.form.total.value=this.form.hargasatuan.value - (this.form.hargasatuan.value * this.form.diskon.value / 100);" value="<?php echo $row_lkend['diskon'];?>" size="2" maxlength="3"/>

            </label>

              %</td>

            <td align="center" style="background:none;border:none;"><label>

              <input name="total" type="text" id="total" value="<?php echo $row_lkend['total'];?>" size="10" maxlength="15"/>

            </label></td>

            <td align="center" style="background:none;border:none;"><label>

              <textarea name="transaksi" cols="40" rows="2" id="transaksi"><?php echo $row_lkend['transaksi'];?></textarea>

            </label></td>

            <td align="center" style="background:none;border:none;"><label></label>

              <label>

                <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxSetKendaraan('edit','<?php echo $row_lkend['id'];?>');" class="checkbutton" title="Simpan Transaksi"/>

              </label></td>

          </tr>

          <?php }else{ ?>

          <tr valign="top" bgcolor="#FFFFFF">

            <td align="left" style="background:none;border:none;"><?php echo $row_lkend['tipekendaraan'];?> - <?php echo $row_lkend['nopolisi'];?></td>

            <td align="right" style="background:none;border:none;"><?php echo number_format($row_lkend['harga'],0,',','.');?></td>

            <td align="center" style="background:none;border:none;"><?php echo $row_lkend['diskon'];?> %</td>

            <td align="right" style="background:none;border:none;"><?php echo number_format($row_lkend['total'],0,',','.'); $subtotal += $row_lkend['total']; ?></td>

            <td align="left" style="background:none;border:none;"><?php echo $row_lkend['transaksi'];?></td>

            <td align="center" ><label>

              <button value="Edit" onclick="ajaxSetKendaraan('formedit','<?php echo $row_lkend['id'];?>');" type="button" class="editbutton" title="Edit Transaksi">&nbsp;</button>

            </label>

              <label>

                <input name="hapus" type="button" id="hapus" value="&nbsp;" onclick="ajaxSetKendaraan('hapus','<?php echo $row_lkend['id'];?>');" title="Hapus Transaksi" class="deletebutton"/>

              </label></td>

          </tr>

          <?php } ?>

          <?php }while($row_lkend = mysql_fetch_assoc($lkend)); } ?>

          <?php if($act <>'formedit') { ?>

          <tr valign="top" bgcolor="#FFFFFF">

            <td align="left" style="background:none;border:none;">&nbsp;</td>

            <td colspan="2" align="right" style="background:none;border:none;">Subtotal :</td>

            <td align="right" style="background:none;border:none;"><?php echo number_format($subtotal,0,',','.');?>

            <input name="subtotal" type="hidden" id="subtotal" value="<?php echo $subtotal;?>"></td>

            <td align="center" style="background:none;border:none;">&nbsp;</td>

            <td align="center" style="background:none;border:none;">&nbsp;</td>

          </tr>

          <tr valign="top" bgcolor="#FFFFFF">

            <td align="left" style="background:none;border:none;">&nbsp;</td>

            <td colspan="2" align="right" style="background:none;border:none;">Biaya Lain :</td>

            <td align="right" style="background:none;border:none;"><label>

              <input name="biaya" type="text" id="biaya" value="0" size="8" maxlength="10" onChange="this.form.ntotal.value = (2*this.form.subtotal.value) -  this.form.subtotal.value + (2*this.form.biaya.value) -  this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;">

            </label></td>

            <td align="center" style="background:none;border:none;">&nbsp;</td>

            <td align="center" style="background:none;border:none;">&nbsp;</td>

          </tr>

          <tr valign="top" bgcolor="#FFFFFF">

            <td align="left" style="background:none;border:none;">&nbsp;</td>

            <td colspan="2" align="right" style="background:none;border:none;">Pajak :</td>

            <td align="right" style="background:none;border:none;"><label>

              <input name="bobotp" type="text" id="bobotp" value="0" size="2" maxlength="3"onChange="this.form.pajak.value = (this.value / 100) * this.form.subtotal.value;this.form.ntotal.value = (2*this.form.subtotal.value) -  this.form.subtotal.value + (2*this.form.biaya.value) -  this.form.biaya.value + (2*this.form.pajak.value) - this.form.pajak.value;">

            </label>

              % =

              <label>

              <input name="pajak" type="text" id="pajak" value="0" size="8" maxlength="10" readonly>

            </label></td>

            <td align="center" style="background:none;border:none;">&nbsp;</td>

            <td align="center" style="background:none;border:none;">&nbsp;</td>

          </tr>

          <tr valign="top" bgcolor="#FFFFFF">

            <td align="left" style="background:none;border:none;">&nbsp;</td>

            <td colspan="2" align="right" style="background:none;border:none;">Grand Total :</td>

            <td align="right" style="background:none;border:none;"><label>

              <input name="ntotal" type="text" id="ntotal" value="<?php echo intval($subtotal);?>" size="8" maxlength="15" readonly/>

            </label></td>

            <td align="center" style="background:none;border:none;">&nbsp;</td>

            <td align="center" style="background:none;border:none;">&nbsp;</td>

          </tr>

          <tr valign="top" bgcolor="#FFFFFF">



            <td align="left" style="background:none;border:none;">

			<!--

			<label>

              <input name="q" type="text" id="q" value="Cari data ..." size="10" maxlength="100" onclick="this.value='';" onchange="findKendaraan(this.value);"/>

            </label>

              <label id="divListKendaraan">

              

              <select name="kendaraan" id="kendaraan" style="width:385px;">

   

                  <option value="">Pilih Kendaraan</option>

                  <?php if($totalRows_kelom > 0) { do { ?>

                  <option value="<?php echo $row_kelom['nopolisi'];?>"><?php echo $row_kelom['tipekendaraan'];?> - <?php echo $row_kelom['nopolisi'];?></option>

                  <?php }while($row_kelom = mysql_fetch_assoc($kelom)); } ?>

                  </select>

                

              </label><?php if(strstr($_SESSION['akses'],"MS-8")) { ?>&nbsp;<a href="index.php?component=masterservice&tersedia=1&open=window" onclick="NewWindow(this.href,'name','1080','525','yes');return false"><img src="images/select.png" width="16" height="16" border="0" /></a><?php } ?>

			  -->

			  <!-- Added by suwondo -->

			  <input type="hidden" name="kendaraan" id="kendaraan" />

			  <input type="text" name="txtkendaraan" id="txtkendaraan" size="28" readonly style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=kendaraan&task=list&barang=false&open=window','name','825','450','yes');return false" placeholder="Pilih Kendaraan..." />

			  </td>



            <td align="center" style="background:none;border:none;"><label id="divHargaKendaraan">

              

              <input name="hargasatuan" type="text" id="hargasatuan" onchange="javascript:this.form.total.value=this.form.hargasatuan.value - (this.form.hargasatuan.value * this.form.diskon.value / 100);" size="10" maxlength="10"/>

              

            </label></td>



            <td align="center" style="background:none;border:none;"><label>



              <input name="diskon" type="text" id="diskon" onchange="javascript:this.form.total.value=this.form.hargasatuan.value - (this.form.hargasatuan.value * this.form.diskon.value / 100);" value="0" size="2" maxlength="3"/>



              </label>



              %</td>



            <td align="center" style="background:none;border:none;"><label>



              <input name="total" type="text" id="total" size="10" maxlength="15"/>



            </label></td>



            <td align="center" style="background:none;border:none;"><label>



              <textarea name="transaksi" cols="40" rows="2" id="transaksi"></textarea>



            </label></td>



            <td align="center" style="background:none;border:none;"><label></label>



                  <label>



                  <input name="add" type="button" id="add" value="&nbsp;" onclick="ajaxSetKendaraan('tambah','');" class="checkbutton" title="Tambah Transaksi"/>

                </label></td>



          </tr>

		  <?php } ?>

        </table>