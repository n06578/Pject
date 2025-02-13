<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $ip = strtok($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

if($_REQUEST['ansType'] == "ansAdd"){
    $que = "insert into TcommuniAnswerTbl set
            joinSeq = '".$_SESSION['loginNum']."',
            conSeq = '".$_REQUEST['conSeq']."',
            conType = '".$_REQUEST['conType']."',
            answerDateTime = '".date('Y-m-d H:i:s')."',
            answerContents = '".$_REQUEST['answerContents']."',
            answerIp = '".$ip."',
            likeCnt='0',
            hateCnt='0',
            declareCnt='0'
        ";
    mysql_query($que);
}
else if($_REQUEST['ansType'] == "ansDel"){
    echo "insert";
    $que = "delete from TlikeHateTbl where conSeq = '".$_REQUEST['conSeq']."' and conType = '".$_REQUEST['conType']."'";
    mysql_query($que);

    $que = "delete from TcommuniAnswerTbl where seq = '".$_REQUEST['conSeq']."'";
    mysql_query($que);

}else{
    if($_REQUEST['ansType'] == "ansLike"){ $likeHate='like'; }
    else { $likeHate='hate'; }

    $que = "select * from TlikeHateTbl where joinSeq ='".$_SESSION['loginNum']."' and conSeq = '".$_REQUEST['conSeq']."' and conType = '".$_REQUEST['conType']."' and likeHate='".$likeHate."'";
    $res = mysql_query($que);
    $cnt = mysql_num_rows($res);
    if($cnt > 0){
        $row = mysql_fetch_array($res);
        $que = "delete from TlikeHateTbl where seq = '".$row['seq']."'";
    }else{
        $que ="insert into TlikeHateTbl set joinSeq ='".$_SESSION['loginNum']."', conSeq = '".$_REQUEST['conSeq']."',conType = '".$_REQUEST['conType']."',likeHate='".$likeHate."',clickDateTime='".date("Y-m-d H:i:s")."'
                ON DUPLICATE KEY UPDATE likeHate = '".$likeHate."',clickDateTime='".date("Y-m-d H:i:s")."'";
    }
    mysql_query($que);
    
}