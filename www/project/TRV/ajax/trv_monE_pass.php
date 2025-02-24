<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

$que_pass_chk = "select a.*,b.nickName from TmoneTbl a left join TjoinTbl b on a.joinSeq = b.seq where a.seq='".$_REQUEST['seq']."' and b.userPassWord = '".$_REQUEST['monePWInput']."'";
$res_pass_chk = mysql_query($que_pass_chk);
echo mysql_num_rows($res_pass_chk);

?>