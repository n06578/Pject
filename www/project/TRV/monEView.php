<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";

$que_con = "select a.*,ifnull(b.seq,0) as ansSeq from TmoneTbl a left join TmoneAnswerTbl b on a.seq = b.moneSeq where a.seq = '".$_REQUEST['seq']."'";
$res_con = mysql_query($que_con);
$row_con = mysql_fetch_array($res_con);
?>
<div class="main-box container-fluid h-90">
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
        <div class="card mx-5 h-80 p-5">
            <?=$row_con['writeContents']?>
        </div>
    </div>
</div>

<?if($row_con['ansSeq'] ==0 ){?>
<div class="text-center" id="writeBtn" onclick="location.href='monEWrite.php?seq=<?=$_REQUEST['seq']?>'"><i class="far fa-save"></i> 수정하기</div>
<?}?>
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