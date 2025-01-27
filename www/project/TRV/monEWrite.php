<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <table class="table noTable mr-5">
            <tr>
                <td class="w-10 text-blg text-right t-navy txt-17 pt-3" id="tripArea">문의제목</td>
                <td class="w-90"><input type="text" class="form-control w-95 noBorder mr-5"></td>
            </tr>
        </table>
        <hr class="hr-navy">
        <div class="card mx-5 h-80">
        
            <textarea id="editor" class="w-100 h-100">
            </textarea>

        </div>
    </div>
</div>
<div class="text-center" id="writeBtn" ><i class="far fa-save"></i> 등록하기</div> <!--onclick="location.href='monEWrite.php'"-->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<!-- Place the first <script> tag in your HTML's <head> -->


<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: '#editor',
    language: 'ko',
    height:"77vh",
    setup: (editor) => {
        editor.on('init', () => {
            editor.setContent('');
        });
    }
});
$("#writeBtn").click(function(){
    var content = tinyMCE.activeEditor.getContent();
    console.log(content);
});
</script>