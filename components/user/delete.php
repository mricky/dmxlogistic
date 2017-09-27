<?php require('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"A-1-3");

$colname_edit = "-1";

if (isset($_GET['id'])) {

  $colname_edit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);

}

mysql_select_db($database_con_gl, $con_gl);

$query_edit = sprintf("SELECT * FROM gl_admin WHERE id = %s", $colname_edit);

$edit = mysql_query($query_edit, $con_gl) or die(mysql_error());

$row_edit = mysql_fetch_assoc($edit);

$totalRows_edit = mysql_num_rows($edit);



mysql_select_db($database_con_gl, $con_gl);

$query_kary = "SELECT id, nama FROM gl_kontak WHERE type = 'Karyawan' ORDER BY nama ASC";

$kary = mysql_query($query_kary, $con_gl) or die(mysql_error());

$row_kary = mysql_fetch_assoc($kary);

$totalRows_kary = mysql_num_rows($kary);

?>

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



	$('#fdelete').submit(function() {

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

	  $('#b_alamat').wysiwyg();

  });

</script>

<link type="text/css" rel="stylesheet" href="css/jquery.wysiwyg.css" />

<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>

<div id="result" style="display:none;"></div>

<h1>Delete User</h1>

<form action="proses/user.php?act=delete" method="POST" name="fdelete" id="fdelete">

  <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="datatable">

    <tr>

      <td width="15%" align="right">Username : </td>

      <td width="85%"><label>

        <input name="username" type="text" id="username" value="<?php echo $row_edit['username']; ?>" size="20" maxlength="20" />

      </label></td>
    </tr>

    <tr>

      <td align="right">Password : </td>

      <td><label>

        <input name="password" type="password" id="password" value="<?php echo $row_edit['password']; ?>" size="20" maxlength="20" />

      </label></td>
    </tr>

    <tr>

      <td align="right">Link Karyawan : </td>

      <td><label>

        <select name="karyawan" id="karyawan" style="width:160px;">

          <option value="0" <?php if (!(strcmp(0, $row_edit['link']))) {echo "selected=\"selected\"";} ?>>Not Set</option>

          <?php

do {  

?>

          <option value="<?php echo $row_kary['id']?>"<?php if (!(strcmp($row_kary['id'], $row_edit['link']))) {echo "selected=\"selected\"";} ?>><?php echo $row_kary['nama']?></option>

          <?php

} while ($row_kary = mysql_fetch_assoc($kary));

  $rows = mysql_num_rows($kary);

  if($rows > 0) {

      mysql_data_seek($kary, 0);

	  $row_kary = mysql_fetch_assoc($kary);

  }

?>
        </select>

      </label></td>
    </tr>

    <tr valign="top">

      <td align="right">Pengaturan :</td>

      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="21%">User</th>

          <th width="20%">Budgeting</th>

          <th width="20%">Klasifikasi</th>

          <th width="19%">Akun</th>
          <th width="20%">Info Perusahaan</th>
          </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="user_1" type="checkbox" id="user_1" value="A-1-1" <?php if(strstr($row_edit['akses'],"A-1-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="user_2" type="checkbox" id="user_2" value="A-1-2" <?php if(strstr($row_edit['akses'],"A-1-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="user_3" type="checkbox" id="user_3" value="A-1-3" <?php if(strstr($row_edit['akses'],"A-1-3")) { ?>checked="checked"<?php }?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="user_4" type="checkbox" id="user_4" value="A-1" <?php if(strstr($row_edit['akses'],"A-1")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

            <li>

              <label>

                <input name="user_5" type="checkbox" id="user_5" value="A-1-4" <?php if(strstr($row_edit['akses'],"A-1-4")) { ?>checked="checked"<?php } ?>/>

                Super User</label></li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="periode_1" type="checkbox" id="periode_1" value="A-2-1" <?php if(strstr($row_edit['akses'],"A-2-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="periode_2" type="checkbox" id="periode_2" value="A-2-2" <?php if(strstr($row_edit['akses'],"A-2-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="periode_3" type="checkbox" id="periode_3" value="A-2-3" <?php if(strstr($row_edit['akses'],"A-2-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="periode_4" type="checkbox" id="periode_4" value="A-2" <?php if(strstr($row_edit['akses'],"A-2")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="klasifikasi_1" type="checkbox" id="klasifikasi_1" value="A-3-1" <?php if(strstr($row_edit['akses'],"A-3-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="klasifikasi_2" type="checkbox" id="klasifikasi_2" value="A-3-2" <?php if(strstr($row_edit['akses'],"A-3-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="klasifikasi_3" type="checkbox" id="klasifikasi_3" value="A-3-3" <?php if(strstr($row_edit['akses'],"A-3-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="klasifikasi_4" type="checkbox" id="klasifikasi_4" value="A-3" <?php if(strstr($row_edit['akses'],"A-3")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">
              <li>
                <label>
                <input name="akun_1" type="checkbox" id="akun_1" value="DD-1-1" <?php if(strstr($row_edit['akses'],"DD-1-1")) { ?>checked="checked"<?php } ?>/>
                  Tambah Data</label>
              </li>
            <li>
                <label>
                <input name="akun_2" type="checkbox" id="akun_2" value="DD-1-2" <?php if(strstr($row_edit['akses'],"DD-1-2")) { ?>checked="checked"<?php } ?>/>
                  Edit Data</label>
              </li>
            <li>
                <label>
                <input name="akun_3" type="checkbox" id="akun_3" value="DD-1-3" <?php if(strstr($row_edit['akses'],"DD-1-3")) { ?>checked="checked"<?php } ?>/>
                  Hapus Data</label>
              </li>
            <li>
                <label>
                <input name="user_4" type="checkbox" id="user_4" value="DD-1" <?php if(strstr($row_edit['akses'],"DD-1")) { ?>checked="checked"<?php } ?>/>
                  Lihat Data</label>
              </li>
            <li>
                <label>
                <input name="akun_5" type="checkbox" id="akun_5" value="DD-1" <?php if(strstr($row_edit['akses'],"DD-2")) { ?>checked="checked"<?php } ?>/>
                  Akun Cabang</label>
              </li>
          </ul></td>
          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="info" type="checkbox" id="info" value="A-4" <?php if(strstr($row_edit['akses'],"A-4")) { ?>checked="checked"<?php } ?>/>
              </label>

              Lihat Data</li>

          </ul></td>
          </tr>

      </table>        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
          <tr>
            <th width="21%">Gol. Aset</th>
            <th width="20%">ATP</th>
            <th width="20%">&nbsp;</th>
            <th width="19%">&nbsp;</th>
            <th width="20%">&nbsp;</th>
          </tr>
          <tr valign="top">
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="golaset_1" type="checkbox" id="golaset_1" value="DD-3-1" <?php if(strstr($row_edit['akses'],"DD-3-1")) { ?>checked="checked"<?php } ?>/>
                  Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="golaset_2" type="checkbox" id="golaset_2" value="DD-3-2" <?php if(strstr($row_edit['akses'],"DD-3-2")) { ?>checked="checked"<?php } ?>/>
                  Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="golaset_3" type="checkbox" id="golaset_3" value="DD-3-3" <?php if(strstr($row_edit['akses'],"DD-3-3")) { ?>checked="checked"<?php } ?>/>
                  Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="golaset_4" type="checkbox" id="golaset_4" value="DD-3" <?php if(strstr($row_edit['akses'],"DD-3")) { ?>checked="checked"<?php } ?>/>
                  Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="atp_1" type="checkbox" id="atp_1" value="DD-4-1" <?php if(strstr($row_edit['akses'],"DD-4-1")) { ?>checked="checked"<?php } ?>/>
                  Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="atp_2" type="checkbox" id="atp_2" value="DD-4-2" <?php if(strstr($row_edit['akses'],"DD-4-2")) { ?>checked="checked"<?php } ?>/>
                  Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="atp_3" type="checkbox" id="atp_3" value="DD-4-3" <?php if(strstr($row_edit['akses'],"DD-4-3")) { ?>checked="checked"<?php } ?>/>
                  Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="atp_4" type="checkbox" id="atp_4" value="DD-4" <?php if(strstr($row_edit['akses'],"DD-4")) { ?>checked="checked"<?php } ?>/>
                  Lihat Data</label>
                </li>
              <li>
                  <input name="penyusutan_4" type="checkbox" id="penyusutan_4" value="DD-5" <?php if(strstr($row_edit['akses'],"DD-5")) { ?>checked="checked"<?php } ?>/>
                Penyusutan Aset</li>
            </ul></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        
              </table></td>
    </tr>
    
    
    <tr valign="top">
      <td align="right">Data - Transaksi :</td>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
          <tr>
            <th width="21%">Transaksi Harian</th>
            <th width="20%" valign="top">Transaksi Order Retail</th>
            <th width="20%">Extend STNK</th>
            <th width="19%" valign="top">Extend Polis</th>
            <th width="20%" valign="top">Extend KIR</th>
          </tr>
          <tr valign="top">
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="transaksi_1" type="checkbox" id="transaksi_1" value="DD-6-1" <?php if(strstr($row_edit['akses'],"DD-6-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="transaksi_2" type="checkbox" id="transaksi_2" value="DD-6-2" <?php if(strstr($row_edit['akses'],"DD-6-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="transaksi_3" type="checkbox" id="transaksi_3" value="DD-6-3" <?php if(strstr($row_edit['akses'],"DD-6-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="transaksi_4" type="checkbox" id="transaksi_4" value="DD-6" <?php if(strstr($row_edit['akses'],"DD-6")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="sretail_1" type="checkbox" id="sretail_1" value="PJ-7-1" <?php if(strstr($row_edit['akses'],"PJ-7-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="sretail_2" type="checkbox" id="sretail_2" value="PJ-7-2" <?php if(strstr($row_edit['akses'],"PJ-7-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="sretail_3" type="checkbox" id="sretail_3" value="PJ-7-3" <?php if(strstr($row_edit['akses'],"PJ-7-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="sretail_4" type="checkbox" id="sretail_4" value="PJ-7" <?php if(strstr($row_edit['akses'],"PJ-7")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="extendstnk_1" type="checkbox" id="extendstnk_1" value="EX-5-1" <?php if(strstr($row_edit['akses'],"EX-1-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="extendstnk_2" type="checkbox" id="extendstnk_2" value="EX-5-2" <?php if(strstr($row_edit['akses'],"EX-1-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="extendstnk_3" type="checkbox" id="extendstnk_3" value="EX-5-3" <?php if(strstr($row_edit['akses'],"EX-1-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="extendstnk_4" type="checkbox" id="extendstnk_4" value="DD-6" <?php if(strstr($row_edit['akses'],"EX-1")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="extendpolis_1" type="checkbox" id="extendpolis_1" value="EX-2-1" <?php if(strstr($row_edit['akses'],"EX-2-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="extendpolis_2" type="checkbox" id="extendpolis_2" value="EX-2-2" <?php if(strstr($row_edit['akses'],"EX-2-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="extendpolis_3" type="checkbox" id="extendpolis_3" value="EX-2-3" <?php if(strstr($row_edit['akses'],"EX-2-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="extendpolis_4" type="checkbox" id="extendpolis_4" value="EX-2" <?php if(strstr($row_edit['akses'],"EX-2")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="extendkir_1" type="checkbox" id="extendkir_1" value="EX-3-1" <?php if(strstr($row_edit['akses'],"EX-3-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="extendkir_2" type="checkbox" id="extendkir_2" value="EX-3-2" <?php if(strstr($row_edit['akses'],"EX-3-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="extendkir_3" type="checkbox" id="extendkir_3" value="EX-3-3" <?php if(strstr($row_edit['akses'],"EX-3-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="extendkir_4" type="checkbox" id="extendkir_4" value="EX-3" <?php if(strstr($row_edit['akses'],"EX-3")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
          </tr>
          <tr>
            <th>Transaksi Mutasi</th>
            <th valign="top">Transaksi Replace</th>
            <th valign="top">Data Kontrak </th>
            <th>Invoice Kontrak </th>
            <th>&nbsp;</th>
          </tr>
          <tr>
            <td valign="top"><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="mutasi_1" type="checkbox" id="mutasi_1" value="EX-4-1" <?php if(strstr($row_edit['akses'],"EX-4-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="mutasi_2" type="checkbox" id="mutasi_2" value="EX-4-2" <?php if(strstr($row_edit['akses'],"EX-4-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="mutasi_3" type="checkbox" id="mutasi_3" value="EX-4-3" <?php if(strstr($row_edit['akses'],"EX-4-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="mutasi_4" type="checkbox" id="mutasi_4" value="EX-4" <?php if(strstr($row_edit['akses'],"EX-4")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td valign="top"><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="replace_1" type="checkbox" id="replace_1" value="EX-5-1" <?php if(strstr($row_edit['akses'],"EX-5-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="replace_2" type="checkbox" id="replace_2" value="EX-5-2" <?php if(strstr($row_edit['akses'],"EX-5-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="replace_3" type="checkbox" id="replace_3" value="EX-5-3" <?php if(strstr($row_edit['akses'],"EX-5-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="replace_4" type="checkbox" id="replace_4" value="EX-5" <?php if(strstr($row_edit['akses'],"EX-5")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="skontrak_1" type="checkbox" id="skontrak_1" value="KR-1-1" <?php if(strstr($row_edit['akses'],"KR-1-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="skontrak_2" type="checkbox" id="skontrak_2" value="KR-1-2" <?php if(strstr($row_edit['akses'],"KR-1-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="skontrak_3" type="checkbox" id="skontrak_3" value="KR-1-3" <?php if(strstr($row_edit['akses'],"KR-1-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="skontrak_4" type="checkbox" id="skontrak_4" value="KR-1" <?php if(strstr($row_edit['akses'],"KR-1")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="ikontrak_1" type="checkbox" id="ikontrak_1" value="IK-1-1" <?php if(strstr($row_edit['akses'],"IK-1-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="ikontrak_2" type="checkbox" id="ikontrak_2" value="IK-1-2" <?php if(strstr($row_edit['akses'],"IK-1-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="ikontrak_3" type="checkbox" id="ikontrak_3" value="IK-1-3" <?php if(strstr($row_edit['akses'],"IK-1-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="ikontrak_4" type="checkbox" id="ikontrak_4" value="IK-1" <?php if(strstr($row_edit['akses'],"IK-1")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td>&nbsp;</td>
          </tr>
          
      </table></td>
    </tr>

    <tr valign="top">
      <td align="right">Data Master Karyawan, Asuransi, Bengkel &amp; Supplier :</td>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
          <tr>
            <th width="21%">Kontak</th>
            <th width="20%">Unit Kerja</th>
            <th width="20%">Customer Corporate</th>
            <th width="19%">Customer Retail</th>
            <th width="20%">Lokasi Kantor</th>
          </tr>
          <tr valign="top">
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="kontak_1" type="checkbox" id="kontak_1" value="DD-2-1" <?php if(strstr($row_edit['akses'],"DD-2-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="kontak_2" type="checkbox" id="kontak_2" value="DD-2-2" <?php if(strstr($row_edit['akses'],"DD-2-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="kontak_3" type="checkbox" id="kontak_3" value="DD-2-3" <?php if(strstr($row_edit['akses'],"DD-2-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="kontak_4" type="checkbox" id="kontak_4" value="DD-2" <?php if(strstr($row_edit['akses'],"DD-2")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="unitkerja_1" type="checkbox" id="unitkerja_1" value="UK-1-1" <?php if(strstr($row_edit['akses'],"UK-1-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="unitkerja_2" type="checkbox" id="unitkerja_2" value="UK-1-2" <?php if(strstr($row_edit['akses'],"UK-1-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="unitkerja_3" type="checkbox" id="unitkerja_3" value="UK-1-3" <?php if(strstr($row_edit['akses'],"UK-1-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="unitkerja_4" type="checkbox" id="unitkerja_4" value="UK-1" <?php if(strstr($row_edit['akses'],"UK-1")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="ccorporate_1" type="checkbox" id="service_9" value="DD-8-1" <?php if(strstr($row_edit['akses'],"DD-8-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="ccorporate_2" type="checkbox" id="service_10" value="DD-8-2" <?php if(strstr($row_edit['akses'],"DD-8-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="ccorporate_3" type="checkbox" id="service_11" value="DD-8-3" <?php if(strstr($row_edit['akses'],"DD-8-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="ccorporate_4" type="checkbox" id="service_12" value="DD-8" <?php if(strstr($row_edit['akses'],"DD-8")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="cretail_1" type="checkbox" id="cretail_1" value="DD-7-1" <?php if(strstr($row_edit['akses'],"DD-7-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="cretail_2" type="checkbox" id="service_6" value="DD-7-2" <?php if(strstr($row_edit['akses'],"DD-7-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="cretail_3" type="checkbox" id="service_7" value="DD-7-3" <?php if(strstr($row_edit['akses'],"DD-7-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="cretail_4" type="checkbox" id="service_8" value="DD-7" <?php if(strstr($row_edit['akses'],"DD-7")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="gudang_1" type="checkbox" id="gudang_1" value="PD-7-1" <?php if(strstr($row_edit['akses'],"PD-7-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="gudang_2" type="checkbox" id="gudang_2" value="PD-7-2" <?php if(strstr($row_edit['akses'],"PD-7-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="gudang_3" type="checkbox" id="gudang_3" value="PD-7-3" <?php if(strstr($row_edit['akses'],"PD-7-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="gudang_4" type="checkbox" id="gudang_4" value="PD-7" <?php if(strstr($row_edit['akses'],"PD-7")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
          </tr>
      </table></td>
    </tr>
    <tr valign="top">
      <td align="right">&nbsp;</td>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
          <tr>
            <th width="21%">Jenis Asuransi </th>
            <th width="19%">Rekanan Asuransi </th>
            <th width="19%">Rekanan Bengkel </th>
            <th width="21%">Rekanan Supplier </th>
            <th width="20%">Wilayah/Cabang</th>
          </tr>
          <tr valign="top">
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="jenisasuransi_1" type="checkbox" id="jenisasuransi_1" value="JA-1-1" <?php if(strstr($row_edit['akses'],"JA-1-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="jenisasuransi_2" type="checkbox" id="jenisasuransi_2" value="JA-1-2" <?php if(strstr($row_edit['akses'],"JA-1-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="jenisasuransi_3" type="checkbox" id="jenisasuransi_3" value="JA-1-3" <?php if(strstr($row_edit['akses'],"JA-1-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="jenisasuransi_4" type="checkbox" id="jenisasuransi_4" value="JA-1" <?php if(strstr($row_edit['akses'],"JA-1")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="rekasuransi_1" type="checkbox" id="rekasuransi_1" value="RB-1-1" <?php if(strstr($row_edit['akses'],"RB-1-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="rekasuransi_2" type="checkbox" id="rekasuransi_2" value="RB-1-2" <?php if(strstr($row_edit['akses'],"RB-1-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="rekasuransi_3" type="checkbox" id="rekasuransi_3" value="RB-1-3" <?php if(strstr($row_edit['akses'],"RB-1-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="rekasuransi_4" type="checkbox" id="rekasuransi_4" value="RB-1" <?php if(strstr($row_edit['akses'],"RB-1")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="rekbengkel_1" type="checkbox" id="rekbengkel_1" value="RB-2-1" <?php if(strstr($row_edit['akses'],"RB-2-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="rekbengkel_2" type="checkbox" id="rekbengkel_2" value="RB-2-2" <?php if(strstr($row_edit['akses'],"RB-2-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="rekbengkel_3" type="checkbox" id="rekbengkel_3" value="RB-2-3" <?php if(strstr($row_edit['akses'],"RB-2-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="rekbengkel_4" type="checkbox" id="rekbengkel_4" value="RB-2" <?php if(strstr($row_edit['akses'],"RB-2")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="reksupplier_1" type="checkbox" id="reksupplier_1" value="RB-3-1" <?php if(strstr($row_edit['akses'],"RB-3-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="reksupplier_2" type="checkbox" id="reksupplier_2" value="RB-3-2" <?php if(strstr($row_edit['akses'],"RB-3-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="reksupplier_3" type="checkbox" id="reksupplier_3" value="RB-3-3" <?php if(strstr($row_edit['akses'],"RB-3-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="reksupplier_4" type="checkbox" id="reksupplier_4" value="RB-3" <?php if(strstr($row_edit['akses'],"RB-3")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="area_1" type="checkbox" id="area_1" value="PD-6-1" <?php if(strstr($row_edit['akses'],"PD-6-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="area_2" type="checkbox" id="area_2" value="PD-6-2" <?php if(strstr($row_edit['akses'],"PD-6-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="area_3" type="checkbox" id="area_3" value="PD-6-3" <?php if(strstr($row_edit['akses'],"PD-6-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="area_4" type="checkbox" id="area_4" value="PD-6" <?php if(strstr($row_edit['akses'],"PD-6")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
          </tr>
      </table></td>
    </tr>
    
    <tr valign="top">
      <td align="right">Data Master Kendaraan :</td>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
          <tr>
            <th width="21%">Merk Kendaraan</th>
            <th width="20%">Jenis Kendaraan</th>
            <th width="20%">Tipe Kendaraan</th>
            <th width="19%">Master Kendaraan</th>
            <th width="20%">Jenis Kecelakaan</th>
          </tr>
          <tr valign="top">
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="mkservice_1" type="checkbox" id="mkservice_1" value="JS-5-1" <?php if(strstr($row_edit['akses'],"JS-5-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="mkservice_2" type="checkbox" id="mkservice_2" value="JS-5-2" <?php if(strstr($row_edit['akses'],"JS-5-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="mkservice_3" type="checkbox" id="mkservice_3" value="JS-5-3" <?php if(strstr($row_edit['akses'],"JS-5-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="mkservice_4" type="checkbox" id="mkservice_4" value="JS-5" <?php if(strstr($row_edit['akses'],"JS-5")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="jkservice_1" type="checkbox" id="jkservice_1" value="JS-6-1" <?php if(strstr($row_edit['akses'],"JS-6-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="jkservice_2" type="checkbox" id="jkservice_2" value="JS-6-2" <?php if(strstr($row_edit['akses'],"JS-6-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="jkservice_3" type="checkbox" id="jkservice_3" value="JS-6-3" <?php if(strstr($row_edit['akses'],"JS-6-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="jkservice_4" type="checkbox" id="jkservice_4" value="JS-6" <?php if(strstr($row_edit['akses'],"JS-6")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="jservice_1" type="checkbox" id="jservice_1" value="JS-7-1" <?php if(strstr($row_edit['akses'],"JS-7-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="jservice_2" type="checkbox" id="jservice_2" value="JS-7-2" <?php if(strstr($row_edit['akses'],"JS-7-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="jservice_3" type="checkbox" id="jservice_3" value="JS-7-3" <?php if(strstr($row_edit['akses'],"JS-7-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="jservice_4" type="checkbox" id="jservice_4" value="JS-7" <?php if(strstr($row_edit['akses'],"JS-7")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="service_1" type="checkbox" id="service_1" value="MS-8-1" <?php if(strstr($row_edit['akses'],"MS-8-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="service_2" type="checkbox" id="service_2" value="MS-8-2" <?php if(strstr($row_edit['akses'],"MS-8-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="service_3" type="checkbox" id="service_3" value="MS-8-3" <?php if(strstr($row_edit['akses'],"MS-8-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="service_4" type="checkbox" id="service_4" value="MS-8" <?php if(strstr($row_edit['akses'],"MS-8")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="jaccident_1" type="checkbox" id="jaccident_1" value="JS-1-1" <?php if(strstr($row_edit['akses'],"JS-1-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="jaccident_2" type="checkbox" id="jaccident_2" value="JS-1-2" <?php if(strstr($row_edit['akses'],"JS-1-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="jaccident_3" type="checkbox" id="jaccident_3" value="JS-1-3" <?php if(strstr($row_edit['akses'],"JS-1-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="jaccident_4" type="checkbox" id="jaccident_4" value="JS-1" <?php if(strstr($row_edit['akses'],"JS-1")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
          </tr>
          <tr>
            <th>Paket Harga Sewa</th>
            <th>Jenis BBM</th>
            <th>Status Kendaraan</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
          <tr>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="phservice_1" type="checkbox" id="phservice_1" value="JS-4-1" <?php if(strstr($row_edit['akses'],"JS-4-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="phservice_2" type="checkbox" id="phservice_2" value="JS-4-2" <?php if(strstr($row_edit['akses'],"JS-4-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="phservice_3" type="checkbox" id="phservice_3" value="JS-4-3" <?php if(strstr($row_edit['akses'],"JS-4-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                    <input name="phservice_4" type="checkbox" id="phservice_4" value="JS-4" <?php if(strstr($row_edit['akses'],"JS-4")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td valign="top"><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="jbservice_1" type="checkbox" id="jbservice_1" value="JS-3-1" <?php if(strstr($row_edit['akses'],"JS-3-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="jbservice_2" type="checkbox" id="jbservice_2" value="JS-3-2" <?php if(strstr($row_edit['akses'],"JS-3-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="jbservice_3" type="checkbox" id="jbservice_3" value="JS-3-3" <?php if(strstr($row_edit['akses'],"JS-3-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="jbservice_4" type="checkbox" id="jbservice_4" value="JS-3" <?php if(strstr($row_edit['akses'],"JS-3")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td valign="top"><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="skservice_1" type="checkbox" id="skservice_1" value="JS-2-1" <?php if(strstr($row_edit['akses'],"JS-2-1")) { ?>checked="checked"<?php } ?>/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="skservice_2" type="checkbox" id="skservice_2" value="JS-2-2" <?php if(strstr($row_edit['akses'],"JS-2-2")) { ?>checked="checked"<?php } ?>/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="skservice_3" type="checkbox" id="skservice_3" value="JS-2-3" <?php if(strstr($row_edit['akses'],"JS-2-3")) { ?>checked="checked"<?php } ?>/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="skservice_4" type="checkbox" id="skservice_4" value="JS-2" <?php if(strstr($row_edit['akses'],"JS-2")) { ?>checked="checked"<?php } ?>/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      </table></td>
    </tr>

    <tr valign="top">

      <td align="right">Kas &amp; Bank :</td>

      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="21%">Transfer</th>

          <th width="20%">Kas Masuk</th>

          <th width="20%">Kas Keluar</th>

          <th width="19%">&nbsp;</th>
          <th width="20%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="transfer_1" type="checkbox" id="transfer_1" value="KB-1-1" <?php if(strstr($row_edit['akses'],"KB-1-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="transfer_2" type="checkbox" id="transfer_2" value="KB-1-2" <?php if(strstr($row_edit['akses'],"KB-1-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="transfer_3" type="checkbox" id="transfer_3" value="KB-1-3" <?php if(strstr($row_edit['akses'],"KB-1-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="transfer_4" type="checkbox" id="transfer_4" value="KB-1" <?php if(strstr($row_edit['akses'],"KB-1")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="kasmasuk_1" type="checkbox" id="kasmasuk_1" value="KB-2-1" <?php if(strstr($row_edit['akses'],"KB-2-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="kasmasuk_2" type="checkbox" id="kasmasuk_2" value="KB-2-2" <?php if(strstr($row_edit['akses'],"KB-2-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="kasmasuk_3" type="checkbox" id="kasmasuk_3" value="KB-2-3" <?php if(strstr($row_edit['akses'],"KB-2-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="kasmasuk_4" type="checkbox" id="kasmasuk_4" value="KB-2" <?php if(strstr($row_edit['akses'],"KB-2")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="kaskeluar_1" type="checkbox" id="kaskeluar_1" value="KB-3-1" <?php if(strstr($row_edit['akses'],"KB-3-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="kaskeluar_2" type="checkbox" id="kaskeluar_2" value="KB-3-2" <?php if(strstr($row_edit['akses'],"KB-3-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="kaskeluar_3" type="checkbox" id="kaskeluar_3" value="KB-3-3" <?php if(strstr($row_edit['akses'],"KB-3-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="kaskeluar_4" type="checkbox" id="kaskeluar_4" value="KB-3" <?php if(strstr($row_edit['akses'],"KB-3")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>

          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

      </table></td>
    </tr>

    <tr valign="top">

      <td align="right">Persediaan :</td>

      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="21%">Persediaan</th>

          <th width="20%">Barang</th>

          <th width="20%">Kelompok Barang</th>

          <th width="19%">Satuan</th>
          <th width="20%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="persediaan_1" type="checkbox" id="persediaan_1" value="PD-1-1" <?php if(strstr($row_edit['akses'],"PD-1-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="persediaan_2" type="checkbox" id="persediaan_2" value="PD-1-2" <?php if(strstr($row_edit['akses'],"PD-1-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="persediaan_3" type="checkbox" id="persediaan_3" value="PD-1-3" <?php if(strstr($row_edit['akses'],"PD-1-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="persediaan_4" type="checkbox" id="persediaan_4" value="PD-1" <?php if(strstr($row_edit['akses'],"PD-1")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

            <li>

              <label>

                <input name="stokopname" type="checkbox" id="stokopname" value="PD-2" <?php if(strstr($row_edit['akses'],"PD-2")) { ?>checked="checked"<?php } ?>/>

                Stok Opname<br />

                <input name="kartustok" type="checkbox" id="kartustok" value="PD-6" <?php if(strstr($row_edit['akses'],"PD-6")) { ?>checked="checked"<?php } ?>/>
              </label>

              Kartu Stok

              <label></label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="barang_1" type="checkbox" id="barang_1" value="PD-3-1" <?php if(strstr($row_edit['akses'],"PD-3-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="barang_2" type="checkbox" id="barang_2" value="PD-3-2" <?php if(strstr($row_edit['akses'],"PD-3-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="barang_3" type="checkbox" id="barang_3" value="PD-3-3" <?php if(strstr($row_edit['akses'],"PD-3-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="barang_4" type="checkbox" id="barang_4" value="PD-3" <?php if(strstr($row_edit['akses'],"PD-3")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="kelompok_1" type="checkbox" id="kelompok_1" value="PD-4-1" <?php if(strstr($row_edit['akses'],"PD-4-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="kelompok_2" type="checkbox" id="kelompok_2" value="PD-4-2" <?php if(strstr($row_edit['akses'],"PD-4-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="kelompok_3" type="checkbox" id="kelompok_3" value="PD-4-3" <?php if(strstr($row_edit['akses'],"PD-4-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="kelompok_4" type="checkbox" id="kelompok_4" value="PD-4" <?php if(strstr($row_edit['akses'],"PD-4")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="satuan_1" type="checkbox" id="satuan_1" value="PD-5-1" <?php if(strstr($row_edit['akses'],"PD-4-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="satuan_2" type="checkbox" id="satuan_2" value="PD-5-2" <?php if(strstr($row_edit['akses'],"PD-4-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="satuan_3" type="checkbox" id="satuan_3" value="PD-5-3" <?php if(strstr($row_edit['akses'],"PD-4-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="satuan_4" type="checkbox" id="satuan_4" value="PD-5" <?php if(strstr($row_edit['akses'],"PD-4")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>
          <td>&nbsp;</td>
        </tr>

      </table></td>
    </tr>

    <tr valign="top">

      <td align="right">Pembelian :</td>

      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="21%">Purchase Order</th>

          <th width="20%">Retur</th>

          <th width="20%">Pembayaran Hutang</th>

          <th width="19%">&nbsp;</th>
          <th width="20%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="purchase_1" type="checkbox" id="purchase_1" value="PB-1-1" <?php if(strstr($row_edit['akses'],"PB-1-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="purchase_2" type="checkbox" id="purchase_2" value="PB-1-2" <?php if(strstr($row_edit['akses'],"PB-1-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="purchase_3" type="checkbox" id="purchase_3" value="PB-1-3" <?php if(strstr($row_edit['akses'],"PB-1-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="purchase_4" type="checkbox" id="purchase_4" value="PB-1" <?php if(strstr($row_edit['akses'],"PB-1")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

            <li>

              <input name="pengiriman_pb" type="checkbox" id="pengiriman_pb" value="PB-2" <?php if(strstr($row_edit['akses'],"PB-2")) { ?>checked="checked"<?php } ?>/>

              Pengiriman Barang</li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="retur_pb_1" type="checkbox" id="retur_pb_1" value="PB-3-1" <?php if(strstr($row_edit['akses'],"PB-3-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pb_2" type="checkbox" id="retur_pb_2" value="PB-3-2" <?php if(strstr($row_edit['akses'],"PB-3-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pb_3" type="checkbox" id="retur_pb_3" value="PB-3-3" <?php if(strstr($row_edit['akses'],"PB-3-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pb_4" type="checkbox" id="retur_pb_4" value="PB-3" <?php if(strstr($row_edit['akses'],"PB-3")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="pembayaranhutang_1" type="checkbox" id="pembayaranhutang_1" value="PB-4-1" <?php if(strstr($row_edit['akses'],"PB-4-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranhutang_2" type="checkbox" id="pembayaranhutang_2" value="PB-4-2" <?php if(strstr($row_edit['akses'],"PB-4-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranhutang_3" type="checkbox" id="pembayaranhutang_3" value="PB-4-3" <?php if(strstr($row_edit['akses'],"PB-4-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranhutang_4" type="checkbox" id="pembayaranhutang_4" value="PB-4" <?php if(strstr($row_edit['akses'],"PB-4")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

            <li>

              <label>

                <input name="hutangusaha" type="checkbox" id="hutangusaha" value="PB-5" <?php if(strstr($row_edit['akses'],"PB-5")) { ?>checked="checked"<?php } ?>/>
              </label>

              Hutang Usaha</li>

            <li>

              <label>

                <input name="kartuhutang" type="checkbox" id="kartuhutang" value="PB-6" <?php if(strstr($row_edit['akses'],"PB-6")) { ?>checked="checked"<?php } ?>/>
              </label>

              Kartu Hutang</li>

          </ul></td>

          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

      </table></td>
    </tr>

    <tr valign="top">

      <td align="right">Penjualan :</td>

      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="21%">Sales Order</th>

          <th width="20%">Retur</th>

          <th width="20%">Pembayaran Piutang</th>

          <th width="19%">&nbsp;</th>
          <th width="20%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="sales_1" type="checkbox" id="sales_1" value="PJ-1-1" <?php if(strstr($row_edit['akses'],"PJ-1-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="sales_2" type="checkbox" id="sales_2" value="PJ-1-2" <?php if(strstr($row_edit['akses'],"PJ-1-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="sales_3" type="checkbox" id="sales_3" value="PJ-1-3" <?php if(strstr($row_edit['akses'],"PJ-1-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="sales_4" type="checkbox" id="sales_4" value="PJ-1" <?php if(strstr($row_edit['akses'],"PJ-1")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

            <li>

              <input name="pengiriman_pj" type="checkbox" id="pengiriman_pj" value="PJ-2" <?php if(strstr($row_edit['akses'],"PJ-2")) { ?>checked="checked"<?php } ?>/>

              Pengiriman Barang</li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="retur_pj_1" type="checkbox" id="retur_pj_1" value="PJ-3-1" <?php if(strstr($row_edit['akses'],"PJ-3-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pj_2" type="checkbox" id="retur_pj_2" value="PJ-3-2" <?php if(strstr($row_edit['akses'],"PJ-3-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pj_3" type="checkbox" id="retur_pj_3" value="PJ-3-3" <?php if(strstr($row_edit['akses'],"PJ-3-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pj_4" type="checkbox" id="retur_pj_4" value="PJ-3" <?php if(strstr($row_edit['akses'],"PJ-3")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="pembayaranpiutang_1" type="checkbox" id="pembayaranpiutang_1" value="PJ-4-1" <?php if(strstr($row_edit['akses'],"PJ-4-1")) { ?>checked="checked"<?php } ?>/>

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranpiutang_2" type="checkbox" id="pembayaranpiutang_2" value="PJ-4-2" <?php if(strstr($row_edit['akses'],"PJ-4-2")) { ?>checked="checked"<?php } ?>/>

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranpiutang_3" type="checkbox" id="pembayaranpiutang_3" value="PJ-4-3" <?php if(strstr($row_edit['akses'],"PJ-4-3")) { ?>checked="checked"<?php } ?>/>

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranpiutang_4" type="checkbox" id="pembayaranpiutang_4" value="PJ-4" <?php if(strstr($row_edit['akses'],"PJ-4")) { ?>checked="checked"<?php } ?>/>

                Lihat Data</label>
            </li>

            <li>

              <input name="piutangusaha" type="checkbox" id="piutangusaha" value="PJ-5" <?php if(strstr($row_edit['akses'],"PJ-5")) { ?>checked="checked"<?php } ?>/>

              Piutang Usaha </li>

            <li>

              <label>

                <input name="kartupiutang" type="checkbox" id="kartupiutang" value="PJ-6" <?php if(strstr($row_edit['akses'],"PJ-6")) { ?>checked="checked"<?php } ?>/>
              </label>

              Kartu Piutang </li>

          </ul></td>

          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

      </table></td>
    </tr>

    <tr valign="top">

      <td align="right">Laporan :</td>

      <td><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="21%">Jurnal &amp; GL</th>

          <th width="20%">Penjualan</th>

          <th width="20%">Aruskas, R/L, &amp; Neraca</th>

          <th width="19%">&nbsp;</th>
          <th width="20%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="t_harian" type="checkbox" id="t_harian" value="L-2" <?php if(strstr($row_edit['akses'],"L-2")) { ?>checked="checked"<?php } ?>/>
              </label>

              Transaksi Harian</li>

            <li>

              <label>

                <input name="jurnal" type="checkbox" id="jurnal" value="L-4" <?php if(strstr($row_edit['akses'],"L-4")) { ?>checked="checked"<?php } ?>/>
              </label>

              Jurnal</li>

            <li>

              <label>

                <input name="bukubesar" type="checkbox" id="bukubesar" value="L-6" <?php if(strstr($row_edit['akses'],"L-6")) { ?>checked="checked"<?php } ?>/>
              </label>

              Buku Besar </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="r_penjualan" type="checkbox" id="r_penjualan" value="L-7" <?php if(strstr($row_edit['akses'],"L-7")) { ?>checked="checked"<?php } ?>/>
              </label>

              Rekap Penjualan</li>

            <li>

              <label>

                <input name="r_iklan" type="checkbox" id="r_iklan" value="L-8" <?php if(strstr($row_edit['akses'],"L-8")) { ?>checked="checked"<?php } ?>/>
              </label>

              Rekap Iklan </li>

            <li>

              <label>

                <input name="rekap_retur" type="checkbox" id="rekap_retur" value="L-9" <?php if(strstr($row_edit['akses'],"L-9")) { ?>checked="checked"<?php } ?>/>
              </label>

              Rekap Retur</li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="aruskas" type="checkbox" id="aruskas" value="L-5" <?php if(strstr($row_edit['akses'],"L-5")) { ?>checked="checked"<?php } ?>/>
              </label>

              Arus Kas</li>

            <li>

              <label>

                <input name="rugilaba" type="checkbox" id="rugilaba" value="L-1" <?php if(strstr($row_edit['akses'],"L-1")) { ?>checked="checked"<?php } ?>/>
              </label>

              Rugi Laba</li>

            <li>

              <label>

                <input name="neraca" type="checkbox" id="neraca" value="L-3" <?php if(strstr($row_edit['akses'],"L-3")) { ?>checked="checked"<?php } ?>/>
              </label>

              Neraca</li>

          </ul></td>

          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

      </table></td>
    </tr>

    <tr>

      <td align="left"><em>*Harus diisi</em>        <input name="id" type="hidden" id="id" value="<?php echo $row_edit['id']; ?>" /></td>

      <td><label>

        <input name="Save" type="submit" id="Save" value="Simpan" />

      </label>

        <label>

          <input type="button" name="Button" value="Batal" onclick="javascript:history.go(-1);" />
        </label></td>
    </tr>
  </table>

  <input type="hidden" name="MM_update" value="add">

</form>