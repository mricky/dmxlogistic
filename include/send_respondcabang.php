<?php require_once('../connections/con_gl.php'); ?>
          <select name="cabang" id="cabang" onKeyPress="return">
          <option value="">Pilih Lokasi Cabang</option>
		  <?php
		  mysql_select_db($database_con_gl, $con_gl);
		  $query_lokasi = "select * from gl_gudang order by gudang";
		  $lokasi       = mysql_query($query_lokasi,$con_gl) or die(mysql_error());
		  $row_lokasi   = mysql_fetch_assoc($lokasi);
		  $total_lokasi = mysql_num_rows($lokasi);
		  ?>
          <?php if($total_lokasi > 0) { do { ?>
          <option value="<?php echo $row_lokasi['id'];?>"><?php echo $row_lokasi['gudang'];?></option>
          <?php }while($row_lokasi = mysql_fetch_assoc($lokasi)); } ?>		  
        </select>