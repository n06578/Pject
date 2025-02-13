<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';


switch($_REQUEST['writeMode']){
	case "mone" :
		if($_REQUEST['moneMode']==""){
			$que = "insert into TmoneTbl set
					joinSeq = '".$_SESSION['loginNum']."',
					writeDateTime = '".date("Y-m-d H:i:s")."',
					writeContents = '".$_REQUEST['moneContents']."',
					writePassWord = '".$_REQUEST['monePW']."',
					writeTitle = '".$_REQUEST['moneTitle']."',
					writeIp = '".$_SERVER['REMOTE_ADDR']."',
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
					writeIp = '".$_SERVER['REMOTE_ADDR']."' where seq = '".$_REQUEST['seq']."'";
			
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
					writeIp = '".$_SERVER['REMOTE_ADDR']."',
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
					writeIp = '".$_SERVER['REMOTE_ADDR']."' where seq = '".$_REQUEST['seq']."'";
			
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
					writeIp = '".$_SERVER['REMOTE_ADDR']."',
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
						writeIp = '".$_SERVER['REMOTE_ADDR']."',
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