<?php
session_start();
include('../config.php');
if (empty($_SESSION['username'])) {
    header("location:../login.php");
}
$last = $_SESSION['username'];
$sqlupdate = "UPDATE users SET last_activ=now() WHERE username='$last'";
$queryupdate = mysqli_query($connect, $sqlupdate);
?>
<!DOCTYPE html>
<html>
<?php
$user = $_SESSION['username'];
$query = mysqli_query($connect, "SELECT fullname,job_title,last_activ FROM users WHERE username='$user'");
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

    <section class="breadcome-list">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="table-responsive" style="color:#fff;">
                            <table id="file" class="table striped">
                                <thead>
                                    <tr>
                                        <td width="5%"><strong>No</strong></td>
                                        <td width="20%"><strong>Nama File Sumber</strong></td>
                                        <td width="20%"><strong>Nama File Enkripsi</strong></td>
                                        <td width="20%"><strong>Path File</strong></td>
                                        <td width="15%"><strong>Status File</strong></td>
                                        <td width="10%"><strong>Aksi</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $query = mysqli_query($connect, "SELECT * FROM file");
                                    while ($data = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data['file_name_source']; ?></td>
                                        <td><?php echo $data['file_name_finish']; ?></td>
                                        <td><?php echo $data['file_url']; ?></td>
                                        <td><?php if ($data['status'] == 1) {
                                                    echo "Enkripsi";
                                                } elseif ($data['status'] == 2) {
                                                    echo "Dekripsi";
                                                } else {
                                                    echo "Status Tidak Diketahui";
                                                }
                                                ?></td>
                                        <td>
                                            <?php
                                                $a = $data['id_file'];
                                                if ($data['status'] == 1) {
                                                    echo '<a href="decrypt-file.php?id_file=' . $a . '" class="btn btn-primary">Dekripsi File</a>';
                                                } elseif ($data['status'] == 2) {
                                                    echo '<a href="enkripsi.php" class="btn btn-success">Enkripsi File</a>';
                                                } else {
                                                    echo '<a href="dekripsi.php" class="btn btn-danger">Data Tidak Diketahui</a>';
                                                }
                                                ?>

                                        </td>
                                    </tr>
                                    <?php
                                        $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>