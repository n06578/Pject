<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>

<div class="main-box h-90 d-none">
    <div class="p-0 m-0 h-100">
        <div class="row h-100">
            <div class="contents-col col ml-2 p-5 pt-2 text-lg" id="mainCardDiv">
                <table class="table noTable">
                    <tr>
                        <td class="w-15 text-blg text-right t-navy tx-18 lh-40" id="tripArea">여행지</td>
                        <td class="w-70">
                            <div class="search-div d-none">
                                
                            </div>
                            <input type="text" class="form-control noBorder searchInput mr-4" value="<?=$_SESSION['searchCountry']?>">
                        </td>
                        <td class="w-10"><input type="button" class="btn btn-sm btn-navy w-100 mr-4 text-blg t-white" id="search" value="조회"></td>
                        <? $addClass =$_SESSION['searchCountry'] == ""?"d-none":"";?>
                        <td class="w-10"><input type="button" class="btn btn-sm btn-warning w-100 mr-4 text-blg <?=$addClass?>" id="clear" value="초기화"></td>
                        <td class="w-10"><input type="button" class="btn btn-sm btn-white mr-4 w-100 text-blg t-navy <?=$addClass?>" id="searchMap" value="위치 확인" data-bs-toggle="modal" data-bs-target="#mapModal"></td>
                    </tr>
                </table>
                <hr class="hr-navy">
                <div class="row mt-5 itemListView">
                    <? include "include/itemListView.php"; ?>
                </div>
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
        
        // 버튼 클릭 시 맨 위로 이동
        $("#cateBtn").on("click", function() {
            location.href = "mainCate.php";
        });
        
        $(document).not(".search-div").click(function() {
            $(".search-div").addClass("d-none");
        });
    });
    $(document).on("click","#clear",function(){
        $.ajax({
            url: "include/itemListView.php",
            type: "POST",
            data: "search=clear",
            success: function (data) {
                $(".searchInput").val("");
                $("#searchMap").addClass("d-none");
                $("#clear").addClass("d-none");
                $(".itemListView").html(data);
            }
        });
    });
    $(document).on("click","#cateBtn",function(){
        location.href = "mainCate.php";
    });
    
    $(document).on("click","#search",function(){
        // alert("여행지를 선택해주세요");
        if($(".searchInput").val()!=""){
            $.ajax({
                url: "include/itemListView.php",
                type: "POST",
                data: "search=ajax&searchCountry="+$(".searchInput").val(),
                success: function (data) {
                    $("#searchMap").removeClass("d-none")
                    $("#clear").removeClass("d-none");
                    $(".itemListView").html(data);
                }
            });
        }else{
            alert("여행지를 선택해주세요");
        }
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