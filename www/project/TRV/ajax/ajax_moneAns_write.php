<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
$ip = '수정필요';

$que = "insert into TmoneAnswerTbl set
		moneSeq = '".$_REQUEST['seq']."',
		answerDateTime = '".date("Y-m-d H:i:s")."',
		answerContents = '".$_REQUEST['moneContents']."',
		answerTitle = '".$_REQUEST['moneTitle']."',
		answerIp = '".$ip."'";

mysql_query($que);