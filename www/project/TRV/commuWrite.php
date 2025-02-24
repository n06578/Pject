<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
$seq = "";
$commuMode= "";
$commuTitle = '';
$editor = '';

if($_REQUEST['seq'] !=""){
    $que_commu = "select * from TcommuniTbl where seq = '".$_REQUEST['seq']."'";
    $res_commu = mysql_query($que_commu);
    $row_commu = mysql_fetch_array($res_commu);

    $seq = $_REQUEST['seq'];
    $commuMode= "updateMode";
    $commuTitle = $row_commu['writeTitle'];
    $editor = $row_commu['writeContents'];
}
?>
<div class="main-box container-fluid h-90">
    <form id="commuFrm">
        <input type="hidden" name="seq" value="<?=$seq?>">
        <input type="hidden" name="writeMode" value="commu">
        <input type="hidden" name="commuMode" value="<?=$commuMode?>">
        <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
            <table class="table noTable mr-5">
                <tr>
                    <td class="w-15 text-blg text-right t-navy txt-17 pt-3" id="tripArea">소통창고</td>
                    <td class="w-85"><input type="text" name="commuTitle" class="form-control w-95 noBorder mr-5" value="<?=$commuTitle?>"></td>
                </tr>
            </table>
            <hr class="hr-navy">
            <div class="card mx-5 h-80">
            
                <textarea id="editor" class="w-100 h-100" name="commuContents">
                    <?=$editor?>
                </textarea>

            </div>
        </div>
    </form>
</div>
<div class="text-center" id="writeBtn"><i class="far fa-save"></i> 등록하기</div>
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
    commuWriteOk()
})

function commuWriteOk(){
    $("#commuFrm").ajaxSubmit({
        url: 'ajax/ajax_commu_write.php',
        type: 'post',
        success : function(val){
            console.log(val);
            location.href="commuView.php?seq="+val
        }
    });
}
</script>