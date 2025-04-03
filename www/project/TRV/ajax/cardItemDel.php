<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

switch($_REQUEST['pageType']){
    case "recent": 
    case "heart":
        $que = "select * from TanotherTbl where joinSeq='".$_SESSION['loginNum']."' and type='".$_REQUEST['pageType']."' and conSeq in (".implode(",",$_REQUEST['chkData']).")";
        $que_back = "insert into TanotherDelTbl $que";
        $que_del = "delete from TanotherTbl where joinSeq='".$_SESSION['loginNum']."' and type='".$_REQUEST['pageType']."' and conSeq in (".implode(",",$_REQUEST['chkData']).")";
        break;
    case "cal":
        if($_REQUEST['calSeq'] !=""){
            $appendQue = " and calanSeq='".$_REQUEST['calSeq']."'";
        }
        $que = "select * from TcalanItemTbl where joinSeq='".$_SESSION['loginNum']."' and itemSeq in (".implode(",",$_REQUEST['chkData']).") $appendQue";
        $que_back = "insert into TcalanItemDelTbl $que";
        $que_del = "delete from TcalanItemTbl where joinSeq='".$_SESSION['loginNum']."' and itemSeq in (".implode(",",$_REQUEST['chkData']).") $appendQue";
    break;
    default: $que="";break;
}
if($que == ""){
    echo "error";
}else{
    mysql_query($que_back);
    mysql_query($que_del);
}