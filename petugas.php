<?php
$page = "petugas";

include_once('header.php');
include_once('database.php');
$db = new Database();

$data = $db->read("*", "petugas");
$no = 1;
?>

<button onclick="functionHide()" class="button">Tambah Petugas</button>

<div class="container">
  <form action="" method="post" id="form" style="display:none; border-radius: 5px; background-color: #f2f2f2; padding: 20px; margin-top: 18px;">
    Nama Lengkap <input type="text" name="nama_lengkap">
    Tanggal Lahir <input type="date" name="tanggal_lahir">
    Alamat
    <textarea name="alamat" cols="30" rows="10"></textarea>
    No. Telepon <input type="text" name="no_telepon">
    Username <input type="text" name="username">
    Password <input type="text" name="password">
    Akses Level
    <select name="akses_level">
      <option value="" selected disabled>Pilih Akses Level</option>
      <option value="kepala">Kepala</option>
      <option value="staf">Staf</option>
    </select>
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
    <th>Nama Lengkap</th>
    <th>Tanggal Lahir</th>
    <th>Alamat</th>
    <th>No. Telepon</th>
    <th>Akses Level</th>
    <th>Aksi</th>
  </tr>
  <?php
  foreach($data as $row){
    ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo $row['nama_lengkap']; ?></td>
      <td><?php echo date("d-m-Y", strtotime($row['tanggal_lahir'])); ?></td>
      <td><?php echo $row['alamat']; ?></td>
      <td><?php echo $row['no_telepon']; ?></td>
      <td><?php echo $row['akses_level']; ?></td>
      <td><a href="">Ubah</a>&nbsp;<a href="">Hapus</a></td>
    </tr>
    <?php
  }
  ?>
</table>
<?php include_once('footer.php');?>
