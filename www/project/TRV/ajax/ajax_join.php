<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include($document_root . '/project/TRV/api/mail_proc.php');  // mail 전송 필수 페이지 include

date_default_timezone_set("Asia/Seoul");

$que = "SELECT * FROM TjoinTbl where nickName = '".$_REQUEST['nickName']."'";
$res = mysql_query($que);
$cnt = mysql_num_rows($res);

if($cnt > 0){
    echo "joinFail";
}else{
    $que = "insert into TjoinTbl set
        userId = '".$_REQUEST['eMail']."',
        userName = '".$_REQUEST['userName']."',
        nickName = '".$_REQUEST['nickName']."',
        joinType = '직접입력',
        userPassWord = '".$_REQUEST['loginPW']."',
        userPhone = '".str_replace("-","",$_REQUEST['phoneNum'])."',
        userCountry = '".$_REQUEST['country']."',
        joinDateTime = '".date("Y-m-d H:i:s")."'
    ";
    mysql_query($que);

    mailSend("메일 인증",$_REQUEST['userName'],"버튼을 눌러 메일 인증을 완료해주세요",$_REQUEST['eMail'],"subUser");

    echo "joinDone";
}

