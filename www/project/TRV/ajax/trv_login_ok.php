<?
session_start();

if($_REQUEST['id'] == "n06578" && $_REQUEST['pw'] == "1234"){
    $_SESSION['loginYn'] = "Y";
    echo "success";
}else{
    echo "fail";
}
?>