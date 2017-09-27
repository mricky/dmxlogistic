 <?php



if($_REQUEST['ajax'] == 'true'){
	//session_start();
	
	include "../../connections/con_gl.php";
	
	//echo 'brekele brekele';
	switch($_REQUEST['act']){
		case 'addPricelistCustomer' :
			//echo 'Tambah';
				//	$_SESSION['nama_penumpang'][] = $_POST['nama_penumpang'];	
			$_SESSION['idcustomer'][] = $_POST['idcustomer'];		
			$_SESSION['idservice'][] = $_POST['idservice'];
			$_SESSION['service'][] = $_POST['service'];
			$_SESSION['idorigin'][] = $_POST['idorigin'];
			$_SESSION['origin'][] = $_POST['origin'];
			$_SESSION['iddestination'][] = $_POST['iddestination'];
			$_SESSION['destination'][] = $_POST['destination'];			
			$_SESSION['idnextdest'][] = $_POST['idnextdest'];
			$_SESSION['nextdest'][] = $_POST['nextdest'];
			$_SESSION['idhandling'][] = $_POST['idhandling'];
			$_SESSION['handling'][] = $_POST['handling'];
			$_SESSION['charge'][] = $_POST['charge'];																		
			$_SESSION['weight'][] = $_POST['weight'];																																            $_SESSION['duration'][] = $_POST['duration'];
    		$_SESSION['description'][] = $_POST['description'];				
			break;
				
		case 'hapus' :
				$pos = $_POST['pos'];					
  				unset($_SESSION['idpricelist'][$pos]);
   				unset($_SESSION['idcustomer'][$pos]);				
				unset($_SESSION['idservice'][$pos]);
				unset($_SESSION['service'][$pos]);
				unset($_SESSION['idorigin'][$pos]);
				unset($_SESSION['origin'][$pos]);
				unset($_SESSION['iddestination'][$pos]);
				unset($_SESSION['destination'][$pos]);
				unset($_SESSION['idnextdest'][$pos]);
				unset($_SESSION['nextdest'][$pos]);
				unset($_SESSION['idhandling'][$pos]);
				unset($_SESSION['handling'][$pos]);
				unset($_SESSION['charge'][$pos]);
				unset($_SESSION['weight'][$pos]);																													         		unset($_SESSION['duration'][$pos]);
				unset($_SESSION['description'][$pos]);
		
			

			
			//unset($_SESSION['info'][$pos]);
		
			$_SESSION['idpricelist']	=  array_values($_SESSION['idpricelist']);			
			$_SESSION['idcustomer']	=  array_values($_SESSION['idcustomer']);		
			$_SESSION['idservice']	=  array_values($_SESSION['idservice']);
			$_SESSION['service']	=  array_values($_SESSION['service']);
			$_SESSION['idorigin']	=  array_values($_SESSION['idorigin']);
			$_SESSION['origin']	=  array_values($_SESSION['origin']);
			$_SESSION['iddestination']	=  array_values($_SESSION['iddestination']);
			$_SESSION['destination']	=  array_values($_SESSION['destination']);
			$_SESSION['idnextdest']	=  array_values($_SESSION['idnextdest']);
			$_SESSION['nextdest']	=  array_values($_SESSION['nextdest']);
			$_SESSION['idhandling']	=  array_values($_SESSION['idhandling']);
			$_SESSION['handling']	=  array_values($_SESSION['handling']);
			$_SESSION['charge']	=  array_values($_SESSION['charge']);
			$_SESSION['weight']	=  array_values($_SESSION['weight']);
			$_SESSION['duration']	=  array_values($_SESSION['duration']);
			$_SESSION['description']	=  array_values($_SESSION['description']);
			
			
			break;
	}
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
<tr>
	<th width="55%" align="center">Service</th>
		<th width="55%" align="center">Armada</th>
		<th width="55%" align="center">Asal</th>
		<th width="55%" align="center">Tujuan</th>
		<th width="55%" align="center">Terusan</th>
		<th width="55%" align="center">Charge/KG</th>
		<th width="55%" align="center">Durasi</th>
		<th width="55%" align="center">Ket</th>
		<th width="55%" align="center"><strong>Aksi</strong></th>
  </tr>
	<?php
	if(isset($_SESSION['idcustomer'])){
		$i=0;
		$urut = 1;
		foreach($_SESSION['idcustomer'] as $idk){
			if($_POST['status']=='editTicketing' && $_POST['pos']==$i){
			
				echo "me status";
			?>
			
			
			<?php
			}else{
					$idpricelist = $_SESSION['idpricelist'][$i];
						
					echo "<tr>";
					echo "<td align='center'>".$_SESSION['service'][$i]."</td>";
					echo "<td align='center'>".$_SESSION['handling'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['origin'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['destination'][$i]."</td>";	
					echo "<td align='center'>".$_SESSION['nextdest'][$i]."</td>";	
					echo "<td align='center'>".$_SESSION['charge'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['duration'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['description'][$i]."</td>";		
					
										echo "<td align='center'>";
				
					echo "<a style='cursor:pointer;' onclick=\"javascript: kirimRequest('components/customer/detailAddPricelistCustomer.php', 'ajax=true&act=hapus&pos=$i', 'ajaxDiv', 'div');\" title='Hapus data'><img src='images/delete.png' /></a>";
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
  <td align="right"  bgcolor="#00CC99" style="background:none;border:none;">
    <input type="hidden" name="idservice" id="idservice" size="2" />
    <input type="text" name="service" id="service" size="10" placeholder="Layanan" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onClick="NewWindow('index.php?component=service&amp;task=list&amp;open=window','name','825','450','yes');return false" /></td>
              
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idhandling" id="idhandling" size="2" />
                <input type="text" name="handling" id="handling" size="10" placeholder="Handling" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onClick="NewWindow('index.php?component=handling&amp;task=list&amp;open=window','name','825','450','yes');return false" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idorigin" id="idorigin" size="2" />
              <input type="text" name="origin" id="origin" size="10" placeholder="Kota Asal" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onClick="NewWindow('index.php?component=kotafrom&amp;task=list&amp;open=window','name','825','450','yes');return false" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="iddestination" id="iddestination" size="2" />
                <input type="text" name="destination" id="destination" size="10" placeholder="Kota Tujuan" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onClick="NewWindow('index.php?component=kotato&amp;task=list&amp;open=window','name','825','450','yes');return false" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idnextdest" id="idnextdest" size="2" />
                <input type="text" name="nextdest" id="nextdest" size="10" placeholder="Kota Tujuan" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onClick="NewWindow('index.php?component=kotaterusan&amp;task=list&amp;open=window','name','825','450','yes');return false" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input name="charge" type="text" value="0"id="charge" size="10" maxlength="100" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input name="duration" type="text" id="duration" placeholder="Isi Durasi" size="10" maxlength="100" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input name="description" type="text" id="description" placeholder="Isi Keterangan" size="20" maxlength="100" /></td>
    <td align="center" bgcolor="#00CC99" style="background:none;border:none;"><input name="add" type="button" id="add" value="&nbsp;" onclick="var err=''; 
   				 if(document.getElementById('service').value=='') err+='service harus dipilih\n';		         		
                 if(document.getElementById('handling').value=='') err+='handling harus dipilih\n';  
                 if(document.getElementById('origin').value=='') err+='origin harus dipilih\n';  				                 if(document.getElementById('destination').value=='') err+='destination harus dipilih\n';                 if(document.getElementById('nextdest').value=='') err+='terusan harus dipilih\n';                 if(document.getElementById('charge').value=='') err+='charge harus dipilih\n';           
					if(err!='') alert(err);
					else kirimRequest('components/customer/detailPricelistCustomer.php', 'ajax=true&amp;act=addPricelistCustomer&amp;idservice='+document.getElementById('idservice').value+'&service='+document.getElementById('service').value+'&idhandling='+document.getElementById('idhandling').value+'&handling='+document.getElementById('handling').value+'&idorigin='+document.getElementById('idorigin').value+'&origin='+document.getElementById('origin').value+'&iddestination='+document.getElementById('iddestination').value+'&destination='+document.getElementById('destination').value+'&idnextdest='+document.getElementById('idnextdest').value+'&nextdest='+document.getElementById('nextdest').value+'&charge='+document.getElementById('charge').value+'&description='+document.getElementById('description').value+'&duration='+document.getElementById('duration').value, 'ajaxDiv', 'div');" class="checkbutton" title="Add Transaksi"/></td>
  </tr>
</table>


