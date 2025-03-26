
<!-- 이미지 확대 보기 -->
<div class="modal " id="imgModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-body _modalBody p-0" ng-switch="invitationStep">
            <div class="modal-content2" ></div>
        </div>
    </div>
</div>
<!-- google 지도 보기 -->
<div class="modal " id="mapModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-body _modalBody" ng-switch="invitationStep" style="height: 90vh;">
            </div>
        </div>
    </div>
</div>
<!-- 여행지 select 활성화  -->
<div class="modal" id="searchModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-fit">
        <div class="modal-content">
            <div class="modal-body _modalBody" ng-switch="invitationStep" style="height: 90vh;">
                <? include "tripSearch.php";?>
            </div>
        </div>
    </div>
</div>
<!-- 로그인 안했을 경우 비밀번호로 문의 보기 활성화 -->
<div class="modal" id="monePWModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title">비밀번호를 입력해주세요</h7>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body _modalBody d-flex" ng-switch="invitationStep">
                <input type="hidden" id="mSeq">
                <input type="password" class="form-control" id="monePWInput">
                <input type="button" class="btn btn-sm btn-navy txt-white" id="monePwBtn" value="확인">
            </div>
        </div>
    </div>
</div>
<!-- 문의 신고하기 활성화 -->
<div class="modal" id="moneDeclare" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body _modalBody d-grid" ng-switch="invitationStep">
                <input type="hidden" name="mType" id="mType" val="">
                <input type="hidden" name="mConType" id="mConType" val="">
                <input type="hidden" name="mConSeq" id="mConSeq" val="">
                <input type="hidden" name="type" id="type" val="">
                <input type="text" name="mDeclareReason" id="declareReason" class="form-control" placeholder="신고사유를 작성해주세요.">
                <font class="text-left txt-7 mt-1" color="red">※ 악의적인 신고는 제재대상입니다. ※</font>
                <input type="button" id="declareBtn" class="btn btn-sm btn-danger mt-1" value="신고하기">
            </div>
        </div>
    </div>
</div>
<!-- 일정 리스트 모달 -->
<div class="modal " id="calListModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body _modalBody" ng-switch="invitationStep" style="height: 90vh;">
                <div class="h-95">
                    <form id="itemCalFrm">
                        <input type="hidden" name="conSeq" id="itemconSeq">
                        <input type="hidden" name="type" id="itemtype">
                        <table class="table table-border table-hover tx-13">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>일정명</td>
                                    <td>일정시작일</td>
                                    <td>일정종료일</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </form>
                </div>
                <div class="text-right">
                    <input type="button" class="btn btn-sm btn-success" id="calAddBtn" value="일정에 추가">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".modal-open").on("click", function() {
        if($(this).hasClass("dItemImg")){
            var imgSrc = $(this).attr("src");
        }else{
            var imgSrc = $(this).find("img").attr("src");
        }
        $(".modal-title").text("이미지");
        $("#imgModal").find(".modal-body").html("<img src='"+imgSrc+"' class='modalImg' style='height: 90vh;'>");
        $("#imgModal").modal("show");
    });

    
    $("#searchMap").on("click", function() {
        $.ajax({
            type: "GET",
            url: "ajax/gMap.php",
            dataType: "html",
            success: function (data) {
                $("#mapModal").find(".modal-body").html(data);
                $("#mapModal").modal("show");
            }
        });
    });

    $(".searchInput").on("click", function() {
        $(".search-div").removeClass("d-none")
        $("#searchModal").modal("show");
    });
    
    $("#searchClose").on("click",function(){
        $("#searchModal").modal("hide")
    })
    $(document).on("click","#declareBtn",function(){
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
                    Type : $("#type").val()
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