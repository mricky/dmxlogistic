<?php require('connections/con_gl.php'); ?>

<?php

cekAkses($_SESSION[akses],"A-1-1");

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

      $('#alamat').wysiwyg();

	  $('#b_alamat').wysiwyg();

  });

</script>

<link type="text/css" rel="stylesheet" href="css/jquery.wysiwyg.css" />

<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>

<div id="result" style="display:none;"></div>

<h1>Tambah User</h1>

<form action="proses/user.php?act=add" method="POST" name="add" id="add">

  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="datatable">

    <tr>

      <td width="17%" align="right">Username* : </td>

      <td colspan="5"><label>

        <input name="username" type="text" id="username" size="28" maxlength="20" autocomplete="off" />

      </label></td>
    </tr>

    <tr>

      <td align="right">Password* : </td>

      <td colspan="5"><label>

        <input name="password" type="password" id="password" size="28" maxlength="20" autocomplete="off" />

      </label></td>
    </tr>

    <tr>

      <td align="right">Link  Karyawan : </td>

      <td colspan="5"><label> <input type="hidden" name="karyawan" id="karyawan" />
        <input type="text" name="txtkaryawan" id="txtkaryawan" size="28" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;" onclick="NewWindow('index.php?component=kontak&amp;task=listkaryawan&amp;open=window','name','825','450','yes');return false" />        
		<?php if(strstr($_SESSION['akses'],"DD-2-1")) { ?>
        <a href="index.php?component=kontak&amp;task=add&amp;open=window" onclick="NewWindow(this.href,'name','1025','450','yes');return false"><img src="images/add_.png" hspace="2" border="0" style="position:absolute;" /></a>
        <?php } ?></label></td>
    </tr>

    <tr valign="top">

      <td align="right">Pengaturan :</td>

      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="20%"><div align="center">User&nbsp;
                <input type="checkbox" name="checkuser" id="checkuser" onclick="javascript: if(this.checked==true){for(i=1;i<=5; i++){document.getElementById('user_'+i).checked=true;}}else{for(i=1;i<=5; i++){document.getElementById('user_'+i).checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Budgeting&nbsp;  
            <input type="checkbox" name="checkbudgeting" id="checbudgeting" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('periode_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('periode_'+i).checked=false;}}" />
          </div></th>

          <th width="20%"><div align="center">Klasifikasi Akun&nbsp;
                <input type="checkbox" name="checkklasifikasi" id="checbklasifikasi" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('klasifikasi_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('klasifikasi_'+i).checked=false;}}" />
                   </div></th>

          <th width="20%"><div align="center">Akun&nbsp;
                <input type="checkbox" name="checkakun" id="checbakun" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=5; i++){document.getElementById('akun_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('akun_'+i).checked=false;}}" />
                   </div></th>
          <th width="19%"><div align="center">Info Perusahaan</div></th>
          </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="user_1" type="checkbox" id="user_1" value="A-1-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="user_2" type="checkbox" id="user_2" value="A-1-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="user_3" type="checkbox" id="user_3" value="A-1-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="user_4" type="checkbox" id="user_4" value="A-1" />

                Lihat Data</label>
            </li>

            <li>

              <label>

                <input name="user_5" type="checkbox" id="user_5" value="A-1-4" />

                Super User</label></li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="periode_1" type="checkbox" id="periode_1" value="A-2-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="periode_2" type="checkbox" id="periode_2" value="A-2-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="periode_3" type="checkbox" id="periode_3" value="A-2-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="periode_4" type="checkbox" id="periode_4" value="A-2" />

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="klasifikasi_1" type="checkbox" id="klasifikasi_1" value="A-3-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="klasifikasi_2" type="checkbox" id="klasifikasi_2" value="A-3-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="klasifikasi_3" type="checkbox" id="klasifikasi_3" value="A-3-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="klasifikasi_4" type="checkbox" id="klasifikasi_4" value="A-3" />

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">
              <li>
                <label>
                <input name="akun_1" type="checkbox" id="akun_1" value="DD-1-1" />
                  Tambah Data</label>
              </li>
            <li>
                <label>
                <input name="akun_2" type="checkbox" id="akun_2" value="DD-1-2" />
                  Edit Data</label>
              </li>
            <li>
                <label>
                <input name="akun_3" type="checkbox" id="akun_3" value="DD-1-3" />
                  Hapus Data</label>
              </li>
            <li>
                <label><input name="akun_4" type="checkbox" id="akun_4" value="DD-1" />
                 Lihat Data</label>
              </li>
            <li>
                <label><input name="akun_5" type="checkbox" id="akun_5" value="DD-2" />
                 Akun Cabang</label>
              </li>
          </ul></td>
          <td><ul style="list-style:none;">
            <li>
              <label>
                <input name="info" type="checkbox" id="info" value="A-4" />
                </label>
              Lihat Data</li>
          </ul></td>
          </tr>

      </table>        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
          <tr>
            <th width="20%"><div align="center">Gol. Aset&nbsp;
                <input type="checkbox" name="checkikontrak" id="checkikontrak" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('golaset_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('golaset_'+i).checked=false;}}" />
                       </div></th>
            <th width="21%"><div align="center">ATP&nbsp;
                <input type="checkbox" name="checkatp" id="checkatp" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('atp_'+i).checked=true;}{document.getElementById('penyusutan_4').checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('atp_'+i).checked=false;}{document.getElementById('penyusutan_4').checked=false;}}" />
            </div></th>
            <th width="35%">&nbsp;</th>
            <th width="24%">&nbsp;</th>
          </tr>
          <tr valign="top">
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="golaset_1" type="checkbox" id="golaset_1" value="DD-3-1" />
                  Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="golaset_2" type="checkbox" id="golaset_2" value="DD-3-2" />
                  Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="golaset_3" type="checkbox" id="golaset_3" value="DD-3-3" />
                  Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="golaset_4" type="checkbox" id="golaset_4" value="DD-3" />
                  Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="atp_1" type="checkbox" id="atp_1" value="DD-4-1" />
                  Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="atp_2" type="checkbox" id="atp_2" value="DD-4-2" />
                  Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="atp_3" type="checkbox" id="atp_3" value="DD-4-3" />
                  Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="atp_4" type="checkbox" id="atp_4" value="DD-4" />
                  Lihat Data</label>
                </li>
              <li>
                  <label>
                  <input name="penyusutan_4" type="checkbox" id="penyusutan_4" value="DD-5" />
                  Penyusutan Aset </label>
                </li>
            </ul></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
              </table></td>
    </tr>

    <tr valign="top">

      <td align="right">Data - Transaksi :</td>

      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>
          <th width="20%"><div align="center">Transaksi Harian
            <input type="checkbox" name="checktransaksi" id="checktransaksi" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('transaksi_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('transaksi_'+i).checked=false;}}" />
          </div></th>
          <th aling="width="21%" valign="top"><div align="center">Transaksi OrderRetail
              <input type="checkbox" name="checksretail" id="checksretail" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('sretail_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('sretail_'+i).checked=false;}}" />
          </div></th>

          <th width="20%"><div align="center">Extend STNK 
            <input type="checkbox" name="checkextendstnk" id="checextendstnk" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('extendstnk_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('extendstnk_'+i).checked=false;}}" />
          </div></th>
          <th width="20%"><div align="center">Extend Asuransi 
            <input type="checkbox" name="checkextendpolis" id="checkextendpolis" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('extendpolis_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('extendpolis_'+i).checked=false;}}" />
          </div></th>
          <th width="19%" valign="top">Extend KIR <input type="checkbox" name="checkextendkir" id="checkextendkir" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('extendkir_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('extendkir_'+i).checked=false;}}" /></th>
        </tr>

        <tr valign="top">
          <td><ul style="list-style:none;">
              <li>
                <label>
                <input name="transaksi_1" type="checkbox" id="transaksi_1" value="DD-6-1" />
                  Tambah Data</label>
              </li>
            <li>
                <label>
                <input name="transaksi_2" type="checkbox" id="transaksi_2" value="DD-6-2" />
                  Edit Data</label>
              </li>
            <li>
                <label>
                <input name="transaksi_3" type="checkbox" id="transaksi_3" value="DD-6-3" />
                  Hapus Data</label>
              </li>
            <li>
                <label>
                <input name="transaksi_4" type="checkbox" id="transaksi_4" value="DD-6" />
                  Lihat Data</label>
              </li>
          </ul></td>
          <td><ul style="list-style:none;">
              <li>
                <label>
                <input name="sretail_1" type="checkbox" id="sretail_1" value="PJ-7-1"/>
                  Tambah Data</label>
              </li>
            <li>
                <label>
                <input name="sretail_2" type="checkbox" id="sretail_2" value="PJ-7-2"/>
                  Edit Data</label>
              </li>
            <li>
                <label>
                <input name="sretail_3" type="checkbox" id="sretail_3" value="PJ-7-3"/>
                  Hapus Data</label>
              </li>
            <li>
                <label>
                <input name="sretail_4" type="checkbox" id="sretail_4" value="PJ-7"/>
                  Lihat Data</label>
              </li>
          </ul></td>

          <td><ul style="list-style:none;">
            <li>
              <label>
              <input name="extendstnk_1" type="checkbox" id="extendstnk_1" value="EX-1-1"/>
                Tambah Data</label>
            </li>
            <li>
              <label>
              <input name="extendstnk_2" type="checkbox" id="extendstnk_2" value="EX-1-2"/>
                Edit Data</label>
            </li>
            <li>
              <label>
              <input name="extendstnk_3" type="checkbox" id="extendstnk_3" value="EX-1-3"/>
                Hapus Data</label>
            </li>
            <li>
              <label>
              <input name="extendstnk_4" type="checkbox" id="extendstnk_4" value="EX-1"/>
                Lihat Data</label>
            </li>
          </ul>          </td>
          <td><ul style="list-style:none;">
            <li>
              <label>
              <input name="extendpolis_1" type="checkbox" id="extendpolis_1" value="EX-2-1"/>
                Tambah Data</label>
            </li>
            <li>
              <label>
              <input name="extendpolis_2" type="checkbox" id="extendpolis_2" value="EX-2-2"/>
                Edit Data</label>
            </li>
            <li>
              <label>
              <input name="extendpolis_3" type="checkbox" id="extendpolis_3" value="EX-2-3"/>
                Hapus Data</label>
            </li>
            <li>
              <label>
              <input name="extendpolis_4" type="checkbox" id="extendpolis_4" value="EX-2"/>
                Lihat Data</label>
            </li>
          </ul>          </td>
          <td><ul style="list-style:none;">
            <li>
              <label>
              <input name="extendkir_1" type="checkbox" id="extendkir_1" value="EX-3-1"/>
                Tambah Data</label>
            </li>
            <li>
              <label>
              <input name="extendkir_2" type="checkbox" id="extendkir_2" value="EX-3-2"/>
                Edit Data</label>
            </li>
            <li>
              <label>
              <input name="extendkir_3" type="checkbox" id="extendkir_3" value="EX-3-3"/>
                Hapus Data</label>
            </li>
            <li>
              <label>
              <input name="extendkir_4" type="checkbox" id="extendkir_4" value="EX-3"/>
                Lihat Data</label>
            </li>
          </ul>          </td>
        </tr>

        <tr>

          <th><div align="center">Transaksi Mutasi 
            <input type="checkbox" name="checkmutasi" id="checkmutasi" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('mutasi_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('mutasi_'+i).checked=false;}}" />
          </div></th>

          <th valign="top"><div align="center">Transaksi Replacement 
            <input type="checkbox" name="checkreplace" id="checkreplace" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('replace_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('replace_'+i).checked=false;}}" />
          </div></th>
          <th valign="top"><div align="center">Transaksi Order Corporate
            <input type="checkbox" name="checkskontrak" id="checkskontrak" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('skontrak_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('skontrak_'+i).checked=false;}}" />
          </div></th>
          <th><div align="center">Invoice Kontrak 
            <input type="checkbox" name="checkikontrak" id="checkikontrak" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('ikontrak_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('ikontrak_'+i).checked=false;}}" />
          </div></th>
          <th><div align="center">TransaksiCheckOutIN
              <input type="checkbox" name="checkoutin" id="checkoutin" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('checkoutin_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('ikontrak_'+i).checked=false;}}" />
          </div></th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">
            <li>
              <label>
                <input name="mutasi_1" type="checkbox" id="mutasi_1" value="EX-4-1"/>
                Tambah Data</label>
            </li>
            <li>
              <label>
              <input name="mutasi_2" type="checkbox" id="mutasi_2" value="EX-4-2"/>
                Edit Data</label>
            </li>
            <li>
              <label>
              <input name="mutasi_3" type="checkbox" id="mutasi_3" value="EX-4-3"/>
                Hapus Data</label>
            </li>
            <li>
              <label>
              <input name="mutasi_4" type="checkbox" id="mutasi_4" value="EX-4"/>
                Lihat Data</label>
            </li>
          </ul>          </td>

          <td><ul style="list-style:none;">
            <li>
              <label>
                <input name="replace_1" type="checkbox" id="replace_1" value="EX-5-1"/>
                Tambah Data</label>
            </li>
            <li>
              <label>
              <input name="replace_2" type="checkbox" id="replace_2" value="EX-5-2"/>
                Edit Data</label>
            </li>
            <li>
              <label>
              <input name="replace_3" type="checkbox" id="replace_3" value="EX-5-3"/>
                Hapus Data</label>
            </li>
            <li>
              <label>
              <input name="replace_4" type="checkbox" id="replace_4" value="EX-5"/>
                Lihat Data</label>
            </li>
          </ul>          </td>
          <td><ul style="list-style:none;">
            <li>
              <label>
                <input name="skontrak_1" type="checkbox" id="skontrak_1" value="KR-1-1"/>
                Tambah Data</label>
            </li>
            <li>
              <label>
              <input name="skontrak_2" type="checkbox" id="skontrak_2" value="KR-1-2"/>
                Edit Data</label>
            </li>
            <li>
              <label>
              <input name="skontrak_3" type="checkbox" id="skontrak_3" value="KR-1-3"/>
                Hapus Data</label>
            </li>
            <li>
              <label>
              <input name="skontrak_4" type="checkbox" id="skontrak_4" value="KR-1"/>
                Lihat Data</label>
            </li>
          </ul>          </td>
          <td><ul style="list-style:none;">
            <li>
              <label>
              <input name="ikontrak_1" type="checkbox" id="ikontrak_1" value="IK-1-1"/>
                Tambah Data</label>
            </li>
            <li>
              <label>
              <input name="ikontrak_2" type="checkbox" id="ikontrak_2" value="IK-1-2"/>
                Edit Data</label>
            </li>
            <li>
              <label>
              <input name="ikontrak_3" type="checkbox" id="ikontrak_3" value="IK-1-3"/>
                Hapus Data</label>
            </li>
            <li>
              <label>
              <input name="ikontrak_4" type="checkbox" id="ikontrak_4" value="IK-1"/>
                Lihat Data</label>
            </li>
          </ul>          </td>
          <td><ul style="list-style:none;">
              <li>
                <label>
                <input name="checkoutin_1" type="checkbox" id="checkoutin_1" value="OI-1-1"/>
                  Tambah Data</label>
              </li>
            <li>
                <label>
                <input name="checkoutin_2" type="checkbox" id="checkoutin_2" value="OI-1-2"/>
                  Edit Data</label>
              </li>
            <li>
                <label>
                <input name="checkoutin_3" type="checkbox" id="checkoutin_3" value="OI-1-3"/>
                  Hapus Data</label>
              </li>
            <li>
                <label>
                <input name="checkoutin_4" type="checkbox" id="checkoutin_4" value="OI-1"/>
                  Lihat Data</label>
              </li>
          </ul></td>
        </tr>

      </table></td>
    </tr>
    <tr valign="top">
      <td align="right">&nbsp;</td>
      <th width="17%"><div align="center">Transaksi Kecelakaan
          <input type="checkbox" name="checkmutasi" id="checkmutasi" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('mutasi_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('accident_'+i).checked=false;}}" />
      </div></th>
      <th width="17%"><div align="center">Transaksi Kasir
          <input type="checkbox" name="checkreplace" id="checkreplace" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('replace_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('replace_'+i).checked=false;}}" />
      </div></th>
      <th width="17%"><div align="center">Transaksi DO
          <input type="checkbox" name="checkmutasi" id="checkmutasi" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('mutasi_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('do_'+i).checked=false;}}" />
      </div></th>
      <th width="16%">&nbsp;</th>
      <th width="16%">&nbsp;</th>
    </tr>
    <tr valign="top">
      <td align="right">&nbsp;</td>
      <td><ul style="list-style:none;">
          <li>
            <label>
            <input name="accident_1" type="checkbox" id="accident_1" value="AC-1-1"/>
              Tambah Data</label>
          </li>
        <li>
            <label>
            <input name="accident_2" type="checkbox" id="accident_2" value="AC-1-2"/>
              Edit Data</label>
          </li>
        <li>
            <label>
            <input name="accident_3" type="checkbox" id="accident_3" value="AC-1-3"/>
              Hapus Data</label>
          </li>
        <li>
            <label>
            <input name="accident_4" type="checkbox" id="accident_4" value="AC-1"/>
              Lihat Data</label>
          </li>
      </ul></td>
      <td><ul style="list-style:none;">
          <li>
            <label>
            <input name="kasir_1" type="checkbox" id="kasir_1" value="KS-1-1"/>
              Tambah Data</label>
          </li>
        <li>
            <label>
            <input name="kasir_2" type="checkbox" id="kasir_2" value="KS-1-2"/>
              Edit Data</label>
          </li>
        <li>
            <label>
            <input name="kasir_3" type="checkbox" id="kasir_3" value="KS-1-3"/>
              Hapus Data</label>
          </li>
        <li>
            <label>
            <input name="kasir_4" type="checkbox" id="kasir_4" value="KS-1"/>
              Lihat Data</label>
          </li>
      </ul></td>
      <td><ul style="list-style:none;">
          <li>
            <label>
            <input name="do_1" type="checkbox" id="do_1" value="DO-1-1"/>
              Tambah Data</label>
          </li>
        <li>
            <label>
            <input name="do_2" type="checkbox" id="do_2" value="DO-1-2"/>
              Edit Data</label>
          </li>
        <li>
            <label>
            <input name="do_3" type="checkbox" id="do_3" value="DO-1-3"/>
              Hapus Data</label>
          </li>
        <li>
            <label>
            <input name="do_4" type="checkbox" id="do_4" value="DO-1"/>
              Lihat Data</label>
          </li>
      </ul></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="top">
      <td align="right">Data Master Karyawan, Asuransi, Bengkel &amp; Supplier :</td>
      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
          <tr>
            <th width="20%"><div align="center">Karyawan
                <input type="checkbox" name="checkbudgeting2" id="checkbudgeting" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('kontak_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('kontak_'+i).checked=false;}}" />
            </div></th>
            <th width="21%"><div align="center">Unit Kerja
                <input type="checkbox" name="checkbudgeting3" id="checkbudgeting2" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('unitkerja_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('unitkerja_'+i).checked=false;}}" />
            </div></th>
            <th width="20%"><div align="center">Customer Corporate
                <input type="checkbox" name="checkbudgeting4" id="checkbudgeting3" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('ccorporate_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('ccorporate_'+i).checked=false;}}" />
            </div></th>
            <th width="20%"><div align="center">Customer Retail
                <input type="checkbox" name="checkbudgeting5" id="checkbudgeting4" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('cretail_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('cretail_'+i).checked=false;}}" />
            </div></th>
            <th width="19%"><div align="center">Lokasi Kantor
                <input type="checkbox" name="checkbudgeting6" id="checkbudgeting5" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('gudang_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('gudang_'+i).checked=false;}}" />
            </div></th>
          </tr>
          <tr valign="top">
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="kontak_1" type="checkbox" id="kontak_1" value="DD-2-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="kontak_2" type="checkbox" id="kontak_2" value="DD-2-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="kontak_3" type="checkbox" id="kontak_3" value="DD-2-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="kontak_4" type="checkbox" id="kontak_4" value="DD-2" />
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="unitkerja_1" type="checkbox" id="unitkerja_1" value="UK-1-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="unitkerja_2" type="checkbox" id="unitkerja_2" value="UK-1-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="unitkerja_3" type="checkbox" id="unitkerja_3" value="UK-1-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="unitkerja_4" type="checkbox" id="unitkerja_4" value="UK-1" />
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="ccorporate_1" type="checkbox" id="ccorporate_1" value="DD-8-1"/>
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="ccorporate_2" type="checkbox" id="ccorporate_2" value="DD-8-2"/>
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="ccorporate_3" type="checkbox" id="ccorporate_3" value="DD-8-3"/>
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="ccorporate_4" type="checkbox" id="ccorporate_4" value="DD-8"/>
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                    
                  <input name="cretail_1" type="checkbox" id="cretail_1" value="DD-7-1"/>
                  Tambah Data</label>
                </li>
              <li>
                  <label>
                    <input name="cretail_2" type="checkbox" id="cretail_2" value="DD-7-2"/>
                  Edit Data</label>
                </li>
              <li>
                  <label>
                    <input name="cretail_3" type="checkbox" id="cretail_3" value="DD-7-3"/>
                  Hapus Data</label>
                </li>
              <li>
                  <label>
                    <input name="cretail_4" type="checkbox" id="cretail_4" value="DD-7"/>
                  Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="gudang_1" type="checkbox" id="gudang_1" value="PD-7-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="gudang_2" type="checkbox" id="gudang_2" value="PD-7-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="gudang_3" type="checkbox" id="gudang_3" value="PD-7-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="gudang_4" type="checkbox" id="gudang_4" value="PD-7" />
                    Lihat Data</label>
                </li>
            </ul></td>
          </tr>
      </table></td>
    </tr>
    <tr valign="top">
      <td align="right">&nbsp;</td>
      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
        <tr>
          <th width="20%"><div align="center">Jenis Polis
            <input type="checkbox" name="checkbudgeting7" id="checkbudgeting6" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('jenisasuransi_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('jenisasuransi_'+i).checked=false;}}" />
          </div></th>
          <th width="21%"><div align="center">Rekanan Asuransi
            <input type="checkbox" name="checkbudgeting8" id="checkbudgeting7" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('rekasuransi_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('rekasuransi_'+i).checked=false;}}" />
          </div></th>
          <th width="21%"><div align="center">Rekanan Bengkel
            <input type="checkbox" name="checkrekbengkel" id="checkrekbengkel" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('rekbengkel_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('rekbengkel_'+i).checked=false;}}" />
          </div></th>
          <th width="19%"><div align="center">Rekanan Supplier
            <input type="checkbox" name="checkreksupplier" id="checkreksupplier" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('reksupplier_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('reksupplier_'+i).checked=false;}}" />
          </div></th>
          <th width="19%"><div align="center">Wilayah/Area
            <input type="checkbox" name="checkarea" id="checkarea" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('area_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('area_'+i).checked=false;}}" />
          </div></th>
        </tr>
        <tr valign="top">
          <td><ul style="list-style:none;">
              <li>
                <label>
                <input name="jenisasuransi_1" type="checkbox" id="jenisasuransi_1" value="JA-1-1" />
                  Tambah Data</label>
              </li>
            <li>
                <label>
                <input name="jenisasuransi_2" type="checkbox" id="jenisasuransi_2" value="JA-1-2" />
                  Edit Data</label>
              </li>
            <li>
                <label>
                <input name="jenisasuransi_3" type="checkbox" id="jenisasuransi_3" value="JA-1-3" />
                  Hapus Data</label>
              </li>
            <li>
                <label>
                <input name="jenisasuransi_4" type="checkbox" id="jenisasuransi_4" value="JA-1" />
                  Lihat Data</label>
              </li>
          </ul></td>
          <td><ul style="list-style:none;">
              <li>
                <label>
                <input name="rekasuransi_1" type="checkbox" id="rekasuransi_1" value="RB-1-1" />
                  Tambah Data</label>
              </li>
            <li>
                <label>
                <input name="rekasuransi_2" type="checkbox" id="rekasuransi_2" value="RB-1-2" />
                  Edit Data</label>
              </li>
            <li>
                <label>
                <input name="rekasuransi_3" type="checkbox" id="rekasuransi_3" value="RB-1-3" />
                  Hapus Data</label>
              </li>
            <li>
                <label>
                <input name="rekasuransi_4" type="checkbox" id="rekasuransi_4" value="RB-1" />
                  Lihat Data</label>
              </li>
          </ul></td>
          <td><ul style="list-style:none;">
              <li>
                <label>
                <input name="rekbengkel_1" type="checkbox" id="rekbengkel_1" value="RB-2-1"/>
                  Tambah Data</label>
              </li>
            <li>
                <label>
                <input name="rekbengkel_2" type="checkbox" id="rekbengkel_2" value="RB-2-2"/>
                  Edit Data</label>
              </li>
            <li>
                <label>
                <input name="rekbengkel_3" type="checkbox" id="rekbengkel_3" value="RB-2-3"/>
                  Hapus Data</label>
              </li>
            <li>
                <label>
                <input name="rekbengkel_4" type="checkbox" id="rekbengkel_4" value="RB-2"/>
                  Lihat Data</label>
              </li>
          </ul></td>
          <td><ul style="list-style:none;">
              <li>
                <label>
                  <input name="reksupplier_1" type="checkbox" id="reksupplier_1" value="RB-3-1"/>
                  Tambah Data</label>
              </li>
            <li>
                <label>
                  <input name="reksupplier_2" type="checkbox" id="reksupplier_2" value="RB-3-2"/>
                  Edit Data</label>
              </li>
            <li>
                <label>
                  <input name="reksupplier_3" type="checkbox" id="reksupplier_3" value="RB-3-3"/>
                  Hapus Data</label>
              </li>
            <li>
                <label>
                  <input name="reksupplier_4" type="checkbox" id="reksupplier_4" value="RB-3"/>
                  Lihat Data</label>
              </li>
          </ul></td>
          <td><ul style="list-style:none;">
            <li>
              <label>
                <input name="area_1" type="checkbox" id="area_1" value="PD-6-1" />
                Tambah Data</label>
            </li>
            <li>
              <label>
              <input name="area_2" type="checkbox" id="area_2" value="PD-6-2" />
                Edit Data</label>
            </li>
            <li>
              <label>
              <input name="v_3" type="checkbox" id="area_3" value="PD-6-3" />
                Hapus Data</label>
            </li>
            <li>
              <label>
              <input name="area_4" type="checkbox" id="area_4" value="PD-6" />
                Lihat Data</label>
            </li>
          </ul>          </td>
        </tr>
      </table></td>
    </tr>
    
    <tr valign="top">
      <td align="right">Data Master Kendaraan :</td>
      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
          <tr>
            <th width="20%"><div align="center">Merk Kendaraan
                <input type="checkbox" name="checkmkservice" id="checkmkservice" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('mkservice_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('mkservice_'+i).checked=false;}}" />
            </div></th>
            <th width="21%"><div align="center">Jenis Kendaraan
                <input type="checkbox" name="checkjkservice" id="checkjkservice" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('jkservice_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('jkservice_'+i).checked=false;}}" />
            </div></th>
            <th width="21%"><div align="center">Tipe Kendaraan
                <input type="checkbox" name="checkjservice" id="checkjservice" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('jservice_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('jservice_'+i).checked=false;}}" />
            </div></th>
            <th width="19%"><div align="center">Stok Kendaraan
                <input type="checkbox" name="checkservice" id="checkservice" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('service_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('service_'+i).checked=false;}}" />
            </div></th>
            <th width="19%"><div align="center">Jenis Kecelakaan
                <input type="checkbox" name="checkjaccident" id="checkjaccident" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('jaccident_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('jaccident_'+i).checked=false;}}" />
            </div></th>
          </tr>
          <tr valign="top">
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="mkservice_1" type="checkbox" id="mkservice_1" value="JS-5-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="mkservice_2" type="checkbox" id="mkservice_2" value="JS-5-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="mkservice_3" type="checkbox" id="mkservice_3" value="JS-5-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="mkservice_4" type="checkbox" id="mkservice_4" value="JS-5" />
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="jkservice_1" type="checkbox" id="jkservice_1" value="JS-6-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="jkservice_2" type="checkbox" id="jkservice_2" value="JS-6-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="jkservice_3" type="checkbox" id="jkservice_3" value="JS-6-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="jkservice_4" type="checkbox" id="jkservice_4" value="JS-6" />
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="jservice_1" type="checkbox" id="jservice_1" value="JS-7-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="jservice_2" type="checkbox" id="jservice_2" value="JS-7-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="jservice_3" type="checkbox" id="jservice_3" value="JS-7-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="jservice_4" type="checkbox" id="jservice_4" value="JS-7" />
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="service_1" type="checkbox" id="service_1" value="MS-8-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="service_2" type="checkbox" id="service_2" value="MS-8-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="service_3" type="checkbox" id="service_3" value="MS-8-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="service_4" type="checkbox" id="service_4" value="MS-8" />
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="jaccident_1" type="checkbox" id="jaccident_1" value="JS-1-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="jaccident_2" type="checkbox" id="jaccident_2" value="JS-1-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="jaccident_3" type="checkbox" id="jaccident_3" value="JS-1-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="jaccident_4" type="checkbox" id="jaccident_4" value="JS-1" />
                    Lihat Data</label>
                </li>
            </ul></td>
          </tr>
      </table>        <table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">
          <tr>
            <th width="20%"><div align="center">Paket Harga Sewa
                <input type="checkbox" name="checkphservice" id="checkphservice" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('phservice_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('phservice_'+i).checked=false;}}" />
            </div></th>
            <th width="21%"><div align="center">Jenis BBM
                <input type="checkbox" name="checkjbservice" id="checkjbservice" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('jbservice_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('jbservice_'+i).checked=false;}}" />
            </div></th>
            <th width="21%"><div align="center">Status Kendaraan
                <input type="checkbox" name="checkskservice" id="checkskservice" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('skservice_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('skservice_'+i).checked=false;}}" />
            </div></th>
            <th width="19%">&nbsp;</th>
            <th width="19%">&nbsp;</th>
          </tr>
          <tr valign="top">
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="phservice_1" type="checkbox" id="phservice_1" value="JS-4-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="phservice_2" type="checkbox" id="phservice_2" value="JS-4-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="phservice_3" type="checkbox" id="phservice_3" value="JS-4-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="phservice_4" type="checkbox" id="phservice_4" value="JS-4" />
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="jbservice_1" type="checkbox" id="jbservice_1" value="JS-3-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="jbservice_2" type="checkbox" id="jbservice_2" value="JS-3-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="jbservice_3" type="checkbox" id="jbservice_3" value="JS-3-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="jbservice_4" type="checkbox" id="jbservice_4" value="JS-3" />
                    Lihat Data</label>
                </li>
            </ul></td>
            <td><ul style="list-style:none;">
                <li>
                  <label>
                  <input name="skservice_1" type="checkbox" id="skservice_1" value="JS-2-1" />
                    Tambah Data</label>
                </li>
              <li>
                  <label>
                  <input name="skservice_2" type="checkbox" id="skservice_2" value="JS-2-2" />
                    Edit Data</label>
                </li>
              <li>
                  <label>
                  <input name="skservice_3" type="checkbox" id="skservice_3" value="JS-2-3" />
                    Hapus Data</label>
                </li>
              <li>
                  <label>
                  <input name="skservice_4" type="checkbox" id="skservice_4" value="JS-2" />
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

      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="20%"><div align="center">Transfer
            <input type="checkbox" name="checktransfer" id="checktransfer" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('transfer_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('transfer_'+i).checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Kas Masuk
            <input type="checkbox" name="checkkasmasuk" id="checkkasmasuk" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('kasmasuk_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('kasmasuk_'+i).checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Kas Keluar
            <input type="checkbox" name="checkkaskeluar" id="checkkaskeluar" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('kaskeluar_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('kaskeluar_'+i).checked=false;}}" />
          </div></th>

          <th width="19%">&nbsp;</th>
          <th width="19%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="transfer_1" type="checkbox" id="transfer_1" value="KB-1-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="transfer_2" type="checkbox" id="transfer_2" value="KB-1-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="transfer_3" type="checkbox" id="transfer_3" value="KB-1-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="transfer_4" type="checkbox" id="transfer_4" value="KB-1" />

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="kasmasuk_1" type="checkbox" id="kasmasuk_1" value="KB-2-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="kasmasuk_2" type="checkbox" id="kasmasuk_2" value="KB-2-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="kasmasuk_3" type="checkbox" id="kasmasuk_3" value="KB-2-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="kasmasuk_4" type="checkbox" id="kasmasuk_4" value="KB-2" />

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="kaskeluar_1" type="checkbox" id="kaskeluar_1" value="KB-3-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="kaskeluar_2" type="checkbox" id="kaskeluar_2" value="KB-3-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="kaskeluar_3" type="checkbox" id="kaskeluar_3" value="KB-3-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="kaskeluar_4" type="checkbox" id="kaskeluar_4" value="KB-3" />

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

      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="20%"><div align="center">Persediaan
            <input type="checkbox" name="checkpersediaan" id="checkpersediaan" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=6; i++){document.getElementById('persediaan_'+i).checked=true;}{document.getElementById('stokopname').checked=true;}{document.getElementById('kartustok').checked=true;}}else{for(i=1;i&lt;=6; i++){document.getElementById('persediaan_'+i).checked=false;}{document.getElementById('stokopname').checked=false;}{document.getElementById('kartustok').checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Barang/Jasa
            <input type="checkbox" name="checkbarang" id="checkbarang" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('barang_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('barang_'+i).checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Kelompok Barang/Jasa
            <input type="checkbox" name="checkkelompok" id="checkkelompok" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('kelompok_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('kelompok_'+i).checked=false;}}" />
          </div></th>

          <th width="19%"><div align="center">Satuan
            <input type="checkbox" name="checksatuan" id="checksatuan" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('satuan_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('satuan_'+i).checked=false;}}" />
          </div></th>
          <th width="19%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="persediaan_1" type="checkbox" id="persediaan_1" value="PD-1-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="persediaan_2" type="checkbox" id="persediaan_2" value="PD-1-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="persediaan_3" type="checkbox" id="persediaan_3" value="PD-1-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="persediaan_4" type="checkbox" id="persediaan_4" value="PD-1" />

                Lihat Data</label>
            </li>

            <li>

              <label>

<input name="stokopname" type="checkbox" id="stokopname" value="PD-2" />

Stok Opname<br />

<input name="kartustok" type="checkbox" id="kartustok" value="PD-6" />
              </label>

Kartu Stok

<label></label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="barang_1" type="checkbox" id="barang_1" value="PD-3-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="barang_2" type="checkbox" id="barang_2" value="PD-3-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="barang_3" type="checkbox" id="barang_3" value="PD-3-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="barang_4" type="checkbox" id="barang_4" value="PD-3" />

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="kelompok_1" type="checkbox" id="kelompok_1" value="PD-4-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="kelompok_2" type="checkbox" id="kelompok_2" value="PD-4-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="kelompok_3" type="checkbox" id="kelompok_3" value="PD-4-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="kelompok_4" type="checkbox" id="kelompok_4" value="PD-4" />

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="satuan_1" type="checkbox" id="satuan_1" value="PD-5-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="satuan_2" type="checkbox" id="satuan_2" value="PD-5-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="satuan_3" type="checkbox" id="satuan_3" value="PD-5-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="satuan_4" type="checkbox" id="satuan_4" value="PD-5" />

                Lihat Data</label>
            </li>

          </ul></td>
          <td>&nbsp;</td>
        </tr>

      </table></td>
    </tr>

    <tr valign="top">

      <td align="right">Pembelian :</td>

      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="20%"><div align="center">Purchase Order
            <input type="checkbox" name="checkpurchase" id="checkpurchase" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('purchase_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('purchase_'+i).checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Retur
            <input type="checkbox" name="checkretur_pb" id="checkretur_pb" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('retur_pb_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('retur_pb_'+i).checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Pembayaran Hutang
            <input type="checkbox" name="checkpembayaranhutang" id="checkpembayaranhutang" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('pembayaranhutang_'+i).checked=true;}{document.getElementById('hutangusaha').checked=true;}{document.getElementById('kartuhutang').checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('pembayaranhutang_'+i).checked=false;}{document.getElementById('hutangusaha').checked=true;}{document.getElementById('kartuhutang').checked=true;}}" />
          </div></th>

          <th width="19%">&nbsp;</th>
          <th width="19%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="purchase_1" type="checkbox" id="purchase_1" value="PB-1-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="purchase_2" type="checkbox" id="purchase_2" value="PB-1-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="purchase_3" type="checkbox" id="purchase_3" value="PB-1-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="purchase_4" type="checkbox" id="purchase_4" value="PB-1" />

                Lihat Data</label>
            </li>

            <li>

              <label>

                <input name="pengiriman_pb" type="checkbox" id="pengiriman_pb" value="PB-2" />

                Pengiriman Barang </label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="retur_pb_1" type="checkbox" id="retur_pb_1" value="PB-3-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pb_2" type="checkbox" id="retur_pb_2" value="PB-3-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pb_3" type="checkbox" id="retur_pb_3" value="PB-3-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pb_4" type="checkbox" id="retur_pb_4" value="PB-3" />

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="pembayaranhutang_1" type="checkbox" id="pembayaranhutang_1" value="PB-4-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranhutang_2" type="checkbox" id="pembayaranhutang_2" value="PB-4-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranhutang_3" type="checkbox" id="pembayaranhutang_3" value="PB-4-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranhutang_4" type="checkbox" id="pembayaranhutang_4" value="PB-4" />

                Lihat Data</label>
            </li>

            <li>

              <label>

                <input name="hutangusaha" type="checkbox" id="hutangusaha" value="PB-5" />
              </label>

Hutang Usaha</li>

            <li>

              <label>

                <input name="kartuhutang" type="checkbox" id="kartuhutang" value="PB-6" />
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

      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="20%"><div align="center">Sales Order
            <input type="checkbox" name="checksales" id="checksales" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=5; i++){document.getElementById('sales_'+i).checked=true;}{document.getElementById('pengiriman_pj').checked=true;}}else{for(i=1;i&lt;=5; i++){document.getElementById('sales_'+i).checked=false;}{document.getElementById('pengiriman_pj').checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Retur
            <input type="checkbox" name="checkretur_pj" id="checkretur_pj" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=4; i++){document.getElementById('retur_pj_'+i).checked=true;}}else{for(i=1;i&lt;=4; i++){document.getElementById('retur_pj_'+i).checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Pembayaran Piutang
            <input type="checkbox" name="checkpembayaranpiutang" id="checkpembayaranpiutang" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=6; i++){document.getElementById('pembayaranpiutang_'+i).checked=true;}{document.getElementById('piutangusaha').checked=true;}{document.getElementById('kartupiutang').checked=true;}}else{for(i=1;i&lt;=6; i++){document.getElementById('pembayaranpiutang_'+i).checked=false;}{document.getElementById('piutangusaha').checked=false;}{document.getElementById('kartupiutang').checked=false;}}" />
          </div></th>

          <th width="19%">&nbsp;</th>
          <th width="19%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="sales_1" type="checkbox" id="sales_1" value="PJ-1-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="sales_2" type="checkbox" id="sales_2" value="PJ-1-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="sales_3" type="checkbox" id="sales_3" value="PJ-1-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="sales_4" type="checkbox" id="sales_4" value="PJ-1" />

                Lihat Data</label>
            </li>

            <li>

              <label>

                <input name="pengiriman_pj" type="checkbox" id="pengiriman_pj" value="PJ-2" />

                Pengiriman Barang</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="retur_pj_1" type="checkbox" id="retur_pj_1" value="PJ-3-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pj_2" type="checkbox" id="retur_pj_2" value="PJ-3-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pj_3" type="checkbox" id="retur_pj_3" value="PJ-3-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="retur_pj_4" type="checkbox" id="retur_pj_4" value="PJ-3" />

                Lihat Data</label>
            </li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="pembayaranpiutang_1" type="checkbox" id="pembayaranpiutang_1" value="PJ-4-1" />

                Tambah Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranpiutang_2" type="checkbox" id="pembayaranpiutang_2" value="PJ-4-2" />

                Edit Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranpiutang_3" type="checkbox" id="pembayaranpiutang_3" value="PJ-4-3" />

                Hapus Data</label>
            </li>

            <li>

              <label>

                <input name="pembayaranpiutang_4" type="checkbox" id="pembayaranpiutang_4" value="PJ-4" />

                Lihat Data</label>
            </li>

            <li>

              <input name="piutangusaha" type="checkbox" id="piutangusaha" value="PJ-5" />

Piutang Usaha</li>

            <li>

              <label>

                <input name="kartupiutang" type="checkbox" id="kartupiutang" value="PJ-6" />
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

      <td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="datatable">

        <tr>

          <th width="20%"><div align="center">Jurnal &amp; GL
            <input type="checkbox" name="checkt_harian" id="checkt_harian" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=3; i++){document.getElementById('t_harian').checked=true;}{document.getElementById('jurnal').checked=true;}{document.getElementById('bukubesar').checked=true;}}else {for(i=1;i&lt;=3; i++){document.getElementById('t_harian').checked=false;}{document.getElementById('jurnal').checked=false;}{document.getElementById('bukubesar').checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Penjualan
            <input type="checkbox" name="checkbudgeting34" id="checkbudgeting33" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=3; i++){document.getElementById('r_penjualan').checked=true;}{document.getElementById('r_iklan').checked=true;}{document.getElementById('rekap_retur').checked=true;}}else {for(i=1;i&lt;=3; i++){document.getElementById('r_penjualan').checked=false;}{document.getElementById('r_iklan').checked=false;}{document.getElementById('rekap_retur').checked=false;}}" />
          </div></th>

          <th width="21%"><div align="center">Aruskas, R/L, &amp; Neraca
            <input type="checkbox" name="checkbudgeting35" id="checkbudgeting34" onclick="javascript: if(this.checked==true){for(i=1;i&lt;=3; i++){document.getElementById('aruskas').checked=true;}{document.getElementById('rugilaba').checked=true;}{document.getElementById('neraca').checked=true;}}else {for(i=1;i&lt;=3; i++){document.getElementById('aruskas').checked=false;}{document.getElementById('rugilaba').checked=false;}{document.getElementById('neraca').checked=false;}}" />
          </div></th>

          <th width="19%">&nbsp;</th>
          <th width="19%">&nbsp;</th>
        </tr>

        <tr valign="top">

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="t_harian" type="checkbox" id="t_harian" value="L-2" />
              </label>

Transaksi Harian </li>

            <li>

              <label>

                <input name="jurnal" type="checkbox" id="jurnal" value="L-4" />
              </label>

Jurnal</li>

            <li>

              <label>

                <input name="bukubesar" type="checkbox" id="bukubesar" value="L-6" />
              </label>

Buku Besar</li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="r_penjualan" type="checkbox" id="r_penjualan" value="L-7" />
              </label>

Revenue by Sales</li>

            <li>

              <label>

                <input name="r_iklan" type="checkbox" id="r_iklan" value="L-8" />
              </label>

Rekap Penjualan </li>

            <li>

              <label>

                <input name="rekap_retur" type="checkbox" id="rekap_retur" value="L-9" />
              </label>

Rekap Retur</li>

          </ul></td>

          <td><ul style="list-style:none;">

            <li>

              <label>

                <input name="aruskas" type="checkbox" id="aruskas" value="L-5" />
              </label>

Arus Kas </li>

            <li>

              <label>

                <input name="rugilaba" type="checkbox" id="rugilaba" value="L-1" />
              </label>

Rugi Laba </li>

            <li>

              <label>

                <input name="neraca" type="checkbox" id="neraca" value="L-3" />
              </label>

Neraca</li>

          </ul></td>

          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>

      </table></td>
    </tr>

    <tr>

      <td align="left"><em>*Harus diisi</em>        <input name="id" type="hidden" id="id" /></td>

      <td colspan="5"><label><input name="Save" type="submit" id="Save" value="Simpan" /></label>

        <label>

        <input type="button" name="Button" value="Batal" onClick="javascript:history.go(-1);">
      </label></td>
    </tr>
  </table>

  <input type="hidden" name="MM_insert" value="add">

</form>

