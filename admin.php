<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
include("ayar.php");
session_start();
if(!isset($_SESSION["login"])){
echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
}else{
header("Refresh: 1; url=index.php");
}
?>
</body>
</html>