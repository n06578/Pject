<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

if($_REQUEST['seq'] == ""){
    $que = "insert into TselfInfoTbl set
            joinSeq = '".$_SESSION['loginNum']."',
            keyword = '',
            userAge = '0',
            selfPresent = '".$_REQUEST['selfPresent']."',
            inTrvCnt = '".$_REQUEST['inTrvCnt']."',
            outTrvCnt = '".$_REQUEST['outTrvCnt']."',
            blackListYn = '0'
    ";
}else{
    $que = "update TselfInfoTbl set keyword = '',
                userAge = '0',
                selfPresent = '".$_REQUEST['selfPresent']."',
                inTrvCnt = '".$_REQUEST['inTrvCnt']."',
                outTrvCnt = '".$_REQUEST['outTrvCnt']."',
                blackListYn = '0'
            where seq = '".$_REQUEST['seq']."'";

}
echo $que;
mysql_query($que);

$que_join = "update TjoinTbl set nickName = '".$_REQUEST['nickName']."' where seq = '".$_SESSION['loginNum']."'";
mysql_query($que_join);