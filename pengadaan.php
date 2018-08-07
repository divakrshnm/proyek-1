<?php 

$page = "pengadaan";

include_once('header.php');
include_once('database.php');
$db = new Database();

$datas = $db->read("*", "supplier");

$join = 'INNER JOIN obat ON daftar_kebutuhan_obat.kode_obat = obat.kode_obat';

$collums = 'obat.nama_obat, daftar_kebutuhan_obat.jumlah_kebutuhan';

$datad = $db->read($collums, 'daftar_kebutuhan_obat', null, $join);

$join = '
INNER JOIN supplier ON pengadaan_obat.kode_supplier = supplier.kode_supplier
INNER JOIN petugas ON pengadaan_obat.username = petugas.username
INNER JOIN detail_pengadaan_obat ON pengadaan_obat.no_pengadaan = detail_pengadaan_obat.no_pengadaan
INNER JOIN obat ON detail_pengadaan_obat.kode_obat = obat.kode_obat
';

$collums = 'petugas.nama_lengkap, supplier.nama_supplier, pengadaan_obat.tanggal_pesan, detail_pengadaan_obat.jumlah_kebutuhan, obat.nama_obat';

$dataj = $db->read($collums ,'pengadaan_obat', null, $join);
$no = 1;
?>

<button onclick="functionHide()" class="button">Tambah Pengadaan</button>

<div class="container">
<form action="" method="post" id="form" style="display:none; border-radius: 5px; background-color: #f2f2f2; padding: 20px; margin-top: 18px;">
No. Pengadaan <input type="text" name="no_pengadaan">
Tanggal Pesan<input type="date" name="kode_supplier">
Supplier
<select name="supplier">
    <option value="" selected disabled>Pilih Supplier</option>
    <?php
foreach($datas as $row){
?>
    <option value="<?php echo $row['kode_supplier'];?>"><?php echo $row['nama_supplier'];?></option>
    <?php
}
?>
</select>
<table>
<tr>
<th>No.</th>
<th>Nama Obat</th>
<th>Jumlah Kebutuhan</th>
<th>Aksi</th>
</tr>
<?php
foreach($datad as $row){
?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $row['nama_obat']; ?></td>
<td><?php echo $row['jumlah_kebutuhan']; ?></td>
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
        <td class="container"><input type="text" name="jumlah_kebutuhan[0]"></td>
        <td></td>
    </tr>
</div>
   
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><button onclick="tambahItem(); return false;" class="button">Tambah</button>&nbsp;<input type="submit" value="Simpan" class="button"></td>
    </tr>
    </form>
</table>
</form>
</div>

<table>
<tr>
<th>No.</th>
<th>Nama Obat</th>
<th>Jumlah Kebutuhan</th>
<th>Tanggal Pesan</th>
<th>Petugas</th>
<th>Supplier</th>
<th>Aksi</th>
</tr>
<?php
$no = 1;
foreach($dataj as $row){
?>
<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $row['nama_obat']; ?></td>
<td><?php echo $row['jumlah_kebutuhan']; ?></td>
<td><?php echo date("d-m-Y", strtotime($row['tanggal_pesan'])); ?></td>
<td><?php echo $row['nama_lengkap']; ?></td>
<td><?php echo $row['nama_supplier']; ?></td>
<td><a href="">Ubah</a>&nbsp;<a href="">Hapus</a></td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php include_once('footer.php');?>