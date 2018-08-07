<?php 

$page = "pemusnahan";

include_once('header.php');
include_once('database.php');
$db = new Database();


$join = '

INNER JOIN obat ON daftar_obat_kadaluarsa.kode_obat = obat.kode_obat
INNER JOIN detail_obat_masuk ON daftar_obat_kadaluarsa.no_masuk = detail_obat_masuk.no_masuk
ORDER BY detail_obat_masuk.tanggal_kadaluarsa DESC LIMIT 1;
';

$collums = 'daftar_obat_kadaluarsa.jumlah_obat_kadaluarsa, obat.nama_obat, detail_obat_masuk.tanggal_kadaluarsa';

$datad = $db->readJoin($collums ,'daftar_obat_kadaluarsa', null, $join);

$join = '
INNER JOIN detail_pemusnahan_obat ON pemusnahan_obat.no_pemusnahan = detail_pemusnahan_obat.no_pemusnahan
INNER JOIN petugas ON pemusnahan_obat.username = petugas.username
INNER JOIN obat ON detail_pemusnahan_obat.kode_obat = obat.kode_obat
';

$collums = 'obat.nama_obat, detail_pemusnahan_obat.jumlah_obat_kadaluarsa, petugas.nama_lengkap, pemusnahan_obat.tanggal_pengajuan';

$data = $db->readJoin($collums ,'pemusnahan_obat', null, $join);

$no = 1;
?>

<button onclick="functionHide()" class="button">Tambah Pemusnahan</button>

<div class="container">
<form action="" method="post" id="form" style="display:none; border-radius: 5px; background-color: #f2f2f2; padding: 20px; margin-top: 18px;">
No. Pengadaan <input type="text" name="no_pengadaan">
Tanggal Pemusnahan<input type="date" name="kode_pemusnahan">

<table>
<tr>
<th>No.</th>
<th>Nama Obat</th>
<th>Jumlah Obat Kadaluarsa</th>
<th>Tanggal Obat Kadaluarsa</th>
<th>Aksi</th>
</tr>
<?php
foreach($datad as $row){
?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $row['nama_obat']; ?></td>
<td><?php echo $row['jumlah_obat_kadaluarsa']; ?></td>
<td><?php echo $row['tanggal_kadaluarsa']; ?></td>
<td><a href="">Ubah</a>&nbsp;<a href="">Hapus</a></td>
</tr>
<?php
}
?>

<form action="">
<div id="itemlist">
    <tr>
        <td><?php echo $no++; ?></td>
        <td class="container"><input type="text" name="kode_obat[0]"></td>
        <td class="container"><input type="text" name="jumlah_obat[0]"></td>
        <td class="container"><input type="date" name="tanggal_kadaluarsa[0]"></td>
        <td></td>
    </tr>
</div>
   
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><button onclick="tambahItem(); return false" class="button">Tambah</button>&nbsp;<input type="submit" value="Simpan" class="button"></td>
    </tr>
    </form>
</table>
</form>
</div>

<table>
<thead>
<tr>
<th>No.</th>
<th>Nama Obat</th>
<th>Jumlah Obat Kadaluarsa</th>
<th>Tanggal Pengajuan</th>
<th>Petugas</th>
<th>Aksi</th>
</tr>
<?php
$no = 1;
foreach($data as $row){
?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $row['nama_obat']; ?></td>
<td><?php echo $row['jumlah_obat_kadaluarsa']; ?></td>
<td><?php echo $row['tanggal_pengajuan']; ?></td>
<td><?php echo $row['nama_lengkap']; ?></td>
<td><a href="">Ubah</a>&nbsp;<a href="">Hapus</a></td>
</tr>
<?php
}
?>
</table>
<?php include_once('footer.php');?>