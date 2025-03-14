<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
$que_home = "select * from TjoinTbl where seq = '".$_SESSION['goUserNum']."'";
$res_home = mysql_query($que_home);
$row_home = mysql_fetch_array($res_home);
?>
<div class="main-box h-90 d-none">
    <div class="p-0 m-0 h-100">
        <div class="row h-100">
            <div class="contents-col col px-5 text-lg">
                <table class="table noTable tx-14">
                    <tr>
                        <td class="w-30" rowspan="5">
                            <div class="card ">
                                <div class="card-body listItem p-2">
                                    <div class="profileBox modal-open" data-bs-toggle="modal" data-bs-target="#imgModal">
                                        <img class="listItemImg" src="../../img/trv/listItem/item1.jpg">
                                        
                                        <div class="itemBigView text-right txt-7 d-none">
                                            크게보기
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="fw-800 tx-18 w-30"><?=$row_home['nickName']?></td>
                        <td class="w-35 text-right">
                            <span class="fw-800">국내여행횟수</span>
                            <span>0</span>
                        </td>
                        <td class="w-35 text-left pl-4">
                            <span class="fw-800">국외여행횟수</span>
                            <span>0</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="fw-800">한줄소개</td>
                    </tr>
                    <tr>
                        <td colspan="3">한줄소개</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="fw-800">추구하는 여행 스타일</td>
                    </tr>
                    <?
                    if($_SESSION['goUserNum'] == $_SESSION['loginNum']) {
                    ?>
                    <tr>
                        <td colspan="3" class="text-right">
                           <a href="#" class="btn btn-sm btn-warning">
                                <span class="text">변경내용 초기화</span>
                            </a>
                            <a href="#" class="btn btn-sm btn-success">
                                <span class="text">저장</span>
                            </a>
                        </td>
                    </tr>
                    <?}?>
                </table>
                <hr class="hr-navy">
                <div class="row mt-4">
                    <?
                    $Where = HomeViewWhere($_SESSION['viewType'],$_SESSION['goUserNum']);
                    $que_item = "select * from TuserItem where 1=1 joinSeq ='".$_SESSION['goUserNum']."' order by writeDate desc";
                    $res_item = mysql_query($que_item);
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
                    <?}?>
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