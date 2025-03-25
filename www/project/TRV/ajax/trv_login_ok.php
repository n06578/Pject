<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

if($_REQUEST['id'] == "n06578" && $_REQUEST['pw'] == "1234"){
    $_SESSION['loginYn'] = "Y";
    $_SESSION['loginNum'] = "0";
    echo "manager";
}else{
    $where = " and userPassWord = '".$_REQUEST['pw']."'";
    if($_REQUEST['type'] == "kakao"){
        $where = " and seq = '".$_REQUEST['pw']."'";
        $que = "select * from TjoinTbl where userId = '".$_REQUEST['id']."'";
    }
    $que = "select * from TjoinTbl where userId = '".$_REQUEST['id']."'";
    $res = mysql_query($que);
    $cnt = mysql_num_rows($res);
    if($cnt > 0 ){
        $que_mail = "select * from TjoinTbl where userId = '".$_REQUEST['id']."' $where and joinAgreeChk = 1";
        $res_mail = mysql_query($que_mail);
        $cnt_mail = mysql_num_rows($res_mail);
        if($cnt_mail > 0){
            $row = mysql_fetch_array($res);
            $_SESSION['loginYn'] = "Y";
            $_SESSION['loginNum'] = $row['seq'];
            $_SESSION['loginName'] = $row['nickName'];
            echo "success";
        }else{
            echo "fail_1";
        }
    }else{
        echo "fail_2";
    }
}
?>