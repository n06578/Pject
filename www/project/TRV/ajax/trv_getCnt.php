<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
if($_REQUEST['Type'] == "gongji"){
    $mainType="postGongji";
}else{
    $mainType="postCommu";
}
switch($_REQUEST['conType']){
    case "LikeCnt" :
        echo getAnsCnt($_REQUEST['conSeq'],$mainType,"like");
        break;
    case "HateCnt" :
        echo getAnsCnt($_REQUEST['conSeq'],$mainType,"hate");
        break;
    case "ansLikeCnt" :
        echo getAnsCnt($_REQUEST['subSeq'],$_REQUEST['Type'],"like");
        break;
    case "ansHateCnt" :
        echo getAnsCnt($_REQUEST['subSeq'],$_REQUEST['Type'],"hate");
        break;
	default:
		echo "error";
	break;
}