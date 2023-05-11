<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbname = 'kripto';
$connect = mysqli_connect($host, $user, $pass) or die(mysqli_error($connect));
$dbselect = mysqli_select_db($connect, $dbname);