<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>

<div class="main-box h-90 d-none">
    <div class="p-0 m-0 h-100">
        <div class="row h-100">
            <!-- <div class="sub-col mb-2">
                <aside class="side-bar list1">
                    <ul><li><a href="#" id="menu1">인기</a></li></ul>
                </aside>
                <aside class="side-bar list2">
                    <ul><li><a href="#" id="menu2">추천</a></li></ul>
                </aside>
                <aside class="side-bar list3">
                    <ul><li><a href="#" id="menu3">찜</a></li></ul>
                </aside>
                <aside class="side-bar list4">
                    <ul><li><a href="#" id="menu4">친구들</a></li></ul>
                </aside>
            </div> -->
            <div class="contents-col col ml-2 p-5 pt-2 text-lg" id="mainCardDiv">
                <table class="table noTable">
                    <tr>
                        <td class="w-15 text-blg text-right t-navy tx-18 lh-40" id="tripArea">여행지</td>
                        <td class="w-70">
                            <div class="search-div d-none">
                                
                            </div>
                            <input type="text" class="form-control noBorder searchInput mr-4">
                        </td>
                        <td class="w-15"><input type="button" class="btn btn-sm btn-white mr-4 w-100 text-blg t-navy" id="searchMap" value="위치 확인" data-bs-toggle="modal" data-bs-target="#mapModal"></td>
                        <td class="w-10"><input type="button" class="btn btn-sm btn-navy w-100 mr-4 text-blg t-white" id="search" value="조회"></td>
                    </tr>
                </table>
                <hr class="hr-navy">
                <div class="row mt-5">
                    <?
                    for($i=0; $i<40; $i++) {
                        $j = $i;
                        if($i > 7 ){
                            $j = $i%8;
                        }
                    ?>
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card h-500 py-2 c-pointer listItemCard">
                            <div class="card-body listItem p-2">
                                <div class="listItemBox modal-open" data-bs-toggle="modal" data-bs-target="#imgModal">
                                    <img class="listItemImg" src="../../test/capture_20250305081728.png">
                                    
                                    <div class="itemBigView text-right tx-10">
                                        크게보기
                                    </div>
                                </div>
                                <div class="listItemCon pt-2" title="내용이 아마도 이곳에?내용이 아마도 이곳에?내용이 아마도 이곳에?
                                    내용이 아마도 이곳에?
                                    내용이 아마도 이곳에?
                                    내용이 아마도 이곳에?내용이 아마도 이곳에?내용이 아마도 이곳에?내용이 아마도 이곳에?">
                                    내용이 아마도 이곳에?
                                    내용이 아마도 이곳에?
                                    내용이 아마도 이곳에?
                                    내용이 아마도 이곳에?
                                    내용이 아마도 이곳에?
                                    내용이 아마도 이곳에?내용이 아마도 이곳에?내용이 아마도 이곳에?내용이 아마도 이곳에?
                                    <div class="listItemWrt text-right tx-10">
                                        작성자
                                    </div>
                                    <div class="showDetail text-right tx-10" onclick="location.href='trvView.php'">
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
<div class="text-center" id="cateBtn"><i class="fas fa-arrow-up"></i> 카테고리로 보기</div>
<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
    
    $(document).ready(function() {
        $(".listItemWrt").addClass("d-none");
        $(".showDetail").addClass("d-none");
        $(".itemBigView").addClass("d-none");
        

        
        // 버튼 클릭 시 맨 위로 이동
        $("#cateBtn").on("click", function() {
            location.href = "mainCate.php";
        });
        
        $(".searchInput").on("click", function() {
            $(".search-div").removeClass("d-none")
            $("#searchModal").modal("show");
        });

        $(document).not(".search-div").click(function() {
            $(".search-div").addClass("d-none");
        });
        
		$("#searchClose").on("click",function(){
			$("#searchModal").modal("hide")
		})
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