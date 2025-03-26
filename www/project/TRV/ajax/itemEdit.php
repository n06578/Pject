<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

$ip = '수정필요';
$type = $_REQUEST['type'];
if($type == "ansAdd"){
    $que = "insert into TitemAnswerTbl set
                joinSeq = '".$_SESSION['loginNum']."',
                conSeq = '".$_REQUEST['conSeq']."',
                answerDateTime = '".date('Y-m-d H:i:s')."',
                answerContents = '".$_REQUEST['answerContents']."',
                answerIp = '".$ip."',
                declareCnt='0'
            ";
    mysql_query($que);
}
else if($type == "itemDel"){
    $que = "delete from TitemAnswerTbl where conSeq = '".$_REQUEST['conSeq']."'";
    mysql_query($que);
    $que = "delete from TuserItem where seq = '".$_REQUEST['conSeq']."'";
    mysql_query($que);
    $que = "delete from TuserItemList where itemSeq = '".$_REQUEST['conSeq']."'";
    mysql_query($que);
    $que = "delete from TuserItemFile where itemSeq = '".$_REQUEST['conSeq']."'";
    mysql_query($que);
}
else if($type == "likeHate"){
    
    $likeHate = $_REQUEST['ansType'];

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
}else if($type == "ansDel"){
    
    $que = "delete from TlikeHateTbl where conSeq = '".$_REQUEST['conSeq']."' and conType = '".$_REQUEST['conType']."'";
    mysql_query($que);

    $que = "delete from TitemAnswerTbl where seq = '".$_REQUEST['conSeq']."'";
    mysql_query($que);
}
else if($type == "heart"){
    $que_chk = "select * from TanotherTbl where joinSeq ='".$_SESSION['loginNum']."' and conSeq = '".$_REQUEST['conSeq']."' and type='heart'";
    $res_chk = mysql_query($que_chk);
    $cnt_chk = mysql_num_rows($res_chk);
    if($cnt_chk > 0 ){
        $que_heart = "delete from TanotherTbl where joinSeq ='".$_SESSION['loginNum']."' and conSeq = '".$_REQUEST['conSeq']."' and type='heart'";
        echo "del";
    }else{
        $que_heart ="insert into TanotherTbl set joinSeq ='".$_SESSION['loginNum']."', conSeq = '".$_REQUEST['conSeq']."',type = 'heart',addDateTime='".date("Y-m-d H:i:s")."'";
        echo "add";
    }
    mysql_query($que_heart);
}
else if($type == "calander"){
    $que_del = "delete from TcalanItemTbl where joinSeq ='".$_SESSION['loginNum']."' and itemSeq = '".$_REQUEST['conSeq']."' and calanSeq not in (".implode(",",$_REQUEST['calSeq']).")";
    mysql_query($que_del);
    foreach ($_REQUEST['calSeq'] as $calSeq) {
        $que ="insert into TcalanItemTbl set joinSeq ='".$_SESSION['loginNum']."', calanSeq = '".$calSeq."',	itemSeq = '".$_REQUEST['conSeq']."',addDateTime	='".date("Y-m-d H:i:s")."'
                    ON DUPLICATE KEY UPDATE joinSeq = '".$_SESSION['loginNum']."'";
        mysql_query($que);
    }
}