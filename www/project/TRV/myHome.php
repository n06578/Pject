<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";

$thisPage = $_SESSION['homeType'] == "myPost" ?  $_SESSION['viewType']:"";
$cardChkShow = $PageName = "";
switch(@$thisPage) {
    case "home": $PageName = "게시물"; $cardChkShow="d-none"; break;
    case "recent": $PageName = "최근 본 게시물"; break;
    case "cal": $PageName = "일정에 추가된 게시물"; break;
    case "heart": $PageName = "찜한 게시물"; break;
    default: $PageName = "";
}
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" crossorigin="anonymous">
<link rel="stylesheet" href="../../../css/main/cropper.css">
<link rel="stylesheet" href="../../../css/main/main.css">
<div class="main-box h-90 d-none">
    <div class="p-0 m-0 h-100">
        <div class="row h-100">
            <div class="contents-col col px-5 text-lg">
                <div class="showInfoBox">
                    <? include "include/showInfo.php"; ?>
                </div>
                <hr class="hr-navy">
                <?if(@$_SESSION['homeType'] == "myPost"){?>
                <div class="mt-4 text-right">
                    <text class="f-left fw-600 tx-13"><?=$PageName ?></text>
                    <?if($thisPage!="home"){?><input type="button" class="btn btn-sm btn-navy" onclick="location.href='myHomeChk.php?viewType=home'" value="게시물"><?}?>
                    <?if($thisPage!="recent"){?><input type="button" class="btn btn-sm btn-sky ml-1" onclick="location.href='myHomeChk.php?viewType=recent'" value="최근본"><?}?>
                    <?if($thisPage!="cal"){?><input type="button" class="btn btn-sm btn-gray ml-1" onclick="location.href='myHomeChk.php?viewType=cal'" value="일정"><?}?>
                    <?if($thisPage!="heart"){?><input type="button" class="btn btn-sm btn-pink ml-1" onclick="location.href='myHomeChk.php?viewType=heart'" value="찜"><?}?>
                </div>
                <?}?>
                <div class="row mt-1">
                    <?
                    $que_item = HomeViewWhere($_SESSION['viewType'],$_SESSION['goUserNum']);
                    $res_item = mysql_query($que_item);
                    $num_item = mysql_num_rows($res_item);
                    while($row_item = mysql_fetch_array($res_item)) {
                        $mainSeq = $row_item['seq'];
                        $que_sub = "select * from TuserItemList where itemSeq = '".$mainSeq."'";
                        $res_sub = mysql_query($que_sub);
                        $row_sub = mysql_fetch_array($res_sub);


                        $que_file = "select * from TuserItemFile where itemSeq = '".$mainSeq."'";
                        $res_file = mysql_query($que_file);
                        $cnt_file = mysql_num_rows($res_file);
                        $row_file = mysql_fetch_array($res_file);
                        
                        /* include에서 사용하는 변수 */
                        $srcItem = ($cnt_file > 0)? $row_file['filePath']:"";
                        $contentsItem = (@$row_sub['itemComment'] !="") ? nl2br($row_sub['itemComment']) : "";
                        $nameItem = getName($row_item['joinSeq']);

                        include "include/itemCardDiv.php";
                    } if($num_item < 1){ ?>
                        <div class="text-center mt-4 tx-16 fw-600">
                            등록된 게시글이 없습니다.
                        </div>
                    <? } ?>
                </div>
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


<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>

<script src="https://unpkg.com/jquery@3/dist/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap@4/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../../../js/main/cropper.js"></script>

<script>
    $(document).ready(function() {
        $(".listItemWrt").addClass("d-none");
        $(".showDetail").addClass("d-none");
        $(".itemBigView").addClass("d-none");
        
        $(".modal-open").on("click", function() {
            var imgSrc = $(this).find("img").attr("src");
            $(".modal-title").text("이미지");
            $(".modal-body").html("<img src='"+imgSrc+"' class='modalImg' style='height: 90vh;'>");
            $("#imgModal").modal("show");
        });
    });
    $(document).ready(function () {
        let croppers = [];

        const fileInput = $("<input>").attr({
            type: "file",
            accept: "image/*",
            class: "temp-file-input",
            style: "display:none",
        });

        $("body").append(fileInput);

        // 이미지 추가 버튼 클릭 시 파일 선택 창 열기
        $(document).on("click", ".proImgChg", function () {
            fileInput.trigger("click");
            thisBtn = $(this).parent();
        });

        // 파일 선택 후 이미지 추가
        fileInput.on("change", function (event) {
            const file = event.target.files[0];
            const scrollContainer = thisBtn.parent();
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const $newItem = $(`
                        <div class="profileCropper mr-1">
                            <img class="cropped-img" src="${e.target.result}">
                        </div>
                    `);

                    // 이미지 박스를 .imgItemTest에 추가
                    // $(".imgItemBtn").before($newItem);
                    thisBtn.before($newItem);
                    thisBtn.focus();

                    if (croppers.length > 0) {
                        // 모든 기존 Cropper를 destroy
                        croppers.forEach(({ cropper }) => {
                            cropper.destroy();
                        });
                        croppers = [];  // croppers 배열 초기화
                    }

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
                        dragMode : 'move',
                        ready() { 
                            // Cropper가 준비된 후 실행
                            setTimeout(() => {
                                const container = $newItem.find(".cropper-container");
                                container.append('<button type="button" class="btn btn-sm btn-danger txt-white btn-remove-img">X</button>');
                            }, 100);
                        }
                    });

                    croppers.push({ cropper, container: $newItem });
                };
                reader.readAsDataURL(file);
            }
            $(".profileBox").addClass("d-none");
        });

        // 개별 이미지 삭제
        $(document).on("click", ".btn-remove-img", function () {
            $(".profileBox").removeClass("d-none");
            const parent = $(this).closest(".profileCropper");
            croppers = croppers.filter(c => c.container[0] !== parent[0]);
            parent.remove();
        });
        
        $(document).on("click","#infoSave",function(){
            mobiscroll.toast({
                message: "닉네임 중복 검사중...",
                display: "center",
                color: "gray",
                closeButton: false
            });
            $.ajax({
                type: "GET",
                url: "ajax/ajax_nickChk.php", // 데이터를 가져올 서버 URL
                data: {type:"nickChg",nick:$("#nickName").val()},
                success: function(data) {
                    if(data == "ok"){
                        const formData = new FormData($("#infoFrm")[0]);

                        const cropImagePromises = croppers.map(({ cropper, container }, index) => {
                            return new Promise(resolve => {
                                cropper.getCroppedCanvas().toBlob(blob => {
                                    formData.append(`croppedImages[]`, blob, `image.jpg`); // 배열로 보낼 때에는[]를 사용
                                    resolve();
                                }, 'image/jpeg');
                            });
                        });;

                        Promise.all(cropImagePromises).then(() => {
                            $.ajax({
                                url: 'ajax/ajax_info_save.php',
                                type: 'POST',
                                data: formData,
                                processData: false, // FormData 사용 시 processData는 false여야 함
                                contentType: false, // FormData 사용 시 contentType은 false여야 함
                                success : function(val){
                                    mobiscroll.toast({
                                        message: "저장되었습니다.",
                                        display: "center",
                                        color: "gray",
                                        closeButton: false
                                    });
                                    showInfoBox("","add");
                                }
                            });
                        });

                    }else{
                        mobiscroll.toast({
                            message: "닉네임 사용 불가",
                            display: "center",
                            color: "gray",
                            closeButton: false
                        });
                    }
                }
            });
        })
    });
    $(document).on("click","#changInfo, #infoReload",function(){
        showInfoBox("edit","add")
    });

    $(document).on("click","#cancelBtn, #cancelBtn",function(){
        showInfoBox("","add")
    })
    
    
    function showInfoBox(infoType,dbType){
        $.ajax({
            type: "GET",
            url: "include/showInfo.php", // 데이터를 가져올 서버 URL
            data: {showType:infoType,dbType:dbType},
            success: function(data) {
                $(".showInfoBox").html(data);
            }
        });
    }

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

    $(document).on("click","#cardDelBtn",function(){
        // 선택된 체크박스의 값을 가져옵니다.
        var chkData = [];
        var cnt = 0;
        $(".itemChkBox:checked").each(function() {
            console.log($(this).val());
            chkData.push($(this).val());
            cnt++;
        });
        if(cnt < 1){
            pAlert("error","실패","삭제할 게시물을 선택해주세요.",true);
            return false;
        }else{
            const notice = PNotify.info({
                title: '삭제하시겠습니까?',
                text: '해당 게시물 삭제하면 복구가 불가능합니다.',
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
                                    notice.close();
                                    $.ajax({
                                        type: "GET",
                                        url: "ajax/cardItemDel.php", // 데이터를 가져올 서버 URL
                                        data: {pageType:"<?=@$thisPage?>",chkData:chkData},
                                        success: function(data) {
                                            mobiscroll.toast({
                                                message: "삭제되었습니다.",
                                                display: "center",
                                                color: "gray",
                                                closeButton: false
                                            });
                                            location.reload();
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
        }
    });
    
</script>
