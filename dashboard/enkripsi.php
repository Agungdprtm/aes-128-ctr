<?php
session_start();
include('../config.php');
if (empty($_SESSION['username'])) {
    header("location:../Login.php");
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

    <body>
        <section class="breadcome-list">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="encrypt-proses.php"
                                enctype="multipart/form-data">
                                <fieldset>
                                    <legend style="color:#000000;">Form Enkripsi</legend>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" style="color:#000000;"
                                            for="inputFile">File</label>
                                        <div class="col-lg-4">
                                            <input class="form-control" id="inputFile" placeholder="Input File"
                                                type="file" name="file" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" style="color:#000000;"
                                            for="inputPassword">Key</label>
                                        <div class="col-lg-4">
                                            <input class="form-control" id="inputPassword" type="password"
                                                placeholder="Password" name="pwdfile" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" style="color:#000000;"
                                            for="textArea">Deskripsi</label>
                                        <div class="col-lg-4">
                                            <textarea class="form-control" id="textArea" rows="3" name="desc"
                                                placeholder="Deskripsi"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="textArea"></label>
                                        <div class="col-lg-2">
                                            <input type="submit" name="encrypt_now" value="Enkripsi File"
                                                class="form-control btn btn-info">
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>

</body>

</html>