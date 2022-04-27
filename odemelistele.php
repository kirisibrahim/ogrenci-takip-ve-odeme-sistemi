<html>
<head>
<meta charset="utf-8">
<title>Sistem Analizi ve tasarımı ödevi</title>
<link href="style/style.css" rel="stylesheet">  
</head>
<body style="background-color: #FFCCBC;">
<div class="kayit_form">
<h2 style="background-color: #A1887F; text-shadow: 4px 4px 2px #000;" align="center">ÖDEME LİSTESİ</h2>
<form action="odemelistele.php" method="GET">
<table  width="50%" style="float:left;">
<tr><td>ÖĞRENCİ NO:</td><td><input type="text" class="input" name="ogr_no" placeholder="Öğrenci Numarasını Giriniz" required></td><td colspan="5"></td></tr>
<tr><td rows="5" colspan="2" align="center"><input type="submit" class="submit" value="GÖRÜNTÜLE"></td></tr>
</table>
</form>
<div class="container">
<table  id="ogrenci2">
<tr ><th>Öğrenci Numarası</th><th>Öğrenci Adı</th><th>Öğrenci Soyadı</th><th>Öğrenci Sınıfı</th></tr>
<?php
error_reporting(0);

$db = new PDO("mysql:host=localhost;dbname=sistem_analizi;charset=utf8", "root", "");

foreach($db->query("Select * from ogr_kayit", PDO::FETCH_BOTH)as $row)
{

	foreach($db->query("Select * from siniflar where sinif_id='$row[ogr_sinif]'",PDO::FETCH_BOTH)as $siniff)
	{
	echo "<tr><td>$row[ogr_id]</td><td>$row[ogr_ad]</td><td>$row[ogr_soyad]</td><td>$siniff[sinif_ad]</td></tr>";
	}
}
?>
</table>
</div>
<br>
<div style="height:300px;overflow:auto;">

<table id="ogrenci">
<tr><th>Ödeme ID</th><th>Öğrenci Numarası</th><th>Öğrencinin Adı Soyadı</th><th>Ödeme Şekli</th><th>Ödenen Ücret</th></th><th>Kalan Ücret</th></tr>
<?php
error_reporting(0);
$db = new PDO("mysql:host=localhost;dbname=sistem_analizi;charset=utf8", "root", "");
if($_GET['ogr_no'])
{
	$ogr_no=$_GET['ogr_no'];
		foreach($db->query("Select count(*) as kayit_kontrol from ogr_kayit where ogr_id='$ogr_no'",PDO::FETCH_BOTH)as $kayitvarmi)
{
	if($kayitvarmi['kayit_kontrol']>0)
	{
			foreach($db->query("Select count(*) as var  from odemeler where ogr_id='$ogr_no'",PDO::FETCH_BOTH)as $varmi)
{
	if($varmi['var']>0 )
	{
		foreach($db->query("Select * from odemeler where ogr_id='$ogr_no'", PDO::FETCH_BOTH)as $ucret)
		{
foreach($db->query("Select * from ogr_kayit where ogr_id='$ogr_no'", PDO::FETCH_BOTH)as $row)
{
foreach($db->query("Select * from siniflar where sinif_id='$row[ogr_sinif]'", PDO::FETCH_BOTH)as $row2)
{

	$abc=$ucret['kalan_ucret']-$ucret['odenen_ucret'];
echo "<tr><td>$ucret[odeme_id]</td><td>$row[ogr_id]</td><td>$row[ogr_ad]  $row[ogr_soyad]</td><td>$ucret[odeme_sekli]</td><td>$ucret[odenen_ucret]</td><td>$abc</td></tr>";
if($ucret['odenen_ucret']==$ucret['kalan_ucret'])
{
	$odeme=$ucret['odeme_id'];
	echo "<tr><td>	$odeme</td><td>$row[ogr_id]</td><td>$row[ogr_ad]  $row[ogr_soyad]</td><td>$ucret[odeme_sekli]</td><td>$ucret[odenen_ucret]</td><td>0</td></tr>";
}
}
}	
}	
	}else
	{
		echo "<tr><td colspan='6' align='center'>GEÇMİŞ ÖDEME KAYDI YOK</td></tr>";
	}
}
}
	else
	{
		echo "<tr><td colspan='6' align='center'>Aradığınız Numarada Öğrenci Kaydı Bulunmamaktadır</td></tr>";
	}
	}
}
else
{
	echo "<tr><td colspan='6' align='center'>Öğrenci Numarasına göre arama yapınız</td></tr>";
}
?>
</table>
<br>
<br>
<br>
<br>
<br>
<button type="button" class="submit" onclick="window.location.href='index.php'" >Ana Sayfaya Dön</button>
</div>

</div>
</body>
</html>