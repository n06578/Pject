<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <table class="table noTable">
            <tr>
                <td class="w-15 text-blg text-right t-navy txt-17 pt-3" id="tripArea">소통창고</td>
                <td><input type="text" class="form-control noBorder mr-4"></td>
                <td class="w-10"><input type="button" class="btn btn-navy w-100 mr-4 text-blg t-white" id="search" value="검색"></td>
            </tr>
        </table>
        <hr class="hr-navy">
        <div class="card mx-5">
            <table class="table table-border table-hover">
                <thead>
                    <tr class="text-center">
                        <td class="w-10">No.</td>
                        <td>소통창고 제목</td>
                        <td class="w-15">등록일시</td>
                        <td class="w-15">작성자</td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="c-pointer">
                        <td class="text-center">1</td>
                        <td>2</td>
                        <td class="text-center">3</td>
                        <td class="text-center">4</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center" id="writeBtn" onclick="location.href='commuWrite.php'"><i class="fas fa-pen"></i> 작성하기</div>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
</script>