 <?php

if($_REQUEST['ajax'] == 'true'){
	//session_start();
	
	include "../../connections/con_gl.php";
	
//	echo 'brekele brekele';
	switch($_REQUEST['act']){
		case 'addSTT' :
			echo 'Tambah';
				//	$_SESSION['nama_penumpang'][] = $_POST['nama_penumpang'];	

			$_SESSION['stt'][] = $_POST['stt'];
			$_SESSION['idservice'][] = $_POST['idservice'];
			$_SESSION['service'][] = $_POST['service'];
			$_SESSION['idorigin'][] = $_POST['idorigin'];
			$_SESSION['origin'][] = $_POST['origin'];
			$_SESSION['iddestination'][] = $_POST['iddestination'];
			$_SESSION['destination'][] = $_POST['destination'];	
			$_SESSION['idnextdest'][] = $_POST['idnextdest'];	
			$_SESSION['nextdest'][] = $_POST['nextdest'];	
			$_SESSION['modatransport'][] = $_POST['transport'];
			$_SESSION['idmodatransport'][] = $_POST['idtransport'];
			$_SESSION['weight'][] = $_POST['weight'];																		
			$_SESSION['tcharge'][] = $_POST['tcharge'];																																           		
			break;
				
		case 'hapus' :
				$pos = $_POST['pos'];					

				unset($_SESSION['stt'][$pos]);
				unset($_SESSION['idservice'][$pos]);
				unset($_SESSION['service'][$pos]);
				unset($_SESSION['idorigin'][$pos]);
				unset($_SESSION['origin'][$pos]);
				unset($_SESSION['iddestination'][$pos]);
				unset($_SESSION['destination'][$pos]);
				unset($_SESSION['idnextdest'][$pos]);
				unset($_SESSION['nextdest'][$pos]);				
				unset($_SESSION['modatransport'][$pos]);
				unset($_SESSION['idmodatransport'][$pos]);
				unset($_SESSION['weight'][$pos]);
				unset($_SESSION['tcharge'][$pos]);																													         	
			

			
			//unset($_SESSION['info'][$pos]);
		
					

			$_SESSION['stt']	=  array_values($_SESSION['stt']);
			$_SESSION['idservice']	=  array_values($_SESSION['idservice']);
			$_SESSION['service']	=  array_values($_SESSION['service']);
			$_SESSION['idorigin']	=  array_values($_SESSION['idorigin']);
			$_SESSION['origin']	=  array_values($_SESSION['origin']);
			$_SESSION['iddestination']	=  array_values($_SESSION['iddestination']);
			$_SESSION['destination']	=  array_values($_SESSION['destination']);	
			$_SESSION['idnextdest']	=  array_values($_SESSION['idnextdest']);	
			$_SESSION['nextdest']	=  array_values($_SESSION['nextdest']);	
			$_SESSION['modatransport']	=  array_values($_SESSION['modatransport']);
			$_SESSION['idmodatransport']	=  array_values($_SESSION['idmodatransport']);
			$_SESSION['weight']	=  array_values($_SESSION['weight']);
			$_SESSION['tcharge']	=  array_values($_SESSION['tcharge']);

			
			
			break;
	}
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
<tr>
     	<th width="10%" align="center">STT</th>
		<th width="14%" align="center">Service</th>
		<th width="14%" align="center">Armada</th>
     	<th width="12%" align="center">Asal</th>
		<th width="12%" align="center">Tujuan</th>
		<th width="12%" align="center">Terusan</th>
		<th width="12%" align="center">Berat</th>
		<th width="12%" align="center">Total Charge</th>
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
					echo "<td align='center'>".$_SESSION['stt'][$i]."</td>";
					echo "<td align='center'>".$_SESSION['service'][$i]."</td>";
					echo "<td align='center'>".$_SESSION['modatransport'][$i]."</td>";	
					echo "<td align='center'>".$_SESSION['origin'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['destination'][$i]."</td>";	
					echo "<td align='center'>".$_SESSION['nextdest'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['weight'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['tcharge'][$i]."</td>";		
						
					echo "<td align='center'>";	
		
					echo "<a style='cursor:pointer;' onclick=\"javascript: kirimRequest('components/invoice/detailSTT.php', 'ajax=true&act=hapus&pos=$i', 'ajaxDiv', 'div');\" title='Hapus data'><img src='images/delete.png' /></a>";
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
    <input type="text" name="stt" id="stt" size="10" placeholder="STT" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onClick="NewWindow('index.php?component=invoice&amp;task=listSTT&amp;customer='+document.getElementById('idcustomer').value+'&amp;open=window','name','825','450','yes');return false" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idservice" id="idservice" size="2" />
                <input type="text" name="service" id="service" size="10" placeholder="Layanan" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px;"/></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idtransport" id="idtransport" size="2" />
                <input type="text" name="transport" id="transport" size="10" placeholder="Moda Transport" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " /></td>
    <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idorigin" id="idorigin" size="2" />
      <input type="text" name="origin" id="origin" size="10" placeholder="Kota Asal" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; "/></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="iddestination" id="iddestination" size="2" />
                <input type="text" name="destination" id="destination" size="10" placeholder="Kota Tujuan" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; "  /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idnextdest" id="idnextdest" size="2" />
                  <input type="text" name="nextdest" id="nextdest" size="10" placeholder="Kota Terusan" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; "  /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input name="weight" type="text" value="0"id="weight" size="10" maxlength="100" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input name="tcharge" type="text" value="0"id="tcharge" size="10" maxlength="100" /></td>
              <td align="center" bgcolor="#00CC99" style="background:none;border:none;"><input name="add" type="button" id="add" value="&nbsp;" onClick="var err=''; 
   				 if(document.getElementById('service').value=='') err+='service harus dipilih\n';		         		 if(document.getElementById('transport').value=='') err+='moda transport harus dipilih\n';                 
                 if(document.getElementById('origin').value=='') err+='origin harus dipilih\n';  				                 		if(document.getElementById('destination').value=='') err+='destination harus dipilih\n';                           if(document.getElementById('idcustomer').value=='') err+='Silahkan pilih customer\n';
                                              
					if(err!='') alert(err);
					else kirimRequest('components/invoice/detailSTT.php', 'ajax=true&amp;act=addSTT&amp;stt='+document.getElementById('stt').value+'&amp;service='+document.getElementById('service').value+'&amp;idservice='+document.getElementById('idservice').value+'&amp;service='+document.getElementById('service').value+'&amp;idorigin='+document.getElementById('idorigin').value+'&amp;origin='+document.getElementById('origin').value+'&amp;iddestination='+document.getElementById('iddestination').value+'&amp;destination='+document.getElementById('destination').value+'&amp;nextdest='+document.getElementById('nextdest').value+'&amp;idtransport='+document.getElementById('idtransport').value+'&amp;transport='+document.getElementById('transport').value+'&amp;weight='+document.getElementById('weight').value+'&amp;tcharge='+document.getElementById('tcharge').value, 'ajaxDiv', 'div');" class="checkbutton" title="Add Transaksi"/></td>
  </tr>
</table>


