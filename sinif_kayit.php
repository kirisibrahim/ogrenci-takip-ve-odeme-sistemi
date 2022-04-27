<html>
<head>
<meta charset="utf-8">
<title>Sistem Analizi ve tasarımı ödevi</title>
<link href="style/style.css" rel="stylesheet">    
</head>
<body style="background-color: 	#FFA726;">
<div class="form">
<center><h2 class="title">Sınıf Kayıt Paneli</h2>

<form action="sinif_kayit.php" method="GET">

<div class="input-container ic1">
<input type="text" class="input" name="ders_ad" placeholder="Ders Adını Giriniz" required>
<div class="cut"></div>
</div>
<div class="input-container ic1">
<input type="text" class="input" name="kontenjan" placeholder="Ders Kontenjanını Giriniz" required>
<div class="cut"></div>
</div>
<div class="input-container ic1">
<input type="text" class="input" name="fiyat" placeholder="Ders Ücretini Giriniz" required>
<div class="cut"></div>
</div>
<div class="input-container ic1">
 <?php 
 error_reporting(0);
if($_GET['mesaj'])
{
	$mesaj=$_GET['mesaj'];
	$renk=$_GET['renk'];
echo "<center><div align='center' style='width:100%;color:white; background-color:$renk;height:30px;'> $mesaj</div></center>";

}
?>
<input type="submit" class="submit" value="DERSİ KAYDET">

<div class="cut"></div>
</div>

<button type="button" class="submit" onclick="window.location.href='index.php'" >Ana Sayfaya Dön</button>
</form>
<?php
error_reporting(0);

$db = new PDO("mysql:host=localhost;dbname=sistem_analizi;charset=utf8", "root", "");
if($_GET["ders_ad"] and $_GET["kontenjan"] and  $_GET["fiyat"])
{
$ders_ad=$_GET["ders_ad"];
$kontenjan=$_GET["kontenjan"];
$fiyat=$_GET["fiyat"];

foreach($db->query("Select Count(sinif_ad)  as kayit_kontrol from siniflar where sinif_ad='$ders_ad'",PDO::FETCH_BOTH)as $derskontrol)
{
	if($derskontrol['kayit_kontrol']<=0)
	{
		$sorgu=$db->query("insert into  siniflar(sinif_ad,kontenjan,fiyat) values('$ders_ad','$kontenjan','$fiyat')");	
if($sorgu)
{
	$msg=" Sınıf Kaydı Bsşarıyla Gerçekleştirildi..";
	$renk="darkgreen";
header("location:sinif_kayit.php?mesaj=$msg&renk=$renk");	
 
}

	}
	else{
		
			$msg=" Zaten Böyle Bir Sınıf Mevcut!!";
	$renk="red";
header("location:sinif_kayit.php?mesaj=$msg&renk=$renk");	
	}


	
}
}

?>

</div>
</body>
</html>