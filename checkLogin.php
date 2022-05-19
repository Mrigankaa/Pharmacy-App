<?php
session_start();
include "connect.php";
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
 header('location:index.php');
 exit();
}
