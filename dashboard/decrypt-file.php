<?php
session_start();
include('../config.php');
if(empty($_SESSION['username'])){
header("location:../index.php");
}
$last = $_SESSION['username'];
$sqlupdate = "UPDATE users SET last_activity=now() WHERE username='$last'";
$queryupdate = mysqli_query($connect,$sqlupdate);
?>
<!DOCTYPE html>
<html>
<?php
$user = $_SESSION['username'];
$query = mysqli_query($connect,"SELECT fullname,job_title,last_activ FROM users WHERE username='$user'");
$data = mysqli_fetch_array($query);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<style>
* {
    padding: 0;
    margin: 0;
    list-style: none;
    text-decoration: none;
    box-sizing: border-box;
}
</style>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>File Enkripsi & Deskripsi AES</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="header-advance-area bg-info">
    <div class="header-top-area">
        <div class="container-fluid">
            <div class="row">
                <div class="">
                    <div class="header-top-wraper">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <ul class="metismenu my-4 d-flex align-items-center" id="menu1">
                                <li class="active">
                                    <a class="nav-link" href="index.php">
                                        <span class="mini-click-non fs-2 mx-4 text white">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="enkripsi.php" aria-expanded="false"><i
                                            class="icon nalika-unlocked icon-wrap"></i> <span
                                            class="mini-click-non fs-2 mx-4 text white">Enkripsi</span></a>
                                </li>
                                <li>
                                    <a class="nav-link" href="dekripsi.php" aria-expanded="false"><i
                                            class="icon nalika-unlocked icon-wrap"></i> <span
                                            class="mini-click-non fs-2 mx-4 text white">Deskripsi</span></a>
                                </li>
                            </ul>
                            <div class="">
                                <a href="logout.php"> Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
</div>
</div>
<section class="breadcome-list">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php
                            $id_file = $_GET['id_file'];
                            $query = mysqli_query($connect,"SELECT * FROM file WHERE id_file='$id_file'");
                            $data2 = mysqli_fetch_array($query);
                            ?>

                    <form class="form-horizontal" method="post" action="deskrip-proses.php">
                        <div class="table-responsive">
                            <table class="table striped" style="color:#fff;">
                                <tr>
                                    <td>Nama File Sumber</td>
                                    <td>:</td>
                                    <td><?php echo $data2['file_name_source']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama File Enkripsi</td>
                                    <td>:</td>
                                    <td><?php echo $data2['file_name_finish']; ?></td>
                                </tr>
                                <tr>
                                    <td>Ukuran File</td>
                                    <td>:</td>
                                    <td><?php echo $data2['file_size']; ?> KB</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Enkripsi</td>
                                    <td>:</td>
                                    <td><?php echo $data2['tgl_upload']; ?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td><?php echo $data2['keterangan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Masukkan Password Untuk Mendekrip</td>
                                    <td></td>
                                    <td>
                                        <div class="col-md-6">
                                            <input type="hidden" name="fileid" value="<?php echo $data2['id_file'];?>">
                                            <input class="form-control" id="inputPassword" type="password"
                                                placeholder="Password" name="pwdfile" required><br>
                                            <input type="submit" name="decrypt_now" value="Dekripsi File"
                                                class="form-control btn btn-primary">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</html>