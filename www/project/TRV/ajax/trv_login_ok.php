<?
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
session_start();

if($_REQUEST['id'] == "n06578" && $_REQUEST['pw'] == "1234"){
    $_SESSION['loginYn'] = "Y";
    $_SESSION['loginNum'] = "0";
    echo "manager";
}else{
    $que = "select * from TjoinTbl where userId = '".$_REQUEST['id']."' and userPassWord = '".$_REQUEST['pw']."'";
    $res = mysql_query($que);
    $cnt = mysql_num_rows($res);
    if($cnt > 0 ){
        $row = mysql_fetch_array($res);
        $_SESSION['loginYn'] = "Y";
        $_SESSION['loginNum'] = $row['seq'];
        echo "success";
    }else{
        echo "fail";
    }
}
?>