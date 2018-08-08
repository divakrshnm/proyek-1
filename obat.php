<?php

$page = "obat";

include_once('header.php');
include_once('database.php');
$db = new Database();

?>

<button onclick="functionHide()" class="button">Tambah Obat</button>

<div class="container">
  <form action="" method="post" id="form" style="display:none; border-radius: 5px; background-color: #f2f2f2; padding: 20px; margin-top: 18px;">
    Kode Obat : <input type="text" name="kode_obat"><br>
    Nama Obat : <input type="text" name="nama_obat"><br>
    Harga Jual : <input type="text" name="harga_jual"><br>
    Stok Minimal : <input type="text" name="stok_minimal"><br>
    <input type="submit" value="Simpan" class="button">
  </form>
</div>

<div class="container">
  <form action="obat.php" method="post" style="float:right; width:460px;">
    <input type="date" name="tanggal_kadaluarsa" style="float:left; width:300px;">
    <input type="submit" value="Cari Kadaluarsa" style="margin-left:6px; margin-top:6px; font-size:15px;">
  </form>
</div>

<?php
if(!empty($_POST['tanggal_kadaluarsa'])){
  $join = "
  LEFT JOIN detail_obat_masuk ON obat.kode_obat = detail_obat_masuk.kode_obat
  LEFT JOIN obat_masuk ON detail_obat_masuk.no_masuk = obat_masuk.no_masuk

  WHERE detail_obat_masuk.tanggal_kadaluarsa = '".$_POST['tanggal_kadaluarsa']."'
  ";
} else{
  $join = '
  LEFT JOIN detail_obat_masuk ON obat.kode_obat = detail_obat_masuk.kode_obat
  LEFT JOIN obat_masuk ON detail_obat_masuk.no_masuk = obat_masuk.no_masuk
  ';
}

$collums = 'obat_masuk.tanggal_masuk, detail_obat_masuk.tanggal_kadaluarsa, obat.jumlah_obat, detail_obat_masuk.no_masuk, obat.kode_obat, obat.nama_obat, obat.harga_jual, obat.jumlah_obat, obat.stok_minimal';

$data = $db->read($collums ,'obat', null, $join);
$no = 1;
?>

<table>
  <tr>
    <th>No.</th>
    <th>Nama Obat</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Tanggal Masuk</th>
    <th>Tanggal Kadaluarsa</th>
    <th>Kadaluarsa</th>
    <th>Aksi</th>
  </tr>
  <?php
  foreach($data as $row){
    ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo $row['nama_obat']; ?></td>
      <td><?php echo $row['harga_jual']; ?></td>
      <td><?php if(isset($row['jumlah_obat'])){echo $row['jumlah_obat'];}else{ echo "-";} ?></td>
      <td><?php if(isset($row['tanggal_masuk'])){echo date("d-m-Y", strtotime($row['tanggal_masuk']));}else{ echo "-";} ?></td>
      <td><?php if(isset($row['tanggal_kadaluarsa'])){echo date("d-m-Y", strtotime($row['tanggal_kadaluarsa']));}else{ echo "-";} ?></td>
      <td style="text-align: center;"><input type="checkbox" name="kadaluarsa"></td>
      <td><a href="">Ubah</a>&nbsp;<a href="">Hapus</a></td>
    </tr>
    <?php
  }
  ?>
</table>
<button class="button" style="float:right; margin-top:14px;">Terima Perubahan</button>
<?php include_once('footer.php');?>
