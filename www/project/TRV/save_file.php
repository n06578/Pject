<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';

// 메인 아이템 등록
$que = "insert into TuserItem set
    joinSeq = '".$_SESSION['loginNum']."',
    country = '".$_REQUEST['country']."',
    writeDate = '".date('Y-m-d H:i:s')."'
";
mysql_query($que);
$mainSeq = mysql_insert_id();

// 저장 폴더 준비
$uploadDir = 'itemImgFile/user_'.$_SESSION['loginNum'];
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$itemList = count($_REQUEST['select']);
for ($i = 1; $i <= $itemList; $i++) {
    $subNumFiles = (!isset($_FILES['croppedImages']['name'][$i])) ? 0 : count($_FILES['croppedImages']['name'][$i]);
    if ($subNumFiles == 0 && str_replace(" ", "", $_REQUEST['textarea'][$i]) == "") continue;

    // 서브 아이템 등록
    $que = "insert into TuserItemList set
        itemSeq = '".$mainSeq."',
        itemType = '".$_REQUEST['select'][$i]."',
        itemComment = '".$_REQUEST['textarea'][$i]."'
    ";
    mysql_query($que);
    $subSeq = mysql_insert_id();

    // 이미지 파일 처리
    for ($j = 0; $j < $subNumFiles; $j++) {
        $fileName = $_FILES['croppedImages']['name'][$i][$j];
        $fileTmpName = $_FILES['croppedImages']['tmp_name'][$i][$j];
        $fileSize = $_FILES['croppedImages']['size'][$i][$j];
        $fileError = $_FILES['croppedImages']['error'][$i][$j];

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExt, $allowedExts) && $fileError === 0 && $fileSize <= 5 * 1024 * 1024) {
            $newFileName = uniqid('', true) . '.' . $fileExt;
            $fileDestination = $uploadDir . "/" . $newFileName;

            // 이미지 압축 및 저장
            if (compressImage($fileTmpName, $fileDestination, $fileExt, 1024, 70)) {
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
            }
        }
    }
}

echo "success|".$mainSeq;


// 이미지 압축 함수
function compressImage($source, $destination, $ext, $maxWidth = 1024, $quality = 70) {
    list($width, $height) = getimagesize($source);
    $scale = $maxWidth / $width;

    if ($scale >= 1) {
        $newWidth = $width;
        $newHeight = $height;
    } else {
        $newWidth = $maxWidth;
        $newHeight = $height * $scale;
    }

    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'png':
            $image = imagecreatefrompng($source);
            break;
        case 'gif':
            $image = imagecreatefromgif($source);
            break;
        default:
            return false;
    }

    $newImage = imagecreatetruecolor($newWidth, $newHeight);

    if ($ext == 'png') {
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
    }

    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    $result = false;
    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $result = imagejpeg($newImage, $destination, $quality);
            break;
        case 'png':
            $result = imagepng($newImage, $destination, 6); // 0~9 압축 정도
            break;
        case 'gif':
            $result = imagegif($newImage, $destination);
            break;
    }

    imagedestroy($image);
    imagedestroy($newImage);
    return $result;
}
?>