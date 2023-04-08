<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'kripto';
$connect = mysqli_connect($host, $user, $pass) or die(mysqli_error($connect));
$dbselect = mysqli_select_db($connect, $dbname);