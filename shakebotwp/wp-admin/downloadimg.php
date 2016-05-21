<?php
header('Content-type: application/octet-stream');
header('Content-Disposition: inline; filename="'.$_GET['amazonimg'].'"');
readfile($_GET['amazonimg']);
?>
