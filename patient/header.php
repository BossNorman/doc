<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>I.D.R.A.S.</title>

    <!-- Custom styles for this page -->
    <link href="../vendor/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="../vendor/parsley/parsley.css" />

    <link rel="stylesheet" type="text/css" href="../vendor/datepicker/bootstrap-datepicker.css" />

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
    html {
        scroll-behavior: smooth;
    }
    </style>
</head>

<body>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
            <div class="container px-1">
                <a class="navbar-brand" href="#">
                    <img src="../images/logo.png" alt='Logo' style="width: 40px; padding-right: 10px;">
                    I.D.R.A.S.
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <!-- Navbar for Login or Not-Login User -->
                        <?php
                        if (!isset($_SESSION['patient_id'])) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#Symptoms">Symptoms Checker</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#Book">Book Appointment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <?php
                        } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php#Symptoms">Symptoms Checker</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php#Book">Book Appointment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointment.php">Appointment History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    <div style="margin-top:55px">