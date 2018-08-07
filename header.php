<?php
session_start();
if($_SESSION['status'] != "login"){
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="javascript.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Apotek XYZ</title>
</head>
<body>

<ul class="header">
  <li><img src="apotek.png" style="height: 60px; width:60px;"></li>
  <li style="font-size:40px; font-weight: bold; color: #FFFFFF; padding:6px">SISTEM INFORMASI APOTEK</li>
</ul>

<ul class="menu">
<?php
    switch ($_SESSION['akses_level']) {
        case 'kepala':
?>
<li>
<a <?php if(@$page == "petugas"){echo 'class="active"';} ?> href="petugas.php">Data Petugas</a>
</li>
<li>
<a <?php if(@$page == "supplier"){echo 'class="active"';} ?> href="supplier.php">Data Supplier</a>
</li>
<li>
<a <?php if(@$page == "pengadaan"){echo 'class="active"';} ?> href="pengadaan.php">Data Pengadaan Obat</a>
</li>
<li>
<a <?php if(@$page == "pemusnahan"){echo 'class="active"';} ?> href="pemusnahan.php">Data Pemusnahan Obat</a>
</li>
<?php
        break;
        case 'staf':
        ?>
        <li>
        <a <?php if(@$page == "obat"){echo 'class="active"';} ?> href="obat.php">Data Obat</a>
        </li>
        <li>
        <a <?php if(@$page == "obatmasuk"){echo 'class="active"';} ?> href="obatmasuk.php">Data Obat Masuk</a>
        </li>
        <li>
        <a <?php if(@$page == "kebutuhanobat"){echo 'class="active"';} ?> href="kebutuhanobat.php">Data Kebutuhan Obat</a>
        </li>
        <li>
        <a <?php if(@$page == "obatkadaluarsa"){echo 'class="active"';} ?> href="obatkadaluarsa.php">Data Obat Kadaluarsa</a>
        </li>
        <?php
            break;
    }
?>
<li>
<a href="logout.php">Logout</a>
</li>
</ul>
<div style="margin-left:21%;padding:1px 16px;height:1000px;margin-top: 117px; padding-top:16px;">