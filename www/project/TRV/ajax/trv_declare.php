<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT'] . '/project/TRV/api/mail_proc.php';  // mail 전송 필수 페이지 include

// var_dump($_REQUEST);
$que = "select * from TdeclareTbl where joinSeq = '".$_SESSION['loginNum']."' and conSeq = '".$_REQUEST['conSeq']."' and Type = '".$_REQUEST['Type']."' and conType = '".$_REQUEST['conType']."'";
$res = mysql_query($que);
$cnt = mysql_num_rows($res);
if($cnt < 1){
    $que = "insert into TdeclareTbl set
                joinSeq = '".$_SESSION['loginNum']."',
                conSeq = '".$_REQUEST['conSeq']."',
                Type = '".$_REQUEST['Type']."',
                conType = '".$_REQUEST['conType']."',
                declareType='',
                declareReason = '".$_REQUEST['declareReason']."',
                clickDateTime = '".date("Y-m-d H:i:s")."'";
            
    mysql_query($que);

    $que_send = "select * from TjoinTbl where seq = '".$_SESSION['loginNum']."'";
    $res_send = mysql_query($que_send);
    $row_send = mysql_fetch_array($res_send);
    if($_REQUEST['conType']=="postDeclare"){
        mailSend("신고가 접수되었습니다.","관리자",$row_send['userName']."님이 해당 게시물을 신고하였습니다.<br>버튼을 눌러 게시물을 확인해주세요.","n06578@gmail.com","declare,".$_REQUEST['Type'].",".$_REQUEST['conType']  ,"&seq=".$_REQUEST['conSeq']);
    }else{
        // ATagNoSend("신고가 접수되었습니다.","관리자",$row_send['userName']."님이 해당 게시물을 신고하였습니다.<br>","n06578@gmail.com",$_REQUEST['mType']."|".$_REQUEST['mConType']  ,"&seq=".$_REQUEST['conSeq']);
    }

}else{
    $row = mysql_fetch_array($res);
    echo $row['clickDateTime'];
}