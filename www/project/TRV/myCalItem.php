<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
$cardItemCol = "col-xl-3";
$cardChkShow = "";
$que = "select * from TcalanderTbl where seq = '".$_REQUEST['seq']."'";
$res = mysql_query($que);
$row = mysql_fetch_array($res);
?>
<div class="main-box h-90 d-none">
    <div class="p-0 m-0 h-100">
        <div class="row h-100">
            <div class="contents-col col px-5 text-lg">
                <div class="card tx-12 mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="text-center col-1"><b>일정명</b></div>
                            <div class="col"><?=$row['title']?></div>
                            <hr class ="hr-navy py-1 p-0 m-0">
                        </div>
                        <div class="row">
                            <div class="text-center col-1"><b>일정소명</b></div>
                            <div class="col"><?=$row['subTitle']?></div>
                            <hr class ="hr-navy py-1 p-0 m-0">
                        </div>
                        <div class="row">
                            <div class="text-center col-1"><b>일정시작일</b></div>
                            <div class="col"><?=substr($row['startDateTime'],0,10)?></div>
                            <hr class ="hr-navy py-1 p-0 m-0">
                        </div>
                        <div class="row">
                            <div class="text-center col-1"><b>일정종료일</b></div>
                            <div class="col"><?=substr($row['endDateTime'],0,10)?></div>
                            <hr class ="hr-navy py-1 p-0 m-0">
                        </div>
                        <div class="row">
                            <div class="text-center col-1"><b>일정메모</b></div>
                            <div class="col"><?=$row['contents']?></div>
                        </div>
                    </div>
                </div>
                <hr class="hr-navy">
                <div class="row mt-4">
                    <?
                    $que_item = "select * from TcalanItemTbl where calanSeq='".$_REQUEST['seq']."' order by addDateTime desc";
                    $res_item = mysql_query($que_item);
                    $num_item = mysql_num_rows($res_item);
                    while($row_item = mysql_fetch_array($res_item)) {
                        $mainSeq = $row_item['itemSeq'];
                        $que_sub = "select * from TuserItemList where itemSeq = '".$mainSeq."'";
                        $res_sub = mysql_query($que_sub);
                        $row_sub = mysql_fetch_array($res_sub);


                        $que_file = "select * from TuserItemFile where itemSeq = '".$mainSeq."'";
                        $res_file = mysql_query($que_file);
                        $cnt_file = mysql_num_rows($res_file);
                        $row_file = mysql_fetch_array($res_file);
                        /* include에서 사용하는 변수 */
                        $srcItem = ($cnt_file > 0)? "".$row_file['filePath']:"";
                        $contentsItem = (@$row_sub['itemComment'] !="") ? nl2br($row_sub['itemComment']) : "";
                        $nameItem = getName($row_item['joinSeq']);

                        include "include/itemCardDiv.php";
                    }
                    if($num_item < 1){
                        echo "<div class='text-center'>등록된 게시물이 없습니다.</div>";
                    }
                    ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<div class="text-center <?=$cardChkShow?> position1" id="cardDelBtn"><i class="fas fa-trash-alt"></i> 삭제</div>
<div class="text-center" id="listBtn" onclick="history.back();"><i class="fas fa-list"></i> 일정보기</div>

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
                                        data: {pageType:"cal",chkData:chkData,calSeq : "<?=$_REQUEST['seq']?>"},
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