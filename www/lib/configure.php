<?php
header("HTTP/1.1 200 OK");
header("Content-Type: application/json; charset=UTF-8");
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/lib_mysql.php';
date_default_timezone_set('Asia/Seoul');

// db 정보
$host='34.231.136.110';		   # 호스트명 또는 IP
$user='n06578';			   # Mysql 유저이름
$dbpass='Nyoun003310.';		   # DB 패스워드
$dbname='PjectDB';		   # 데이타 베이스 이름
$conn = mysqli_connect($host, $user, $dbpass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/lib_function.php';

// $que = "select * from test";
// $res = mysql_query($que);
// while($row = mysql_fetch_array($res)){
//     echo $row['test1'];
//     echo "<br>";
//     echo $row['test2'];
//     echo "<br>";
//     echo $row['test3'];
//     echo "<br>";
//     echo $row['test4'];
//     echo "<br>";
// }
?>