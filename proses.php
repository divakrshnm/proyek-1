<?php
include_once('database.php');
$db = new Database();

@$proses = $_POST['proses'];
switch ($proses) {
    case 'login':
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = $db->login("petugas", "username = '$username' && password = '$password'");
        if($result > 0){
            session_start();
            $data = $db->read("*", "petugas", "username = '$username' && password = '$password'");
            $_SESSION['nama_lengkap'] = $data[0]['nama_lengkap'];
            $_SESSION['akses_level'] = $data[0]['akses_level'];
            $_SESSION['status'] = "login";
            header("location:index.php");
        }
        echo "Username dan Password Salah";
    }
    else{
        echo "Username dan Password Kosong";
    }
    break;
}
?>