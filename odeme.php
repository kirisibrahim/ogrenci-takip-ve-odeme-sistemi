<html>
<head>
<meta charset="utf-8">
<title>Sistem Analizi ve tasarımı ödevi</title>
<link href="style/style.css" rel="stylesheet">      
</head>
<body style="background-color: 	#B2FF59;">
<div style="background-color: #F44336;" class="kayit_form">

<h2 style="background-color: #D50000; color: #00FFFF; text-shadow: 5px 5px 2px black;" align="center">ÖDEME FORMU</h2>

<form action="odeme.php" method="GET">
<table  width="50%" style="float:left;">
<tr><td>ÖĞRENCİ NO:</td><td><input type="text" class="input" name="ogr_no" placeholder="Öğrenci Numarasını Giriniz" required></td><td colspan="5"></td></tr>
<tr><td>ÖDEME ŞEKLİ:</td><td><select name="odeme_sekli" class="input" id="dersler" required>
<option value='Kredi Kartı'>KREDİ KARTI</option>
<option value='NAKİT'>NAKİT</option>
</select>
<tr><td>ÖDENEN ÜCRET:</td><td><input type="text" class="input" name="odenen_ucret" placeholder="ÖDENEN ÜCRET"  required></td><td colspan="5"></td></tr>

<tr><td rows="5" colspan="2" align="center"><input type="submit" class="submit" value="ÖDEME YAP"></td></tr>

</table>
</form>
<div class="container">
<table  id="ogrenci2">
<tr ><th>Öğrenci Numarası</th><th>Öğrenci Adı</th><th>Öğrenci Soyadı</th><th>Kalan Borç</th></tr>
<?php
error_reporting(0);
$db = new PDO("mysql:host=localhost;dbname=sistem_analizi;charset=utf8", "root", "");
foreach($db->query("Select * from ogr_kayit", PDO::FETCH_BOTH)as $row)
{
echo "<tr><td>$row[ogr_id]</td><td>$row[ogr_ad]</td><td>$row[ogr_soyad]</td><td>$row[ogr_borc]</td></tr>";
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
<button type="button" class="submit" onclick="window.location.href='index.php'" >Ana Sayfaya Dön</button>
</div>

<?php
error_reporting(0);
$ogr_no=$_GET["ogr_no"];
$odeme_sekli=$_GET["odeme_sekli"];
$odenen_ucret=$_GET["odenen_ucret"];
$db = new PDO("mysql:host=localhost;dbname=sistem_analizi;charset=utf8", "root", "");

	foreach($db->query("Select * from ogr_kayit where ogr_id='$ogr_no'", PDO::FETCH_BOTH)as $bilgi)
		if($odenen_ucret<=$bilgi['ogr_borc'])
		{	
$sorgu=$db->query("insert into  odemeler(ogr_id, odeme_sekli,odenen_ucret,kalan_ucret) values('$ogr_no','$odeme_sekli','$odenen_ucret','$bilgi[ogr_borc]')");
if($sorgu)
{
	$yeni_borc=$bilgi['ogr_borc']-$odenen_ucret;
	$guncelle=$db->query("Update ogr_kayit set ogr_borc='$yeni_borc' where ogr_id=$ogr_no");
	$msg="$bilgi[ogr_id] numaralı $bilgi[ogr_ad] $bilgi[ogr_soyad] adlı öğrencinin $odenen_ucret ₺ Borcu ödendi. Kalan Borç: $yeni_borc ₺  Ödeme Şekli : $odeme_sekli";
		$renk='darkgreen';
		header("location:odeme.php?mesaj=$msg&renk=$renk");
		}
		}
		else
		{
			$renk='red';
			$msg="Ödenecek tutar borçtan fazla olamaz";
		header("location:odeme.php?mesaj=$msg&renk=$renk");
		}
?>
</body>
</html>