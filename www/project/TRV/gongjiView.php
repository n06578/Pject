<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";

$que_con = "select a.*,ifnull(b.seq,0) as ansSeq from TgongjiTbl a left join (select * from TcommuniAnswerTbl where conType='gongji') b on a.seq = b.conSeq where a.seq = '".$_REQUEST['seq']."'";
$res_con = mysql_query($que_con);
$row_con = mysql_fetch_array($res_con);

// 작성자 확인
if($_SESSION['loginNum'] != "0"){
    $que_view = "update TgongjiTbl set viewCnt = viewCnt+1 where seq = '".$_REQUEST['seq']."'";
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
    <div class="h-100">
        <div class="contents-col col pt-2 text-lg h-100" id="subCardDiv">
            <table class="table noTable my-0">
                <tr>
                    <td class="text-left text-blg t-navy txt-11 pt-3 pl-5">Title<text class="ml-3 txt-10"><?=$row_con['writeTitle']?></text></td>
                </tr>
            </table>
            <hr class="hr-navy mx-4 mt-0 mb-3">
            <div class="row">
                <div class="mx-5 col text-left mb-1 txt-8"> [ 작성일시 <?=$row_con['writeDateTime']?> ] </div>

                <div class="mx-5 col text-right mb-1 txt-8"> 
                    <?
                        $que_lh = "select * from TlikeHateTbl where joinSeq ='".$_SESSION['loginNum']."' and conSeq = '".$_REQUEST['seq']."' and conType = 'postGongji'";
                        $res_lh = mysql_query($que_lh);
                        $cnt_lh = mysql_num_rows($res_lh);
                        $likeChk = $hateChk = "far";
                        if($cnt_lh>0){
                            $row_lh  = mysql_fetch_array($res_lh);
                            $row_lh['likeHate'] == "like"?  $likeChk = "fas": $hateChk = "fas";
                        }
                    ?>
                    <label class="c-pointer mr-1 getCnt" id="LikeCnt" data-seq="<?=$_REQUEST['seq']?>" title="<?=getAnsCnt($_REQUEST['seq'],"postGongji","like")?>"><i class="<?=$likeChk?> fa-thumbs-up" ></i> </label>
                    <label class="c-pointer mr-1 getCnt" id="HateCnt" data-seq="<?=$_REQUEST['seq']?>" title="<?=getAnsCnt($_REQUEST['seq'],"postGongji","hate")?>"><i class="<?=$hateChk?> fa-thumbs-down"></i></label>
                    <?if($commu_writer == "yes"){?>
                    <label class="c-pointer postDelete"><i class="fas fa-trash-alt"></i></label>
                    <?}else{?>
                        <label class="c-pointer" id="postDeclare" data-seq="<?=$_REQUEST['seq']?>"><i class="fas fa-exclamation-triangle"></i></label>
                    <?}?>
                </div>
            </div>
            <div class="card mx-5 h-80 p-3 txt-9"> <?=$row_con['writeContents']?> </div>
        </div>
    </div>
    <div id="scrollAnsDiv">
        <?
        $que_ans = "select * from TcommuniAnswerTbl where conSeq='".$_REQUEST['seq']."' and conType='gongji'";
        $res_ans = mysql_query($que_ans);
        while($row_ans = mysql_fetch_array($res_ans)){
        ?>
            <div class="ansCard px-2 py-1 txt-9">
                <label class="txt-10"><?=getName($row_ans['joinSeq'])?></label>
                <label class="f-right txt-8"><?=$row_ans['answerDateTime']?></label>
                <div> <label><?=$row_ans['answerContents']?></label> </div>
                <div class="likeHateDiv text-right" id="likeHate_<?=$row_ans['seq']?>">
                    <?
                    $que_lh = "select * from TlikeHateTbl where joinSeq ='".$_SESSION['loginNum']."' and conSeq = '".$row_ans['seq']."' and conType = 'gongji'";
                    $res_lh = mysql_query($que_lh);
                    $cnt_lh = mysql_num_rows($res_lh);
                    $likeChk = $hateChk = "far";
                    if($cnt_lh>0){
                        $row_lh  = mysql_fetch_array($res_lh);
                        $row_lh['likeHate'] == "like"?  $likeChk = "fas": $hateChk = "fas";
                    }
                    ?>
                    <label class="c-pointer mr-1 getCnt" id="ansLikeCnt" data-seq="<?=$row_ans['seq']?>" title="<?=getAnsCnt($row_ans['seq'],$row_ans['conType'],"like")?>"><i class="<?=$likeChk?> fa-thumbs-up"></i> </label>
                    <label class="c-pointer mr-1 getCnt" id="ansHateCnt" data-seq="<?=$row_ans['seq']?>" title="<?=getAnsCnt($row_ans['seq'],$row_ans['conType'],"hate")?>"><i class="<?=$hateChk?> fa-thumbs-down"></i></label>
                <? if($row_ans['joinSeq'] == $_SESSION['loginNum']){ ?>
                    <label class="c-pointer deleteCnt"><i class="fas fa-trash-alt"></i></label>
                <? }else{ ?>
                    <label class="c-pointer" id="ansDeclare" data-seq="<?=$row_ans['seq']?>"><i class="fas fa-exclamation-triangle"></i></label>
                <? } ?>
                </div>
            </div>
        <?}?>
    </div>
    <div class="col ansWrite">
        <div class="row p-3 pb-0">
            <textarea class="form-control col-9 w-100 mb-2" id="ansText"></textarea>
            <input type="button" class="btn btn-white col-1 f-right txt-8" id="ansAdd" value="등록">
        </div>
    </div>
</div>
<div class="text-center" id="listBtn" onclick="location.href='gongji.php'"><i class="fas fa-list"></i> 목록</div>
<?if($commu_writer == "yes"){?>
<div class="text-center" id="writeBtn" onclick="location.href='gongjiWrite.php?seq=<?=$_REQUEST['seq']?>'"><i class="far fa-save"></i> 수정하기</div>
<?}?>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<!-- Place the first <script> tag in your HTML's <head> -->


<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
$("#ansAdd").on("click",function(){
    if("<?=$login?>" =="yes") {
        $.ajax({
            url: "ajax/trv_commu_add_ok.php",
            type: "POST",
            data: {
                answerContents: $("#ansText").val(),
                conSeq : "<?=$_REQUEST['seq']?>",
                conType : "gongji",
                ansType : "ansAdd"
            },
            success: function(data){
                location.reload();
            }
        });
    }else{
        loginChkClos()
    }
})

function loginChk(){
    if("<?=$login?>" =="yes") {return true;}
    else{return false;}
}

$(document).on('mouseenter mouseleave', '.getCnt',function(){
    var thisId = $(this).attr('id');
    $.ajax({
        url: "ajax/trv_getCnt.php",
        type: "POST",
        data: {
            conSeq : $(this).data('seq'),
            conType: thisId,
            Type : "gongji"
        },
        success: function(data){
            $("#"+thisId).attr("title",data);
            $("#"+thisId).addClass("chjk");
        }
    });
});
$(document).on('click', '#LikeCnt',function(){
    if(loginChk()){
        $(this).find("i").toggleClass("fas far");
        $(this).next().find("i").removeClass("fas")
        $(this).next().find("i").addClass("far")
        ansLikeHateCnt(this,"like","postGongji");
    }else{
        loginChkClos()
    }
})
$(document).on('click', '#HateCnt',function(){
    if(loginChk()){
        $(this).find("i").toggleClass("fas far");
        $(this).prev().find("i").removeClass("fas")
        $(this).prev().find("i").addClass("far")
        ansLikeHateCnt(this,"hate","postGongji");
    }else{
        loginChkClos()
    }
})

$(document).on('click', '#ansLikeCnt',function(){
    if(loginChk()){
        $(this).find("i").toggleClass("fas far");
        $(this).next().find("i").removeClass("fas")
        $(this).next().find("i").addClass("far")
        ansLikeHateCnt(this,"like","gongji");
    }else{
        loginChkClos()
    }
})
$(document).on('click', '#ansHateCnt',function(){
    if(loginChk()){
        $(this).find("i").toggleClass("fas far");
        $(this).prev().find("i").removeClass("fas")
        $(this).prev().find("i").addClass("far")
        ansLikeHateCnt(this,"hate","gongji");
    }else{
        loginChkClos()
    }
})
$(document).on('click', '.deleteCnt',function(){
    ansLikeHateCnt(this,"ansDel","gongji");
})

$(document).on('click','.postDelete',function(){
    const notice = PNotify.info({
        title: '해당 모든 내역이 삭제됩니다.',
        text: '삭제하시겠습니까?',
        icon: 'fa fa-exclamation-triangle',
        hide: false, // 자동으로 닫히지 않도록 설정
        closer: false, // 닫기 버튼 비활성화
        sticker: false, // 스티커 버튼 비활성화
        destroy: true, // 알림을 클릭으로 제거 가능하도록 설정
        stack: new PNotify.Stack({
            dir1: 'down',
            modal: true,
            firstpos1: 25,
            overlayClose: false
        }),
        modules: new Map([
            ...PNotify.defaultModules,
            [PNotifyConfirm, {
                confirm: true,
                buttons: [
                    {
                        text: '확인',
                        click: (notice) => {
                            notice.close()
                            $.ajax({
                                url: "ajax/trv_post_del.php",
                                type: "POST",
                                data: {
                                    conType : "gongji",
                                    seq : "<?=$_REQUEST['seq']?>",
                                },
                                success: function(data){
                                    pAlert("info","삭제완료","성공적으로 삭제되었습니다.",true);
                                    location.href="gongji.php";
                                }
                            });
                        }
                    },
                    {
                        text: '취소',
                        click: notice => notice.close()
                    }
                ]
            }]
        ])
    });
})

function ansLikeHateCnt(thisVal,ansType,conType){
    if(conType=="gongji"){
        var thisId = $(thisVal).parents().attr("id");
        var ansSeq = thisId.replace("likeHate_","");
    }else{
        var ansSeq = "<?=$_REQUEST['seq']?>";
    }
    $.ajax({
        url: "ajax/trv_commu_add_ok.php",
        type: "POST",
        data: {
            answerContents: $("#ansText").val(),
            conSeq : ansSeq,
            conType : conType,
            ansType : ansType
        },
        success: function(data){
            if(ansType == "ansDel"){
                $("#"+thisId).parent().remove();
            }
        }
    });
}

$(document).on('click','#postDeclare, #ansDeclare',function(){
    if(loginChk()){
        $("#moneDeclare").modal("show")
        $("#declareReason").val("");
        $("#declareReason").focus()
        $("#mType").val("gongji");
        $("#mConType").val($(this).attr("id"));
        $("#mConSeq").val($(this).data("seq"));
    }else{
        loginChkClos()
    }
})

$(document).on("click","#decalreBtn",function(){
    if($("#declareReason").val() == ""){
        pAlert("error","실패","신고사유를 입력하세요.",true);
    }else{
        $.ajax({
            url: "ajax/trv_declare.php",
            type: "POST",
            data: {
                conSeq : $("#mConSeq").val(),
                conType: $("#mConType").val(),
                declareReason:$("#declareReason").val(),
                Type : "gongji"
            },
            success: function(data){
                $("#moneDeclare").modal("hide")
                if(data == ""){
                    pAlert("error","신고접수","성공적으로 신고가 접수되었습니다.",true);
                }else{
                    pAlert("error","실패",data+"에 신고가 접수되었습니다.",true);
                }
            } 
        });
    }
})
</script>