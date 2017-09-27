<?
require("iam_xls.php");

$query = str_replace("+"," ",$_GET[query]);
$weks = stripslashes($query);
if($_GET[files]<>'') {
	$thefile = $_GET[files];
}else{
	$thefile ="export_data";
}
$mid_excel = new IAM_XLS($thefile);
               
$mid_excel->WriteSQLDump($weks, 'shortcut_db', 'root', '', 'localhost');
?>