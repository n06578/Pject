<?
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/lib_mysql.php';

if($_FILES['upimg1']['name']!=""){
	$file_name1 = $_FILES['upimg1']['tmp_name'];
	$file_size1 = $_FILES['upimg1']['size'];
	$file_type1 = $_FILES['upimg1']['type'];
	$file_realname1 = $_FILES['upimg1']['name'];

	$fileType1 = substr(strrchr($file_realname1,"."),1); //확장자명
	$fileType1 = strtolower($fileType1);

	$saveFilename1 = date("Ymdhis")."f1.".$fileType1; //파일저장명
	
    $filePath1 = $_SERVER['DOCUMENT_ROOT']."/file/".$saveFilename1;
    $move = move_uploaded_file($file_name1, $filePath1);
    
	$que = "insert into fileList set
    uploadDate = '".date("Y-m-d H:i:s")."',
    filename = '$saveFilename1',
    realName = '$file_realname1'";

    mysql_query($que);
}
?>
<script>
    location.href = "down.php";
</script>