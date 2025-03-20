<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT'] . '/project/TRV/api/mail_proc.php';  // mail 전송 필수 페이지 include

$que = "select * from TjoinTbl where userName ='".$_REQUEST['userName']."' and userId = '".$_REQUEST['userEmail']."'";
$res = mysql_query($que);
$cnt = mysql_num_rows($res);
$row = mysql_fetch_array($res);
if($cnt > 0 ){
    $que = "update TjoinTbl set userPassWord='990903userPassWordChangeChk' where seq = '".$row['seq']."'";
    mailSend("비밀번호 찾기",$_REQUEST['userName'],$_REQUEST['userName']."님 비밀번호를 찾기 원하신다면<br> 버튼을 눌러 비밀번호 변경을 시도해주세요.",$_REQUEST['userEmail'],"passFindChk" ,"&seq=".$row['seq']);
}else{
    echo "error1";
}
