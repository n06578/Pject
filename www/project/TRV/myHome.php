<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";

?>
<div class="main-box h-90 d-none">
    <div class="p-0 m-0 h-100">
        <div class="row h-100">
            <div class="contents-col col px-5 text-lg">
                <div class="showInfoBox">
                    <? include "include/showInfo.php"; ?>
                </div>
                <hr class="hr-navy">
                <div class="row mt-4">
                    <?
                    $Where = HomeViewWhere($_SESSION['viewType'],$_SESSION['goUserNum']);
                    $que_item = "select * from TuserItem where 1=1 $Where order by writeDate desc";
                    $res_item = mysql_query($que_item);
                    $num_item = mysql_num_rows($res_item);
                    while($row_item = mysql_fetch_array($res_item)) {
                        $mainSeq = $row_item['seq'];
                        $que_sub = "select * from TuserItemList where itemSeq = '".$mainSeq."'";
                        $res_sub = mysql_query($que_sub);
                        $row_sub = mysql_fetch_array($res_sub);


                        $que_file = "select * from TuserItemFile where itemSeq = '".$mainSeq."'";
                        $res_file = mysql_query($que_file);
                        $row_file = mysql_fetch_array($res_file);
                    ?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-500 py-2 c-pointer">
                            <div class="card-body listItem p-2">
                                <div class="listItemBox modal-open" data-bs-toggle="modal" data-bs-target="#imgModal">
                                    <img class="listItemImg" src="<?=$row_file['filePath']?>">
                                    
                                    <div class="itemBigView text-right txt-7">
                                        크게보기
                                    </div>
                                </div>
                                <div class="listItemCon pt-2" onclick="location.href='itemView.php?seq=<?=$mainSeq?>'" title="<?=$row_sub['itemComment']?>">
                                    <?=$row_sub['itemComment']?>
                                    <div class="showDetail text-right txt-6">
                                        자세히보기
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?} if($num_item < 1){ ?>
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
    $(document).on("click","#changInfo, #infoReload",function(){
        showInfoBox("edit","add")
    });

    $(document).on("click","#cancelBtn, #infoReload",function(){
        showInfoBox("","add")
    })
    
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
                    $("#infoFrm").ajaxSubmit({
                        url: 'ajax/ajax_info_save.php',
                        type: 'post',
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
    
</script>