<?php 

$page = "obatmasuk";

include_once('header.php');
include_once('database.php');
$db = new Database();

$join = '
INNER JOIN detail_obat_masuk ON obat_masuk.no_masuk = detail_obat_masuk.no_masuk
INNER JOIN obat ON detail_obat_masuk.kode_obat = obat.kode_obat
';

$collums = 'obat.nama_obat, detail_obat_masuk.jumlah_masuk, obat_masuk.tanggal_masuk';

$data = $db->read($collums ,'obat_masuk', null, $join);

$no = 1;
?>

<button onclick="functionHide()" class="button">Tambah Obat Masuk</button>

<div class="container">
<form action="" method="post" id="form" style="display:none; border-radius: 5px; padding: 20px; margin-top: 18px;">
Tanggal Masuk<input type="date" name="kode_supplier">
<table>
    <thead style="background-color: #f2f2f2;">
    <tr>
        <td>No.</td>
        <th>Kode Obat</th>
        <th>Jumlah</th>
        <th>Tanggal Kadaluarsa</th>
        <th></th>
    </tr>
    </thead>
    <tbody id="itemlist">
    <tr>
        <td>1</td>
        <td><input type="text" name="kode_obat[0]"></td>
        <td><input type="text" name="jumlah_obat[0]"></td>
        <td><input type="date" name="tanggal_kadaluarsa[0]"></td>
        <td></td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><button onclick="tambahItem(); return false" class="button">Tambah</button>&nbsp;<input type="submit" value="Simpan" class="button"></td>
    </tr>
    </tfoot>
    
</table>

</form>
</div>

<table>
<tr>
<th>No.</th>
<th>Nama Obat</th>
<th>Jumlah</th>
<th>Tanggal Masuk</th>
<th>Aksi</th>
</tr>
<?php
foreach($data as $row){
?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $row['nama_obat']; ?></td>
<td><?php echo $row['jumlah_masuk']; ?></td>
<td><?php echo date("d-m-Y", strtotime($row['tanggal_masuk'])); ?></td>
<td><a href="">Ubah</a>&nbsp;<a href="">Hapus</a></td>
</tr>
<?php
}
?>
</table>
<?php include_once('footer.php');?>

<script>
var i = 1;
var j = 2;

function tambahItem() {
    var itemlist = document.getElementById('itemlist');

    var row = document.createElement('tr');
    var noObat = document.createElement('td');
    var kodeObat = document.createElement('td');
    var jumlah = document.createElement('td');
    var tanggalKadaluarsa = document.createElement('td');
    var aksi = document.createElement('td');

    itemlist.appendChild(row);
    row.appendChild(noObat);
    row.appendChild(kodeObat);
    row.appendChild(jumlah);
    row.appendChild(tanggalKadaluarsa);
    row.appendChild(aksi);

    var kode_obat = document.createElement('input');
    kode_obat.setAttribute("type", "text");
    kode_obat.setAttribute('name', 'kode_obat[' + i + ']');

    var jumlah_obat = document.createElement('input');
    jumlah_obat.setAttribute("type", "text");
    jumlah_obat.setAttribute('name', 'jumlah_obat[' + i + ']');

    var tanggal_kadaluarsa = document.createElement('input');
    tanggal_kadaluarsa.setAttribute("type", "date");
    tanggal_kadaluarsa.setAttribute('name', 'tanggal_kadaluarsa[' + i + ']');

    var hapus = document.createElement('span');

    var no = document.createElement('span');

    noObat.appendChild(no);
    kodeObat.appendChild(kode_obat);
    jumlah.appendChild(jumlah_obat);
    tanggalKadaluarsa.appendChild(tanggal_kadaluarsa);
    aksi.appendChild(hapus);

    hapus.innerHTML = '<button class="button">Hapus</button>';

    no.innerHTML = j++;

    hapus.onclick = function () {
        row.parentNode.removeChild(row);
    };
    i++;
}
</script>