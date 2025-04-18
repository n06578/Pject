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

$uploadDir = 'itemImgFile/user_'.$_SESSION['loginNum'];
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$itemList = count($_REQUEST['select']);
for ($i = 1; $i <= $itemList; $i++) {
    $subNumFiles = (!isset($_FILES['croppedImages']['name'][$i])) ? 0 : count($_FILES['croppedImages']['name'][$i]);
    if ($subNumFiles == 0 && str_replace(" ", "", $_REQUEST['textarea'][$i]) == "") continue;

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

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExt, $allowedExts) && $fileError === 0 && $fileSize <= 5 * 1024 * 1024) {
            $newFileName = uniqid('', true) . '.' . $fileExt;
            $fileDestination = $uploadDir . "/" . $newFileName;

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
            }
        }
    }
}

echo "success|".$mainSeq;

// 단순 압축 함수 (크기 유지)
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
            $result = imagepng($image, $destination, 6); // 압축 레벨: 0~9 (6이 보통)
            break;
        case 'gif':
            $image = imagecreatefromgif($source);
            $result = imagegif($image, $destination);
            break;
        default:
            return false;
    }

    imagedestroy($image);
    return $result;
}
?>