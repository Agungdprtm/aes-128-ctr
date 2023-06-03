<?php
session_start();
include('../config.php');
if (empty($_SESSION['username'])) {
    header("location:../index.php");
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

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>File Enkripsi & Dekripsi AES</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-1000
      p-2 w-[300px] overflow-y-auto text-center bg-gray-900 shadow h-screen">
        <div class="text-gray-100 text-xl">
            <div class="p-2.5 mt-1 flex items-center rounded-md ">
                <img src="img/logo-puslitbang.svg" alt="" class="h-10 w-10" /></i>
                <h1 class="text-[15px]  ml-3 text-xl text-gray-200 font-bold">Puslitbang Polri</h1>
            </div>
            <hr class="my-2 text-gray-600">

            <div>
                <div
                    class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-600">
                    <a class="nav-link" href="index.php">
                        <span class="text-[15px] ml-4 text-gray-200">Dashboard</span>
                    </a>
                </div>
                <div
                    class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-600">
                    <a class="nav-link" href="enkripsi.php">
                        <span class="text-[15px] ml-4 text-gray-200">Enkripsi</span>
                    </a>
                </div>
                <div
                    class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-600">
                    <a class="nav-link" href="dekripsi.php">
                        <span class="text-[15px] ml-4 text-gray-200">Dekripsi</span>
                    </a>
                </div>
                <div
                    class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-600">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <a class="nav-link" href="logout.php">
                        <span class="text-[15px] ml-4 text-gray-200">Log Out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="breadcome-list ml-[320px] p-10">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        $id_file = $_GET['id_file'];
                        $query = mysqli_query($connect, "SELECT * FROM file WHERE id_file='$id_file'");
                        $data2 = mysqli_fetch_array($query);
                        ?>
                        <h3 align="center" style="color:#000000;">Dekripsi File <i style="color:red">
                                <?php echo $data2['file_name_finish'] ?>
                            </i></h3><br>
                        <form class="form-horizontal" method="post" action="decrypt-process.php">
                            <div class="table-responsive">
                                <table class="table striped" style="color:#000000;">
                                    <tr>
                                        <td>Nama File Sumber</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $data2['file_name_source']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama File Enkripsi</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $data2['file_name_finish']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran File</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $data2['file_size']; ?> KB
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Enkripsi</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $data2['tgl_upload']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>
                                            <?php echo $data2['keterangan']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Masukkan Password Untuk Mendekrip</td>
                                        <td></td>
                                        <td>
                                            <div class="col-md-6">
                                                <input type="hidden" name="fileid"
                                                    value="<?php echo $data2['id_file']; ?>">
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
</body>

</html>