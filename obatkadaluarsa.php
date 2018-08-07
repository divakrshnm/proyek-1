<?php 

$page = "obatkadaluarsa";

include_once('header.php');
include_once('database.php');
$db = new Database();

$join = '
INNER JOIN obat ON daftar_obat_kadaluarsa.kode_obat = obat.kode_obat
INNER JOIN detail_obat_masuk ON daftar_obat_kadaluarsa.no_masuk = detail_obat_masuk.no_masuk 
AND daftar_obat_kadaluarsa.kode_obat = detail_obat_masuk.kode_obat 
';

$collums = 'obat.kode_obat, obat.nama_obat, detail_obat_masuk.tanggal_kadaluarsa, daftar_obat_kadaluarsa.jumlah_obat_kadaluarsa';

$data = $db->read($collums ,'daftar_obat_kadaluarsa', null, $join);

$no = 1;
?>


<table>
<tr>
<th>No.</th>
<th>Kode Obat</th>
<th>Nama Obat</th>
<th>Tanggal Kadaluarsa</th>
<th>Jumlah</th>
<th>Aksi</th>
</tr>
<?php
foreach($data as $row){
?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $row['kode_obat']; ?></td>
<td><?php echo $row['nama_obat']; ?></td>
<td><?php echo date("d-m-Y", strtotime($row['tanggal_kadaluarsa'])); ?></td>
<td><?php echo $row['jumlah_obat_kadaluarsa']; ?></td>
<td><a href="">Ubah</a>&nbsp;<a href="">Hapus</a></td>
</tr>
<?php
}
?>

</table>
<?php include_once('footer.php');?>