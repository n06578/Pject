<?php
session_start();
date_default_timezone_set('Asia/Seoul');
$baseName = explode(".php",basename($_SERVER["PHP_SELF"]));
$_SESSION['left_menu_active'] = $baseName[0];

$documentRoot = preg_replace("`\/[^/]*\.php$`i", "", $_SERVER['PHP_SELF']);
$documentPath = explode("/",$documentRoot);
$rootPath = "../";
$rootPath =  str_repeat($rootPath,count($documentPath)-1);

//footer box 기본값 x
$showFooter = false;

if(($baseName[0] == "myCal" || $baseName[0] == "myHome") && !isset($_SESSION['loginYn']) ) {
    echo "<script>alert('로그인 후 이용해주세요.');location.href='login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google" content="notranslate">

    <!-- Page level plugins -->
    <script src="<?=$rootPath?>vendor/chart.js/Chart.min.js"></script>
    <script src="<?=$rootPath?>vendor/jquery/jquery.min.js"></script>
    <script src="<?=$rootPath?>js/jquery-1.11.1.min.js"></script>
    <script src="<?=$rootPath?>js/jquery.form.js"></script>
    <title>PjectY</title>

    <!-- Custom fonts for this template-->
    <link href="<?=$rootPath?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?=$rootPath?>css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="<?=$rootPath?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?=$rootPath?>css/mobiscroll.jquery.min.css" rel="stylesheet" />
    <link href="<?=$rootPath?>css/font.css?v=<?=time()?>" rel="stylesheet" />
    <link href="<?=$rootPath?>css/trv.css?v=<?=time()?>" rel="stylesheet" />
    <script src="<?=$rootPath?>js/mobiscroll.jquery.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">