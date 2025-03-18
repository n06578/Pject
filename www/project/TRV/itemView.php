<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
$mainSeq = $_REQUEST['seq'];

$que_main = "select * from TuserItem where seq = '".$mainSeq."'";
$res_main = mysql_query($que_main);
$row_main = mysql_fetch_array($res_main);
$country = $row_main['country'];

$que_sub = "select * from TuserItemList where itemSeq = '".$mainSeq."'";
$res_sub = mysql_query($que_sub);
?>
<div class="main-box item-box h-90">
    <div class="h-100 p-3" id="mainCardDiv">
        <div class="dTripArea t-navy tx-19 mb-4 fw-600"><?=$country?></div>
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
        $que_ans = "select * from TcommuniAnswerTbl where conSeq='3' and conType='gongji'";
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
    <div class="col dAnsWrite p-2">
        <div class="row mb-2">
            <div class="col text-left">
                <input type="button" class="btn btn-white txt-8" id="ansAdd" value="일정추가">
            </div>
            <div class="col text-right">
                <button type="button" class="btn btn-white txt-8" ><i class="far fa-thumbs-up" ></i></button>
                <button type="button" class="btn btn-white txt-8" ><i class="far fa-thumbs-down" ></i></button>
                <button type="button" class="btn btn-white txt-8" ><i class="fas fa-exclamation-triangle" ></i></button>
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
</script>