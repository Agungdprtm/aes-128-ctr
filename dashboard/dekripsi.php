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


    <section class="breadcome-list ">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" style="color:#000000;">
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
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['file_name_source']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['file_name_finish']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['file_url']; ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ($data['status'] == 1) {
                                                    echo "Enkripsi";
                                                } elseif ($data['status'] == 2) {
                                                    echo "Dekripsi";
                                                } else {
                                                    echo "Status Tidak Diketahui";
                                                }
                                                ?>
                                        </td>
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
</body>