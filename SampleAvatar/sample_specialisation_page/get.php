<?php
$selectedId = $_GET['specId'];
session_start();
$_SESSION['specs']=$selectedId;
// echo "<script type='text/javascript'>alert('$sym');</script>";

header("location:../../patient/index.php");
?>