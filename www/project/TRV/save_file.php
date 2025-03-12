<?php
// upload.php
exit;
// 서버에 저장할 디렉토리 경로
$uploadDir = 'test/';  // 이 디렉토리가 존재하고 쓰기 권한이 있어야 합니다.

// 업로드할 파일이 있는지 확인
if (isset($_FILES['croppedImages']) && !empty($_FILES['croppedImages']['name'][0])) {
    // 여러 개의 이미지를 처리할 경우
    $numFiles = count($_FILES['croppedImages']['name']);

    for ($i = 0; $i < $numFiles; $i++) {
        // 파일 정보
        $fileName = $_FILES['croppedImages']['name'][$i];
        $fileTmpName = $_FILES['croppedImages']['tmp_name'][$i];
        $fileSize = $_FILES['croppedImages']['size'][$i];
        $fileError = $_FILES['croppedImages']['error'][$i];

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
                    $fileDestination = $uploadDir . $newFileName;

                    // 파일을 서버에 저장
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        echo "파일 업로드 성공: " . $newFileName . "<br>";
                    } else {
                        echo "파일 업로드 실패<br>";
                    }
                } else {
                    echo "파일 크기가 너무 큽니다. 최대 5MB까지 업로드 가능합니다.<br>";
                }
            } else {
                echo "파일 업로드 오류: " . $fileError . "<br>";
            }
        } else {
            echo "허용되지 않은 파일 형식입니다.<br>";
        }
    }
} else {
    echo "파일이 선택되지 않았습니다.<br>";
}
?>
