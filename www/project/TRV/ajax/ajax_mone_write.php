<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

// if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     $ip = strtok($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
// } else {
//     $ip = $_SERVER['REMOTE_ADDR'];
// }
$ip = '수정필요';
switch($_REQUEST['writeMode']){
	case "mone" :
		if($_REQUEST['moneMode']==""){
			$que = "insert into TmoneTbl set
					joinSeq = '".$_SESSION['loginNum']."',
					writeDateTime = '".date("Y-m-d H:i:s")."',
					writeContents = '".$_REQUEST['moneContents']."',
					writePassWord = '".$_REQUEST['monePW']."',
					writeTitle = '".$_REQUEST['moneTitle']."',
					writeIp = '".$ip."',
					declareCnt = '0'";
			
			mysql_query($que);
			
			$moneSeq = mysql_insert_id();
			
			echo $moneSeq;
		}
		else{
			$que = "update TmoneTbl set
					joinSeq = '".$_SESSION['loginNum']."',
					writeDateTime = '".date("Y-m-d H:i:s")."',
					writeContents = '".$_REQUEST['moneContents']."',
					writePassWord = '".$_REQUEST['monePW']."',
					writeTitle = '".$_REQUEST['moneTitle']."',
					writeIp = '".$ip."' where seq = '".$_REQUEST['seq']."'";
			
			mysql_query($que);
			
			echo $_REQUEST['seq'];
		}
	break;
	case "gongJi":
		if($_REQUEST['gongjiMode'] ==""){
			$que = "insert into TgongjiTbl set
					writeDateTime = '".date("Y-m-d H:i:s")."',
					writeContents = '".$_REQUEST['gongjiContents']."',
					writeTitle = '".$_REQUEST['gongjiTitle']."',
					writeIp = '".$ip."',
					likeCnt = '0',
					hateCnt = '0',
					viewCnt = '0'";
			
			mysql_query($que);
			
			$moneSeq = mysql_insert_id();
			
			echo $moneSeq;
		}
		else{
			$que = "update TgongjiTbl set
					writeDateTime = '".date("Y-m-d H:i:s")."',
					writeContents = '".$_REQUEST['gongjiContents']."',
					writeTitle = '".$_REQUEST['gongjiTitle']."',
					writeIp = '".$ip."' where seq = '".$_REQUEST['seq']."'";
			
			mysql_query($que);
			
			echo $_REQUEST['seq'];
		}
	break;
	case "commu":
		if($_REQUEST['commuMode'] ==""){
			$que = "insert into TcommuniTbl set
					joinSeq = '".$_SESSION['loginNum']."',
					writeDateTime = '".date("Y-m-d H:i:s")."',
					writeTitle = '".$_REQUEST['commuTitle']."',
					writeContents = '".$_REQUEST['commuContents']."',
					writeIp = '".$ip."',
					country='',
					city='',
					likeCnt = '0',
					hateCnt = '0',
					viewCnt = '0',
					declareCnt='0'";
			
			mysql_query($que);
			
			$moneSeq = mysql_insert_id();
			
			echo $moneSeq;
		}
		else{
			$que = "update TcommuniTbl set
						joinSeq = '".$_SESSION['loginNum']."',
						writeDateTime = '".date("Y-m-d H:i:s")."',
						writeTitle = '".$_REQUEST['commuTitle']."',
						writeContents = '".$_REQUEST['commuContents']."',
						writeIp = '".$ip."',
						country='',
						city=''
					where seq = '".$_REQUEST['seq']."'";
			
			mysql_query($que);
			
			echo $_REQUEST['seq'];
		}
	break;
	default:
		echo "error";
	break;
}