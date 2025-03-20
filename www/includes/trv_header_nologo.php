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
//로그인 여부 체크
$login="no";
if($_SESSION['loginNum'] != 0 && $_SESSION['loginYn'] == "Y"){
    $login="yes";
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
    <?include "linkScript.php";?>
    <title>PjectY</title>

</head>
<?include $rootPath."lib/PNotify.php"; // PNotiry관련 함수 ?>
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">