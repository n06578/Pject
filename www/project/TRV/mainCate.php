<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
if($_SESSION['searchCountry'] == ""){
    echo "<script>location.href='trvMain2.php'</script>";
}
?>
<div class="main-box h-90 d-none">
    <div class="p-0 m-0 h-100">
        <div class="row h-100">
            <div class="contents-col col ml-2 p-5 pt-2 text-lg" id="mainCardDiv">
                <table class="table noTable">
                    <tr>
                        <td class="w-15 text-blg text-right t-navy tx-18 lh-40" id="tripArea">여행지</td>
                        <td class="w-70">
                            <div class="search-div d-none">
                                
                            </div>
                            <input type="text" class="form-control noBorder searchInput mr-4" value="<?=$_SESSION['searchCountry']?>">
                        </td>
                        <td class="w-10"><input type="button" class="btn btn-sm btn-navy w-100 mr-4 text-blg t-white" id="search" value="조회"></td>
                        <? $addClass =$_SESSION['searchCountry'] == ""?"d-none":"";?>
                        <td class="w-10"><input type="button" class="btn btn-sm btn-warning w-100 mr-4 text-blg <?=$addClass?>" id="clear" value="초기화"></td>
                        <td class="w-10"><input type="button" class="btn btn-sm btn-white mr-4 w-100 text-blg t-navy <?=$addClass?>" id="searchMap" value="위치 확인" data-bs-toggle="modal" data-bs-target="#mapModal"></td>
                    </tr>
                </table>
                <hr class="hr-navy">
                
                <div class="container">
                    <div class="row">
                        <!-- 첫 번째 열 (3행 병합) -->
                        <div class="col-4">
                            <div class="cateBox merged-box" style="height: 100%; min-height: 240px;">
                                <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn1" data-text="전체보기">
                                    <img src="../../img/trv/cateBtn.png" class="mb-3" style="width:60%;"><br>
                                    전체보기
                                </button>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4 cateBox">
                                    <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn2" data-text="음식">
                                        <i class="fas fa-utensils mb-2"></i><br>
                                        음식
                                    </button>
                                </div>
                                <div class="col-4 cateBox">
                                    <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn3" data-text="관광">
                                        <i class="fas fa-tram mb-2"></i><br>
                                        관광
                                    </button>
                                </div>
                                <div class="col-4 cateBox">
                                    <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn4" data-text="쇼핑">
                                        <i class="fas fa-weight-hanging mb-2"></i><br>
                                        쇼핑
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 cateBox">
                                    <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn5" data-text="패션">
                                        <i class="fas fa-tshirt mb-2"></i><br>
                                        패션
                                    </button>
                                </div>
                                <div class="col-4 cateBox">
                                    <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn6" data-text="문화">
                                        <i class="fas fa-mortar-pestle mb-2"></i><br>
                                        문화
                                    </button>
                                </div>
                                <div class="col-4 cateBox">
                                    <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn7" data-text="휴양">
                                        <i class="fas fa-umbrella-beach mb-2"></i><br>
                                        휴양
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 cateBox">
                                    <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn8" data-text="교통">
                                        <i class="fas fa-train mb-2"></i><br>
                                        교통
                                    </button>
                                </div>
                                <div class="col-4 cateBox">
                                    <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn9" data-text="숙소">
                                        <i class="fas fa-hotel"></i><br>
                                        숙소
                                    </button>
                                </div>
                                <div class="col-4 cateBox">
                                    <button type="button" class="btn btn-primary w-100 h-100 p-1 fw-600 tx-16 cateBtn" id="cateBtn10" data-text="이색여행">
                                        <i class="fas fa-magic mb-2"></i><br>
                                        이색여행
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="listView d-none">
                    <div class="row mt-5">
                        <div class="card">
                            <div class="card-body tx-12 text-center">
                                <div class="row px-4">
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk1"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk1" value="전체보기" <?=checkBoxChk("전체보기")?>>전체보기</label>
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk2"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk2" value="음식" <?=checkBoxChk("음식")?>>음식</label>
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk3"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk3" value="관광" <?=checkBoxChk("관광")?>>관광</label>
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk4"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk4" value="쇼핑" <?=checkBoxChk("쇼핑")?>>쇼핑</label>
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk5"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk5" value="패션" <?=checkBoxChk("패션")?>>패션</label>
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk6"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk6" value="문화" <?=checkBoxChk("문화")?>>문화</label>
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk7"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk7" value="휴양" <?=checkBoxChk("휴양")?>>휴양</label>
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk8"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk8" value="교통" <?=checkBoxChk("교통")?>>교통</label>
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk9"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk9" value="숙소" <?=checkBoxChk("숙소")?>>숙소</label>
                                    <label class="col p-0 d-flex lh-24 mb-0" for="cateChk10"><input type="checkbox" class="form-checkbox cateChk mr-2" id="cateChk10" value="이색여행" <?=checkBoxChk("숙소")?>>이색여행</label>
                                    <button type="button" class="col p-0 btn btn-sm btn-success" id="cateChgBtn">변경</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 itemListView">
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<?
function checkBoxChk($data){
    if (in_array("전체보기", $_SESSION['cateViewList'])) { return "checked";}
    if (in_array($data, $_SESSION['cateViewList'])) {return "checked";}
}
?>
<div class="text-center" id="writeBtn"><i class="fas fa-list"></i> 목록보기</div>
<!-- <div class="text-center" id="writeBtn" onclick="location.href='trvmain2.php'"><i class="fas fa-list"></i> 목록보기</div> -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
    
    $(document).ready(function() {
        if("<?=@$_SESSION['cateView']?>" == "cateList"){
            $("#cateChgBtn").click();
            $(".container").addClass("d-none");
        }else{
            $(".listItemWrt").addClass("d-none");
            $(".showDetail").addClass("d-none");
            $(".itemBigView").addClass("d-none");
        }
        
        // 버튼 클릭 시 맨 위로 이동
        $("#cateBtn").on("click", function() {
            location.href = "mainCate.php";
        });
        
        $(document).not(".search-div").click(function() {
            $(".search-div").addClass("d-none");
        });
        
        $(".listItemBox").on({
            "mouseover":function() {
                $(this).find(".itemBigView").removeClass("d-none").addClass("d-flex");
            },
            "mouseout":function() {
                $(this).find(".itemBigView").removeClass("d-flex").addClass("d-none");
            }
        });

        $(".listItem").on({
            "mouseover":function() {
                $(this).find(".listItemWrt").removeClass("d-none").addClass("d-flex");
                $(this).find(".showDetail").removeClass("d-none").addClass("d-flex");
                
            },
            "mouseout":function() {
                $(this).find(".listItemWrt").removeClass("d-flex").addClass("d-none");
                $(this).find(".showDetail").removeClass("d-flex").addClass("d-none");
            }
        });
    });

    $(document).on("click","#clear",function(){
        $.ajax({
            url: "include/itemListView.php",
            type: "POST",
            data: "search=clear&pageName=mainCate&",
            success: function (data) {
                location.href="trvmain2.php";
            }
        });
    });

    $(document).on("click","#cateBtn",function(){
        location.href = "mainCate.php";
    });
    
    $(document).on("click","#search",function(){
        // alert("여행지를 선택해주세요");
        if($(".searchInput").val()!=""){
            $.ajax({
                url: "include/itemListView.php",
                type: "POST",
                data: "search=ajax&pageName=mainCate&searchCountry="+$(".searchInput").val(),
                success: function (data) {
                    $("#searchMap").removeClass("d-none")
                    $("#clear").removeClass("d-none");
                    location.reload();
                }
            });
        }else{
            pAlert("error","실패","여행지를 선택해주세요.",true);
        }
    });
    
    var formData = new FormData();

    $(document).on("click", ".cateBtn", function() {
        $('.cateChk').prop('checked', false);
        if ($(this).data("text") == "전체보기") {
            $('.cateChk').prop('checked', true);
        } else {
            $('.cateChk[value="' + $(this).data("text") + '"]').prop('checked', true);
        }
        formData.append('cate[]', $(this).data("text"));  // cate[]로 배열처럼 값을 추가
        getCateList();
    });

    $(document).on("click","#cateChk1",function(){
        if($(this).prop('checked')){
            $('.cateChk').prop('checked', true);
        }else{
            $('.cateChk').prop('checked', false);
        }
    })

    $(document).on("click", "#cateChgBtn", function() {
        if ($('.cateChk:checked').length === 0) {
            pAlert("error", "실패", "하나 이상의 항목을 선택해야 합니다.", true);
            return false;
        } else {
            $('.cateChk:checked').each(function() {
                formData.append('cate[]', $(this).val());  // cate[]로 배열처럼 값을 추가
            });
        }
        getCateList();  // 카테고리 리스트 업데이트
    });

    // getCateList 함수에서 AJAX 호출
    function getCateList() {
        formData.set('cateView', "cateList");
        $.ajax({
            url: "include/cateSession.php",
            type: "POST",
            data: formData,  // FormData 객체를 그대로 전달
            processData: false,  // FormData 사용 시 기본적으로 false로 설정
            contentType: false,  // contentType도 false로 설정
            success: function(data) {
                $.ajax({
                    url: "include/cateListView.php",
                    type: "POST",
                    data: formData,  // FormData 객체를 그대로 전달
                    processData: false,  // FormData 사용 시 기본적으로 false로 설정
                    contentType: false,  // contentType도 false로 설정
                    success: function(data) {
                        $(".itemListView").html(data);
                        $(".container").addClass("d-none");
                        $(".listView").removeClass("d-none");
                        formData = new FormData();  // 새 FormData 객체로 초기화

                    }
                });
            }
        });
    }


    $(document).on("click","#writeBtn",function(){
        formData.set('cateView', "cateMain");
        $.ajax({
            url: "include/cateSession.php",
            type: "POST",
            data: formData,  // FormData 객체를 그대로 전달
            processData: false,  // FormData 사용 시 기본적으로 false로 설정
            contentType: false,  // contentType도 false로 설정
            success: function(data) {
                $(".listView").addClass("d-none")
                $(".container").removeClass("d-none")
            }
        })
    })

</script>