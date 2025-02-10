<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";

$que_con = "select a.*,ifnull(b.seq,0) as ansSeq from TgongjiTbl a left join (select * from TcommuniAnswerTbl where conType='gongji') b on a.seq = b.conSeq where a.seq = '".$_REQUEST['seq']."'";
$res_con = mysql_query($que_con);
$row_con = mysql_fetch_array($res_con);

if($_SESSION['loginNum'] != "0"){
    $que_view = "update TgongjiTbl set viewCnt = viewCnt+1 where seq = '".$_REQUEST['seq']."'";
    mysql_query($que_view);
}
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
<?if($_SESSION['loginYn'] == "Y" && $_SESSION['loginNum'] == "0"){?>
<div class="text-center" id="writeBtn" onclick="location.href='gongjiWrite.php?seq=<?=$_REQUEST['seq']?>'"><i class="far fa-save"></i> 수정하기</div>
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