 <?php



if($_REQUEST['ajax'] == 'true'){
	//session_start();
	
	include "../../connections/con_gl.php";
	
//	echo 'brekele brekele';
	switch($_REQUEST['act']){
		case 'addPricelistAgent' :
			echo 'Tambah';
				//	$_SESSION['nama_penumpang'][] = $_POST['nama_penumpang'];	

			$_SESSION['idagent'][] = $_POST['idagent'];
			$_SESSION['agent'][] = $_POST['agent'];
			$_SESSION['idservice'][] = $_POST['idservice'];
			$_SESSION['service'][] = $_POST['service'];
			$_SESSION['idorigin'][] = $_POST['idorigin'];
			$_SESSION['origin'][] = $_POST['origin'];
			$_SESSION['iddestination'][] = $_POST['iddestination'];
			$_SESSION['destination'][] = $_POST['destination'];			
			$_SESSION['idhandling'][] = $_POST['idhandling'];
			$_SESSION['handling'][] = $_POST['handling'];
			$_SESSION['modatransport'][] = $_POST['transport'];
			$_SESSION['idmodatransport'][] = $_POST['idtransport'];
			$_SESSION['rate'][] = $_POST['rate'];																		
			$_SESSION['minpackage'][] = $_POST['minpackage'];																																           		
			break;
				
		case 'hapus' :
				$pos = $_POST['pos'];					

				unset($_SESSION['idagent'][$pos]);
				unset($_SESSION['agent'][$pos]);
				unset($_SESSION['idservice'][$pos]);
				unset($_SESSION['service'][$pos]);
				unset($_SESSION['idorigin'][$pos]);
				unset($_SESSION['origin'][$pos]);
				unset($_SESSION['iddestination'][$pos]);
				unset($_SESSION['destination'][$pos]);				
				unset($_SESSION['idhandling'][$pos]);
				unset($_SESSION['handling'][$pos]);
				unset($_SESSION['modatransport'][$pos]);
				unset($_SESSION['idmodatransport'][$pos]);
				unset($_SESSION['rate'][$pos]);
				unset($_SESSION['minpackage'][$pos]);																													         	
			

			
			//unset($_SESSION['info'][$pos]);
		
					

			$_SESSION['idagent']	=  array_values($_SESSION['idagent']);
			$_SESSION['agent']	=  array_values($_SESSION['agent']);
			$_SESSION['idservice']	=  array_values($_SESSION['idservice']);
			$_SESSION['service']	=  array_values($_SESSION['service']);
			$_SESSION['idorigin']	=  array_values($_SESSION['idorigin']);
			$_SESSION['origin']	=  array_values($_SESSION['origin']);
			$_SESSION['iddestination']	=  array_values($_SESSION['iddestination']);
			$_SESSION['destination']	=  array_values($_SESSION['destination']);			
			$_SESSION['idhandling']	=  array_values($_SESSION['idhandling']);
			$_SESSION['handling']	=  array_values($_SESSION['handling']);
			$_SESSION['modatransport']	=  array_values($_SESSION['modatransport']);
			$_SESSION['idmodatransport']	=  array_values($_SESSION['idmodatransport']);
			$_SESSION['rate']	=  array_values($_SESSION['rate']);
			$_SESSION['minpackage']	=  array_values($_SESSION['minpackage']);

			
			
			break;
	}
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="datatable">
<tr>
     	<th width="10%" align="center">Service</th>
		<th width="14%" align="center">Moda Transport</th>
     	<th width="12%" align="center">Handling</th>
		<th width="12%" align="center">Asal</th>
		<th width="12%" align="center">Tujuan</th>
		<th width="12%" align="center">Rate</th>
		<th width="12%" align="center">Min Paket</th>
		<th width="16%" align="center"><strong>Aksi</strong></th>
  </tr>
	<?php
	if(isset($_SESSION['idagent'])){
		$i=0;
		$urut = 1;
		foreach($_SESSION['idagent'] as $idk){
			if($_POST['status']=='editTicketing' && $_POST['pos']==$i){
			
				echo "me status";
			?>
			
			
			<?php
			}else{					
						
					echo "<tr>";
					echo "<td align='center'>".$_SESSION['service'][$i]."</td>";
					echo "<td align='center'>".$_SESSION['modatransport'][$i]."</td>";	
					echo "<td align='center'>".$_SESSION['handling'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['origin'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['destination'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['rate'][$i]."</td>";		
					echo "<td align='center'>".$_SESSION['minpackage'][$i]."</td>";		
						
					echo "<td align='center'>";	
		
					echo "<a style='cursor:pointer;' onclick=\"javascript: kirimRequest('components/agent/detailAddPricelistAgent.php', 'ajax=true&act=hapus&pos=$i', 'ajaxDiv', 'div');\" title='Hapus data'><img src='images/delete.png' /></a>";
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
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idtransport" id="idtransport" size="2" />
                <input type="text" name="transport" id="transport" size="10" placeholder="Moda Transport" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onclick="NewWindow('index.php?component=agenthandling&amp;task=listmodatransport&amp;open=window','name','825','450','yes');return false" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idhandling" id="idhandling" size="2" />
                  <input type="text" name="handling" id="handling" size="10" placeholder="Handling" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onclick="NewWindow('index.php?component=agenthandling&amp;task=listhandling&amp;open=window','name','825','450','yes');return false" /></td>
    <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="idorigin" id="idorigin" size="2" />
      <input type="text" name="origin" id="origin" size="10" placeholder="Kota Asal" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onclick="NewWindow('index.php?component=kotafrom&amp;task=list&amp;open=window','name','825','450','yes');return false" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input type="hidden" name="iddestination" id="iddestination" size="2" />
                <input type="text" name="destination" id="destination" size="10" placeholder="Kota Tujuan" readonly="readonly" style="background-color:#fff;border:1px solid #999; height:16px; " onclick="NewWindow('index.php?component=kotato&amp;task=list&amp;open=window','name','825','450','yes');return false" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input name="rate" type="text" value="0"id="rate" size="10" maxlength="100" /></td>
              <td align="right" bgcolor="#00CC99" style="background:none;border:none;"><input name="minpackage" type="text" value="0"id="minpackage" size="10" maxlength="100" /></td>
              <td align="center" bgcolor="#00CC99" style="background:none;border:none;"><input name="add" type="button" id="add" value="&nbsp;" onclick="var err=''; 
   				 if(document.getElementById('service').value=='') err+='service harus dipilih\n';		         		 if(document.getElementById('transport').value=='') err+='moda transport harus dipilih\n'; 
                 if(document.getElementById('handling').value=='') err+='handling harus dipilih\n';  
                 if(document.getElementById('origin').value=='') err+='origin harus dipilih\n';  				                 		if(document.getElementById('destination').value=='') err+='destination harus dipilih\n';                            
                   if(document.getElementById('rate').value=='') err+='rate agent harus dipilih\n';     
                   if(document.getElementById('minpackage').value=='') err+='rate agent harus dipilih\n';           
					if(err!='') alert(err);
					else kirimRequest('components/agent/detailAddPricelistAgent.php', 'ajax=true&amp;act=addPricelistAgent&amp;idservice='+document.getElementById('idservice').value+'&amp;service='+document.getElementById('service').value+'&amp;idtransport='+document.getElementById('idtransport').value+'&amp;transport='+document.getElementById('transport').value+'&amp;idhandling='+document.getElementById('idhandling').value+'&amp;handling='+document.getElementById('handling').value+'&amp;idorigin='+document.getElementById('idorigin').value+'&amp;origin='+document.getElementById('origin').value+'&amp;iddestination='+document.getElementById('iddestination').value+'&amp;destination='+document.getElementById('destination').value+'&amp;rate='+document.getElementById('rate').value+'&amp;minpackage='+document.getElementById('minpackage').value, 'ajaxDiv', 'div');" class="checkbutton" title="Add Transaksi"/></td>
  </tr>
    
	
</table>


