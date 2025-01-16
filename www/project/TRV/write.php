<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <form id="myTripFrm">
            <table class="table noTable">
                <tr>
                    <td class="w-10 text-blg text-right t-navy txt-18" id="tripArea">여행지</td>
                    <td class="w-75"><input type="text" class="form-control noBorder mr-4"></td>
                    <td class="w-15"><input type="button" class="btn btn-white mr-4 w-100 text-blg t-navy" id="searchMap" value="지도에서 찾기"></td>
                    <td class="w-10"><input type="button" class="btn btn-navy w-100 mr-4 text-blg t-white" id="search" value="조회"></td>
                </tr>
            </table>
            <hr class="hr-navy">
            <div class="mx-5">
                <input type="text" class="form-control noBorder mr-4" placeholder="내용을 입력하세요">
                <br>
                <input type="file" name="upimg" id="upimg" accept="image/*,application/pdf" class="form-control noBorder mb-2">
                <span id="currImg"></span>
            </div>
        </form>     
    </div>
</div>
<div class="text-center" id="saveBtn"><i class="fas fa-pen"></i> 올리기</div>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
$("#saveBtn").click(function() {
    $("#myTripFrm").ajaxSubmit({
        url: 'ajax/myTripSave.php',
        type: 'post',
        success : function(val){
            mobiscroll.toast({
                message: "저장되었습니다.",
                display: "center",
                color: "gray",
                closeButton: true
            });
            setTimeout(function() {
                location.href='myHome.php';
            }, 1000);
        }
    });
});
										
window.onload = function() {
	var fileInput = document.getElementById('upimg');
	var fileDisplayArea = document.getElementById('currImg');
	fileInput.addEventListener('change', function(e) {
		var file = fileInput.files[0];
		var imageType = /image.*/;

		if (file.type.match(imageType)) {
			var reader = new FileReader();

			reader.onload = function(e) {
				fileDisplayArea.innerHTML = "";

				var img = new Image();
				img.src = reader.result;
				img.style.width = '260px';   //이미지 width
				
				fileDisplayArea.appendChild(img);
			}

			reader.readAsDataURL(file);
		}
	});
}
</script>