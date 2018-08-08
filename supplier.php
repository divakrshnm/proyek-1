<?php

$page = "supplier";

include_once('header.php');
include_once('database.php');
$db = new Database();

$data = $db->read("*", "supplier");
$no = 1;
?>

<button onclick="functionHide()" class="button">Tambah Supplier</button>

<div class="container">
  <form action="" method="post" id="form" style="display:none; border-radius: 5px; background-color: #f2f2f2; padding: 20px; margin-top: 18px;">
    Kode Supplier : <input type="text" name="kode_supplier">
    Nama Supplier : <input type="text" name="nama_supplier">
    Alamat : <input type="text" name="alamat">
    No. Telepon : <input type="text" name="no_telepon">
    <input type="submit" value="Simpan" class="button">
  </form>
</div>

<div class="container">
  <form action="#" method="post" style="float:right; width:410px;">
    <input type="text" name="tanggal_kadaluarsa" style="float:left; width:300px;">
    <input type="submit" value="Cari Data" style="margin-left:6px; margin-top:6px; font-size:15px;">
  </form>
</div>

<table>
  <tr>
    <th>No.</th>
    <th>Kode Supplier</th>
    <th>Nama Supplier</th>
    <th>Alamat</th>
    <th>No. Telepon</th>
    <th>Aksi</th>
  </tr>
  <?php
  foreach($data as $row){
    ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo $row['kode_supplier']; ?></td>
      <td><?php echo $row['nama_supplier']; ?></td>
      <td><?php echo $row['alamat']; ?></td>
      <td><?php echo $row['no_telepon']; ?></td>
      <td><a href="">Ubah</a>&nbsp;<a href="">Hapus</a></td>
    </tr>
    <?php
  }
  ?>
</table>
<?php include_once('footer.php');?>
