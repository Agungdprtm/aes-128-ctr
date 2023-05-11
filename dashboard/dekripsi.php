<?php
session_start();
include('../config.php');
if (empty($_SESSION['username'])) {
  header("location:../index.php");
}
$last = $_SESSION['username'];
$sqlupdate = "UPDATE users SET last_activity=now() WHERE username='$last'";
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
  <div class="left-sidebar-pro">
    <nav id="sidebar" class="">
      <div class="sidebar-header">
      </div>
      <div class="nalika-profile">
        <div class="profile-dtl">
          <a href="#"><img src="https://lh3.googleusercontent.com/ogw/ADGmqu-5A4r40ZPotQWqRs5qBqjF1pxruJuJs5TURuzdZw=s83-c-mo" alt="" /></a>
          <h2><?php echo $data['fullname']; ?><p class="designation icon" style="color:green;"><?php echo $data['job_title']; ?></p>
          </h2>
        </div>
        <div class="profile-social-dtl">
          <ul class="dtl-social">
            <li><a href="#"><i class="icon nalika-facebook"></i></a></li>
            <li><a href="#"><i class="icon nalika-twitter"></i></a></li>
            <li><a href="#"><i class="icon nalika-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="left-custom-menu-adp-wrap comment-scrollbar">
        <nav class="sidebar-nav left-sidebar-menu-pro">
          <ul class="metismenu" id="menu1">
            <li class="active">
              <a class="nav-link" href="index.php">
                <i class="icon nalika-home icon-wrap"></i>
                <span class="mini-click-non">Dashboard</span>
              </a>
            </li>
            <li>
              <a class="nav-link" href="enkripsi.php" aria-expanded="false"><i class="icon nalika-unlocked icon-wrap"></i> <span class="mini-click-non">Enkripsi</span></a>
            </li>
            <li>
              <a class="nav-link" href="dekripsi.php" aria-expanded="false"><i class="icon nalika-unlocked icon-wrap"></i> <span class="mini-click-non">Dekripsi</span></a>
            </li>
          </ul>
        </nav>
      </div>
    </nav>
  </div>
  <!-- Start Welcome area -->
  <div class="all-content-wrapper">
    <div class="header-advance-area">
      <div class="header-top-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="header-top-wraper">
                <div class="row">
                  <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                    <div class="menu-switcher-pro">
                      <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                        <i class="icon nalika-menu-task"></i>
                      </button>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                    <div class="header-top-menu tabl-d-n hd-search-rp">
                      <div class="breadcome-heading">
                        <form role="search" class="">
                          <input type="text" placeholder="Search..." class="form-control">
                          <a href=""><i class="fa fa-search"></i></a>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="header-right-info">
                      <ul class="nav navbar-nav mai-top-nav header-right-menu">
                        <li class="nav-item">
                          <a href="logout.php"> Log Out</a>
                        </li>
                      </ul>
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
</body>

</html>