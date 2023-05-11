<?php
session_start();
include "../config.php";   //memasukan koneksi
include "aes.class.php";
include "aesctr.class.php"; //memasukan file AES

$idfile    = mysqli_escape_string($connect, $_POST['fileid']);
$pwdfile   = mysqli_escape_string($connect, substr(md5($_POST["pwdfile"]), 0, 16));
$query     = "SELECT password FROM file WHERE id_file='$idfile' AND password='$pwdfile'";
$sql       = mysqli_query($connect, $query);
if (mysqli_num_rows($sql) > 0) {
    $query1     = "SELECT * FROM file WHERE id_file='$idfile'";
    $sql1       = mysqli_query($connect, $query1);
    $data       = mysqli_fetch_assoc($sql1);

    $file_path  = $data["file_url"];
    $key        = $data["password"];
    $file_name  = $data["file_name_source"];
    $size       = $data["file_size"];

    $file_size  = filesize($file_path);

    $query2     = "UPDATE file SET status='2' WHERE id_file='$idfile'";
    $sql2       = mysqli_query($connect, $query2);

    $mod        = $file_size % 16;

    $aes        = new AesCtr();
    $fopen1     = fopen($file_path, "rb");

    $cache      = "hasil_dekripsi/$file_name";
    $fopen2     = fopen($cache, "wb");

   

    while(!feof($fopen1)) {
        $filedata    = fread($fopen1, 8192);
        $plain       = $aes->decrypt($filedata, $key, 128);
        fwrite($fopen2, $plain);
    }
    
    
    $_SESSION["download"] = $cache;

    echo ("<script language='javascript'>
       window.open('download.php', '_blank');
       window.location.href='dekripsi.php';
       window.alert('Berhasil mendekripsi file.');
       </script>
       ");
} else {
    echo ("<script language='javascript'>
    window.location.href='decrypt-file.php?id_file=$idfile';
    window.alert('Maaf, Password tidak sesuai.');
    </script>");
}