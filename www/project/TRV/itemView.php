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
    $(document).ready(function() {
        $(".modal-open").on("click", function() {
            var imgSrc = $(this).find("img").attr("src");
            $(".modal-title").text("이미지");
            $(".modal-body").html("<img src='"+imgSrc+"' class='modalImg' style='height: 90vh;'>");
            $("#imgModal").modal("show");
        });
    });

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