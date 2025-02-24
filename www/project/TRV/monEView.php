<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";

$que_con = "select a.*,ifnull(b.seq,0) as ansSeq from TmoneTbl a left join TmoneAnswerTbl b on a.seq = b.moneSeq where a.seq = '".$_REQUEST['seq']."'";
$res_con = mysql_query($que_con);
$row_con = mysql_fetch_array($res_con);

// 작성자 확인
if($_SESSION['loginNum'] != $row_con['joinSeq']){
    $que_view = "update TcommuniTbl set viewCnt = viewCnt+1 where seq = '".$_REQUEST['seq']."'";
    mysql_query($que_view);
    $commu_writer = "";
}else{
    $commu_writer = "yes";
}
//로그인 확인
if($_SESSION['loginNum'] !="-" && $_SESSION['loginNum'] !="") {$login="yes";}
else{$login="no";}
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
<?
if($row_con['ansSeq'] !=0 ){
    $que_ans = "select * from TmoneAnswerTbl where seq = '".$row_con['ansSeq']."'";
    $res_ans = mysql_query($que_ans);
    $row_ans = mysql_fetch_array($res_ans);
}
?>
<div class="modal" id="moneMdl" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="min-height: 90vh;">
            <div class="modal-body _modalBody d-grid" ng-switch="invitationStep">
                <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
                    <table class="table noTable mx-5">
                        <tr>
                            <td class="text-left text-blg t-navy txt-14 pt-3 pl-5">답변 Title<text class="ml-4 txt-12"><?=$row_ans['answerTitle']?></text></td>
                        </tr>
                    </table>
                    <hr class="hr-navy">
                    <div class="mx-5 text-right txt-10">
                        작성일자 : <?=$row_ans['answerDateTime']?>
                    </div>
                    <div class="card mx-5 h-80 p-5 text-left">
                        <?=$row_ans['answerContents']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?if($row_con['ansSeq'] ==0 && $login == "yes" && $commu_writer=="yes"){?>
    <div class="text-center" id="writeBtn" onclick="location.href='monEWrite.php?seq=<?=$_REQUEST['seq']?>'"><i class="far fa-save"></i> 수정하기</div>
<?}else if($row_con['ansSeq'] != 0 && $_SESSION['loginNum']!="0"){?>
    <div class="text-center moneBtn" id="moneBtn" ><i class="far fa-save"></i> 답변보기</div>
<?}else if($_SESSION['loginNum']=="0"){
    if($row_con['ansSeq'] ==0){$btnTxt = "답변등록";}
    else{$btnTxt = "답변수정";}
    ?>
    <div class="text-center moneBtn" id="manaMoneBtn" ><i class="far fa-save"></i> 답변보기</div>
    <div class="text-center" id="writeBtn" onclick="location.href='manageMonEWrite.php?seq=<?=$_REQUEST['seq']?>'"><i class="far fa-save"></i> <?=$btnTxt?></div>
    <?}?>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<!-- Place the first <script> tag in your HTML's <head> -->
<script>
    $(document).on("click",".moneBtn",function(){
        $("#moneMdl").modal("show");
    })

</script>