<div id="box-exportdata">
<a href="javascript:window.print();"><img src="images/_print.png" border="0" /></a><br /><br />
<a href="xls/export_xls.php?query=<?php echo str_replace(" ","+",$query_data);?>&amp;files=<?php echo $_GET['component'];?>" title="Export Excel"><img src="images/_xls.png" border="0" /></a><?php if($_GET['component']<>'bukubesar') { ?><br /><br />
<a href="doc/transaksihariandoc.php?query=<?php echo str_replace(" ","+",$query_data);?>&amp;files=<?php echo $_GET['component'];?>" title="Export Word"><img src="images/_word.png" border="0"/></a><?php } ?>
</div>