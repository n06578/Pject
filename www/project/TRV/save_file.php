<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

$que = "insert into TuserItem set
    joinSeq = '".$_SESSION['loginNum']."',
    country = '".$_REQUEST['country']."',
    writeDate = '".date('Y-m-d H:i:s')."'
";
mysql_query($que);

$mainSeq = mysql_insert_id();


$uploadDir = 'itemImgFile/user_'.$_SESSION['loginNum'];  // 이 디렉토리가 존재하고 쓰기 권한이 있어야 합니다.

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$itemList = count($_REQUEST['select']);
for ($i = 1; $i <= $itemList; $i++) {
    $subNumFiles = (!isset($_FILES['croppedImages']['name'][$i]))? 0:count($_FILES['croppedImages']['name'][$i]);
    if($subNumFiles==0 && str_Replace(" ","",$_REQUEST['textarea'][$i]) == "") continue;
    $que = "insert into TuserItemList set
            itemSeq = '".$mainSeq."',
            itemType = '".$_REQUEST['select'][$i]."',
            itemComment = '".$_REQUEST['textarea'][$i]."'
        ";

    mysql_query($que);

    $subSeq = mysql_insert_id();

    for ($j = 0; $j < $subNumFiles; $j++) {
            $fileName = $_FILES['croppedImages']['name'][$i][$j];
            $fileTmpName = $_FILES['croppedImages']['tmp_name'][$i][$j];
            $fileSize = $_FILES['croppedImages']['size'][$i][$j];
            $fileError = $_FILES['croppedImages']['error'][$i][$j];

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
                    $newFileName = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = $uploadDir ."/" . $newFileName;

                    // 파일을 서버에 저장
                    if (compressImageFast($fileTmpName, $fileDestination, $fileExt, 70)) {
                        $que = "insert into TuserItemFile set
                            itemSeq = '".$mainSeq."',
                            itemListSeq = '".$subSeq."',
                            fileRealName = '".$fileName."',
                            fileName = '".$newFileName."',
                            fileSize = '".filesize($fileDestination)."',
                            filePath = '".$fileDestination."',
                            fileType = '',
                            fileExt = '".$fileExt."'
                        ";
                        mysql_query($que);
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
    }
}

echo "success|".$mainSeq;
function compressImageFast($source, $destination, $ext, $quality = 70) {
    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($source);
            $result = imagejpeg($image, $destination, $quality);
            break;
        case 'png':
            $image = imagecreatefrompng($source);
            imagealphablending($image, true);
            imagesavealpha($image, true);
            $result = imagepng($image, $destination, 6); // 압축 0~9 중간값
            break;
        default:
            return false; // gif 등은 제외
    }
    imagedestroy($image);
    return $result;
}
?>
