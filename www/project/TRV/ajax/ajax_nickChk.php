<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

if($_GET['type'] == "join"){
    $que = "select * from TjoinTbl where nickName='".$_GET['nick']."'";
}
$res = mysql_query($que);
$cnt = mysql_num_rows($res);
if($cnt > 0) {echo "ng"; }
else{ echo "ok";}