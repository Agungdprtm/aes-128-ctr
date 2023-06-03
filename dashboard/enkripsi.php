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
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-600">
          <a class="nav-link" href="index.php">
            <span class="text-[15px] ml-4 text-gray-200">Dashboard</span>
          </a>
        </div>
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-600">
          <a class="nav-link" href="enkripsi.php">
            <span class="text-[15px] ml-4 text-gray-200">Enkripsi</span>
          </a>
        </div>
        <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-600">
          <a class="nav-link" href="dekripsi.php">
            <span class="text-[15px] ml-4 text-gray-200">Dekripsi</span>
          </a>
        </div>
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-600">
          <i class="bi bi-box-arrow-in-right"></i>
          <a class="nav-link" href="logout.php">
            <span class="text-[15px] ml-4 text-gray-200">Log Out</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <section class="breadcome-list ml-[320px] p-10">
    <div class="card">
      <div class="card-body">
        <form class="form-horizontal" method="post" action="encrypt-process.php" enctype="multipart/form-data">
          <fieldset>
            <legend class="text-white">Form Enkripsi</legend>
            <div class="mb-3">
              <label for="inputFile" class="text-white">File</label>
              <input class="form-control" id="inputFile" placeholder="Input File" type="file" name="file" required>
            </div>
            <div class="mb-3">
              <label for="inputPassword" class="text-white">Key</label>
              <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="pwdfile"
                required>
            </div>
            <div class="mb-3">
              <label for="textArea" class="text-white">Deskripsi</label>
              <textarea class="form-control" id="textArea" rows="3" name="desc" placeholder="Deskripsi"></textarea>
            </div>
            <div class="mb-3">
              <div class="col-lg-2">
                <input type="submit" name="encrypt_now" value="Enkripsi File" class="form-control btn btn-info">
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </section>
</body>


</html>