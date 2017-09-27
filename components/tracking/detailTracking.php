 <?php

if($_REQUEST['ajax'] == 'true'){
	//session_start();
	
	include "../../connections/con_gl.php";
	
//	echo 'brekele brekele';
	switch($_REQUEST['act']){
		case 'addTracking' :
			echo 'Tambah';
				//	$_SESSION['nama_penumpang'][] = $_POST['nama_penumpang'];	

			$_SESSION['stt'][] = $_POST['stt'];
			$_SESSION['trackingdate'][] = $_POST['trackingdate'];
			$_SESSION['city'][] = $_POST['city'];
			$_SESSION['idcity'][] = $_POST['idcity'];
			$_SESSION['idstatus'][] = $_POST['idstatus'];
			$_SESSION['status'][] = $_POST['status'];
			$_SESSION['desc'][] = $_POST['desc'];			
		;																																           		
			break;
				
		case 'hapus' :
				$pos = $_POST['pos'];					

				unset($_SESSION['stt'][$pos]);
				unset($_SESSION['trackingdate'][$pos]);
				unset($_SESSION['city'][$pos]);
				unset($_SESSION['idcity'][$pos]);
				unset($_SESSION['idstatus'][$pos]);
				unset($_SESSION['status'][$pos]);
				unset($_SESSION['desc'][$pos]);
																										         	
			

			
			//unset($_SESSION['info'][$pos]);
		
					

			$_SESSION['stt']	=  array_values($_SESSION['stt']);
			$_SESSION['trackingdate']	=  array_values($_SESSION['trackingdate']);
			$_SESSION['city']	=  array_values($_SESSION['city']);
			$_SESSION['idcity']	=  array_values($_SESSION['idcity']);
			$_SESSION['idstatus']	=  array_values($_SESSION['idstatus']);
			$_SESSION['status']	=  array_values($_SESSION['status']);
			$_SESSION['desc']	=  array_values($_SESSION['desc']);			
					
			
			break;
	}
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
<tr>
     	<th width="10%" align="center">Tgl</th>
		<th width="14%" align="center">Kota</th>
		<th width="14%" align="center">Status</th>
     	<th width="12%" align="center">Keterangan</th>
	<th width="16%" align="center"><strong>Aksi</strong></th>
  </tr>
	<?php
	if(isset($_SESSION['stt'])){
		$i=0;
		$urut = 1;
		foreach($_SESSION['stt'] as $idk){
			if($_POST['status']=='editTicketing' && $_POST['pos']==$i){
			
				echo "me status";
			?>
			
			
			<?php
			}else{					
						
					echo "<tr>";
					echo "<td align='center'>".$_SESSION['trackingdate'][$i]."</td>";
					echo "<td align='center'>".$_SESSION['city'][$i]."</td>";
					echo "<td align='center'>".$_SESSION['status'][$i]."</td>";	
					echo "<td align='center'>".$_SESSION['desc'][$i]."</td>";	
							
						
					echo "<td align='center'>";	
		
					echo "<a style='cursor:pointer;' onclick=\"javascript: kirimRequest('components/tracking/detailTracking.php', 'ajax=true&act=hapus&pos=$i', 'ajaxDiv', 'div');\" title='Hapus data'><img src='images/delete.png' /></a>";
					echo "</td>";
				echo "</tr>";
			
			
				//echo ($_SESSION['service'][$i]);
				// deskripsi hotel, ariline dll
				$urut ++;
				
			}
			$i++;
		}
	}
	?>	
    
           
  <tr valign="top" bgcolor="#FFFFFF">
  <td align="right"  bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idservice2" id="idservice2" size="2" />
    <input name="tanggalkirim" type="text" class="calendar" id="trackingdate" value="<?php echo date("Y/m/d");?>" size="20" maxlength="12"/></td>
  <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idcity" id="idcity" size="2" />
    <input type="text" name="city" id="city" size="20" placeholder="Kota Asal" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onclick="NewWindow('index.php?component=tracking&amp;task=listKota&amp;open=window','name','825','450','yes');return false" /></td>
  <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idstatus" id="idstatus" size="2" />
    <input type="text" name="status" id="status" size="20" placeholder="Tracking Status" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onclick="NewWindow('index.php?component=tracking&amp;task=listStatus&amp;open=window','name','825','450','yes');return false" /></td>
    <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input name="desc" type="text" id="desc" size="20" maxlength="100" /></td>
              <td align="center" bgcolor="#00CC99" style="background:none;border:none;"><input name="add" type="button" id="add" value="&nbsp;" onClick="var err=''; 
   				 if(document.getElementById('idcity').value=='') err+='kota harus dipilih\n';		         		 	if(document.getElementById('idstatus').value=='') err+='tracking status harus dipilih\n';                 
                 
                                              
					if(err!='') alert(err);
					else kirimRequest('components/tracking/detailTracking.php', 'ajax=true&amp;act=addTracking&amp;trackingdate='+document.getElementById('trackingdate').value+'&amp;city='+document.getElementById('city').value+'&amp;idcity='+document.getElementById('idcity').value+'&amp;idstatus='+document.getElementById('idstatus').value+'&amp;status='+document.getElementById('status').value+'&amp;desc='+document.getElementById('desc').value, 'ajaxDiv', 'div');" class="checkbutton" title="Add Transaksi"/></td>
  </tr>
</table>


