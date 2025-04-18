<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
$seq = "";
$gongjiMode= "";
$gongjiTitle = '';
$editor = '';

if($_REQUEST['seq'] !=""){
    $que_gongji = "select * from TgongjiTbl where seq = '".$_REQUEST['seq']."'";
    $res_gongji = mysql_query($que_gongji);
    $row_gongji = mysql_fetch_array($res_gongji);

    $seq = $_REQUEST['seq'];
    $gongjiMode= "updateMode";
    $gongjiTitle = $row_gongji['writeTitle'];
    $editor = $row_gongji['writeContents'];
}
?>
<div class="main-box container-fluid h-90">
    <form id="gongjiFrm">
        <input type="hidden" name="seq" value="<?=$seq?>">
        <input type="hidden" name="writeMode" value="gongJi">
        <input type="hidden" name="gongjiMode" value="<?=$gongjiMode?>">
        <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
            <table class="table noTable mr-5">
                <tr>
                    <td class="w-15 text-blg text-right t-navy txt-17 pt-3" id="tripArea">공지제목</td>
                    <td class="w-85"><input type="text" name="gongjiTitle" class="form-control w-95 noBorder mr-5" value="<?=$gongjiTitle?>"></td>
                </tr>
            </table>
            <hr class="hr-navy">
            <div class="card mx-5 h-80">
                <input type="hidden" name='managerPw'>
                <textarea id="editor" class="w-100 h-90" name="gongjiContents">
                    <?=$editor?>
                </textarea>
            </div>
        </div>
    </form>
</div>
<?if($_SESSION['loginYn'] == "Y" && $_SESSION['loginNum'] == "0"){?>
<div class="text-center" id="listBtn" onclick="location.href='gongJi.php'"><i class="fas fa-list"></i> 목록</div>
<div class="text-center" id="writeBtn" ><i class="far fa-save"></i> 등록하기</div>
<?}?>
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

        });
    }
});

$("#writeBtn").on("click",function(){
    var content = tinyMCE.activeEditor.getContent();
    $("#editor").val(content);
    gongjiWriteOk()
})

function gongjiWriteOk(){
    $("#gongjiFrm").ajaxSubmit({
        url: 'ajax/ajax_commu_write.php',
        type: 'post',
        success : function(val){
            console.log(val);
            location.href="gongjiView.php?seq="+val
        }
    });
}
</script>