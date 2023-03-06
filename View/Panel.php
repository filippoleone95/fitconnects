<!DOCTYPE html>
<html lang="it">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>FitConnects - <?= $base ?></title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="<?= $Assets->getURL() ?>/assets/favicon.ico" />
  <!-- Bootstrap Icons-->
  <link href="<?= $Vendor->getURL() ?>/twbs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
  <link href="<?= $Lib->getURL() . "\css\styles.css" ?>" rel="stylesheet" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../Lib/dash/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../Lib/dash/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/f3b5704387.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  
  <!-- CSS Files -->
  <link id="pagestyle" href="../Lib/dash/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
  <link id="pagestyle" href="../Lib/css/custom.css" rel="stylesheet" />

</head>

<body class="g-sidenav-show  bg-gray-200 <?php if(isset($_COOKIE["dark"])){ echo $_COOKIE["dark"]; } ?>" id="body">
  <?php if($base != "Allenamento" && $base != "Login" && $base != "PreSignup" && $base != "Signup" && $base != "Administrator" && $base != "SignupAllenatore" && $base != "Complete" && $base != "Home" && $base != "EmailVerify")
   include $View->getURL() . "/Sidenav.php" ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg " id = "main" >
    <?php 
    if($base != "Login" && $base != "Signup" && $base != "PreSignup" && $base != "Administrator" && $base != "SignupAllenatore" && $base != "Complete" && $base != "Home" && $base != "EmailVerify")
    include $View->getURL() . "/Navbar.php" ?>
    <!-- End Navbar -->