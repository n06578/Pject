<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";

$que_con = "select a.*,ifnull(b.seq,0) as ansSeq from TmoneTbl a left join TmoneAnswerTbl b on a.seq = b.moneSeq where a.seq = '".$_REQUEST['seq']."'";
$res_con = mysql_query($que_con);
$row_con = mysql_fetch_array($res_con);


$ansSeq = "";
$moneMode= "";
$moneTitle = '';
$editor = '';

if($row_con['ansSeq'] !="0"){
    $que_mone = "select * from TmoneAnswerTbl where seq = '".$row_con['ansSeq']."'";
    $res_mone = mysql_query($que_mone);
    $row_mone = mysql_fetch_array($res_mone);

    $ansSeq = $row_con['ansSeq'];
    $moneMode= "updateMode";
    $moneTitle = $row_mone['answerTitle'];
    $editor = $row_mone['answerContents'];
}
?>
<div class="main-box container-fluid h-90">
    <form id="monEFrm">
        <input type="hidden" name="seq" value="<?=$_REQUEST['seq']?>">
        <input type="hidden" name="ansSeq" id="ansSeq" value="<?=$ansSeq?>">
        <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
            <table class="table noTable mr-5">
                <tr>
                    <td class="w-15 text-blg text-right t-navy txt-17 pt-3" id="tripArea">답변제목</td>
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
<div class="text-center" id="moneViewBtn" ><i class="far fa-save"></i> 문의내용</div>
<div class="text-center" id="writeBtn" ><i class="far fa-save"></i> 등록하기</div>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<!-- Place the first <script> tag in your HTML's <head> -->

<div class="modal" id="moneViewMdl" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="min-height: 90vh;">
            <div class="modal-body _modalBody d-grid" ng-switch="invitationStep">
                <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
                    <table class="table noTable mx-5">
                        <tr>
                            <td class="text-left text-blg t-navy txt-14 pt-3 pl-5">Title<text class="ml-4 txt-12"><?=$row_con['writeTitle']?></text></td>
                        </tr>
                    </table>
                    <hr class="hr-navy">
                    <div class="mx-5 text-right txt-10">
                        작성일자 : <?=$row_con['writeDateTime']?>
                    </div>
                    <div class="card mx-5 h-80 p-5 text-left">
                        <?=$row_con['writeContents']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: '#editor',
    language: 'ko',
    height:"77vh",
    setup: (editor) => {
        editor.on('init', () => {
        });
    }
});
$("#writeBtn").click(function(){
    var content = tinyMCE.activeEditor.getContent();
    $("#editor").val(content);
    moneWriteOk();
});

function moneWriteOk(){
    $("#monEFrm").ajaxSubmit({
        url: 'ajax/ajax_moneAns_write.php',
        type: 'post',
        success : function(val){
            location.href="monEView.php?seq=<?=$_REQUEST['seq']?>"
        }
    });
}
$("#moneViewBtn").click(function(){
    $("#moneViewMdl").modal("show")
})
</script>