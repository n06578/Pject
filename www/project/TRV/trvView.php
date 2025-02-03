<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-5 text-lg h-100" id="mainCardDiv">
        <!-- <hr class="hr-navy"> -->
        <div class="card mx-5 h-80 p-5">
        <p>안녕하세요, TinyMCE 에디터입니다!</p>
            <p>&nbsp;</p>
            <p><em>ㄴㅇㄹㄴㅇㄹㄴㅇㄹㄴㅇ</em></p>
            <p>&nbsp;</p>
            <p><strong>ㄴㅇㅎㄹㄴㅇㄴㅇㅎ</strong></p>

        </div>
    </div>
</div>
<div class="text-center" id="writeBtn" onclick="location.href='monEWrite.php'"><i class="far fa-save"></i> 등록하기</div>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<!-- Place the first <script> tag in your HTML's <head> -->


<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: '#editor',
    language: 'ko',
    setup: (editor) => {
        editor.on('init', () => {
            editor.setContent('<p>안녕하세요, TinyMCE 에디터입니다!</p>');
        });
    }
});
</script>