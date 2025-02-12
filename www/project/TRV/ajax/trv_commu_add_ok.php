<?
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
session_start();
if($_REQUEST['ansType'] == "ansAdd"){
    $que = "insert into TcommuniAnswerTbl set
            joinSeq = '".$_SESSION['loginNum']."',
            conSeq = '".$_REQUEST['conSeq']."',
            conType = '".$_REQUEST['conType']."',
            answerDateTime = '".date('Y-m-d H:i:s')."',
            answerContents = '".$_REQUEST['answerContents']."',
            answerIp = '".$_SERVER['REMOTE_ADDR']."',
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