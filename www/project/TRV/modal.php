
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
                <input type="password" class="form-control mr-1" id="monePWInput">
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

<!-- 약관동의 활성화 -->
<div class="modal" id="joinAgreeMdl" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body _modalBody d-grid" ng-switch="invitationStep">
                <div class="card show1">
                    <div class="card-header text-left pl-3 m-0 py-2">
                        <h5 class="card-title m-0">이용약관 동의</h5>[필수]
                    </div>
                    <div class="card-body text-left">
                        <b>제1조 (목적)</b><br>
                        이 약관은 TRV(이하 ‘서비스’)를 이용함에 있어 이용자의 권리, 의무 및 책임사항을 규정합니다.
                        <br><br>
                        <b>제2조 (서비스 내용)</b><br>
                        TRV는 여행 관련 게시글을 등록, 열람, 저장할 수 있는 플랫폼을 제공합니다.
                        사용자는 카테고리를 선택해 게시물을 작성할 수 있으며, 원하는 게시물을 일정에 저장할 수 있습니다.
                        <br><br>
                        <b>제3조 (이용자의 의무)</b><br>
        
                        타인의 정보를 도용하거나 부정한 행위를 해서는 안 됩니다.
        
                        게시물에 허위정보, 음란물, 혐오 표현 등 부적절한 내용을 올릴 수 없습니다.
        
                        서비스의 정상적인 운영을 방해하는 행위를 해서는 안 됩니다.
                        <br><br>
                        <b>제4조 (게시물 관리)</b><br>
                        이용자가 작성한 게시물은 TRV가 운영하는 기준에 따라 노출 또는 삭제될 수 있습니다.
                        부적절하거나 신고된 게시물은 사전 통보 없이 삭제될 수 있습니다.
                        <br><br>
                        <b>제5조 (서비스의 변경 및 중단)</b><br>
                        TRV는 서비스의 일부 또는 전부를 사전 공지 후 변경하거나 중단할 수 있습니다.
                    </div>
                    <div class="card-footer text-right bg-white f-bottom">
                        <input type="button" class="btn btn-success t-white" id="joinAgreeBtn1" value="동의합니다.">
                        <input type="button" class="btn btn-danger t-white" id="joinDisagreeBtn1" value="동의하지 않습니다.">
                    </div>
                </div>
                <div class="card show2 d-none">
                    <div class="card-header text-left pl-3 m-0 py-2">
                        <h5 class="card-title m-0">개인정보 처리방침</h5>[필수]
                    </div>
                    <div class="card-body text-left">
                    <b>수집 항목</b><br>
                        필수: 닉네임, 이메일<br>
                        선택: 프로필 사진, 여행 일정 정보, 저장한 게시물 목록<br>
                    <b>수집 목적</b><br>
                        게시글 작성 및 열람<br>
                        일정 저장 기능 제공<br>
                        맞춤형 서비스 제공 및 개선<br>
                    <b>보유 및 이용 기간</b><br>
                        회원 탈퇴 시까지 또는 관련 법령에 따른 보관 기간 동안 보유합니다.<br>
                    <b>제3자 제공</b><br>
                        TRV는 이용자의 동의 없이 개인정보를 외부에 제공하지 않습니다.<br>
                    <b>개인정보 보호 책임자</b><br>
                        문의처: [trv@yourdomain.com]<br>
                        전화번호: [123-456-7890]<br>
                        문의가능시간 : 평일 09:00~18:00<br>
                    </div>

                    <div class="card-footer text-right bg-white f-bottom">
                        <input type="button" class="btn btn-success t-white" id="joinAgreeBtn2" value="동의합니다.">
                        <input type="button" class="btn btn-danger t-white" id="joinDisagreeBtn2" value="동의하지 않습니다.">
                    </div>
                </div>
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
                                    <td><input type="checkbox" id="calChkAll"></td>
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
    $(document).on("click","#calChkAll",function(){
        if($(this).is(":checked")){
            $(".calSeq").prop("checked",true);
        }else{
            $(".calSeq").prop("checked",false);
        }
    })
</script>