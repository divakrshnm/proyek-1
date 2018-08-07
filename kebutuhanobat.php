<?php 

$page = "kebutuhanobat";

include_once('header.php');
include_once('database.php');
$db = new Database();

$join = '
INNER JOIN obat ON daftar_kebutuhan_obat.kode_obat = obat.kode_obat
';

$collums = 'daftar_kebutuhan_obat.jumlah_kebutuhan, obat.kode_obat, obat.nama_obat';

$data = $db->read($collums ,'daftar_kebutuhan_obat', null, $join);

$no = 1;
?>

<table>
<tr>
<th>No.</th>
<th>Kode Obat</th>
<th>Nama Obat</th>
<th>Jumlah Kebutuhan</th>
<th>Aksi</th>
</tr>
<?php
foreach($data as $row){
?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $row['kode_obat']; ?></td>
<td><?php echo $row['nama_obat']; ?></td>
<td><?php echo $row['jumlah_kebutuhan']; ?></td>
<td><a href="">Ubah</a>&nbsp;<a href="">Hapus</a></td>
</tr>
<?php
}
?>


</table>
<?php include_once('footer.php');?>