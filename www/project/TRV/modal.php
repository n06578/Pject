
<div class="modal " id="imgModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-body _modalBody p-0" ng-switch="invitationStep">
            <div class="modal-content2" ></div>
        </div>
    </div>
</div>
<!-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpj9mhqC5Vd2Wn6FXPqEr5crupY0FRKXg&callback=console.debug&libraries=maps,marker&v=beta"></script> -->
<div class="modal " id="mapModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body _modalBody" ng-switch="invitationStep" style="height: 90vh;">
                <!-- <gmp-map center="40.12150192260742,-100.45039367675781" zoom="4" map-id="DEMO_MAP_ID">
                    <gmp-advanced-marker position="40.12150192260742,-100.45039367675781" title="My location"></gmp-advanced-marker>
                </gmp-map> -->
            </div>
        </div>
    </div>
</div>

<div class="modal" id="searchModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-fit">
        <div class="modal-content">
            <div class="modal-body _modalBody" ng-switch="invitationStep" style="height: 90vh;">
                <? include "test.php";?>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="monePWModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body _modalBody" ng-switch="invitationStep">
                <input type="password" id="monePWInput">
                <input type="button" id="monePwBtn" value="등록">
            </div>
        </div>
    </div>
</div>
<div class="modal" id="moneDeclare" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body _modalBody d-grid" ng-switch="invitationStep">
                <input type="hidden" name="mType" id="mType" val="">
                <input type="hidden" name="mConType" id="mConType" val="">
                <input type="hidden" name="mConSeq" id="mConSeq" val="">
                <input type="text" name="mDeclareReason" id="declareReason" class="form-control" placeholder="신고사유를 작성해주세요.">
                <font class="text-left txt-7 mt-1" color="red">※ 악의적인 신고는 자재해주세요. ※</font>
                <input type="button" id="decalreBtn" class="btn btn-sm btn-danger mt-1" value="신고하기">
            </div>
        </div>
    </div>
</div>


<script>
    $(".modal-open").on("click", function() {
        var imgSrc = $(this).find("img").attr("src");
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
</script>