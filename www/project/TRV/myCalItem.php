<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
$cardItemCol = "col-xl-3";
?>
<div class="main-box h-90 d-none">
    <div class="p-0 m-0 h-100">
        <div class="row h-100">
            <div class="contents-col col px-5 text-lg">
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
                        $srcItem = ($cnt_file > 0)? "../".$row_file['filePath']:"";
                        $contentsItem = (@$row_sub['itemComment'] !="") ? nl2br($row_sub['itemComment']) : "";
                        $nameItem = getName($row_item['joinSeq']);

                        include "include/itemCardDiv.php";
                    }
                    ?>
                </div>
            </div> 
        </div>
    </div>
</div>
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
    
</script>