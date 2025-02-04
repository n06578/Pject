<?php
include $_SERVER['DOCUMENT_ROOT'] . '/project/TRV/api/mail_proc.php';  // mail 전송 필수 페이지 include
// include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";

echo $_SERVER['DOCUMENT_ROOT'] . '/project/TRV/api/mail_proc.php';
mailSend("메일 인증","확인","버튼을 눌러 메일 인증을 완료해주세요","n06578@gmail.com","subUser");
?>


<script>
</script>