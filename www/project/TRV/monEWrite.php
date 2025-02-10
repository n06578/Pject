<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
$seq = "";
$moneTitle = "";
$editor = "";
$moneWrite = "";
if($_REQUEST['seq'] != ""){
    $que_mone = "select * from TmoneTbl where seq='".$_REQUEST['seq']."'";
    $res_mone = mysql_query($que_mone);
    $row_mone = mysql_fetch_array($res);
    
    $seq = $_REQUEST['seq'];
    $moneTitle = $row_mone['writeTitle'];
    $editor = $row_mone['writeContents'];
    $moneWrite = "updateMode";
}
?>
<div class="main-box container-fluid h-90">
    <form id="monEFrm">
        <input type="hidden" name="seq" value="<?=$seq?>">
        <input type="hidden" name ="writeMode" value="mone">
        <input type="hidden" name="monePW" id="monePW">
        <input type="hidden" name="moneMode" value="<?=$moneWrite?>">
        <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
            <table class="table noTable mr-5">
                <tr>
                    <td class="w-15 text-blg text-right t-navy txt-17 pt-3" id="tripArea">문의제목</td>
                    <td class="w-85"><input type="text" class="form-control w-95 noBorder mr-5" name="moneTitle" value="<?=$moneTitle?>"></td>
                </tr>
            </table>
            <hr class="hr-navy">
            <div class="card mx-5 h-80">
                <textarea id="editor" class="w-100 h-100" name="moneContents">
                    <?=$editor?>
                </textarea>
            </div>
        </div>
    </form>
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
    $("#editor").val(content);
    $("#monePWModal").modal("show");
});

$("#monePwBtn").on("click",function(){
    var PwInput = $("#monePWInput").val();
    $("#monePW").val(PwInput);
    moneWriteOk();
});

function moneWriteOk(){
    $("#monEFrm").ajaxSubmit({
        url: 'ajax/ajax_mone_write.php',
        type: 'post',
        success : function(val){
            location.href="monEView.php?seq="+val
        }
    });
}
</script>