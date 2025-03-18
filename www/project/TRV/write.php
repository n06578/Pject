<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" crossorigin="anonymous">
<link rel="stylesheet" href="../../../css/main/cropper.css">
<link rel="stylesheet" href="../../../css/main/main.css">

<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <form action="myTripFrm.php" id="myTripFrm" method="post" enctype="multipart/form-data">
            <table class="table noTable">
                <tr>
                    <td class="w-10 text-blg text-right t-navy tx-18" id="tripArea">여행지</td>
                    <td class="w-75"><input type="text" class="form-control noBorder searchInput mr-4" name="country"></td>
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
                        <div class="imgItemBtn">
                            <button type="button" class="btn w-100 h-100 addImgPart"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <textarea class="form-control" name="textarea[]" rows="6"></textarea>
                </div>
                <div class="addDivBtn mb-5">
                    <button type="button" class="btn w-100 h-100 addDivPart"><i class="fas fa-plus"></i></button>
                </div>
                <span id="currImg"></span>
            </div>
        </form>     
    </div>
</div>

<!-- 템플릿 (숨겨진 상태) -->
<div class="d-none">
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
                <!-- <div class="imgItemTest"></div> -->
                <div class="imgItemBtn">
                    <button type="button" class="btn w-100 h-100 addImgPart"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <textarea class="form-control mt-2" name="textarea[]" rows="6"></textarea>
        </div>
    </div>
</div>

<div class="text-center" id="saveBtn"><i class="fas fa-pen"></i> 올리기</div>

<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>

<script src="https://unpkg.com/jquery@3/dist/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap@4/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../../../js/main/cropper.js"></script>
<script>
$(document).ready(function () {
    let croppers = [];
    let thisBtn = 0;
    // 파일 입력 엘리먼트 미리 생성
    const fileInput = $("<input>").attr({
        type: "file",
        accept: "image/*",
        class: "temp-file-input",
        style: "display:none",
    });

    $("body").append(fileInput);

    // 이미지 추가 버튼 클릭 시 파일 선택 창 열기
    $(document).on("click", ".addImgPart", function () {
        fileInput.trigger("click");
        thisBtn = $(this).parent();
    });

    // 파일 선택 후 이미지 추가
    fileInput.on("change", function (event) {
        const file = event.target.files[0];
        const scrollContainer = thisBtn.parent();
        // console.log(scrollContainer);
        // console.log(scrollContainer.scrollLeft());
        
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const $newItem = $(`
                    <div class="imgItemTest mr-1">
                        <img class="cropped-img" src="${e.target.result}">
                        <button type="button" class="btn btn-sm btn-danger txt-white btn-remove-img">X</button>
                    </div>
                `);

                // 이미지 박스를 .imgItemTest에 추가
                // $(".imgItemBtn").before($newItem);
                thisBtn.before($newItem);
                thisBtn.focus();
                // Cropper 적용
                const imgElement = $newItem.find(".cropped-img")[0];
                const cropper = new Cropper(imgElement, {
                    aspectRatio: 1,
                    viewMode: 0,
                    autoCropArea: 1,
                    movable: true,
                    zoomable: true,
                    rotatable: false,
                    scalable: true,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    background : 'transparent',
                    dragMode : 'move'
                });

                croppers.push({ cropper, container: $newItem });
                scrollToEnd(scrollContainer[0],scrollContainer);
            };
            reader.readAsDataURL(file);
        }
    });

    // 개별 이미지 삭제
    $(document).on("click", ".btn-remove-img", function () {
        const parent = $(this).closest(".imgItemTest");
        croppers = croppers.filter(c => c.container[0] !== parent[0]);
        parent.remove();
    });

    // 저장 버튼 클릭 시 크롭한 이미지 업로드
    $("#saveBtn").click(async function (event) {
        
        return false;
        event.preventDefault();
        // numberChk를 기준으로 각각의 select와 textarea의 name을 변경
        $(".filebox").each(function () {
            // 각 .filebox 내부에서 numberChk 값을 추출
            const numberChkValue = $(this).find('.numberChk').text().trim().replace('# ', '').trim(); // '# 1' -> '1'
            console.log(numberChkValue);
            // 해당 div 안에 있는 select와 textarea의 name 속성 변경
            $(this).find('select').attr('name', `select[${numberChkValue}]`);
            $(this).find('textarea').attr('name', `textarea[${numberChkValue}]`);
        });
        const formData = new FormData($("#myTripFrm")[0]);

        const cropImagePromises = croppers.map(({ cropper, container }, index) => {
            return new Promise(resolve => {
                cropper.getCroppedCanvas().toBlob(blob => {
                    const numberChkValue = $(container).parent().parent().find('.numberChk').text().trim().replace('# ', ''); // numberChk에서 번호를 추출
                    formData.append(`croppedImages[${numberChkValue}][]`, blob, `image${index}.jpg`);
                    resolve();
                }, 'image/jpeg');
            });
        });

        await Promise.all(cropImagePromises);
        mobiscroll.toast({
            message: "게시물 업로드 중...",
            display: "center",
            color: "gray",
            closeButton: false
        });

        $.ajax({
            url: "save_file.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                response = response.split("|");
                if(response[0] == "success"){
                    mobiscroll.toast({
                        message: "업로드 완료",
                        display: "center",
                        color: "gray",
                        closeButton: false
                    });
                    location.href = "itemView.php?seq="+response[1];
                }else{
                    mobiscroll.toast({
                        message: "업로드 실패",
                        display: "center",
                        color: "gray",
                        closeButton: false
                    });
                }
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error("저장 실패:", error);
            }
        });
    });
});

$(document).on("click", ".addDivPart", function() {
    var imgItem = $("#imgDivAdd").html();
    $(this).parent().before(imgItem);
    numberChg();
    $("#mainCardDiv").animate( { scrollTop : $("#mainCardDiv")[0].scrollHeight }, 700 );
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
function scrollToEnd(container,thisDiv) {
    setTimeout(() => {
        thisDiv.animate( { scrollLeft : container.scrollWidth }, 700 );
    }, 0);
}
</script>
