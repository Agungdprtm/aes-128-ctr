<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 600); // Increase maximum execution time
error_reporting(E_ALL);

session_start();
include "../config.php";
include "AES.php";
include "Padkey.php";

$idfile = mysqli_escape_string($connect, $_POST['fileid']);
$pwdfile = mysqli_escape_string($connect, substr(md5($_POST["pwdfile"]), 0, 16));
$query = "SELECT password FROM file WHERE id_file='$idfile' AND password='$pwdfile'";
$sql = mysqli_query($connect, $query);

if (mysqli_num_rows($sql) > 0) {
    $query1 = "SELECT * FROM file WHERE id_file='$idfile'";
    $sql1 = mysqli_query($connect, $query1);
    $data = mysqli_fetch_assoc($sql1);

    $file_path = $data["file_url"];
    $key = $data["password"];
    $file_name = $data["file_name_source"];
    $size = $data["file_size"];

    $file_size = filesize($file_path);

    $query2 = "UPDATE file SET status='2' WHERE id_file='$idfile'";
    $sql2 = mysqli_query($connect, $query2);

    $mod = $file_size % 16;

    $pad = new Paddkey();
    $padkey = $pad->adjustKeyLength($key, 128);
    $aes = new Aes($padkey);

    $fopen1 = fopen($file_path, "rb");
    $cache = "hasil_dekripsi/$file_name";
    $fopen2 = fopen($cache, "wb");

    if ($mod == 0) {
        $banyak = $file_size / 16;
    } else {
        $banyak = ($file_size - $mod) / 16;
        $banyak = $banyak + 1;
    }

    $filedata = fread($fopen1, $file_size);
    $base = base64_decode($filedata);
    $plain = $aes->decrypt($base);
    fwrite($fopen2, $plain);

    fclose($fopen1);
    fclose($fopen2);

    $_SESSION["download"] = $cache;

    echo ("<script language='javascript'>
       window.open('download.php', '_blank');
       window.location.href='dekripsi.php';
       window.alert('Berhasil mendekripsi file.');
       </script>");
} else {
    echo ("<script language='javascript'>
    window.location.href='decrypt-file.php?id_file=$idfile';
    window.alert('Maaf, Password tidak sesuai.');
    </script>");
}
