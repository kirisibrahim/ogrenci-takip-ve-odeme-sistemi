<html>
<head>
<meta charset="utf-8">
<title>Sistem Analizi ve tasarımı ödevi</title>
<link href="style/style.css" rel="stylesheet">  
</head>
<body style="background-color: 	#BF360C;">

<div style="background-color: #795548;" class="kayit_form">
<h2 style="background-color: #A1887F; text-shadow: 4px 4px 2px #000;" align="center">ÖĞRENCİ VEYA SINIF KAYDI</h2>
<form action="kayit.php" method="GET">
<table   width="50%" width="%50" style="float:left;">
<tr><td>ÖĞRENCİ AD:</td><td><input type="text" class="input" name="ogr_ad" placeholder="Öğrenci Adını Giriniz" required></td><td colspan="5"></td></tr>
<tr><td>ÖĞRENCİ SOYAD:</td><td><input type="text"  class="input" name="ogr_soyad" placeholder="Öğrenci Soyadını Giriniz" required></td></tr>
<tr><td>ÖĞRENCİ SINIFI:</td><td><select name="ogr_sinif" class="input" id="dersler" required>
<?php
error_reporting(0);
$db = new PDO("mysql:host=localhost;dbname=sistem_analizi;charset=utf8", "root", "");
	foreach($db->query("Select * from siniflar", PDO::FETCH_BOTH)as $sinif)
{
foreach($db->query("Select count(*) as sayi from ogr_kayit where ogr_sinif='$sinif[sinif_id]'", PDO::FETCH_BOTH)as $varmi)
 $bos=$sinif['kontenjan']- $varmi['sayi'];
 if($bos>0)
 {
	 echo "<option value='$sinif[sinif_id]'>$sinif[sinif_ad] (Boş Kontenjan:  $bos)</option>"; 
 }
}
?>
</select>
</td></tr>
<tr ><td align="center"><input type="submit" class="submit" value="KAYDET"></td><td><button type="button" class="submit" onclick="window.location.href='sinif_kayit.php'" >Sınıf Ekle</button></td></tr>
<tr ></tr>
</form>
</table>
<div class="container">
<table  id="ogrenci2">
<tr ><th>Sınıf Adı</th><th>Kontenjan</th><th>Fiyat</th></tr>
<?php
error_reporting(0);
$db = new PDO("mysql:host=localhost;dbname=sistem_analizi;charset=utf8", "root", "");

foreach($db->query("Select * from siniflar", PDO::FETCH_BOTH)as $siniff)
{
	foreach($db->query("Select count(*) as sayi from ogr_kayit where ogr_sinif='$siniff[sinif_id]'", PDO::FETCH_BOTH)as $varmi)
 $bos=$siniff['kontenjan']- $varmi['sayi'];
echo "<tr><td>$siniff[sinif_ad]</td><td>$bos</td><td>$siniff[fiyat]</td></tr>";
}
?>
</table>

</div>
 <?php 
if($_GET['mesaj'])
{
	$mesaj=$_GET['mesaj'];
	$renk=$_GET['renk'];
echo "<center><div align='center' style='width:100%;color:white; background-color:$renk;height:30px;'> $mesaj</div></center>";
}
?>
<h2 style="background-color: #A1887F; text-shadow: 4px 4px 2px #000;" align="center">KAYITLI ÖĞRENCİLER</h2>
<div class="container" style="width:100%; height:30%;" >
<table id="ogrenci">
<tr><th>Öğrenci Numarası</th><th>Öğrenci Adı</th><th>Öğrenci Soyadı</th><th>Öğrenci Sınıfı</th></tr>
<?php
error_reporting(0);

$db = new PDO("mysql:host=localhost;dbname=sistem_analizi;charset=utf8", "root", "");

foreach($db->query("Select * from ogr_kayit", PDO::FETCH_BOTH)as $row)
{
foreach($db->query("Select * from siniflar where sinif_id='$row[ogr_sinif]'", PDO::FETCH_BOTH)as $row2)
{
	
echo "<tr><td>$row[ogr_id]</td><td>$row[ogr_ad]</td><td>$row[ogr_soyad]</td><td>$row2[sinif_ad]</td></tr>";
}}
?>
</table>
</div>
<button  type="button" class="submit" onclick="window.location.href='index.php'" >Ana Sayfaya Dön</button>
<?php
error_reporting(0);
$ogr_ad=$_GET["ogr_ad"];
$ogr_soyad=$_GET["ogr_soyad"];
$ogr_sinif=$_GET["ogr_sinif"];
$db = new PDO("mysql:host=localhost;dbname=sistem_analizi;charset=utf8", "root", "");
if($ogr_ad!="" and $ogr_soyad!="" and $ogr_sinif!="")
{
foreach($db->query("Select * from siniflar where sinif_id='$ogr_sinif'", PDO::FETCH_BOTH)as $sinif)
$tutar=$sinif['fiyat'];
$sorgu=$db->query("insert into  ogr_kayit(ogr_ad, ogr_soyad, ogr_sinif,ogr_borc) values('$ogr_ad','$ogr_soyad', '$ogr_sinif','$tutar')");
	if($sorgu)
	{
		$msg="$sinif[sinif_ad] sınıfına $ogr_ad  $ogr_soyad adlı öğrenci başarıyla kayıt edilmiştir.";
		$renk="darkgreen";
			header("location:kayit.php?mesaj=$msg&renk=$renk");
	}
}
?>
</div>
</body>
</html>
