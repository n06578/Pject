<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

if($_REQUEST['seq'] == ""){
    $que = "insert into TselfInfoTbl set
            joinSeq = '".$_SESSION['loginNum']."',
            keyword = '',
            userAge = '0',
            selfPresent = '".$_REQUEST['selfPresent']."',
            inTrvCnt = '".$_REQUEST['inTrvCnt']."',
            outTrvCnt = '".$_REQUEST['outTrvCnt']."',
            blackListYn = '0'
    ";
}else{
    $que = "update TselfInfoTbl set keyword = '',
                userAge = '0',
                selfPresent = '".$_REQUEST['selfPresent']."',
                inTrvCnt = '".$_REQUEST['inTrvCnt']."',
                outTrvCnt = '".$_REQUEST['outTrvCnt']."',
                blackListYn = '0'
            where seq = '".$_REQUEST['seq']."'";

}
mysql_query($que);

$fileName = $_FILES['croppedImages']['name'][0];
$fileTmpName = $_FILES['croppedImages']['tmp_name'][0];
$fileSize = $_FILES['croppedImages']['size'][0];
$fileError = $_FILES['croppedImages']['error'][0];

// 업로드 파일의 확장자 확인
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
// 허용된 파일 확장자 (jpg, jpeg, png, gif)
$allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

// 파일 확장자가 허용된 확장자인지 확인
if (in_array($fileExt, $allowedExts)) {
// 업로드 오류가 없으면
    if ($fileError === 0) {
        // 파일 크기가 5MB 이하인지 확인
        if ($fileSize <= 5 * 1024 * 1024) {
            // 파일 이름을 안전하게 변경 (중복을 피하기 위해 랜덤하게 처리)
            $newFileName = $_SESSION['loginNum'].date("YmdHis") . '.' . $fileExt;
            $uploadDir = '../itemImgFile/user_'.$_SESSION['loginNum']."/profile";  // 이 디렉토리가 존재하고 쓰기 권한이 있어야 합니다.
            $fileDestination = $uploadDir ."/" . $newFileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // 파일을 서버에 저장
            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                
                $que = "delete from TuserprofileFile where joinSeq = '".$_SESSION['loginNum']."'";
                mysql_query($que);

                $que = "insert into TuserprofileFile set
                            joinSeq = '".$_SESSION['loginNum']."',
                            fileRealName = '".$fileName."',
                            fileName = '".$newFileName."',
                            fileSize = '".$fileSize."',
                            filePath = '".str_replace("../","",$fileDestination)."',
                            fileType = 'profile',
                            fileExt	= '".$fileExt."'
                    ";
                mysql_query($que);
                // echo "파일 업로드 성공: " . $newFileName;
            } else {
                // echo "파일 업로드 실패.";
            }
        } else {
            // echo "파일 크기가 너무 큽니다. 최대 5MB까지 업로드 가능합니다.<br>";
        }
    } else {
        // echo "파일 업로드 오류: " . $fileError . "<br>";
    }
} else {
    // echo "허용되지 않은 파일 형식입니다.<br>";
}

$que_join = "update TjoinTbl set nickName = '".$_REQUEST['nickName']."' where seq = '".$_SESSION['loginNum']."'";
mysql_query($que_join);