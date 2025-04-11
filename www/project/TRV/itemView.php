<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
$mainSeq = $_REQUEST['seq'];

$que_main = "select * from TuserItem where seq = '".$mainSeq."'";
$res_main = mysql_query($que_main);
$row_main = mysql_fetch_array($res_main);
$country = $row_main['country'];
$writeDate = $row_main['writeDate'];

$que_sub = "select * from TuserItemList where itemSeq = '".$mainSeq."'";
$res_sub = mysql_query($que_sub);

if($row_main['joinSeq'] != $_SESSION['loginNum'] && $_SESSION['loginNum'] !="-"){
$que_recent ="insert into TanotherTbl set joinSeq ='".$_SESSION['loginNum']."', conSeq = '".$mainSeq."',type = 'recent',addDateTime='".date("Y-m-d H:i:s")."'
                ON DUPLICATE KEY UPDATE addDateTime='".date("Y-m-d H:i:s")."'";
mysql_query($que_recent);
}

?>
<div class="main-box item-box h-90">
    <div class="h-100 p-3" id="mainCardDiv">
        <div class="row">
            <div class="dTripArea t-navy tx-19 fw-600"><?=$country?></div>
            <div class="dTripArea t-navy tx-11 mb-4 fw-500"><?=getName($row_main['joinSeq'])?> ( <?=$writeDate?> )</div>
        </div>
        <?
        $subCnt = 0;
        while($row_sub = mysql_fetch_array($res_sub)){
            /* include에서 사용 변수 */
            $subSeq = $row_sub['seq'];
            $itemType = $row_sub['itemType'];
            $itemComment = $row_sub['itemComment'];
            

            $que_file = "select * from TuserItemFile where itemSeq = '".$mainSeq."' and itemListSeq = '".$subSeq."'";
            $res_file = mysql_query($que_file);
            $num_file = mysql_num_rows($res_file);
            if($subCnt != 0 ){echo "<hr>";}
            include "include/itemViewOption.php";
            $subCnt++;
        }
        ?>
        
        
    </div>
    <div id="scrollAnsDiv">
        <?
        $que_ans = "select * from TitemAnswerTbl where conSeq='".$_REQUEST['seq']."'";
        $res_ans = mysql_query($que_ans);
        while($row_ans = mysql_fetch_array($res_ans)){
        ?>
            <div class="ansCard px-2 py-1 txt-9">
                <label class="txt-10"><?=getName($row_ans['joinSeq'])?></label>
                <label class="f-right txt-8"><?=$row_ans['answerDateTime']?></label>
                <div> <label><?=$row_ans['answerContents']?></label> </div>
                <div class="likeHateDiv text-right" id="likeHate_<?=$row_ans['seq']?>">
                    <?
                    $likeChk = $hateChk = "far";
                    if($row_ans['joinSeq'] == $_SESSION['loginNum']){
                        $que_lh = "select * from TlikeHateTbl where joinSeq ='".$_SESSION['loginNum']."' and conSeq = '".$row_ans['seq']."' and conType = 'itemAns'";
                        $res_lh = mysql_query($que_lh);
                        $cnt_lh = mysql_num_rows($res_lh);
                        if($cnt_lh>0){
                            $row_lh  = mysql_fetch_array($res_lh);
                            $row_lh['likeHate'] == "like"?  $likeChk = "fas": $hateChk = "fas";
                        }
                    }
                    ?>
                    <label class="c-pointer mr-1 getCnt" id="ansLikeCnt" data-seq="<?=$row_ans['seq']?>" title="<?=getAnsCnt($row_ans['seq'],"itemAns","like")?>"><i class="<?=$likeChk?> fa-thumbs-up"></i> </label>
                    <label class="c-pointer mr-1 getCnt" id="ansHateCnt" data-seq="<?=$row_ans['seq']?>" title="<?=getAnsCnt($row_ans['seq'],"itemAns","hate")?>"><i class="<?=$hateChk?> fa-thumbs-down"></i></label>
                <? if($row_ans['joinSeq'] == $_SESSION['loginNum'] || $_SESSION['loginNum'] == '0'){ ?>
                    <label class="c-pointer deleteCnt"><i class="fas fa-trash-alt"></i></label>
                <? }else{ ?>
                    <label class="c-pointer" id="ansDeclare" data-seq="<?=$row_ans['seq']?>"><i class="fas fa-exclamation-triangle"></i></label>
                <? } ?>
                </div>
            </div>
        <?}?>
    </div>
    <div class="col dAnsWrite p-2">
        <div class="row mb-2">
            <div class="col text-left">
                <?
                $que_heart = "select * from TanotherTbl where joinSeq ='".$_SESSION['loginNum']."' and conSeq = '".$mainSeq."' and type='heart'";
                $res_heart = mysql_query($que_heart);
                $cnt_heart = mysql_num_rows($res_heart);
                $heartChk = $cnt_heart > 0 ?"fas":"far";
                ?>
                <button type="button" class="btn btn-white txt-8" id="heartBtn"><i class="<?=$heartChk?> fa-heart"></i></i></button>
                <input type="button" class="btn btn-white txt-8" id="calBtn" value="일정추가">
            </div>
            <div class="col text-right">
                <?
                $likeChk = $hateChk = "far";
                if($login == "yes"){
                    $que_lh = "select * from TlikeHateTbl where joinSeq ='".$_SESSION['loginNum']."' and conSeq = '".$mainSeq."' and conType = 'item'";
                    $res_lh = mysql_query($que_lh);
                    $cnt_lh = mysql_num_rows($res_lh);
                    if($cnt_lh>0){
                        $row_lh  = mysql_fetch_array($res_lh);
                        $row_lh['likeHate'] == "like"?  $likeChk = "fas": $hateChk = "fas";
                    }
                }
                ?>
                
                <button type="button" class="btn btn-white txt-8" id="likeCnt"><i class="<?=$likeChk?> fa-thumbs-up" ></i></button>
                <button type="button" class="btn btn-white txt-8" id="hateCnt"><i class="<?=$hateChk?> fa-thumbs-down" ></i></button>
                
                <? if($row_main['joinSeq'] == $_SESSION['loginNum'] || $_SESSION['loginNum'] == '0'){ ?>
                <button type="button" class="btn btn-white txt-8" id="delBtn"><i class="fas fa-trash-alt"></i></label></button>
                <? }else{   ?>
                    <button type="button" class="btn btn-white txt-8" data-seq="<?=$_REQUEST['seq']?>" id="postDeclare"><i class="fas fa-exclamation-triangle" ></i></button>
                <?} ?>
                <button type="button" class="btn btn-white txt-8"  id="showAnsWrite" ><i class="fas fa-angle-up" ></i></button>
            </div>
        </div>
        <div class="row pb-0 text-right d-none" id="dAnsWrite">
            <div class="col text-left">    
                <textarea class="form-control col-12 w-100 mb-2" id="ansText"></textarea>
                <input type="button" class="btn btn-white f-right txt-8" id="ansAdd" value="등록">
            </div>
        </div>
    </div>
</div>

<div class="modal " id="imgModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-body _modalBody p-0" ng-switch="invitationStep" >
            <div class="modal-content" >
            </div>
        </div>
    </div>
</div>
<div class="text-center" id="listBtn" onclick="history.back();"><i class="fas fa-list"></i> 목록</div>
<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>

    $(".listItemBox").on({
        "mouseover":function() {
            $(this).find(".itemBigView").removeClass("d-none").addClass("d-flex");
        },
        "mouseout":function() {
            $(this).find(".itemBigView").removeClass("d-flex").addClass("d-none");
        }
    });

    $(".ItemImg").on({
        "mouseover":function() {
            $(this).find(".listItemWrt").removeClass("d-none").addClass("d-flex");
            $(this).find(".showDetail").removeClass("d-none").addClass("d-flex");
            
        },
        "mouseout":function() {
            $(this).find(".listItemWrt").removeClass("d-flex").addClass("d-none");
            $(this).find(".showDetail").removeClass("d-flex").addClass("d-none");
        }
    });
    
    $(document).on("click", "#showAnsWrite", function() {
        $("#dAnsWrite").toggleClass("d-none");
        $(this).find("i").toggleClass("fa-angle-down fa-angle-up");
    });
    $(document).on("click","#ansAdd",function(){
        console.log(loginChk());
        if(loginChk()){
            var ansText = $("#ansText").val();
            if(ansText == ""){
                alert("내용을 입력해주세요.");
                return;
            }
            $.ajax({
                url: "ajax/itemEdit.php",
                type: "POST",
                data: {conSeq:"<?=$mainSeq?>", type:"ansAdd", answerContents:ansText},
                success: function(data){
                    //scrollAnsDiv 구역만 새로고침
                    $("#scrollAnsDiv").load("itemView.php #scrollAnsDiv");
                    $("#ansText").val("");
                }
            });
        }else{
            loginChkClos()
        }
        
    });
    $(document).on("click","#delBtn",function(){
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
                                    url: "ajax/itemEdit.php",
                                    type: "POST",
                                    data: {conSeq:"<?=$mainSeq?>", type:"itemDel"},
                                    success: function(data){
                                        pAlert("info","삭제완료","성공적으로 삭제되었습니다.",true);
                                        location.href="trvmain2.php";
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
    });
    
    $(document).on('click', '#likeCnt',function(){
        if(loginChk()){
            $(this).find("i").toggleClass("fas far");
            $(this).next().find("i").removeClass("fas")
            $(this).next().find("i").addClass("far")
            ansLikeHateCnt(this,"likeHate","like","item");
        }else{
            loginChkClos()
        }
    })
    $(document).on('click', '#hateCnt',function(){
        if(loginChk()){
            $(this).find("i").toggleClass("fas far");
            $(this).prev().find("i").removeClass("fas")
            $(this).prev().find("i").addClass("far")
            ansLikeHateCnt(this,"likeHate","hate","item");
        }else{
            loginChkClos()
        }
    })

    $(document).on('click', '#ansLikeCnt',function(){
        if(loginChk()){
            $(this).find("i").toggleClass("fas far");
            $(this).next().find("i").removeClass("fas")
            $(this).next().find("i").addClass("far")
            ansLikeHateCnt(this,"likeHate","like","itemAns");
        }else{
            loginChkClos()
        }
    })
    $(document).on('click', '#ansHateCnt',function(){
        if(loginChk()){
            $(this).find("i").toggleClass("fas far");
            $(this).prev().find("i").removeClass("fas")
            $(this).prev().find("i").addClass("far")
            ansLikeHateCnt(this,"likeHate","hate","itemAns");
        }else{
            loginChkClos()
        }
    })

    $(document).on('click', '.deleteCnt',function(){
        ansLikeHateCnt(this,"ansDel","del","itemAns");
    })

    function ansLikeHateCnt(thisVal,type,ansType,conType){
        if(conType=="itemAns"){
            var thisId = $(thisVal).parents().attr("id");
            var ansSeq = thisId.replace("likeHate_","");
        }else{
            var ansSeq = "<?=$_REQUEST['seq']?>";
        }
        $.ajax({
            url: "ajax/itemEdit.php",
            type: "POST",
            data: {
                answerContents: $("#ansText").val(),
                conSeq : ansSeq,
                type : type,
                conType : conType,
                ansType : ansType
            },
            success: function(data){
                if(type == "ansDel"){
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
            $("#mType").val("item");
            $("#mConType").val($(this).attr("id"));
            $("#mConSeq").val($(this).data("seq"));
            $("#type").val("item");
        }else{
            loginChkClos()
        }
    })
    $(document).on('click','#heartBtn',function(){
        if(loginChk()){
            $(this).find("i").toggleClass("fas far");
            $.ajax({
                url: "ajax/itemEdit.php",
                type: "POST",
                data: {
                    conSeq : "<?=$_REQUEST['seq']?>",
                    type : 'heart'
                },
                success: function(data){
                    var message= "찜 등록";
                    if(data == "del"){message= "찜 삭제";}
                    mobiscroll.toast({
                        message: message,
                        display: "bottom",
                        color: "gray",
                        closeButton: false
                    });
                }
            });
        }else{
            loginChkClos()
        }
    })
    
    $(document).on('click','#calBtn',function(){
        if(loginChk()){
            $(this).find("i").toggle("일정추가 일정제거");
            $.ajax({
                url: "ajax/ajax_cal_list.php",
                type: "POST",
                data: {
                    conSeq:"<?=$_REQUEST['seq']?>",
                    type : 'item'
                },
                success: function(data){
                    $("#calListModal").find("tbody").html(data);
                    $("#calListModal").find("#itemconSeq").val("<?=$_REQUEST['seq']?>");
                    $("#calListModal").find("#itemtype").val("calander");
                    $("#calListModal").modal("show");
                }
            });
        }else{
            loginChkClos()
        }
    })
    $(document).on('click','#calAddBtn',function(){
        if ($('.calSeq:checked').length === 0) {
            pAlert("error","실패","하나 이상의 체크박스를 선택해야 합니다.",true);
            return false;
        }else{
            $("#itemCalFrm").ajaxSubmit({
                url: 'ajax/itemEdit.php',
                type: 'post',
                success : function(val){
                    $("#calListModal").modal("hide");
                    mobiscroll.toast({
                        message: "일정에 추가되었습니다.",
                        display: "bottom",
                        color: "gray",
                        closeButton: false
                    });
                }
            });
        }
    })
    
</script>