<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
        $allowedExts = ['jpg', 'jpeg', 'png'];

        if (in_array($fileExt, $allowedExts) && $fileError === 0 && $fileSize <= 5 * 1024 * 1024) {
            $newFileName = uniqid('', true) . '.' . $fileExt;
            $fileDestination = $uploadDir . "/" . $newFileName;

            if (compressImageToTarget($fileTmpName, $fileDestination, $fileExt, 100 * 1024)) {
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

// ✅ 이미지 100KB 이하로 저장하는 함수
function compressImageToTarget($source, $destination, $ext, $targetSize = 100 * 1024) {
    if ($ext == 'jpg' || $ext == 'jpeg') {
        $image = imagecreatefromjpeg($source);
    } else if ($ext == 'png') {
        $image = imagecreatefrompng($source);
    } else {
        return false;
    }

    $quality = 90;
    $step = 5;

    do {
        ob_start();
        if ($ext == 'jpg' || $ext == 'jpeg') {
            imagejpeg($image, null, $quality);
        } else if ($ext == 'png') {
            imagepng($image, null, round($quality / 10)); // PNG 압축 0~9
        }
        $data = ob_get_clean();
        $size = strlen($data);
        $quality -= $step;
    } while ($size > $targetSize && $quality > 10);

    file_put_contents($destination, $data);
    imagedestroy($image);

    return $size <= $targetSize;
}
?>