<?php
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment;Filename=$_GET[files].xls");

include('template_daftar_cost.php');
// Create new COM object – word.application
//$word = new COM("word.application");

// Hide MS Word application window
$word->Visible = 0;

//Create new document
//$word->Documents->Add();

// Define page margins
$word->Selection->PageSetup->LeftMargin = '1';
$word->Selection->PageSetup->RightMargin = '1';

// Define font settings
$word->Selection->Font->Name = 'Arial';
$word->Selection->Font->Size = 10;

// Add text
//$word->Selection->TypeText("TEXT!");

// Save document
$filename = tempnam(sys_get_temp_dir(), "xls");
//$word->Documents[1]->SaveAs($filename);

// Close and quit
//$word->quit();
unset($word);

header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment;Filename=$_GET[files].xls");

// Send file to browser
readfile($filename);
unlink($filename);
?>