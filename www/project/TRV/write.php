<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <form action="myTripFrm.php" id="myTripFrm" method="post" enctype="multipart/form-data">
            <table class="table noTable">
                <tr>
                    <td class="w-10 text-blg text-right t-navy tx-18" id="tripArea">여행지</td>
                    <td class="w-75"><input type="text" class="form-control noBorder mr-4"></td>
                    <td class="w-15"><input type="button" class="btn btn-white mr-4 w-100 text-blg t-navy" id="searchMap" value="지도에서 찾기"></td>
                    <td class="w-10"><input type="button" class="btn btn-navy w-100 mr-4 text-blg t-white" id="search" value="조회"></td>
            </tr>
            </table>
            <hr class="hr-navy">
            <div class="mx-5">
                <div class="filebox card p-2 mb-4">
                    <div class="d-flex">
                        <p class="text-left w-50 numberChk tx-19 fw-500"># 1</p>
                        <p class="text-right w-50"><input type="button" class="btn btn-sm btn-danger txt-white btn-del" value="삭제"></p>
                    </div>
                    <select class="form-select" name="select[]">
                        <option value="음식">음식</option>
                        <option value="숙소">숙소</option>
                    </select>
                     <div class="x-scroll my-2">
                        <div class="imgItemTest"></div>
                        <div class="imgItemBtn"><button type="button" class="btn w-100 h-100 addImgPart"><i class="fas fa-plus"></i></button></div>
                     </div>
                    <textarea class="form-control" name="textarea[]"></textarea>
                </div>
                <div class="addDivBtn mb-5">
                    <button type="button" class="btn w-100 h-100 addDivPart" ><i class="fas fa-plus"></i></button>
                </div>
                <span id="currImg"></span>
            </div>
        </form>     
    </div>
</div>
<div class="d-none">
    <div id="imgItemAdd">
        <div class="imgItemTest"></div>
    </div>
    <div id="imgDivAdd">
        <div class="filebox card p-2 mb-4">
            <div class="d-flex">
                <p class="text-left w-50 numberChk tx-19 fw-500"># 1</p>
                <p class="text-right w-50"><input type="button" class="btn btn-sm btn-danger txt-white btn-del" value="삭제"></p>
            </div>
            <select class="form-select" name="select[]">
                <option value="음식">음식</option>
                <option value="숙소">숙소</option>
            </select>
            <div class="x-scroll my-2">
                <div class="imgItemTest"></div>
                <div class="imgItemBtn"><button type="button" class="btn w-100 h-100 addImgPart"><i class="fas fa-plus"></i></button></div>
            </div>
            <textarea class="form-control mt-2" name="textarea[]"></textarea>
        </div>
    </div>
</div>
<div class="text-center" id="saveBtn"><i class="fas fa-pen"></i> 올리기</div>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
$("#saveBtn").click(function() {
    
    var frm = $("#myTripFrm");
    frm.submit();
    // $("#myTripFrm").ajaxSubmit({
    //     url: 'ajax/myTripSave.php',
    //     type: 'post',
    //     success : function(val){
    //         mobiscroll.toast({
    //             message: "저장되었습니다.",
    //             display: "center",
    //             color: "gray",
    //             closeButton: true
    //         });
    //         setTimeout(function() {
    //             location.href='myHome.php';
    //         }, 1000);
    //     }
    // });
});

$(document).on("click", ".addImgPart", function() {
    var imgItem = $("#imgItemAdd").html();
    $(this).parent().before(imgItem);
});

$(document).on("click", ".addDivPart", function() {
    var imgItem = $("#imgDivAdd").html();
    $(this).parent().before(imgItem);
    numberChg();
});

$(document).on("click",".btn-del",function(){
    $(this).parent().parent().parent().remove();
    numberChg();
})
function numberChg(){
    var number = 1;
    $(".numberChk").each(function() {
        $(this).html("# "+number);
        number++;
    });
}
</script>