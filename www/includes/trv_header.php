<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
session_start();
date_default_timezone_set('Asia/Seoul');
$baseName = explode(".php",basename($_SERVER["PHP_SELF"]));
$_SESSION['left_menu_active'] = $baseName[0];

$documentRoot = preg_replace("`\/[^/]*\.php$`i", "", $_SERVER['PHP_SELF']);
$documentPath = explode("/",$documentRoot);
$rootPath = "../";
$rootPath =  str_repeat($rootPath,count($documentPath)-1);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google" content="notranslate">
    <?include "linkScript.php"; // link, script 관련 경로 ?>
    <title>PjectY</title>
</head>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        PNotify.defaults.styling = 'brighttheme';
        PNotify.defaults.icons = 'brighttheme';
    });
</script>
<? 
include $rootPath."lib/PNotify.php"; // PNotiry관련 함수 

//footer box 기본값 x
$showFooter = false;
if(!isset($_SESSION['loginYn'])){
    $_SESSION['loginNum'] = '-';
    $_SESSION['loginYn'] = "N";
}else{
    if($_SESSION['loginNum'] != 0){
        $que_info = "select * from TjoinTbl where seq = '".$_SESSION['loginNum']."'";
        $res_info = mysql_query($que_info);
        $row_info = mysql_fetch_array($res_info);
    }
}
if(!isset($_REQUEST['seq'])){$_REQUEST['seq'] = "";}
if( ($baseName[0] == "myCal" || $baseName[0] == "myHome") && $_SESSION['loginYn'] != "Y" ){ 
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loginChkLoca();
        });
    </script>
<?
    exit;
}
?>
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
            <?if($baseName[0] == "trvmain2") {?>
                <div id="roadingImg"></div>
            <?}?>
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top trvMainTop d-none">
                    <!-- Topbar Search -->
                    <div class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div id="trvLogoImg" class="c-pointer" onclick="location.href='trvmain2.php'"></div>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="btn btn-white">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
<? include "trv_leftmenu.php";?>
