<?php
session_start();
unset($_SESSION[admin],$_SESSION[akses]);
session_destroy();
header("Location:index.php");
?>