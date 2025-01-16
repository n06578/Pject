<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box h-90 d-none">
    <div class="p-0 m-0 h-100">
        <div class="row h-100">
            <div class="sub-col mb-2">
                <aside class="side-bar list1">
                    <ul><li><a href="#">인기</a></li></ul>
                </aside>
                <aside class="side-bar list2">
                    <ul><li><a href="#">추천</a></li></ul>
                </aside>
                <aside class="side-bar list3">
                    <ul><li><a href="#">찜</a></li></ul>
                </aside>
                <aside class="side-bar list4">
                    <ul><li><a href="#">관련인</a></li></ul>
                </aside>
            </div>
            <div class="contents-col col ml-2 p-4 pt-2 text-lg" id="mainCardDiv">
                <table class="table px-5 mt-2">
                    <tr>
                        <td class="w-10 text-blg text-right">여행지</td>
                        <td class="w-80"><input type="text" class="form-control mr-4"></td>
                        <td class="w-20"><input type="button" class="btn btn-secondary mr-4 text-blg" value="조회"></td>
                    </tr>
                </table>
                    <!-- <div class="row px-5 mt-2 text-blg w-100 d-ruby">
                        여행지 
                        <input type="text" class="form-control mr-4">
                        <input type="button" class="btn mr-4" value="조회">
                    </div> -->
                    <hr>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
